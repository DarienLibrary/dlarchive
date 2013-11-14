<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {
	
	public function main($offset=null)
	{
	    if (!$this->session->userdata('username')){
		redirect('main/login');
	    }
	    if (isset($_GET['reset']) && $_GET['reset'] == true) {
		$this->session->unset_userdata('search_filters');
		$this->session->unset_userdata('filters_set');
		$this->session->unset_userdata('results_per_page');
	    }
	    
	    if (isset($_POST['results_per_page'])){
		$this->session->set_userdata('results_per_page',(int)$this->input->post('results_per_page'));
	    } elseif (!$this->session->userdata('results_per_page')){
		$this->session->set_userdata('results_per_page',20);
	    }
	    
	    $filters_passed = false;
	    if (isset($_POST['keyword'])){
		// Read the posted form fields
		$keyword = $this->input->post('keyword');
		$format  = $this->input->post('file_format');
		$from    = $this->input->post('from');
		$to      = $this->input->post('to');
		$filters_passed = true;
	    } else {
		//$session_filters = $this->session->userdata('search_filters');
		if ($this->session->userdata('filters_set') == 'true'){
		    $search_data = $this->session->userdata('search_filters');
		    if (!empty($search_data['keyword'])) $keyword = $search_data['keyword'];
		    if (!empty($search_data['format']))  $format  = $search_data['format'];
		    if (!empty($search_data['from']))    $from    = $search_data['from'];
		    if (!empty($search_data['to']))      $to      = $search_data['to'];
		    $filters_passed = true;
		}
	    }
	    // Check if search form is posted 
	    if ($filters_passed){
		// For every field that has been set add a search filter
		$filters = array();
		if (!empty($keyword)) $filters['keyword'] = $keyword;
		if (!empty($format) && ($format != 'all'))  $filters['format'] = $format;
		if (!empty($from))    $filters['from'] = $from;
		if (!empty($to))      $filters['to'] = $to;
		
		$this->session->set_userdata('filters_set','true');
		$this->session->set_userdata('search_filters',$filters);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/search/main';
		$config['per_page'] = $this->session->userdata('results_per_page');
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';

		// Call the model and pass through the filters to be used
		$this->load->model('document');
		$results = $this->document->search($filters,$offset,$config['per_page']);
		$data['list'] = $results['page'];
		
		$data['view_name'] = 'search_results';
		$data['page_title'] = 'Search results';
		
		$config['total_rows'] = $results['count'];
		$this->pagination->initialize($config);
		
		// Load the view that displays the search results
		$this->load_view('search/listing/search_results',$data);
		
	    } else {
		// If not form is posted nor pagination has been used, load the search form
		$data['view_name'] = 'main';
		$data['page_title'] = 'Search the database';
		$data['active'] = 'search';

		$this->load_view('search/main',$data);
	    }   
	}
	
}