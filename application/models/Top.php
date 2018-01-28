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
    private $prueba;
    
    
    public function Top($ano) {
        parent::__construct();
        $this->agno = $ano;
        $this->date = date('Y-m-d H:i:s');
        $this->prueba = array();
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
        $query = $this->db->query('SELECT DISTINCT nombreUsuario FROM `top_usuarios` where agno = "'.$this->agno.'"');
        return $query;
    }
    
    private function selectTopOfUser($user) {
        $query = $this->db->query('SELECT * FROM `top_usuarios` where nombreUsuario = "'.$user.'" and agno = "'.$this->agno.'"  order by puesto');
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
        ?>
            <div class="container card bg-faded" style="font-family: Montserrat-Bold;font-size:16px;"> 
        <?php
        for ($z=1;$z<=10;$z++) {
            ?>
               <div class="row hover" style="padding:30px;margin:5px;cursor: initial">
                    <?php $this->getSongByPuesto($z);?>
                </div>
            <?php
        }
        ?>
            </div>
        <?php
        
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
        
        //$topFinal = array();
        //$topFinal[$user] = 0;
        $this->prueba[$user] = 0;
        $query2 = $this->selectTopOfUser($user);
        if ($query2->num_rows() > 0) {
            $results2 = $query2->result();
            foreach ($results2 as $rows2) {
                if ($puestos[$rows2->puesto] ==  $rows2->idCancion) {
                    //$topFinal[$user]++;
                    $this->prueba[$user]++;
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
            $i=0;
            foreach ($results1 as $rows1) {
                $this->countTopRight($rows1->nombreUsuario);
            }
        }
        return $topFinal;
    }
    
    public function showTopOfUsers() {
        $this->getTopUsu();
        $body = new Body();
        ?>
            <div class="container card bg-faded " style="padding-bottom: 20px">
                <div class="row topPuntd bg-faded">
                    <div class="col-md-6" style="font-size: 30px;text-align: center;height:50px;">
                        Usuario
                    </div>
                    <div class="col-md-6" style="font-size: 30px;text-align: center;height:50px;">
                        Puntuación
                    </div>
                </div>
        <?php
        $a = new Usuarios();
        array_multisort($this->prueba, SORT_DESC, $this->prueba);
        $kk = 1;
        foreach ($this->prueba as $key=>$value) {
            $b = $a->getUser($key);
            $body->createDivClass("perfilDiv","topUsuF","data-usu='".$key."' data-year='".$this->agno."'");
            $body->createDivClass("row hover", "");
            $body->createDivClass("col-md-6 inline-block", "");
            ?>
                <div class="row justify-content-md-center" style="margin:20px;">
                    <div class='circleP perComm'>
                        <img src="<?php echo config_item('imgPer').$key."/"
                                    . "".$b[0]->picture;?>" alt="img">
                    </div>
                    <div class="col-md-8" style="margin-top: 15px;">
            <?php
            if ($b[0]->nombre == "") {
                $body->printText($b[0]->usuario);
            } else {
                $body->printText($b[0]->nombre);
            }
            $body->endDiv();
            $body->endDiv();
            $body->endDiv();
            ?>
                <div class="col-md-6" style="text-align: center;font-size:24px;">
                    <div style="margin-top:15px">
                        <?php 
                            echo $value." aciertos ";
                            if ($kk == 1) {
                                ?>
                                    <i class="fa fa-trophy  fa-6"  style="color:#D9F028;font-size: 38px" aria-hidden="true"></i>
                                    
                                <?php
                            } else if ($kk == 2) {
                                ?>
                                    <i class="fa fa-trophy  fa-5" aria-hidden="true"  style="color:#9B9895;font-size: 34px"></i>
                                <?php
                            } else if ($kk == 3) {
                                ?>
                                    <i class="fa fa-trophy  fa-4" aria-hidden="true" style="color:#FB7E32;font-size: 30px"></i>
                                <?php
                            }
                            $kk++;
                        ?> 
                                    
                    </div>
                </div>
            <?php
            $body->endDiv();
            $body->endDiv();
        }
        $body->endDiv();
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
