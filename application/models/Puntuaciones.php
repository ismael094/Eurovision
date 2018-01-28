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
    private $puntEsc;
    private $comment;
    private $usuA;
    private $usuB;
    private $dataTable = array();
    private $dynaTable;
    
    //Lo utilizo para controlar si se muestra la puntuación
    //si es menor a 2018, no se puede mostrar ya que no estaba
    private $controlYear; 
    
    
    function Puntuaciones($year) {        
        parent::__construct();
        $this->username = $this->session->userdata('username');
        $this->year = $year;
        /*Puntuación por escena. No se puede mostrar en las
         * puntuaciones de 2016 ni 2017
        */
        if ($year  > 2017) {
            $this->controlYear = true;
        } else {
            $this->controlYear = false;
        }
    } 
    
    private function insertPunt() {
        $query = $this->db->query('INSERT INTO puntuaciones(nombreUsuario,idCancion,puntVoz,puntCan,puntEsc,comentario) VALUES ("'
            . ''.$this->username.'", '.$this->idSong.', '.$this->puntVoz.', '.$this->puntCan.','.$this->puntEsc.', "'.$this->comment.'")'); 
    }
    
    private function updatePunt() {
        $query = $this->db->query('UPDATE puntuaciones SET puntVoz = '.$this->puntVoz.', puntCan = '.$this->puntCan.',puntEsc = '.$this->puntEsc.',comentario '
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
        } elseif ($number == 5) {
            $s = "CALL prueba2('".$id."', '".$this->username."', '".$this->usuA."', '".$this->usuB."')";
        }
        $query = $this->db->query($s);
        return $query;
    }
    
    private function callNext($query) {
        $query->next_result();
        return $query;
    } 

    public function savePunt($idSong,$puntVoz,$puntCan,$puntEsc, $comment) {
        $this->setData($idSong,$puntVoz,$puntCan,$puntEsc,$comment,true);
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
            $this->setData("",$results[0]->puntVoz,$results[0]->puntCan,$results[0]->puntEsc,$results[0]->comentario,false);
        } else {
            $this->setData("","","","",false);
        }
    }
    
    private function setData($idSong,$voz,$can,$esc,$comm,$setId) {
        if ($setId) {
            $this->idSong = $idSong;
        }
        $this->puntVoz = $voz;
        $this->puntCan = $can;
        $this->puntEsc = $esc;
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
        $sty = "";
        if ($this->controlYear) {
            $sty = "font-size:15px;";
        }
        $dynaTable->createTable();
        $dynaTable->createElement("thead");
        $dynaTable->createElement("tr");
        $dynaTable->createTh("id", "", "País", "display:none");
        $dynaTable->createTh("enlace", "", "País", "display:none");
        $dynaTable->createTh("country", "", "País", $sty);
        $dynaTable->createTh("titulo", "", "Título", $sty);
        $dynaTable->createTh("autor", "", "Intérprete", $sty);
        if ($glo) {
            $a = "";
        } else {
            $a = " " .$this->username;
        }
        if ($mode) {
            
            $dynaTable->createTh("voz", "", "Voz".$a, $sty);
            $dynaTable->createTh("can", "", "Canción".$a, $sty);
            
            if ($this->controlYear) {
                $dynaTable->createTh("esc", "", "P. Esc".$a, "font-size:10px;");
            }
            $dynaTable->createTh("vozj", "", "Voz ".$this->usuA, $sty);
            $dynaTable->createTh("canj", "", "Canción ".$this->usuA, $sty);
            
            if ($this->controlYear) {
                $dynaTable->createTh("escj", "", "P. Esc. ".$this->usuA, "font-size:10px;");
            }
            $dynaTable->createTh("vozd", "", "Voz ".$this->usuB, $sty);
            $dynaTable->createTh("cand", "", "Canción ".$this->usuB, $sty);
            
            if ($this->controlYear) {
                $dynaTable->createTh("esc", "", "P. Esc. ".$this->usuB, "font-size:10px;");
            }
            
        } else {
            $dynaTable->createTh("voz", "", "Voz", "");
            $dynaTable->createTh("can", "", "Canción", "");
            
            if ($this->controlYear) {
                $dynaTable->createTh("esc", "", "P. Escena", "");
            }
        }
        $dynaTable->createTh("media", "", "Media", "$sty");
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
        if ($this->controlYear) {
            foreach($array as $key=>$value) {
                $this->dataTable[$i++] = $value;
            }
        } else {
            foreach($array as $key=>$value) {
                if ($key != "puntEsc") {
                    $this->dataTable[$i++] = $value;
                }
            }
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
                if ($this->controlYear) {
                    $query2 = $this->selectCall(0,$row->idCancion);
                } else {
                    $query2 = $this->selectCall(5,$row->idCancion);
                }
                
                $query2->next_result();
                if ($query2->num_rows() > 0) {
                    $results2 = $query2->result();
                    if ($this->controlYear) {
                        $p = (($results2[0]->puntVozJ + $results2[0]->puntCanJ + $results2[0]->puntEscJ +
                            $results2[0]->puntVozI + $results2[0]->puntCanI + $results2[0]->puntEscI +
                            $results2[0]->puntVozD + $results2[0]->puntCanD + $results2[0]->puntEscD)/9);
                    } else {
                        $p = (($results2[0]->puntVozJ + $results2[0]->puntCanJ + 
                            $results2[0]->puntVozI + $results2[0]->puntCanI + 
                            $results2[0]->puntVozD + $results2[0]->puntCanD)/6);
                    }
                    $media = number_format((float)$p,2,'.','');
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
            $a = new Usuarios();
            
            echo '<div class="container" style="max-height:300px;height:calc(100% - 120px);">';
            ?>
                <div class="row">
                    <div class="col" style="margin-top:20px;">
                        <h5>Comentarios:</h5>
                    </div>
                </div>
            <?php
            foreach ($results as $rows) {
                $b = $a->getUser($rows->nombreUsuario);
                ?>
                    <div class="row" style="margin-top:20px;">
                        
                        <div class="media col ">
                            <div class='d-flex mr-3 circleP perComm'>
                                <img src="<?php echo config_item('imgPer').$rows->nombreUsuario."/"
                                            . "".$b[0]->picture;?>" alt="img">
                            </div>
                            <div class="media-body">
                                <h5 class="mt-0">
                                    <strong>
                                        <?php 
                                            if ($b[0]->nombre == "") {
                                                echo $b[0]->usuario;
                                            } else {
                                                echo $b[0]->nombre;
                                            }
                                        ?>
                                    </strong>
                                </h5>
                                <?php echo ltrim($rows->comentario);?>
                            </div>
                        </div>
                    </div>    
                <?php
            }
            echo '</div>';
            ?>
                <script type="text/javascript">
                    var $img = $(".perComm img"),
                      width = $img.width(),
                      height = $img.height(),
                      tallAndNarrow = width / height < 1;
                    if (tallAndNarrow) {
                      //$img.addClass('tallAndNarrow');
                    }
                    $img.addClass('loaded');
              </script>
            <?php
        }
        
    }
    private function puntModeIndGlo($mode,$site) {
        $this->username = $this->session->userdata('username');
        $rr;
        if ($mode == 'ind') {
            if ($site == 'punt') {
                $query = $this->selectCall(1);    
            } else {
                $query = $this->selectCall(2);                
            }
            $rr = true;
        } else {
            $query = $this->selectCall(3);
            $rr = false;
        }

        if ($query->num_rows() > 0) {
            $dynaTable = new DynaTable();
            if ($rr) {
                $this->buildHeadTable(false);
            } else {
                $this->buildHeadTable(false,true);
            }
            $query->next_result();
            $results = $query->result();
            $query->next_result();
            foreach ($results as $rows) {
                $rows->puntCan = number_format((float)$rows->puntCan,2,'.','');
                $rows->puntVoz = number_format((float)$rows->puntVoz,2,'.','');
                $rows->puntEsc = number_format((float)$rows->puntEsc,2,'.','');
                $punC =$rows->puntCan;
                $punV = $rows->puntVoz;
                $punE = $rows->puntEsc;
                if ($this->year>2017) {
                    $p= ($punC + $punV + $punE)/3;
                    $media = number_format((float)$p,2,'.','');
                } else {
                    $p = (($punC + $punV)/2);
                    $media = number_format((float)$p,2,'.','');
                }
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
            echo '<div>No has puntuado ninguna canción</div>';
            
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
            foreach ($results2 as $rows2) {
                $state = false;
                echo '<div class="row alert';
                $z = -1;
                for ($z=1;$z<=10;$z++) {
                    if ($rows2->idCancion == $puestos[$z]) {
                        $state=true;
                        break;
                    }
                }
                if ($state) {
                    if ($rows2->puesto == $z) {
                        echo ' alert-success " alt="Coincidencia con el Top10"';
                    } else {
                        echo ' alert-warning"';
                    }
                } else {
                    echo '"';
                }
                
                
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
                        </div>
                        </div>';
            }
            ?>
               <div class="row justify-content-md-center" style="margin-top:15px;text-align: center">
                   <div class="col-md-2 alert alert-success">Acierto</div>
                   <div class="col-md-6 alert alert-warning">En el Top 10 pero en diferente puesto</div>
               </div> 
            <?php
            echo '';
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
    public function getPuntEsc() {
        return $this->puntEsc;
    }
}
