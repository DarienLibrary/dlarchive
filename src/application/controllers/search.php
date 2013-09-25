<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {
	
	public function main()
	{
	    if (!$this->session->userdata('username')){
		redirect('main/login');
	    }
	    
	    if (isset($_POST['searchbox'])){
		$keyword = $this->input->post('searchbox');
		$this->load->model('document');
		$records = $this->document->search($keyword);
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