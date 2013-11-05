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
    
    public function search($filters){
	$this->db->select('*');
	// For each filter set, add a WHERE in the sql statement
	if (isset($filters['keyword']))
	    $this->db->where('doc_title LIKE ',"%$filters[keyword]%");
	if (isset($filters['format']))
	    $this->db->where('format',$filters['format']);
	if (isset($filters['from'])){
	    $from = new DateTime($this->input->post('from'));
	    $from = $from->format('Y-n-j G:i:s');
	    $to = new DateTime($this->input->post('to'));
	    $to = $to->format('Y-n-j G:i:s');
	    
	    $where = "(datetime_start BETWEEN '$from' AND '$to') OR (datetime_end BETWEEN '$from' AND '$to')";
	    $this->db->where($where);
	}
	// Order the retrieved records by 'record_date' field
	$this->db->order_by('record_date','ASC');
	$records = $this->db->get('content')->result_array();
	
	return $records;
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
	   unlink(UPLOADPATH.$filename);
	   return true;
	} else {
	    return false;
	}
     }
    
}