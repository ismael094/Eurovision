<?php
error_reporting(0);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Modals
 *
 * @author alumno
 */
class Modals extends CI_Controller {  
    public function printModal(){
        /*echo '<div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-model="0" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">'.$_POST['name'].'</h4>
                </div>
                <div class="modal-body" style="height: 345px">
                    <div>
                        <iframe class="col-md-12" height="315" src="'.$_POST['href'].'" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="modal-footer" style="max-height: 230px;overflow-y:auto">';
                    $b = new Puntuaciones(0);
                    $b->getComments($_POST['id']);
          echo '</div>
         
          <div class="modal-footer">
           <br />
            <button type="button" class="btn btn-default" data-dismiss="modal" id="StopButton1">Cerrar</button>
          </div>
        </div>
      </div>';*/
        ?>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="height: 100%">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center"><?php echo $_POST['name']?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                        <div class="row justify-content-md-center">
                            <iframe class="col-md-10" height="300" src="<?php echo $_POST['href']?>?autoplay=1" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="row justify-content-md-center">
                            <?php $a = new MisCanciones();?>
                            <i class="fa fa-6 fa-thumbs-up <?php if ($a->select($_POST['id'])) { echo "nlike";} else {echo "like";} ?>" data-id="<?php echo $_POST['id'];?>" aria-hidden="true" style="font-size: 30px;margin-top:7px;margin: 0 auto;padding: 15px;"></i>
                        </div>
                        </div>
                        <div style="overflow-y:auto;" class="esUn">
                            <?php
                                $b = new Puntuaciones(0);
                                $b->getComments($_POST['id']);
                            ?>
                        </div>
                    </div>
                    
                    <div class="modal-footer" style="margin-top:10px">
                        <div class="container">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-primary buttonStyle col-md-2" data-dismiss="modal" id="StopButton1">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    public function printModalTop(){
        
        ?>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center">TOP 10</h4>
                        <button type="button" class="close" data-model="1" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="dyTable" class="hoop" style="padding-top:20px">
                            <?php
                                $table = new Puntuaciones($_POST['year']);
                                $table->printPuntuacionesBy('ind', 'top');
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer" style="max-height: 230px;overflow-y:auto">
                        
                    </div>
                    <div class="modal-footer" style="margin-top:10px">
                        <div class="container">
                             <div class="row justify-content-md-center">
                                <div class="alert alert-warning col-md-7" role="alert" style="text-align: center;margin-top:-50px">
                                    Puedes reproducir una canción haciendo <strong>doble-click</strong> sobre ella!
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default buttonStyle col-md-4" data-dismiss="modal" id="StopButton">Cerrar</button>
                                <button type="button" class="btn btn-primary buttonStyle col-md-4 topSave">Guardar y aceptar</button>
                                <input type="hidden" id="control" value="<?php echo $_POST['puesto'];?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    public function printTopByUsu(){
        ?>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center">Top 10</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container" style="font-family: Montserrat-Bold;font-size:16px">
                            <?php
                                $table = new Puntuaciones($_POST['year']);
                                $table->printTopByNombre($_POST['usu'],$_POST['year']);
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-top:10px">
                        <div class="container">
                           
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-primary buttonStyle col-md-2" data-dismiss="modal" id="StopButton">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
}
