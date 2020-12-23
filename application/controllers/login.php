<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		$this->load->view('header');
		$this->load->model('user');
		$data['fetch_data'] = $this->user->get_data();
		$this->load->view('login_page', $data);
		
	}
	public function auth(){
		$this->load->model('user');
		$u = $this->input->post('username');
		$p = $this->input->post('password');
		$this->user->login_user_model($u, $p);
	}
	
	
}
