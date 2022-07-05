<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('setting_model');
        $this->load->model('user_model');
        $this->load->library('form_validation');

        // Check Session Login
        if(!isset($_SESSION['logged_in'])){
            redirect(site_url('auth/login'));
        }
    }

    public function index(){
        $data['judul_app'] = $this->setting_model->get_by_id(1);
        if(isset($_GET['search'])){
            $filter = array();
            if(!empty($_GET['value']) && $_GET['value'] != ''){
                $filter[$_GET['search_by'].' LIKE'] = "%".$_GET['value']."%";
            }
            
            $total_row = $this->user_model->count_total_filter($filter);
            
            $result = $this->user_model->get_filter($filter,url_param());
            $data['users'] = $result;
        }else{
            $total_row = $this->user_model->count_total();
            
            $result = $this->user_model->get_all(url_param());
            $data['users'] = $result;
        }
        $data['paggination'] = get_paggination($total_row,get_search());

        $this->load->view('user/index',$data);
    }

    public function create(){
        $data['judul_app'] = $this->setting_model->get_by_id(1);
        $this->load->view('user/form', $data);
    }

    public function check_id(){
        $data['judul_app'] = $this->setting_model->get_by_id(1);
        $id = $this->input->post('id');
        $check_id = $this->user_model->get_by_id($id);
        if(!$check_id){
            echo "available";
        }else{
            echo "unavailable";
        }
    }

    public function edit($id = ''){
        $data['judul_app'] = $this->setting_model->get_by_id(1);
        $check_id = $this->user_model->get_by_id($id);
        if($check_id){
            $data['user'] = $check_id[0];
            $this->load->view('user/form',$data);
        }else{
            redirect(site_url('user'));
        }
    }

    public function save($id = ''){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        $data['username'] = escape($this->input->post('username'));
        $data['name'] = escape($this->input->post('name'));
        $data['email'] = escape($this->input->post('email'));
        $data['password'] = md5(escape($this->input->post("password")));
        $data['role'] = escape($this->input->post('role'));

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            // EDIT
            $check_id = $this->user_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->user_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            // INSERT NEW
            $this->user_model->insert($data);
        }else{
            $this->session->set_flashdata('form_false', 'Harap periksa form anda.');
            redirect(site_url('user/create'));
        }
        redirect(site_url('user'));
    }
    public function delete($id){
        $check_id = $this->user_model->get_by_id($id);
        if($check_id){
            $this->user_model->delete($id);
        }
        redirect(site_url('user'));
    }
    public function export_csv(){
        $filter = false;
        if(isset($_GET['search'])) {
            if (!empty($_GET['value']) && $_GET['value'] != '') {
                $filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
            }
        }
        $data = $this->user_model->get_all_array($filter);
        $this->csv_library->export('pelanggan.csv',$data);
    }
}
