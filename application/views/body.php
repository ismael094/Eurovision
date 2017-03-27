<?php
    error_reporting(0);
    $user =$this->session->userdata('username');
    if ($_GET['top'] != null) {
        $body->createDiv(8,2,"well",false);
        $body->printH(2,"Top10 Eurovision 2017",'text-align: center');
        $body->endDiv();
        $body->createDiv(8,2,"well row",false);
        $body->createDivClass("topSongContainer");
        $top->setYear($_GET['year']);
        $top->generatePosition();
        $body->endDiv();
        $body->printModal("");
        $body->printModal("1");
        $body->createInput("hidden","",$_GET['year'],"year");
        $body->endDiv();
    } elseif ($_GET['add'] != null && $this->session->userdata('level') == "Administrador") {
        $body->createDiv(2,1,"paisCon",false);
        $paises->getPaises();
        $body->endDiv();
        $body->printFormAddSong();
    } elseif (($_GET['y'] != null) && ($_GET['puntuar'] == 'true') && $user != null) {
        $body->createDiv(2,1,"paisCon",false);
        $paises->getPaisesSongsByYear($_GET['y']);
        $body->endDiv();
        $body->printBeginSetPuntuaciones();  
        
    } elseif ($_GET['y'] != null && $user != null) {
        $body->createMainDiv();
        $body->verPuntuaciones();
        ?>
            <?=$footerHtml;?>
        <?php
    } elseif ($_GET['c'] != null) {
        $body->createDiv(8,2,"well showCan",false);
        $songs->printSongs($_GET['c']);
        $body->endDiv();
        $body->printModal("");
        $body->printScripts();
        ?>
            <?=$footerHtml;?>
        <?php
    } else {
        $body->defaults();
    }