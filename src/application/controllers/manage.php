<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {
	
	
	public function requiredDatepicker(){
	    return true;
	}
	
	public function requiredFrom(){
	    return true;
	}
	
	public function requiredTo(){
	    return true;
	}
    
	public function edit($doc_id){
	    if (!$this->session->userdata('username')){
		redirect('main/login');
	    }
	    
	    $this->load->model('document');
	    $info = $this->document->getDocument($doc_id);
	    $info = $info[0];
	
	    $this->load->helper('form_rules/edit');
	    
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules($this->edit_rules);
	    
		// Αν οι τιμές δεν είναι όλες έγκυρες
		if ($this->form_validation->run() == FALSE)
		{
			// Αν η σελίδα φορτώνεται χωρίς να έχει υποβληθεί η φόρμα
			if (!$this->input->post('form_type')) {
			    $data['info'] = $info;
			}			
			$data['page_title'] = 'Edit document';
			$data['view_name'] = 'edit_document';
			$this->load_view('manage/edit',$data);
		}
		// Αν οι τιμές είναι έγκυρες
		else
		{	
		    // Generate the mysql record
		    $now = new DateTime();
		    $time = $now->format('Y-n-j G:i:s');
		    
		    if (isset($_POST['datepicker'])){
			$from = new DateTime($this->input->post('datepicker'));
			$from = $from->format('Y-n-j G:i:s');
			$to = $from;
		    } else {
			$from = new DateTime($this->input->post('from'));
			$from = $from->format('Y-n-j G:i:s');
			$to = new DateTime($this->input->post('to'));
			$to = $to->format('Y-n-j G:i:s');
		    }
		    
		    $data = array (
			'doc_title'	    =>  $this->input->post('title'),
			'doc_desc'	    =>	$this->input->post('description'),
			'record_date'	    =>	$time,
			'datetime_start'    =>	$from,
			'datetime_end'	    =>	$to,
		    );
		
		    // If another file have been chosen
		    if (strlen($_FILES['itemfile']['name']) > 0){
			$source = $_FILES['itemfile']['tmp_name'];
			$filename = $_FILES['itemfile']['name'];
			$target = UPLOADPATH.$filename;
			move_uploaded_file($source,$target);
			
			unlink(realpath(FCPATH.'/uploads/')."/".$_POST['oldfile']);
			
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
			
			$data['filename'] = $filename;
			$data['format']	= $format;
			
			if ($format == 'pdf'){
			    $pdfbox_path = FCPATH."third_party/pdfbox.jar";
			    $pdf_path = $target;

			    // extract text from pdf
			    $command = "java -jar $pdfbox_path ExtractText -console -encoding utf-8 ".$pdf_path;
			    $pdf_text = shell_exec("$command");
			    // add one more field in the mysql record
			    $data['doc_text'] = $pdf_text;
			} else {
			    $data['doc_text'] = 'null';
			}
			
		    } // File handling ends here

		    $this->document->update($doc_id,$data);
		    redirect("search/main");
		}
	    
	}
	
	public function delete($id){
	    if (!$this->session->userdata('username')){
		redirect('main/login');
	    }
	    
	    $this->load->model('document');
	    if ($this->document->delete($id))
		redirect('search/main');
	    else
		show_error("Database record couldn't be deleted!");
	}
	
}