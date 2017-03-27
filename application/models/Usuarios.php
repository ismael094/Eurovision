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
    private $pass;
    function __construct() {
        parent::__construct();
    }
    
    private function validate(){
        $query = $this->db->query('SELECT * FROM usuarios where usuario="'.$this->nomUsu.'" and pass=MD5("'.$this->pass.'")');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else return False;
    }
    public function login($usuario, $pass) {
        $this->nomUsu = $usuario;
        $this->pass = $pass;
        $results = $this->validate();
        if ($results) {
            foreach ($results as $rows) {
                $newdata = array(
                   'username'  => $rows->usuario,
                   'email'     => $rows->email,
                   'level'     => $rows->nivel,
                   'logged_in' => TRUE
               );
            }
            $this->session->set_userdata($newdata);
        }
        else echo 'ERROR';
    }
}
