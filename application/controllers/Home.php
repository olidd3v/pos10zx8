<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('supplier_model');
		$this->load->model('produk_model');
		$this->load->model('kategori_model');
    		$this->load->model('penjualan_model');
    		$this->load->model('transaksi_model');
		$this->load->model('setting_model');
		$this->load->model('retur_purchase_model');

		
		// Check Session Login
		if(!isset($_SESSION['logged_in'])){
			redirect(site_url('auth/login'));
		}
	}
	
	function index(){
		redirect(site_url('home/dashboard'));
	}
	
	function dashboard(){
    $data['judul_app'] = $this->setting_model->get_by_id(1);
		$date = date('Y-m-d', strtotime("+30 days"));
		$filter['DATE(sales_transaction.pay_deadline_date) <='] = $date;
		$limit_offset['limit'] = 10;
		$limit_offset['offset'] = 0;
		$data['suppliers'] = $this->supplier_model->count_total();
		$data['penjualan_model'] = $this->penjualan_model->count_total();
		$data['transaksi_model'] = $this->transaksi_model->count_total();
		$data['products'] = $this->produk_model->count_total();
		$data['retur_purchase_model'] = $this->retur_purchase_model->count_total();
		$data['categories'] = $this->kategori_model->count_total();
		$this->load->view('home/dashboard',$data);
	}
	
	private function penjualan_daily($bulanan = false){
		$today = date("Y-m-d",strtotime("today"));
		$yesterday = date("Y-m-d",strtotime("-1 day"));	
		if($bulanan){
			$yesterday = date("Y-m-d",strtotime("-30 day"));	
		}	

		$filter['DATE(sales_transaction.date) >='] = $yesterday;
		$filter['DATE(sales_transaction.date) <='] = $today;

		$penjualans = $this->penjualan_model->get_filter($filter,url_param());
		return $penjualans;
	}
}
