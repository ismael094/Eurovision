<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of body
 *
 * @author alumno
 */
error_reporting(0);
class Body extends CI_Model{
    private $year;
    private $date;
    
    function __construct($year="") {        
        parent::__construct();
        $this->year = $year;
        $this->date = date('Y-m-d H:i:s');
    } 
    function Body($year="") {   
        $this->year = $year;
        $this->date = date('Y-m-d H:i:s');
    } 
    public function createElement($element) {
        ?>
            <<?php echo $element;?>>
        <?php
    }
    public function endElement($element) {
        ?>
            </<?php echo $element;?>>
        <?php
    }
    public function createDivClass($class,$id,$data="") {
        ?>
            <div class="<?php echo $class;?>" id="<?php echo $id;?>" <?php echo $data;?>>
        <?php
    }
    public function printText($text) {
        ?>
            <?php echo $text;?>
        <?php
    }
    
    public function createDivWithContent($class,$id,$content,$data="") {
        $this->createDivClass($class,$id,$data);
        echo $content;
    }

    public function createDiv($md,$offset,$class,$end){
        ?>
            <div class="col-md-<?php echo $md;?> col-md-offset-<?php echo $offset . ' '. $class;?>">
        <?php
            if ($end) {
                echo "</div>";
            }
    }
    public function endDiv() {
        ?>
            </div>
        <?php
    }
    public function createMainDiv() {
        ?>
            <div class="col-md-8 col-md-offset-2 well">
        <?php
    }

    public function defaults() {
        $this->createMainDiv();
        $this->printH(1,"Bienvenidos a Eurovision Song Contest 2017",'style="text-align:center"');
    }
    
    public function verPuntuaciones() {
        $nav = new Nav();
        $nav->printNavPunt();
        ?>
            <div class="row" style="margin-top:10px">
                <div class="col card bg-faded">
                    <div id="dyTable" style="padding-top:20px" class="test1">
                        <?php 
                            $punt = new Puntuaciones($_GET['y']);
                            $punt->printPuntuacionesBy('ind','punt');
                        ?>
                    </div>
                </div>
            </div>
        <?php
            $this->printModal("");
            $this->printModal("1");
            $this->createInput("hidden","",$_GET['y'],"puntYear");
        

    }
    public function endPuntuaciones() {
        
        ?>
                    <div id="dataSong" class="container" style="margin-bottom:50px">
                        <div class="row justify-content-md-center">
                            <h2 style="text-align: center;margin-top: 50px;margin-bottom: 50px">Puntuaciones Eurovision Song Contest 2018</h2>
                        </div>  
                        <div class="row justify-content-md-center">
                            <div class="col-md-10">
                                <?php $this->printImage(config_item('imageSetPunt')); ?>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                                <button style="text-align: center;margin: 0 auto;margin-top:50px;width: 190px;" class="btn btn-default buttonStyle col-md-4">
                                    <a href="index.php?y=<?php echo $this->year;?>" style="text-decoration:none;color:white">Ver mis puntuaciones</a>
                                </button>
                        </div>
                    </div>
                
        <?php
    }
    
    public function printH($h,$cont,$style) {
        ?>
            <h<?php echo $h;?> style="<?php echo $style;?>"><?php echo $cont;?></h<?php echo $h;?>>
        <?php
    }
    
    public function printScripts() {
        ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="<?php echo base_url().config_item('themePath').config_item('themeName');?>js/jquery.dynatable.js" ></script>
            <script type="text/javascript" src="resources/themes/default/js/jquery.mobile-events.min.js"></script>
            <script>
                $(document).ready(function () {    
                    $('#my-table').dynatable();
                })
            </script>
            <script src="resources/themes/default/js/bootstrap.min.js"></script>
            <script src="resources/themes/default/js//ajaxRequest.js" ></script>
        <?php
    }
    public function printModal($num) {
        ?>
            <div class="modal h-100" id="myModal<?php echo $num;?>" tabindex="-5" role="dialog" aria-labelledby="examplemyModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    </div>
                </div>  
            </div>
        <?php
    }
    
    public function printBeginSetPuntuaciones() {
        ?>
            <div class="container" style="margin-top:15px;margin-bottom: 15px;">
                <div class="row">
                    <div class="paisCon col-md-3 ">
                        <?php $j = new Paises(); $j->getPaisesSongsByYear(2017);?>
                    </div>
                    <div id="dataSong" class="col col-md-9 card bg-faded row" style="margin:0px">
                            <h2 style="text-align: center;margin-top: 50px;margin-bottom: 50px">Puntuaciones Eurovision Song Contest 2018</h2>
                            <?php $this->printImage(config_item('imageSetPunt')); ?>
                            <button style="text-align: center;margin: 0 auto;margin-top:50px;margin-bottom:20px;width: 150px;" class="btn btn-default buttonSong2 buttonStyle" data-num="0">COMENZAR</button>
                        
                            
                        
                    </div>
                </div>
            </div>
        <?php
    } 
    
    public function printSetPuntuaciones($array) {
        $this->printSetPuntHead();
        $this->createElement('tr class="aa" style="background-color:#aadca3"');
        $this->createElement('td');
        $this->createDivClass("wrap-input100", "", '');
        $this->createInput("number", "form-control input100", $array[0], "puntVoz");
        $this->createElement('span class="focus-input100"');
        $this->endElement("span");
        ?>
            <span class="symbol-input100">
                <i class="fa fa-microphone" aria-hidden="true"></i>
            </span>
            <?php
        $this->endDiv(); 
        $this->endElement("span");
        $this->endElement("td");
        $this->createElement('td');
        $this->createDivClass("wrap-input100", "", '');
        $this->createInput("number", "form-control input100", $array[1], "puntCan");
        $this->createElement('span class="focus-input100"');
        $this->endElement("span");
        ?>
            <span class="symbol-input100">
                <i class="fa fa-music" aria-hidden="true"></i>
            </span>
            <?php
        $this->endDiv(); 
        $this->createInput("hidden", "form-control", $array[3], "year");
        $this->endElement("td");
        $this->createElement('td');
        $this->createDivClass("wrap-input100", "", '');
        $this->createInput("number", "form-control input100", $array[2], "puntEsc");
        $this->createElement('span class="focus-input100"');
        $this->endElement("span");
        ?>
            <span class="symbol-input100">
                <i class="fa fa-video-camera" aria-hidden="true"></i>
            </span>
            <?php
        $this->endDiv();    
        $this->endElement("td");
        $this->createElement('td style="text-align:center"');
        $a = new MisCanciones();
        ?>
            <i  class="fa fa-6 fa-thumbs-up <?php if ($a->select($array[5])) { echo "nlike";} else {echo "like";} ?>" data-id="<?php echo $array[5];?>" aria-hidden="true" style="font-size: 30px;margin-top:7px"></i>
            <?php   
        $this->endElement("td");
        $this->endElement("tr");
        $this->endElement("table");
        $this->endElement("form");
        $this->endDiv();
        $this->endDiv();
        $this->createDivClass("row justify-content-md-center", "", 'style="margin-top:0px"');
        $this->createDivClass("col-md-9", "",'');
        $this->printH(5, "Comentario: ", "");
        $this->createElement('textarea rows="5" name="comment" id="comment"');
        $this->printText($array[4]);
        $this->endElement("textarea");
        $this->endDiv();
        $this->endDiv();
        $this->createDivClass("row justify-content-md-center", "", 'style="margin-top:0px"');
        $this->createDivClass("col-md-8", "",'style="margin-top:20px"');
        ?>
            <div class="row justify-content-md-center">
                <button class="btn btn-default buttonSong buttonStyle col-md-3" data-id="<?php echo $array[5];?>" data-num="<?php if ($array[6] > 0) {echo $array[5]-1;} else echo $array[5];?>">Anterior</button>
                <button class="btn btn-default buttonSong buttonStyle col-md-3" data-id="<?php echo $array[5];?>" data-num="<?php echo $array[6]+1;?>">Siguiente</button>
            </div>
        <?php
        $this->endDiv();
        $this->endDiv();
        $this->endDiv();
    }
    
    public function printSetPuntHead() {
        $this->createDivClass("row justify-content-md-center", "", 'style="margin-top:30px"');
        $this->createDivClass("col-md-9", "",'style="margin-bottom:10px"');
        $this->createElement("form");
        $this->createElement('table class="table puntajes"');
        
        $this->createElement('tr class="thead-default" style=""');
        $this->createElement('th style="text-align: center;background-color:#57b846"');
        $this->printText("Voz");
        $this->endElement("th");
        $this->createElement('th style="text-align: center;background-color:#57b846"');
        $this->printText("Canción");
        $this->endElement("th");
        $this->createElement('th style="text-align: center;background-color:#57b846"');
        $this->printText("Puesta en escena");
        $this->endElement("th");
        $this->endElement("th");
        $this->createElement('th style="text-align: center;background-color:#57b846"');
        $this->printText("");
        $this->endElement("th");
        $this->endElement("tr");
    }
    
    public function printImage($url,$class="") {
        ?>
            <img src="<?php echo $url;?>" class="img-fluid col <?php echo $class;?>"/>
        <?php
    }
    
    public function songPuntStructure($nombre,$interprete,$enlace) {
        ?>
            <div class="row justify-content-md-center">
                <h2 style="margin:20px"><?php echo $nombre;?> - <?php echo $interprete;?></h2>
            </div>
            <div class="row justify-content-md-center">
                <iframe class="col-md-9" height="250" src="<?php echo $enlace;?>"frameborder="0" allowfullscreen>'
                </iframe>
            </div>
        <?php
    }
    
    
    
    public function listSongStructure($nombre,$interprete,$enlace,$pais,$year,$path) {
        ?>
            <div class="media dyCo" data-name="<?php echo $nombre;?> - <?php echo $interprete;?>" data-enlace="<?php echo $enlace;?>">
                <div class="media-left media-middle">
                    <a href="#">
                        <img class="media-object imgs" src="<?php echo base_url().config_item('themePath').config_item('themeName').'/Eurovision/'.$pais.'/'.$year.'/'.$path;?>.png" alt="<?php echo $nombre;?>">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $nombre;?></h4>
                        <?php echo $pais;?> - <?php echo $nombre;?>
                </div>
            </div>
        <?php      
    }
    
    public function printFormAddSong() {
        ?>
            <link rel="stylesheet" type="text/css" href="resources/themes/default/css/d.css">
            <div class="col-md-12 card bg-faded" id="dataSongssss">
                <div class="limiter">
                <div class="container-login100">

                    <div class="wrap-login100" style="margin:0 auto">
                        <span class="login100-form-title" style="margin-top:-100px;font-size: 40px">
                            Añadir canciones
                        </span>
                        
                        <div class="needed login100-form validate-form"   style="margin:0 auto">  
                        <span class="login100-form-title">
                                    Nueva canción
                            </span>

                            <div class="wrap-input100 validate-input" data-validate = "Yes sir I can">
                                <input class="input100" type="text" id="addSongName" placeholder="Nombre de la canción">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                            
                            <div class="wrap-input100 validate-input" data-validate = "Ejemplo: Ed Sheeran">
                                <input class="input100" type="text" id="addSongAuthor" placeholder="Interprete">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Año de la canción">
                                <input class="input100" type="number" id="addSongAgno" placeholder="Año">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            
                            <div class="wrap-input100 validate-input" data-validate = "Enlace vídeo youtube">
                                <input class="input100" type="text" id="addSongEnlace" placeholder="Enlace">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            
                            <div class="wrap-input100 validate-input" data-validate = "Enlace vídeo youtube">
                                <input type="checkbox" id="submitAddFinal" placeholder="Finalista directa"> Finalista directa
                            </div>

                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn submitAddSong">
                                    Añadir
                                </button>
                            </div>
                            <input type="hidden" value="" id="addSongNum"/>
                        
                        </div>
                    </div>
                </div>
            </div>
            <div id="pruebaaa" class="col-md-8 well row"></div>
            </div>
        <?php

    }
    
    public function formAddSongInput($type,$place,$id) {
        ?>
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $place;?></label>
                <input type="<?php echo $type;?>" class="form-control" id="<?php echo $id;?>" >
            </div>
        <?php
    }
    
    public function topStructure($num,$nombre,$interprete,$nombrePa,$has) {
        ?>
                    <div class="col-md-2">
                        <span><?php echo $num;?>º Puesto</span>
                        <?php
                            if ($has) {
                                ?>
                                    <input type="hidden" id="<?php echo $num-1;?>" />
                                <?php
                            }
                        ?>
                    </div>
                    <div class="col-md-2">
                        <span><?php echo $nombre;?></span>    
                    </div>
                    <div class="col-md-2">
                        <span><?php echo $interprete;?></span>    
                    </div>
                    <div class="col-md-3">
                        <span><?php echo $nombrePa;?></span>    
                    </div>
                
                    <?php
                        if ($this->date > config_item("closeDate")) {
                            $this->topButton($num-1,"disabled");
                        } else {
                            $this->topButton($num-1,"");
                        }
                    ?>
        <?php 
    }
    
    public function topButton($puesto,$state) {
        ?>
            <div class="col-md-3 modelTopSongs">
                <button class="btn btn-default topButton"  data-puesto="<?php echo $puesto;?>" <?php echo $state;?>>Seleccionar</button>
            </div>
        <?php
    }
    
    public function createInput($type,$class,$value,$id) {
        ?>
            <input type="<?php echo $type;?>" class="<?php echo $class;?>" id="<?php echo $id;?>" value="<?php echo $value;?>"/>
        <?php
    }
    
}
