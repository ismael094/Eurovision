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
    private $idPais;
    private $year;
    private $name;
    private $author;
    private $video;
    private $finalista;
    private $idSong;
    private $body = Body;
    
    public function Songs() { 
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
        if (!$this->checkIfExist()) {
            $query = $this->db->query('INSERT INTO canciones(nombre,interprete,enlace,idPais,estado,agno) VALUES ("'.$this->name.'", "'.$this->author.'", "'.$this->video.'", '.$this->idPais.', "'.$this->finalista.'", "'.$this->year.'")'); 
            //$query = $this->db->query('UPDATE canciones SET nombre = "'.$this->name.'", interprete = "'.$this->author.'",enlace = "'.$this->video.'" where nombreUsuario = "'.$this->username.'" and idCancion = '.$idSong.''); 
        }
        
        
    }
    
    private function checkIfExist() {
        $que = $this->db->query('SELECT * FROM canciones WHERE nombre="'.$this->name.'" AND interprete="'.$this->author.'" AND agno = "'.$this->year.'" AND idPais="'.$this->idPais.'"');
        if ($que->num_rows() > 0) {
            return true;
        }
        else {  
            return false;
            
        };
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
