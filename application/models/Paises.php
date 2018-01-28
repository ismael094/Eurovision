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
    
    public function getPais($name) {
        return $this->db->query('SELECT paises.idPais, paises.nombre,paises.path FROM paises where nombre="'.$name.'"');
    }
    
    public function getPaises() {
        $this->classAux = "addSongs";
        $this->getResult($this->db->query('SELECT paises.idPais, paises.nombre,paises.path FROM paises order by paises.idPais'));
    }
    
    public function createPais($name) {
        $this->db->query('INSERT INTO paises(nombre) VALUES ("'.$name.'")');
    }
    
    public function getPaisesSongsByYear($year) {
        $this->year = $year;
        $this->classAux = "paises";
        $this->getResult($this->db->query('SELECT paises.idPais, paises.nombre,paises.path FROM paises left join canciones on (paises.idPais = canciones.idPais) where canciones.agno = "'.$this->year.'" order by paises.idPais'));
    }
    private function getResult($query) {
        if ($query->num_rows() > 0) {
            $this->getQueryResult($query->result());
        }
    }
    private function getQueryResult($query) {
        $a = 0;
        foreach ($query as $rows) {
            echo "<div class='" .$this->classAux. "' data-year='".$this->year."' data-id='".$rows->idPais."' data-num='".$a++."'>";
            ?>
                <div class="type-1">
                    <div>
                        <div class="hovDiv btn btn-2 col-md-12">
                            <span class="txt"><?php echo $rows->nombre;?></span>
                            <span class="round">
                                <h5 style="overflow: hidden;height:  100%;margin-top:-10px"><span style="margin-top:-10px;margin-left:1px;" class="flag-icon flag-icon-<?php echo $rows->path;?> alexis"></span></h5>
                            
                            </span>
                        </div>
                    </div>
                </div>
            <?php
                    echo "</div>";  
        }
    }
    
    public function addForm() {
        ?>
            <input type="text" class="input100" id="addPais" style="margin-bottom:10px;">
        <?php
    }
}
