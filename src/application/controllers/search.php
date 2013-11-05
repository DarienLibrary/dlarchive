<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {
	
	public function main()
	{
	    if (!$this->session->userdata('username')){
		redirect('main/login');
	    }
	    // Check if search form is posted 
	    if (isset($_POST['keyword'])){
		// Read the posted form fields
		$keyword = $this->input->post('keyword');
		$format = $this->input->post('file_format');
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		
		// For every field that has been set add a search filter
		$filters = array();
		if (!empty($keyword)) $filters['keyword'] = $keyword;
		if (!empty($format) && ($format != 'all'))  $filters['format'] = $format;
		if (!empty($from))    $filters['from'] = $from;
		if (!empty($to))      $filters['to'] = $to;
		
		// Call the model and pass through the filters to be used
		$this->load->model('document');
		$records = $this->document->search($filters);
		$data['list'] = $records;
		
		$data['view_name'] = 'search_results';
		$data['page_title'] = 'Search results';
		// Load the view that displays the search results
		$this->load_view('search/listing/search_results',$data);
		
	    } else {
		// If not form is posted, load the search form
		$data['view_name'] = 'main';
		$data['page_title'] = 'Search the database';
		$data['active'] = 'search';

		$this->load_view('search/main',$data);
	    }
	    
	}
	
	public function format()
	{
	    if (!$this->session->userdata('username')){
		redirect('main/login');
	    }
	    
	    if (isset($_POST['file_format'])){
		$format = $this->input->post('file_format');
		$this->load->model('document');
		$records = $this->document->search_format($format);
		$data['list'] = $records;
		
		$data['view_name'] = 'search_results';
		$data['page_title'] = 'Search results';

		$this->load_view('search/listing/search_results',$data);
	    } else {
		$data['view_name'] = 'main';
		$data['page_title'] = 'Search the database';
		$data['active'] = 'search';

		$this->load_view('search/main',$data);
	    }
	}
	
	public function date()
	{
	    if (!$this->session->userdata('username')){
		redirect('main/login');
	    }
	    
	    if (isset($_POST['from'])){
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		$this->load->model('document');
		$records = $this->document->search_date($from,$to);
		$data['list'] = $records;
		
		$data['view_name'] = 'search_results';
		$data['page_title'] = 'Search results';

		$this->load_view('search/search_results',$data);
	    } else {
		$data['view_name'] = 'main';
		$data['page_title'] = 'Search the database';
		$data['active'] = 'search';

		$this->load_view('search/main',$data);
	    }
	}
	
}