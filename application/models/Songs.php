<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Songs
 *
 * @author alumno
 */
class Songs extends CI_Model {
    private $username;
    private $idPais;
    private $year;
    private $name;
    private $author;
    private $video;
    private $finalista;
    private $idSong;
    private $body = Body;
    
    public function Songs() { 
        $this->username = $this->session->userdata('username');
    }
    
    public function setSong($idPais,$year,$name,$author,$video,$finalista) {
        $this->year = $year;
        $this->idPais = $idPais;
        $this->name = $name;
        $this->author = $author;
        $this->finalista = $this->checkIfFinalista($finalista);
        $this->video = $this->getEmbedVideo($video);
    }
    
    private function checkIfFinalista($f) {
        /*if ($f == "on") {
            return "F";
        } else {
            return "";
        }*/
        return "";
    }


    public function saveSong() {
        $a = $this->checkIfExist();
        if ($a == false) {
            $query = $this->db->query('INSERT INTO canciones(nombre,interprete,enlace,idPais,estado,agno) VALUES ("'.$this->name.'", "'.$this->author.'", "'.$this->video.'", '.$this->idPais.', "'.$this->finalista.'", "'.$this->year.'")'); 
            return $this->db->insert_id();
        } else {
            //$query = $this->db->query('UPDATE canciones SET nombre = "'.$this->name.'", interprete = "'.$this->author.'",enlace = "'.$this->video.'" where idCancion = '.$a.''); 
            return $a;
        }
        
        
        
    }
    
    private function checkIfExist() {
        $que = $this->db->query('SELECT * FROM canciones WHERE agno = "'.$this->year.'" AND idPais="'.$this->idPais.'"');
        if ($que->num_rows() > 0) {
            $result = $que->result();
            var_dump($result);
            return $result[0]->idCancion;
        }
        else {
            return false;
            
        }
    }
    
    
    
    private function getEmbedVideo($video) {
        $idVideo = substr($video, 32);
        $string = "https://www.youtube.com/embed/".$idVideo;
        return $string;
    }
    
    public function getYears() {
        $query = $this->db->query('SELECT distinct agno FROM canciones');
        if($query->num_rows() > 0){
            return $query->result();
        }
    }
    
    public function getSongsByYear(){
        $query = $this->db->query('SELECT idCancion, canciones.idPais, canciones.nombre as nombreCan,  paises.nombre as nombrePa, path, interprete,enlace FROM canciones left join paises on(canciones.idPais = paises.idPais) where agno="'.$this->year.'"');
        if($query->num_rows() > 0){
            return $query->result();
        }
    }
    
    public function getSongsById($id){
        $query = $this->db->query('SELECT * FROM canciones where idCancion='.$id.'');
        if($query->num_rows() > 0){
            return $query->result();
        }
    }
    
    public function getSongsRandom() {
        $query = $this->db->query('SELECT * FROM canciones ORDER BY RAND() limit 10');
        if($query->num_rows() > 0){
            return $query->result();
        }
    }
    
    
    public function printSongsByYear($year) {
        $this->year = $year;
        $results = $this->getSongsByYear();
        if ($results) {
            foreach ($results as $rows) {
                ?>
                    <div class="col-md-2" data-year="<?php echo $this->year;?>"><?php echo $rows->nombreCan;?></div>
                <?php
            }
                
        }
    }
    
    private function getSongDataByCountry() {
        $query = $this->db->query('SELECT * FROM canciones where idPais="'.$this->idPais.'" and agno="'.$this->year.'"');
        if($query->num_rows() > 0){
            return $query->result();
        }
    }
    
    public function songDataByCountry($idPais, $year) {
        $this->idPais = $idPais;
        $this->year = $year;
        $results = $this->getSongDataByCountry();
        if ($results) {
            $this->idSong = $results[0]->idCancion;
            $song = new Body();
            $song->songPuntStructure($results[0]->nombre, $results[0]->interprete, $results[0]->enlace);
                
            
        }    
    }  
    
    public function printSongs($year) {
        $this->year = $year;
        $results = $this->getSongsByYear();
        if ($results) {
            foreach ($results as $rows) {
                $body = new Body();
                $body->listSongStructure($rows->nombreCan, $rows->interprete, $rows->enlace, $rows->nombrePa, $this->year, $rows->path);
            }
        }
       
    }
    public function test() {
        ?>
            <div class="col-md-8 container card bg-faded" style="height:100%;margin-top:15px">
                <div class="row justify-content-md-center">
                <h3 class="col-md-6" style="text-align: center;padding: 20px">¡Antes de puntuar, escucha estas canciones!</h3>
                </div>
                <div class="row justify-content-md-center" style="overflow-y: auto;">
                    <?php
                        $q = $this->getSongsRandom(); 
                        if ($q != null) {
                            foreach ($q as $raw) {
                                $idY = substr($raw->enlace, 30);
                                ?>  
                                    
                                    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12" style="margin: 10px;">
                                        <div class="hovereffect">
                                            <?php
                                                if ($raw->agno >= 2016) {
                                                    ?>
                                                        <img class="img-fluid p" src="https://img.youtube.com/vi/<?php echo $idY;?>/maxresdefault.jpg" alt="">
                                                    <?php
                                                }else {
                                                    ?>
                                                        <img class="img-fluid p" src="resources/themes/default/img/jklio.png" alt="">
                                                    <?php
                                                }
                                            ?>
                                                        
                                            <div class="overlay getid" >
                                                <p class="justify-content-md-center" style="margin-top: -5px">
                                                    <h2 style="margin-top: -45px"><?php echo $raw->nombre?></h2>
                                                    <div class="float-center replay" 
                                                          data-id="<?php echo $raw->idCancion;?>" 
                                                          data-enlace="<?php echo $raw->enlace;?>" 
                                                          data-name="<?php echo $raw->nombre.' - '.$raw->interprete;?>" style="text-align: center">
                                                        <i class="fa fa-play" aria-hidden="true" style="font-size:35px"></i>
                                                    </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        <?php
    }
    
    public function getSongYear() {
        return $this->year;
        
    }
    public function getSongId() {
        return $this->idSong;
    }
    private function setBody() {
         $this->body = new Body();
    }
}
