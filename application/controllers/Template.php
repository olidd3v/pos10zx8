<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MY_Controller {
	function __construct(){
        parent::__construct();
		    $this->load->model('setting_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
		
		// Check Session Login
		if(!isset($_SESSION['logged_in'])){
			redirect(site_url('auth/login'));
		}
	}
	
	public function index(){
    $data['judul_app'] = $this->setting_model->get_by_id(1);
		$this->load->view('element/header.php',$judul_app);
	}
	

}
