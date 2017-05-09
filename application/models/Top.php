<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Top
 *
 * @author alumno
 */
class Top extends CI_Model {
    private $username;
    private $puesto;
    private $agno;
    private $idCancion;
    private $idAux;
    private $idAux2;
    private $error;
    private $date;
    private $query;
    
    
    public function Top() {
        $this->date = date('Y-m-d h:i:s');
    }
    
    private function updateQuery() {
        $query = $this->db->query('UPDATE top_usuarios SET idCancion = '.$this->idCancion.' where idTopUsu = '.$this->idAux.'');
    }
    
    private function insertQuery() {
        $query = $this->db->query('INSERT INTO top_usuarios(nombreUsuario,puesto,idCancion,agno) VALUES ("'.$this->username.'", '.$this->puesto.', '.$this->idCancion.', "'.$this->agno.'")'); 
    }
    
    private function selectQuery($dupli) {
        if (!$dupli) {
            $a = ' AND puesto="'.$this->puesto.'"';
        } else {
            $a = ' AND idCancion="'.$this->idCancion.'"';
        }
        $j = $this->db->query('SELECT idCancion, idTopUsu FROM top_usuarios WHERE nombreUsuario="'.$this->username.'" '.$a. ' and agno="'.$this->agno.'"');
        return $j;
    }
    
    private function selectTopResult() {
        $query = $this->db->query('SELECT * FROM top WHERE agno = "'.$this->agno.'" order by puesto');
        return $query;
    }
    
    private function getUsers() {
        $query = $this->db->query('SELECT DISTINCT nombreUsuario FROM `top_usuarios`');
        return $query;
    }
    
    private function selectTopOfUser($user) {
        $query = $this->db->query('SELECT * FROM `top_usuarios` where nombreUsuario = "'.$user.'" order by puesto');
        return $query;
    }
    
    public function saveTop($puesto,$idCancion,$year) {
        $this->username = $this->session->userdata('username');
        $this->puesto= $puesto+1;
        $this->idCancion= $idCancion;
        $this->agno= $year;
        $this->error = '';
        $punt = $this->checkIfPunt();
        $dupl = $this->checkIfDupl();
        if (($punt) and (!$dupl)) {
            $this->updateQuery();
        }
        elseif ((!$punt) and (!$dupl)) {
            $this->insertQuery();
        }
        else {
            $query3 = $this->db->query('DELETE FROM top_usuarios where idTopUsu = '.$this->idAux2.''); 
            
            if ($punt) {
                $this->updateQuery();
            }
            elseif (!$punt) {
                $this->insertQuery();
            }
            
        }
        $this->generatePosition();
    }
    private function checkIfPunt() {
        $query = $this->selectQuery(false);
        if ($query->num_rows() > 0) {
            $results = $query->result();
            if ($this->idCancion != $results[0]->idCancion) {
                $this->idAux = $results[0]->idTopUsu;
                return true;
            } else {
                return -1;  
            }  
        } else {  
            return false;
        }
    }
    
    private function checkIfDupl() {
        $query = $this->selectQuery(true);
        if ($query->num_rows() > 0) {
            $results = $query->result();
            $this->idAux2 = $results[0]->idTopUsu;
            return true;
        } else {  
            return false;  
        }
    }


    public function generatePosition() {
        for ($z=1;$z<=10;$z++) {
            ?>
               <div>
                    <?php $this->getSongByPuesto($z);?>
                </div>
            <?php
        }
        
    }
    
    private function getSongData() {
        $query = $this->db->query('SELECT idCancion, canciones.idPais, canciones.nombre as nombreCan,  paises.nombre as nombrePa, path, interprete,enlace FROM canciones left join paises on(canciones.idPais = paises.idPais) where agno="'.$this->agno.'" and canciones.idCancion = '.$this->idCancion.'');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
        
    }
    public function getSongByPuesto($num) {
        $a = $num -1;
        $this->username = $this->session->userdata('username');
        $query = $this->db->query('SELECT canciones.idCancion, canciones.idPais, canciones.nombre as nombreCan,'
                . ' paises.nombre as nombrePa, path, interprete,enlace '
                . 'FROM top_usuarios '
                . 'left join canciones on (top_usuarios.idCancion = canciones.idCancion) '
                . 'left join paises on(canciones.idPais = paises.idPais) '
                . 'where puesto = '.$num.' '
                . 'and nombreUsuario="'.$this->username.'" '
                . 'and top_usuarios.agno = "'.$this->agno.'";');
        $body = new Body();
        if ($query->num_rows() > 0) {
            $results = $query->result();
            $body->topStructure($num, $results[0]->nombreCan, $results[0]->interprete, $results[0]->nombrePa, true);
            
        }
        else {
            $body->topStructure($num, $results[0]->nombreCan, $results[0]->interprete, $results[0]->nombrePa, true);     
        }
    }
    
    public function setYear($year) {
        $this->agno = $year;
    }
    
    private function getSongIdsTopResult() {
        $query = $this->selectTopResult();
        if ($query->num_rows() > 0) {
            $results = $query->result();
                $puestos = array();
                $a = 1;
                foreach ($results as $rows) {
                    $puestos[$a++] = $rows->idCancion;
                }
        }
        return $puestos;
    }
    
    private function countTopRight($user) {
        $puestos = $this->getSongIdsTopResult();
        $topFinal = array();
        $topFinal[$user] = 0;
        $query2 = $this->selectTopOfUser($user);
        if ($query2->num_rows() > 0) {
            $results2 = $query2->result();
            foreach ($results2 as $rows2) {
                if ($puestos[$rows2->puesto] ==  $rows2->idCancion) {
                    $topFinal[$user]++;
                }
            }
        }
        return $topFinal;
    }
    
    public function getTopUsu() {
        $query = $this->getUsers();
        if ($query->num_rows() > 0) {
            $results1 = $query->result();
            $topFinal = array();
                foreach ($results1 as $rows1) {
                    $topFinal = $this->countTopRight($rows1->nombreUsuario);
                }
        }
        return $topFinal;
    }
    
    public function showTopOfUsers() {
        $resultados =  $this->getTopUsu();
        $body = new Body();
        $body->createDivWithContent("col-md-6 well","","Usuario");
        $body->endDiv();
        $body->createDivWithContent("col-md-6 well","","Puntuación");
        $body->endDiv();
        foreach ($resultados as $key=>$value) {
            $body->createDivClass("perfilDiv","topUsuF","data-usu='".$key."'");
            $body->createDivClass("col-md-6 well text-justify container", "");
            $body->printImage("resources/themes/default/img/logo.png","perfilImagen col-md-3 col-md-offset-1 center-block img-circle ");
            $body->createElement("p style='margin-top:20px;' class='lead col-md-3 col-md-offset-1 text-center'");
            $body->printText($key);
            $body->endElement("p");
            $body->endDiv();
            $body->createDivWithContent("col-md-6 well","",$value);
            $body->endDiv();
            $body->endDiv();
        }
    }
    
    
    
    
}
