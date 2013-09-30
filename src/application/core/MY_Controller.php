<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct() {
	    parent::__construct();
	    
	    //ENVIRONMENT != 'development' || $this->output->enable_profiler(TRUE);
	}
	
	protected function load_view($viewname,$data=null){
	    $last_slash = strrpos($viewname, "/");
	    // if the view name contains at least one slash
	    if ($last_slash>0) {
		// το full path για το τοπικό template.php - θα χρειαστεί στην file_exists
		$view_dir = FCPATH."/application/views/".substr($viewname, 0, strrpos($viewname, "/"));
		// το short path για το τοπικό template - θα χρειαστεί στην $this->load->view
		$view_short_path = substr($viewname, 0, strrpos($viewname, "/"));
	    }
	    else { // τα αντίστοιχα path για το γενικό template.php
		$view_dir = FCPATH."/application/views/";
		$view_short_path = "";
	    }
	    
	    if (is_null($data))
		    $data = array(
			'view_name'	=>  $viewname,
		    );
	    else
		$data['view_name']	=  $viewname;
	    
	    // If there is a local template
	    if (file_exists($view_dir."/template.php")){
		$template = $view_short_path."/template";
	    } else { // else load the master template
		$template = "template";
	    }
	    
	    // Load the template
	    $this->load->view($template,$data);
	}
	
}