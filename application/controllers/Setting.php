<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller {
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
		if(isset($_GET['search'])){
			$filter = array();
			if(!empty($_GET['value']) && $_GET['value'] != ''){
				$filter[$_GET['search_by'].' LIKE'] = "%".$_GET['value']."%";
			}

			$total_row = $this->setting_model->count_total_filter($filter);
			$data['settings'] = $this->setting_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->setting_model->count_total();
			$data['settings'] = $this->setting_model->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());

		$this->load->view('setting/index',$data);
	}
	
	public function create(){
		$code_setting = $this->setting_model->get_last_id();
		if($code_setting){
			$id = $code_setting[0]->id;
			$data['code_setting'] = generate_code('SUP',$id);
		}else{
			$data['code_setting'] = 'SUP001';
		}
		
		$this->load->view('setting/form',$data);
	}

	public function edit($id = ''){
		$check_id = $this->setting_model->get_by_id($id);
    $data['judul_app'] = $this->setting_model->get_by_id(1);
		if($check_id){
			$data['setting'] = $check_id[0];
			$this->load->view('setting/form',$data);
		}else{
			redirect(site_url('setting'));
		}
	}

	public function save($id = ''){
		$this->form_validation->set_rules('judul_app', 'judul_app', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'no_telp', 'required');
		$this->form_validation->set_rules('deskripsi_toko', 'deskripsi_toko', 'required');
		// $this->form_validation->set_rules('foto', 'foto', 'required');

		$data['id'] = escape($this->input->post('id'));
		$data['judul_app'] = escape($this->input->post('judul_app'));
		$data['alamat'] = escape($this->input->post('alamat'));
		$data['no_telp'] = escape($this->input->post('no_telp'));
		$data['deskripsi_toko'] = escape($this->input->post('deskripsi_toko'));
		// $data['foto'] = $this->input->post('foto');

    // $config['upload_path']          = './upload/';
    // $config['allowed_types']        = 'gif|jpg|jpeg|png';
    // $config['max_size']             = 1024; // 1MB
    // $this->load->library('upload', $config);
    // $this->upload->do_upload('foto');

		if ($this->form_validation->run() != FALSE && !empty($id)) {
			// EDIT
      
			$check_id = $this->setting_model->get_by_id($id);
			if($check_id){
				unset($data['id']);
				$this->setting_model->update($id,$data);        
			}
		}elseif($this->form_validation->run() != FALSE && empty($id)){
			// INSERT NEW
			$this->setting_model->insert($data);
		}else{
			$this->session->set_flashdata('form_false', 'Harap periksa form anda.');
			redirect(site_url('setting/edit/1'));
		}
		redirect(site_url('setting/edit/1'));
	}
	public function delete($id){
		$check_id = $this->setting_model->get_by_id($id);
		if($check_id){
			$this->setting_model->delete($id);
		}
		redirect(site_url('setting'));
	}
	public function export_csv(){
		$filter = false;
		if(isset($_GET['search'])) {
			$filter = array();
			if (!empty($_GET['value']) && $_GET['value'] != '') {
				$filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
			}
		}
		$data = $this->setting_model->get_all_array($filter);
		$this->csv_library->export('setting.csv',$data);
	}
}
