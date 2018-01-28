<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MisCanciones
 *
 * @author alumno
 */
class MisCanciones extends CI_Model{
    //put your code here
    public function insert($id) {
        $query = $this->db->query('INSERT INTO miscanciones(idCancion,usuario) VALUES ('
            . ''.$id.',"'.$this->session->userdata('username').'")');
    }
    
    public function delete($id) {
        $query = $this->db->query('DELETE FROM miscanciones WHERE idCancion = '.$id.' AND usuario = "'.$this->session->userdata('username').'" '); 
    }
    
    public function select($id) {
        $query = $this->db->query('select * from miscanciones WHERE idCancion = '.$id.' AND usuario = "'.$this->session->userdata('username').'"  ');
        return ($query->num_rows() > 0);
    }
    
    public function selectSongs() {
        $query = $this->db->query('select * from miscanciones WHERE usuario = "'.$this->session->userdata('username').'" ORDER BY RAND()');
        if ($query->num_rows() > 0) {
            return $result = $query->result();
        }
        return false;
        
    }
    
    public function test() {
        ?>
            <div class="col-md-8 container card bg-faded" style="height:100%;margin-top:15px">
                <div class="row justify-content-md-center">
                <h1 class="col-md-4" style="text-align: center">Mis canciones</h1>
                </div>
                <div class="row justify-content-md-center" style="overflow-y: auto;">
                    <?php
                        $a = new MisCanciones();
                        $b = $a->selectSongs();
                        if ($b != false) {
                            foreach ($b as $row) {
                                $son = new Songs();
                                $ff = $son->getSongsById($row->idCancion); 
                                if ($ff != null) {
                                    foreach ($ff as $raw) {
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
                                                        <h2><?php echo $raw->nombre?></h2>
                                                        <p class="justify-content-md-center" style="margin-top: -15px">
                                                            <div class="float-left replay" 
                                                                  data-id="<?php echo $raw->idCancion;?>" 
                                                                  data-enlace="<?php echo $raw->enlace;?>" 
                                                                  data-name="<?php echo $raw->nombre.' - '.$raw->interprete;?>">
                                                                <i class="fa fa-play" aria-hidden="true" style="font-size:25px"></i>
                                                            </div>
                                                            <div  class="float-right nlike2" data-id="<?php echo $raw->idCancion;?>">
                                                                <i class="fa fa-times" aria-hidden="true" style="font-size:25px;"></i>
                                                            </div>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                    }
                                }
                            }
                        } else {
                            ?>
                                <div class="col-md-8 col-sm-5 col-xs-12 alert alert-warning" role="alert" style="margin: 10px;">
                                    No tienes ninguna canción favorita. Para añadir una simplemente haz <strong>click</strong>
                                     sobre la mano que aparece tanto al puntuar una canción como al reproducir una en las puntuaciones.
                                </div>
                            <?php
                        }
                        
                    ?>
                </div>
            </div>
        <?php
    }
}
