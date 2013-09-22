<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends MY_Controller {

	
	public function index()
	{
	    if (!$this->session->userdata('username')){
		redirect('main/login');
	    }
	    
	    $this->load_view('upload/main');
	}
	
	// Checks if the form data posted are valid
	private function validate_form(){
	    // Load the validation rules for the upload form
	    $this->load->helper('form_rules/upload');
	    // Load the form validator class
	    $this->load->helper('FormValidator');
	    // Validate from posted form
	    $validator = new FormValidator($this->upload_rules);
	    $valid = $validator->validate();
	    
	    if (!$valid) {
		$this->upload_errors = $validator->getErrors();
		return false;
	    }
	    else
		return true;
	}
	
	public function uploading()
	{
	    if (!$this->session->userdata('username')){
		redirect('login');
	    }
	    // If posted data are valid
	    if ($this->validate_form()){
		// Store the uploaded file
		$source = $_FILES['itemfile']['tmp_name'];
		$filename = $_FILES['itemfile']['name'];
		$target = realpath(FCPATH.'/uploads/')."/".$filename;
		
		if (!isset($_POST['debug'])) 
		    // Move the temporary file to the resource's folder
		    move_uploaded_file($source,$target);
		else
		    // Delete the temporary file
		    unlink ($source);

		// Generate the mysql record
		$now = new DateTime();
		$time = $now->format('Y-n-j G:i:s');
		
		$filename_parts = pathinfo($filename);
		$extension = $filename_parts['extension'];
		switch ($extension){
		    case 'jpg': 
		    case 'png' :
		    case 'giff':
		    case 'bmp':
		    case 'tiff':
			$format = 'image';
			break;
		    case 'mp3':
			$format = 'audio';
			break;
		    case 'mp4':
			$format = 'video';
			break;
		    case 'txt':
		    case 'rtf':
		    case 'doc':
		    case 'docx':
		    case 'odt':
			$format = 'text';
			break;
		    case 'pdf':
			$format = 'pdf';
			break;
		}
		if (isset($_POST['datepicker'])){
		    $from = new DateTime($this->input->post('datepicker'));
		    $from = $from->format('Y-n-j G:i:s');
		    $to = $from;
		} else {
		    $from = new DateTime($this->input->post('from'));
		    $from = $from->format('Y-n-j G:i:s');
		    $to = new DateTime($this->input->post('to'));
		    $to = $from->format('Y-n-j G:i:s');
		}
		
		$data = array (
			'doc_title'	    =>  $this->input->post('title'),
			'doc_desc'	    =>	$this->input->post('description'),
			'record_date'	    =>	$time,
			'filename'	    =>	$target,
			'format'	    =>	$format,
			'datetime_start'    =>	$from,
			'datetime_end'	    =>	$to,
		    );
		
		// If the debug checkbox was checked then do not store the data to
		// database but send the record back for display
		if (isset($_POST['debug'])){
		    $ajax_reply = array('debug',$data);
		} else {
		    // Store that record in the database and send back a redirection URL
		    $this->load->model('document');
		    $this->document->add($data);
		    $ajax_reply = array('true',base_url().'/upload');
		}
		echo json_encode($ajax_reply);
	    } else {
		// Send back the validation errors
		$ajax_reply = array('false',$this->upload_errors);
		echo json_encode($ajax_reply);
	    }
	}
	
}