<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comentarios
 *
 * @author alumno
 */
class Comentarios extends CI_Model {
    
    
    public function insert($mess) {
        $query = $this->db->query('INSERT INTO comentarios (comentario) VALUES ("'.$mess.'")');
    }
    
    public function getComentarios() {
        $query = $this->db->query('SELECT * FROM comentarios');
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
}
