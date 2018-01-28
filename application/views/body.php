<?php
    error_reporting(0);
    $user =$this->session->userdata('username');
    $date = date('Y-m-d H:i:s');
    if ($_GET['reg'] != null && $user == null) {
        $log->reg();
    } else if ($_GET['complete'] != null || $this->session->userdata('state') == "CHANGE") {
        $log->complete();
    } else if ($_GET['change'] != null ) {
        $log->change();
    } else if ($_GET['top'] != null) {
        ?>
            <div class="container card bg-faded" style="margin-top:10px;height: calc(100% - 86px);overflow-y: auto">
        <?php
        $body->printH(2,"Top10 Eurovision 2017",'text-align: center');
        $body->createDivClass("topSongContainer");
        $top->setYear($_GET['year']);
        $top->generatePosition();
        $body->endDiv();
        $body->printModal("");
        $body->printModal("1");
        $body->createInput("hidden","",$_GET['year'],"year");
        $body->endDiv();
        $body->endDiv();
        //sss
    } elseif ($_GET['add'] != null && ($this->session->userdata('level') == "Administrador" || $this->session->userdata('level') == "REDACTOR")) {
        ?>
            <div class="container" style="margin-top:15px">
        <?php
        $body->createDivClass("row");
        $body->createDiv(3,1,"paisCon",false);
        $paises->addForm();
        $body->createDivClass("lop");
        $paises->getPaises();
        $body->endDiv();
        $body->endDiv();
        $body->createDivClass("col-md-9 ronaldo");
        $body->printFormAddSong();
        $body->endDiv();
        $body->endDiv();
        $body->endDiv();
        //&& $date < config_item("closeDate")
    } elseif (($_GET['y'] != null) && ($_GET['puntuar'] == 'true') && $user != null && $date > config_item("closeDate")) {
        /*$body->createDiv(2,1,"paisCon",false);
        $paises->getPaisesSongsByYear($_GET['y']);
        $body->endDiv();*/
        $body->printBeginSetPuntuaciones();  
        
    } elseif ($_GET['y'] != null && $user != null) {
        $body->createDivClass("container");
        
        $body->verPuntuaciones();
        $body->endDiv();
        
    } elseif ($_GET['c'] != null) {
        $body->createDiv(8,2,"well showCan",false);
        $songs->printSongs($_GET['c']);
        $body->endDiv();
        $body->printModal("");
        $body->printScripts();
        ?>
            <?=$footerHtml;?>
        <?php
    } elseif ($_GET['mySongs'] != null) {
        $body->createDivClass("");
        
        $body->createDivClass("misCanc");
        $mySongs->test();
        
        $body->endDiv();
        $body->printModal("");
        $body->endDiv();
    } else if ($user != null) {
        $body->createDivClass("");
        
        $body->createDivClass("misCancs");
        $songs->test();
        
        $body->endDiv();
        $body->printModal("");
        $body->endDiv();
        ?>
            <video autoplay loop muted poster="screenshot.jpg" id="background">
                <source src="https://media.giphy.com/media/xThta6fNHqrtqRqxmE/source.mp4" type="video/mp4">
            </video>
        <?php
    } else {
        $log->p();
        
    }