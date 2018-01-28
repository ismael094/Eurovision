<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios
 *
 * @author alumno
 */
class Usuarios extends CI_Model {
    private $nomUsu;
    private $nombreC;
    private $file;
    private $fileName;
    private $pass;
    private $isSessionOk;
    private $message;
    function __construct() {
        parent::__construct();
    }
    
    private function validate(){
        $query = $this->db->query('SELECT * FROM usuarios where usuario="'.$this->nomUsu.'" and pass=MD5("'.$this->pass.'")');
        $this->isSessionOk = $query->num_rows() > 0;
        if($query->num_rows() > 0){
            return $query->result();
        }
        return False;
    }
    
    private function selectUser($name){
        $query = $this->db->query('SELECT * FROM usuarios where usuario="'.$name.'"');
        $this->isSessionOk = $query->num_rows() > 0;
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
    
    private function registerQuery() {
        if ($this->selectUser($this->nomUsu) == false) {
            if ($this->saveImgPer() ) {
                $query = $this->db->query('INSERT INTO usuarios (usuario,nombre,pass,picture)'
                    . ' VALUES ("'.$this->nomUsu.'","'.$this->nombreC.'",MD5("'.$this->pass.'"),"'.$this->fileName.'")');
                return true;
            }
            return false;
        }
        return "USUREP";
    }
    
    private function completeQuery() {
        if ($this->saveImgPer() ) {
            $query = $this->db->query('UPDATE usuarios SET nombre="'.$this->nombreC.'",pass=MD5("'.$this->pass.'"),picture="'.$this->fileName.'",'
                    . 'estado="OK" where usuario="'.$this->nomUsu.'"');
            $this->logNin();
        }
    }
    
    private function changeQuery() {
        $o = $this->createChangeUpdate();
        if ($o != false ) {
            $this->db->query($o);
            $this->logNin();
        }
    }
    
    public function createChangeUpdate() {
        $res = '';
        $newdata = array();
        if ($this->nombreC != '') {
            $res=$res.'nombre="'.$this->nombreC.'"';
            $newdata['name'] = $this->nombreC;
        }
        if ($this->pass != '') {
            if ($res!='') {
                $res=$res.', ';
            }
            $res=$res.'pass=MD5("'.$this->pass.'")';
        }
        if ($this->fileName != '') {
            if ($res!='') {
                $res=$res.', ';
            }
            $this->saveImgPer();
            $res=$res.'picture="'.$this->fileName.'"';
            $newdata['picture'] = $this->fileName;
        }
        if ($res !='') {
            $final = 'UPDATE usuarios SET '.$res.' where usuario="'.$this->nomUsu.'"';
            $newdata['username'] = $this->session->userdata('username');
            $newdata['state'] = $this->session->userdata('state');
            $newdata['level'] = $this->session->userdata('level');
            $newdata['logged_in'] = TRUE;
            $this->session->set_userdata($newdata);
            return $final;
        } else {
            return false;
        }
    }
    
    private function saveImgPer() {
	if ($this->file != null || $this->file != '') {
            $nombrearchivo2 = $this->fileName;
                    $ubi=config_item('imgPer').$this->nomUsu;
            mkdir($ubi, 0777,TRUE);
            $gh = move_uploaded_file($this->file, $ubi."/".$nombrearchivo2."");
            $ubica="usuarios/".$nombre."/".$nombrearchivo2."";
            return true;
        }
        return false;
    }
    
    private function logNin() {
        $results = $this->validate();
        if ($results) {
            foreach ($results as $rows) {
                $newdata = array(
                   'username'  => $rows->usuario,
                   'name'     => $rows->nombre,
                   'picture'  => $rows->picture,
                   'state'  => $rows->estado,
                   'level'     => $rows->nivel,
                   'logged_in' => TRUE
               );
            }
            $this->session->set_userdata($newdata);
        }
    }
    
    public function login($usuario, $pass) {
        $this->nomUsu = $usuario;
        $this->pass = $pass;
        $results = $this->validate();
        if ($results) {
            foreach ($results as $rows) {
                $newdata = array(
                   'username'  => $rows->usuario,
                   'name'     => $rows->nombre,
                   'picture'  => $rows->picture,
                   'state'  => $rows->estado,
                   'level'     => $rows->nivel,
                   'logged_in' => TRUE
               );
            }
            $this->session->set_userdata($newdata);
        }
    }
    
    public function isSessionOk() {
        return $this->isSessionOk;
    }
    
    public function getUser($name) {
        $a = $this->selectUser($name);
        return $a;
    }
    
    public function setUser($name) {
        $this->nomUsu = $name;
    }
    
    public function setDataRegister($data) {
        $this->nomUsu = $data["usuario"];
        $this->pass = $data["pass"];
        $this->nombreC = $data["nombre"];
        $this->file = $data["file"];
        $this->fileName = $data["fileName"];
    }
    
    public function setDataComplete($data) {
        $this->pass = $data["pass"];
        $this->nombreC = $data["nombre"];
        $this->file = $data["file"];
        $this->fileName = $data["fileName"];
    }
    
    public function register() {
        return $this->registerQuery();
    }
    
    public function complete() {
        $this->completeQuery();
    }
    
    public function change() {
        $this->changeQuery();
    }
}
