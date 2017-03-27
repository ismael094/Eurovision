<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Description of HTMLViews
 *
 * @author alumno
 */
class HtmlViews  {
   public function printTable($query) {
       echo '<table style="border: 2px solid black;">';
       for ($i=0;$i<count($query);$i++) {
           echo '<tr><td>'.$query[$i]->idalbum.'</td></tr>';
           echo '<tr><td>'.$query[$i]->nombre.'</td></tr>';
           echo '<tr><td>'.$query[$i]->agno.'</td></tr>';
           echo '<tr><td>'.$query[$i]->path.'</td></tr>';
       }
       echo '</table>';
   }
}
