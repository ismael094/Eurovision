<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DynaTable
 *
 * @author alumno
 */
class DynaTable extends CI_Model {
    
    public function createTable() {
        ?>
            <table id="my-table" class="table table-bordered">
        <?php
    }
    
    public function endTable() {
        ?>
            </table>
        <?php
    }
    
    public function createElement($element,$properties="") {
        ?>
            <<?php echo $element. " ".$properties;?>>
        <?php
        
    }
    
    public function endElement($element) {
        ?>
            </<?php echo $element;?>>
        <?php
        
    }
    
    public function createTh($id,$class,$name,$style) {
        ?>
            <th data-dynatable-column="<?php echo $id;?>" class="dynatable-head <?php echo $class;?>" style="<?php echo $style;?>" >
                <a class="dynatable-sort-header" href="#"><?php echo $name;?></a>
            </th> 
        <?php
        
    }
    
    public function createTd($nombre,$propierties="") {
        ?>
            <td <?php echo $propierties;?>><?php echo $nombre;?></td>
        <?php
    }
}
