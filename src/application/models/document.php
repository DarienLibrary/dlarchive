<?php

class Document extends CI_Model {
   
    public function add($data){
	$this->db->insert('content',$data);
    }
    
    public function getDocument($doc_id){
	$this->db->select('*');
	$this->db->where("doc_id = $doc_id");
	return $this->db->get('content')->result_array();
    }
    
    public function getAll(){
	$this->db->order_by('record_date','ASC');
	$this->db->select('*');
	return $this->db->get('content')->result_array();
    }
    
    public function search($keyword){
	$this->db->order_by('record_date','ASC');
	$this->db->select('*');
	$where = "doc_title LIKE '%$keyword%' OR doc_desc LIKE '%$keyword%' OR filename LIKE '%$keyword%'";
	$this->db->where($where);
	return $this->db->get('content')->result_array();
    }
    
    public function search_format($format){
	$this->db->order_by('record_date','ASC');
	$this->db->select('*');
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
	$this->db->select('*');
	$where = "(datetime_start BETWEEN '$from' AND '$to') OR (datetime_end BETWEEN '$from' AND '$to')";
	$this->db->where($where);
	return $this->db->get('content')->result_array();
    }
    
     public function update($id,$data){
	 $this->db->where('doc_id',$id);
	 $this->db->update('content',$data);
     }
    
     public function delete($doc_id){
	 // Get the filename before deleting the database record
	 $this->db->where('doc_id',$doc_id);
	 $info = $this->db->get('content')->result_array();
	
	 // Delete the database record
	$this->db->where('doc_id',$doc_id);
	if ($this->db->delete('content')){
	    // Beside the database record we have to delete the file, too!
	   $filename = $info[0]['filename'];
	   unlink(realpath(FCPATH.'/uploads/')."/".$filename);
	   return true;
	} else {
	    return false;
	}
     }
    
}