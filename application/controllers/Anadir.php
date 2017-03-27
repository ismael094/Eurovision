<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Anadir
 *
 * @author alumno
 */

defined('BASEPATH') OR exit('No direct script access allowed');
class Anadir extends CI_Controller {  
    public function index() {
        $this->load->library('session');
        $data['songs'] = $this->Songs;
        $data['footerHtml'] = $this->load->view('footer', $data, true);
        $this->load->view('addSongs', $data);
    }
    
    public function addSongByAdmin() {
        $song = new Songs;
        $song->setSong($_POST['idPais'],$_POST['agno'],$_POST['name'],$_POST['author'],$_POST['enlace'],$_POST['finalista']);
        $song->saveSong();
    }
}
