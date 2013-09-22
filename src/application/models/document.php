<?php

class Document extends CI_Model {
   
    public function add($data){
	$this->db->insert('content',$data);
    }
    
}