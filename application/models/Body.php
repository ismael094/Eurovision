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
    
    function __construct($year="") {        
        parent::__construct();
        $this->year = $year;
    } 
    function Body($year="") {   
        $this->year = $year;
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
                <div id="dyTable">
                    <?php 
                        $punt = new Puntuaciones($_GET['y']);
                        $punt->printPuntuacionesBy('ind');
                    ?>
                </div>
        <?php
            $this->endDiv();
            $this->printModal("");
            $this->printModal("1");
            $this->createInput("hidden","",$_GET['y'],"puntYear");
            $this->printScripts();
        

    }
    public function endPuntuaciones() {
        $this->createDiv(8,2,"well",false);
        $this->printImage("resources/themes/default/img/wer.jpg");
        $this->endDiv();
        $this->createDiv(8,2,"well",false);
        $this->printH(2,"Has acabado de puntuar las canciones","text-align: center");
        $this->endDiv();
        $this->createDivClass("col-md-8 col-md-offset-2 well","",'style="text-align: center"');
        ?>
            <button class="btn btn-default"><a href="index.php?y=<?php echo $this->year;?>">Ver mis puntuaciones</a></button>
        <?php
        $this->endDiv();
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
            <div class="modal fade" id="myModal<?php echo $num;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
        <?php
    }
    
    public function printBeginSetPuntuaciones() {
        ?>
            <div id="dataSong" class="col-md-8 well row">
                <div class="col-md-8 col-md-offset-2 well">
                   <?php
                        $this->printImage(config_item('imageSetPunt'));
                   ?>
                </div>
                <div class="col-md-8 col-md-offset-2 well">
                    <h2 style="text-align: center">Puntuaciones Eurovision Song Contest 2016</h2>
                </div>
                <div class="col-md-8 col-md-offset-2 well"  style="text-align: center">
                    <button class="btn btn-default buttonSong2" data-num="0">COMENZAR</button>
                </div>
            </div>
        <?php
    } 
    
    public function printSetPuntuaciones($array) {
        $this->printSetPuntHead();
        $this->createElement('tr class="aa"');
        $this->createElement('td');
        $this->createInput("number", "form-control", $array[0], "puntVoz");
        $this->endElement("td");
        $this->createElement('td');
        $this->createInput("number", "form-control", $array[1], "puntCan");
        $this->createInput("hidden", "form-control", $array[2], "year");
        $this->endElement("td");
        $this->endElement("tr");
        $this->endElement("table");
        $this->endElement("form");
        $this->endDiv();
        $this->createDivClass("col-md-12", "",'style="margin-top:20px"');
        $this->printH(5, "Comentario: ", "");
        $this->createElement('textarea rows="10" name="comment" id="comment"');
        $this->printText($array[3]);
        $this->endElement("textarea");
        $this->endDiv();
        $this->createDivClass("col-md-2 col-md-offset-9", "",'style="margin-top:20px"');
        ?>
            <button class="btn btn-default buttonSong" data-id="<?php echo $array[4];?>" data-num="<?php if ($array[5] > 0) {echo $array[5]-1;} else echo $array[5];?>">Anterior</button>
            <button class="btn btn-default buttonSong" data-id="<?php echo $array[4];?>" data-num="<?php echo $array[5]+1;?>">Siguiente</button>
        <?php
        $this->endDiv();
    }
    
    public function printSetPuntHead() {
        $this->createDivClass("col-md-4", "",'style="margin-bottom:10px"');
        $this->createElement("form");
        $this->createElement('table class="table table-bordered puntajes"');
        $this->createElement('tr');
        $this->createElement('th colspan="2" style="text-align: center"');
        $this->printText("Puntuaciones");
        $this->endElement("th");
        $this->endElement("tr");
        $this->createElement('tr');
        $this->createElement('th style="text-align: center"');
        $this->printText("Voz");
        $this->endElement("th");
        $this->createElement('th style="text-align: center"');
        $this->printText("Canción");
        $this->endElement("th");
        $this->endElement("tr");
    }
    
    public function printImage($url,$class="") {
        ?>
            <img src="<?php echo $url;?>" class="img-responsive <?php echo $class;?>"/>
        <?php
    }
    
    public function songPuntStructure($nombre,$interprete,$enlace) {
        ?>
            <div class="col-md-12  col-xs-12">
                <h3><?php echo $nombre;?> - <?php echo $interprete;?></h3>
            </div>
            <div class="col-md-8">
                <iframe class="col-md-12" height="315" src="<?php echo $enlace;?>"frameborder="0" allowfullscreen>'
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
            <div id="dataSongssss" class="col-md-8 well row">
                <?php 
                    $this->createDiv(8,2,"well",false);
                    $this->formAddSongInput("text","Nombre","addSongName");
                    $this->formAddSongInput("text","Intérprete","addSongAuthor");
                    $this->formAddSongInput("number","Año","addSongAgno");
                    $this->formAddSongInput("text","Enlace vídeo","addSongEnlace");
                ?>
                    <div class="checkbox">
                        <label>
                          <input type="checkbox" id="submitAddFinal"> Finalista directa
                        </label>
                    </div>
                    <input type="hidden" class="form-control" id="addSongNum" value="">
                    <button class="btn btn-default  submitAddSong">Añadir</button>
                </div>
            </div>
            <div id="pruebaaa" class="col-md-8 well row"></div>
            
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
            <div class="row well">
                <div class="col-md-2">
                    <span>Puesto <?php echo $num;?></span>
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
        
        if ($this->date > '2016-05-14 08:30:00') {
            $this->topButton($num-1,"disabled");
        } else {
            $this->topButton($num-1,"");
        }
        ?>
            </div>
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
