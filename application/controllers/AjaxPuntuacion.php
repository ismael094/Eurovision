<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Puntuacion
 *
 * @author alumno
 */
class AjaxPuntuacion extends CI_Controller {
    public function index() {
        $this->load->library('session');
        $data['paises'] = $this->Paises;
        $data['footerHtml'] = $this->load->view('footer', $data, true);
        $this->load->view('index', $data);
    }
    
    public function setPunt() {
        $data['punt'] = new Puntuaciones();
        $data['punt']->savePunt($_POST['idSong'],$_POST['puntVoz'],$_POST['puntCan'],$_POST['comment']);
    }
    public function printPunt() {
        if ($_POST['mode']!="top") {
            $data['punt'] = new Puntuaciones($_POST['year']);
            $data['punt']->printPuntuacionesBy($_POST['mode'],$_POST['site']);
        } else {
            $top = new Top($_POST['year']);
            $top->showTopOfUsers();
        }
    }
    public function printEnd() {
        $body = new Body($_POST['year']);
        $body->endPuntuaciones();
    }
}
