<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {
    
	public function index(){
	     if (!$this->session->userdata('username')){
		redirect('main/login');
	    } else {
		redirect('upload');
	    }
	}

	// Authenticates the username and password submitted at the login
	// For the moment the acceptable username and password are hardcoded
	private function _validate_login($username,$password){
	    
	    if (($username == 'archiver')&&($password == 'libpass')) {
		return true;
	    } else {
		$this->login_error = 'Wrong username or password!';
		return false;
	    }
	}		
    
	// This method is called when the user presses the login button
	public function login()
	{
	    if ($this->session->userdata('username')){
		redirect('upload/index');
	    }
	    
	    // If there is not login form submitted
	   if (!($this->input->post('login_form'))) {
	       $this->_show_login_page();
	   } else { // Login form has been submitted
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// Authentication was successful
		if ($this->_validate_login($username,$password)) {
			// Store the username in the session
			$session_data = array(
			    'username'	=>  $username,
			);
			$this->session->set_userdata($session_data);
			// Redirect to main page
			redirect('upload/index');
		// Authentication failed
		} else {
			$this->_show_login_page();
		}
	   }
	}
	
	// Show the login page
	private function _show_login_page(){
	    
	    $data = array();
	    $data['page_title'] = 'Login Page';
	    
	    if (isset($this->login_error))
		$data['login_error'] = $this->login_error;
	    
	    // Load the login page
	    $this->load_view('main/login',$data);
	    
	}
	
	// Logs out the user
	public function logout()
	{   
	    $this->session->sess_destroy();
	    redirect('main/login');
	}
}
?>