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
        echo '<div class="modal-dialog" role="document">
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
      </div>';
    }
    public function printModalTop(){
        echo '<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-model="1" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Top 10</h4>
          </div>
          <div class="modal-body">';
            echo "<div>";
                $table = new Puntuaciones($_POST['year']);
                $table->printPuntuacionesBy('ind', 'top');
            echo '</div>';
            
            echo '</div>
                <div class="modal-footer">
                    <br />
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="StopButton">Cerrar</button>
                    <button type="button" class="btn btn-primary topSave">Save changes</button>
                    <input type="hidden" id="control" value="'.$_POST['puesto'].'"/>
                </div>
              </div>
            </div>';
    }
    public function printTopByUsu(){
        echo '<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Top 10 '.$_POST['usu'].' </h4>
          </div>
          <div class="modal-body">';
            echo "<div class='row well'>";
                $table = new Puntuaciones($_POST['year']);
                $table->printTopByNombre($_POST['usu'],$_POST['year']);
            echo '</div>';
            echo '</div>
                <div class="modal-footer">
                    <br />
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="StopButton">Cerrar</button>
                </div>
              </div>
            </div>';
    }
}
