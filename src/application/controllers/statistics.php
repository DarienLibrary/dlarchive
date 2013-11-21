<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistics extends MY_Controller {
	
	public function index(){
	   $this->load->model('statistics_model');
	   $ffstats = $this->statistics_model->file_format_stats();
	   foreach ($ffstats as $entry){
	       $ffcount[$entry['format']] = (int)$entry['quantity'];
	       $ffsize[$entry['format']] = (int)$entry['size'];
	   }
	   $formats = array(
	       'text'	=>  0,
	       'pdf'	=>  0,
	       'image'	=>  0,
	       'audio'	=>  0,
	       'video'	=>  0
	   );

	   $data['page_title'] = 'Archiver Statistics';
	   $data['ffcount'] = array_merge($formats,$ffcount);
	   $data['ffsize'] = $ffsize;

	   $this->load_view('statistics/display_stats',$data);
	}
	
}