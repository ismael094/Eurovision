<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {       
        
	public function index(){
            $this->load->library('session');
            $data['paises'] = $this->Paises;
            $data['usu'] = $this->Usuarios;
            $data['albumes'] = $this->Albumes;
            $data['songs'] = $this->Songs;
            $data['punt'] = $this->Puntuaciones;
            $data['top'] = $this->Top;
            $data['body'] = $this->Body;
            $data['navi'] = $this->Nav;
            $data['table'] = $this->DynaTable;
            if ($_POST['out'] != null) {
                $this->session->sess_destroy();
                header('location: index.php');
            }
            if ($_POST['usuario'] != null) {
                $data['usu']->login($_POST['usuario'],$_POST['pass']);
                header('location: index.php');
            }
            
            $data['navHtml'] = $this->load->view('nav',$data,true);
            $data['headHtml'] = $this->load->view('head',$data,true);
            $data['footerHtml'] = $this->load->view('footer',$data,true);
            $data['cuerpo'] = $this->load->view('body',$data,true);
            $this->load->view('index',$data);
	}
        
}
