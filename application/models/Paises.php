<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Paises
 *
 * @author alumno
 */
class Paises extends CI_Model {
    private $classAux;
    private $year;
    function __construct() {        
        parent::__construct();
    } 
    public function getPaises() {
        $this->classAux = "addSongs";
        $this->getResult($this->db->query('SELECT paises.idPais, paises.nombre FROM paises order by paises.idPais'));
    }
    
    public function getPaisesSongsByYear($year) {
        $this->year = $year;
        $this->classAux = "paises";
        $this->getResult($this->db->query('SELECT paises.idPais, paises.nombre FROM paises left join canciones on (paises.idPais = canciones.idPais) where canciones.agno = "'.$this->year.'" order by paises.idPais'));
    }
    private function getResult($query) {
        if ($query->num_rows() > 0) {
            $this->getQueryResult($query->result());
        }
    }
    private function getQueryResult($query) {
        $a = 0;
        foreach ($query as $rows) {
            echo "<div class='col-md-12 " .$this->classAux. " well' data-year='".$this->year."' data-id='".$rows->idPais."' data-num='".$a++."'>".$rows->nombre."</div>";  
        }
    }
    
}
