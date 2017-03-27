<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaisData
 *
 * @author alumno
 */
error_reporting(0);
class PaisData extends CI_Controller {
    public function index() {
        $this->load->library('session');
        $data['paises'] = $this->Paises;
        $data['footerHtml'] = $this->load->view('footer', $data, true);
        $this->load->view('index', $data);
    }
    
    public function printData() {
        
        $data['num'] = $_POST['num'];
        $data['songs'] = $this->Songs;
        $data['puntua'] = $this->Puntuaciones;
        $data['songs']->songDataByCountry($_POST['idPais'],$_POST['year']);
        $data['puntua']->getPunt($data['songs']->getSongId());
        $data['footerHtml'] = $this->load->view('footer', $data, true);
        $array = array($data['puntua']->getPuntVoz(),$data['puntua']->getPuntCan(),
            $_POST['year'],$data['puntua']->getPuntCom(),$data['songs']->getSongId(),
            $_POST['num']);
        $body = new Body();
        $body->printSetPuntuaciones($array);
    }
    public function printDataByNum($num) {
        $data['num'] = $_POST['num'];
        $data['songs'] = $this->Songs;
        $data['puntua'] = $this->Puntuaciones;
        $data['songs']->songDataByNum($_POST['num']);
        $data['puntua']->getPunt($data['songs']->getSongId());
        $data['footerHtml'] = $this->load->view('footer', $data, true);
        $this->load->view('puntuacion', $data);
    }
    
}
