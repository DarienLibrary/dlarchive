<?php

class Statistics_model extends CI_Model {
    
    public function file_format_stats(){
	//$sql = "SELECT format, COUNT(doc_id) AS quantity FROM content GROUP BY format";
	$sql ="SELECT format,SUM(filesize) AS size, COUNT(doc_id) AS quantity FROM content GROUP BY format";
	$records = $this->db->query($sql)->result_array();
	return $records;
    }
    
}