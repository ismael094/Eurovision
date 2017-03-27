<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TopSongs
 *
 * @author alumno
 */
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class TopSongs extends CI_Controller {
    public function index() {
        $this->load->library('session');
        $data['paises'] = $this->Paises;
        $data['footerHtml'] = $this->load->view('footer', $data, true);
        $this->load->view('index', $data);
    }
    
    public function save(){
        $this->load->library('session');
        $top = new Top;
        $top->saveTop($_POST['puesto'], $_POST['idCancion'],$_POST['year']);
    }
    
}
