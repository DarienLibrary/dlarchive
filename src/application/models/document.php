<?php

class Document extends CI_Model {
   
    public function add($data){
	$this->db->insert('content',$data);
    }
    
    public function getAll(){
	$this->db->order_by('record_date','ASC');
	$this->db->select('doc_title,doc_desc,doc_text,record_date,datetime_start,datetime_end,format,filename');
	return $this->db->get('content')->result_array();
    }
    
    public function search($keyword){
	$this->db->order_by('record_date','ASC');
	$this->db->select('doc_title,doc_desc,doc_text,record_date,datetime_start,datetime_end,format,filename');
	$where = "doc_title LIKE '%$keyword%' OR doc_desc LIKE '%$keyword%' OR filename LIKE '%$keyword%'";
	$this->db->where($where);
	return $this->db->get('content')->result_array();
    }
    
    public function search_format($format){
	$this->db->order_by('record_date','ASC');
	$this->db->select('doc_title,doc_desc,doc_text,record_date,datetime_start,datetime_end,format,filename');
	$where = "format = '$format'";
	$this->db->where($where);
	return $this->db->get('content')->result_array();
    }
    
    public function search_date($from,$to){
	
	$from = new DateTime($this->input->post('from'));
	$from = $from->format('Y-n-j G:i:s');
	$to = new DateTime($this->input->post('to'));
	$to = $to->format('Y-n-j G:i:s');
	
	$this->db->order_by('record_date','ASC');
	$this->db->select('doc_title,doc_desc,doc_text,record_date,datetime_start,datetime_end,format,filename');
	$where = "(datetime_start BETWEEN '$from' AND '$to') OR (datetime_end BETWEEN '$from' AND '$to')";
	$this->db->where($where);
	return $this->db->get('content')->result_array();
    }
    
}