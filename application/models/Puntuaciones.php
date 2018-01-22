<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Puntuaciones
 *
 * @author alumno
 */
error_reporting(0);
class Puntuaciones extends CI_Model {
    private $username;
    private $year;
    private $idSong;
    private $puntVoz;
    private $puntCan;
    private $comment;
    private $usuA;
    private $usuB;
    private $dataTable = array();
    private $dynaTable;
    
    function Puntuaciones($year) {        
        parent::__construct();
        $this->username = $this->session->userdata('username');
        $this->year = $year;
    } 
    
    private function insertPunt() {
        $query = $this->db->query('INSERT INTO puntuaciones(nombreUsuario,idCancion,puntVoz,puntCan,comentario) VALUES ("'
            . ''.$this->username.'", '.$this->idSong.', '.$this->puntVoz.', '.$this->puntCan.', "'.$this->comment.'")'); 
    }
    
    private function updatePunt() {
        $query = $this->db->query('UPDATE puntuaciones SET puntVoz = '.$this->puntVoz.', puntCan = '.$this->puntCan.',comentario '
            . '= "'.$this->comment.'" where nombreUsuario = "'.$this->username.'" and idCancion = '.$this->idSong.''); 
    }
    
    private function selectPunt() {
        $query = $this->db->query('SELECT * FROM puntuaciones WHERE nombreUsuario="'.$this->username.'" AND idCancion="'.$this->idSong.'"');
        return $query;
    }
    private function getComm() {
        $query = $this->db->query('SELECT * FROM puntuaciones WHERE idCancion="'.$this->idSong.'" and comentario != ""');
        return $query;
    }
    
    private function selectCall($number,$id="") {
        if ($number == 0) {
            $s = "CALL prueba('".$id."', '".$this->username."', '".$this->usuA."', '".$this->usuB."')";
        } elseif ($number == 1) {
            $s = "CALL getSongOfUser('".$this->username."','".$this->year."')";
        } elseif ($number == 2) {
            $s = "CALL getSongFOfUser('".$this->username."','".$this->year."')";
        } elseif ($number == 3) {
            $s = "CALL getSongGlo('".$this->year."')";
        } elseif ($number == 4) {
            $s = "CALL getSongIdJDI(".$this->year.")";
        }
        $query = $this->db->query($s);
        return $query;
    }
    
    private function callNext($query) {
        $query->next_result();
        return $query;
    } 

    public function savePunt($idSong,$puntVoz, $puntCan, $comment) {
        $this->setData($idSong,$puntVoz,$puntCan,$comment,true);
        if ($this->checkIfPunt()) {
            $this->updatePunt();
        } else {
            $this->insertPunt();
        }  
    }
    
    private function checkIfPunt() {
        $query = $this->selectPunt();
        if ($query->num_rows() > 0) {
            return true;
        } else {  
            return false;
        }
    }
    
    public function getPunt($idSong) {
        $this->idSong = $idSong;
        $query = $this->selectPunt();
        if ($query->num_rows() > 0) {
            $results = $query->result();
            $this->setData("",$results[0]->puntVoz,$results[0]->puntCan,$results[0]->comentario,false);
        } else {
            $this->setData("","","","",false);
        }
    }
    
    private function setData($idSong,$voz,$can,$comm,$setId) {
        if ($setId) {
            $this->idSong = $idSong;
        }
        $this->puntVoz = $voz;
        $this->puntCan = $can;
        $this->comment = $comm; 
    }
    
    private function setUsers() {
        if ($this->username == 'ismael') {
            $a = 'jaime';
            $b = 'dailos';
        }
        elseif ($this->username == 'jaime') {
            $a = 'ismael';
            $b = 'dailos';
        }
        elseif ($this->username == 'dailos') {
            $a = 'ismael';
            $b = 'jaime';
        }
        $this->usuA = $a;
        $this->usuB = $b;
    }
    
    private function buildHeadTable($mode,$glo=false) {
        $dynaTable = new DynaTable();
        $dynaTable->createTable();
        $dynaTable->createElement("thead");
        $dynaTable->createElement("tr");
        $dynaTable->createTh("id", "", "País", "display:none");
        $dynaTable->createTh("enlace", "", "País", "display:none");
        $dynaTable->createTh("country", "", "País", "");
        $dynaTable->createTh("titulo", "", "Título", "");
        $dynaTable->createTh("autor", "", "Intérprete", "");
        if ($glo) {
            $a = "";
        } else {
            $a = " " .$this->username;
        }
        $dynaTable->createTh("voz", "", "Voz".$a, "");
        $dynaTable->createTh("can", "", "Canción".$a, "");
        if ($mode) {
            $dynaTable->createTh("vozj", "", "Voz ".$this->usuA, "");
            $dynaTable->createTh("canj", "", "Canción ".$this->usuA, "");
            $dynaTable->createTh("vozd", "", "Voz ".$this->usuB, "");
            $dynaTable->createTh("cand", "", "Canción ".$this->usuB, "");
        }
        $dynaTable->createTh("media", "", "Media", "");
        $dynaTable->endElement("tr");
        $dynaTable->endElement("thead");
        $dynaTable->createElement("tbody");
    }
    
    private function buildTd($propierties) {
        $dynaTable = new DynaTable();
        foreach($this->dataTable as $data) {
            $dynaTable->createTd($data, $propierties);
        }
    }
    
    private function setArray($array,$media=null) {
        $i = 0;
        foreach($array as $key=>$value) {
            $this->dataTable[$i] = $value;
            $i++;
        }
        if ($media!=null) {
            $this->dataTable[$i] = $media;
        }
    }
    
    public function printPuntuacionesBy($mode,$site="") {
        $this->username = $this->session->userdata('username');
        $this->setUsers();
        if ($mode == 'JDI') {
            $this->puntModeJDI();
        }
        elseif ($mode == 'ind' || $mode == 'glo'){
            $this->puntModeIndGlo($mode,$site);
                
        }
    }
    
    private function puntModeJDI() {
        $this->username = $this->session->userdata('username');
        $dynaTable = new DynaTable();
        $query = $this->selectCall(4);
        if ($query->num_rows() > 0) {
            $results = $query->result();
            $query->next_result();
            $this->buildHeadTable(true);
            foreach ($results as $row) {
                $query2 = $this->selectCall(0,$row->idCancion);
                $query2->next_result();
                if ($query2->num_rows() > 0) {
                    $results2 = $query2->result();
                    $media = (($results2[0]->puntVozJ + $results2[0]->puntCanJ + 
                        $results2[0]->puntVozI + $results2[0]->puntCanI + 
                        $results2[0]->puntVozD + $results2[0]->puntCanD)/6);
                    $media = number_format((float)$media,2,'.','');
                    $this->setArray($results2[0],$media);
                    $query2->next_result();
                    $dynaTable->createElement("tr",'class="dyCo" '
                            . 'data-name="'.$results2[0]->nombre.' - '
                            .$results2[0]->interprete.'" data-enlace='
                            . '"'.$results2[0]->enlace.'"');

                    $this->buildTd('style="text-align: left;"');
                    $dynaTable->endElement("tr");
                }
            }
            $dynaTable->endElement("tbody");
            $dynaTable->endElement("table");
        }
        else {
            echo 'No has puntuado ninguna canción';
        }
    }
    public function getComments($id) {
        $this->idSong = $id;
        $query = $this->getComm();
        if ($query->num_rows() > 0) {
            $results = $query->result();
            echo '<div>';
            foreach ($results as $rows) {
                ?>
                
                    <div class="col-md-2 col-sm-2 well" style="text-align:left"><?php echo $rows->nombreUsuario;?></div>
                    <div class="col-md-10 col-sm-10 well" style="text-align:left;max-height: 100px;overflow-y:auto"><?php echo ltrim($rows->comentario);?></div>
                
                <?php
            }
            echo '</div>';
        }
        
    }
    private function puntModeIndGlo($mode,$site) {
        $this->username = $this->session->userdata('username');
        $dynaTable = new DynaTable();
        if ($mode == 'ind') {
            if ($site == 'punt') {
                $query = $this->selectCall(1);    
            } else {
                $query = $this->selectCall(2);                
            }
            $this->buildHeadTable(false);
        } else {
            $query = $this->selectCall(3);
            $this->buildHeadTable(false,true);
        }

        if ($query->num_rows() > 0) {
            $query->next_result();
            $results = $query->result();
            $query->next_result();
            foreach ($results as $rows) {
                $rows->puntCan = number_format((float)$rows->puntCan,2,'.','');
                $rows->puntVoz = number_format((float)$rows->puntVoz,2,'.','');
                $media = ((number_format((float)$rows->puntCan,2,'.','') + number_format((float)$rows->puntVoz,2,'.',''))/2);
                $media = number_format((float)$media,2,'.','');
                
                $this->setArray($rows,$media);

                $dynaTable->createElement("tr",'class="dyCo" data-name="'
                    . ''.$rows->nombre.' - '.$rows->interprete.''
                    . '" data-enlace="'.$rows->enlace.'"');

                $this->buildTd('style="text-align: left;"');
                $dynaTable->endElement("tr");

            }
            $dynaTable->endElement("tbody");
            $dynaTable->endElement("table");
        }
        else {
            echo 'No has puntuado ninguna canción';
        }
    }
    
    public function printTopByNombre($usu,$year) {
        $query = $this->db->query('SELECT * FROM top WHERE agno = "'.$year.'" order by puesto');
        if ($query->num_rows() > 0) {
            $results = $query->result();
                $puestos = array();
                $a = 1;
                foreach ($results as $rows) {
                    $puestos[$a++] = $rows->idCancion;
                }
        }
        $query2 = $this->db->query('SELECT canciones.idCancion, canciones.idPais, canciones.nombre as nombreCan, paises.nombre as nombrePa, path, interprete,enlace,puesto FROM top_usuarios left join canciones on (top_usuarios.idCancion = canciones.idCancion) left join paises on(canciones.idPais = paises.idPais) where nombreUsuario="'.$usu.'" and top_usuarios.agno = "'.$year.'" order by puesto');
        if ($query2->num_rows() > 0) {
            $results2 = $query2->result();
            $b = 1;
            foreach ($results2 as $rows2) {
                echo '<div class="col-md-12 well ';
                for ($z=1;$z<=count($puestos);$z++) {
                    if ($rows2->idCancion == $puestos[$z]) {
                        echo ' coincidencia ';
                    }
                }
                if ($rows2->idCancion == $puestos[$b++]) {
                    echo 'acierto" alt="Coincidencia con el Top10"';
                }
                else echo '"';
                echo '><div class="col-md-3 ">
                            <span>Puesto '.$rows2->puesto.'</span>    
                        </div>
                        <div class="col-md-3 ">
                            <span>'.$rows2->nombreCan.'</span>    
                        </div>
                        <div class="col-md-3 ">
                            <span>'.$rows2->interprete.'</span>    
                        </div>
                        <div class="col-md-3 ">
                            <span>'.$rows2->nombrePa.'</span>    
                        </div></div>';
            }
            echo '<button class="btn col-md-2 acierto">Acierto</button><button class="btn col-md-2 col-md-offset-1 coincidencia">En el TOP10</button>';
        }
    }
    
    public function getPuntVoz() {
        return $this->puntVoz;
    }
    public function getPuntCan() {
        return $this->puntCan;
    }
    public function getPuntCom() {
        return $this->comment;
    }
}
