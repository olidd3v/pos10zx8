<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_purchase extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('auth_model');
        $this->load->library('form_validation');
		$this->load->model('retur_purchase_model');
		$this->load->model('transaksi_model');
		$this->retur_purchase = $this->retur_purchase_model;
		$this->load->model('penjualan_model');
		$this->load->model('kategori_model');
		$this->load->model('produk_model');
		$this->load->model('setting_model');

		
		// Check Session Login
		if(!isset($_SESSION['logged_in'])){
			redirect(site_url('auth/login'));
		}
	}
	
	function index(){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		if(isset($_GET['search'])){
			$filter = array();
			if(!empty($_GET['id']) && $_GET['id'] != ''){
				$filter['purchase_retur.id ='] = $_GET['id'];
			}

			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['DATE(purchase_retur.date) >='] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['DATE(purchase_retur.date) <='] = $_GET['date_end'];
			}

			$total_row = $this->retur_purchase->count_total_filter($filter);
			$data['penjualans'] = $this->retur_purchase->get_filter($filter,url_param());
		}else{
			$total_row = $this->retur_purchase->count_total();
			$data['penjualans'] = $this->retur_purchase->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());
		$this->load->view('retur_purchase/index',$data);
	}

	function report(){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		if(isset($_GET['search'])){
			$filter = array();
			if(!empty($_GET['id']) && $_GET['id'] != ''){
				$filter['purchase_retur.id LIKE'] = "%".$_GET['id']."%";
			}

			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['DATE(purchase_retur.date) >='] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['DATE(purchase_retur.date) <='] = $_GET['date_end'];
			}

			$total_row = $this->retur_purchase->count_total_filter($filter);
			$data['penjualans'] = $this->retur_purchase->get_filter_newx($filter,url_param());
		}else{
			$total_row = $this->retur_purchase->count_total();
			$data['penjualans'] = $this->retur_purchase->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());
		$this->load->view('retur_purchase/report',$data);
	}
	
	function print_report(){
		$app = $this->setting_model->get_by_id(1);
		$data['app'] = $app;
		if(isset($_GET['search'])){
			$filter = array();
			if(!empty($_GET['id']) && $_GET['id'] != ''){
				$filter['purchase_retur.id LIKE'] = "%".$_GET['id']."%";
			}

			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['DATE(purchase_retur.date) >='] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['DATE(purchase_retur.date) <='] = $_GET['date_end'];
			}

			$total_row = $this->retur_purchase->count_total_filter($filter);
			$data['penjualans'] = $this->retur_purchase->get_filter_newx($filter,url_param());
		}else{
			$total_row = $this->retur_purchase->count_total();
			$data['penjualans'] = $this->retur_purchase->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());
		$this->load->view('retur_purchase/print_report',$data);
	}
	
	function create(){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		if(isset($_GET['search'])){
			$filter = array();
			if(!empty($_GET['id']) && $_GET['id'] != ''){
				$filter['purchase_transaction.id LIKE'] = "%".$_GET['id']."%";
			}

			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['DATE(purchase_transaction.date) >='] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['DATE(purchase_transaction.date) <='] = $_GET['date_end'];
			}

			$total_row = $this->transaksi_model->count_total_filter($filter);
			$data['penjualans'] = $this->transaksi_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->transaksi_model->count_total();
			$data['penjualans'] = $this->transaksi_model->get_all(url_param());
		}
		$data['retur'] = true;
		$data['paggination'] = get_paggination($total_row,get_search());
		$this->load->view('retur_purchase/retur_index',$data);
	}

	public function print_now($id = ""){
		$datax = $this->setting_model->get_by_id(1);
		$details = $this->retur_purchase->get_detail_by_id($id);
		if($details){
			$data['details'] = $details;
			$data['toko'] = $datax;
			$this->load->view("retur_purchase/print",$data);
		}else{
			redirect(site_url('retur_purchase?page'));
		}
	}

	function create_retur($id){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		// destry cart
		$this->cart->destroy();

		$details = $this->transaksi_model->get_detail($id);
		if(!$details){
			redirect(site_url());
		}
		$cart_data = $this->_process_cart($details);
		//print_r($cart_data); exit;
		$data['carts'] = $cart_data;
		$data['code_penjualan'] = $id;
		$data['code_retur_penjualan'] = "RETP".strtotime(date("Y-m-d H:i:s"));
		$data['kategoris'] = $this->kategori_model->get_all();
		$data['details'] = $details;
		$this->load->view('retur_purchase/form',$data);
	}
	
	public function detail($id){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		$details = $this->retur_purchase->get_detail_by_id($id);
		if($details){
			$data['details'] = $details;
			$this->load->view('retur_purchase/detail',$data);
		}else{
			redirect(site_url('retur_purchase'));
		}
	}

	public function update_cart($rowid = ''){
		$qty = $this->input->post("qty");
		$data = array(
			'rowid' => $rowid,
			'qty'   => $qty
		);
		$this->cart->update($data);

		echo json_encode(
			array(
				'data' => $this->cart->contents(),
				'total' => $this->cart->total()
			)
		);
	}

	private function _process_cart($transaksi = ''){
		if(!empty($transaksi) & is_array($transaksi)){
			foreach($transaksi as $key => $item){
				$data = array(
					'id'      => $item->product_id,
					'qty'     => $item->quantity,
					'price'   => $item->price_item,
					'category_id' => $item->category_id,
					'category_name' => $item->category_name,
					'name'    => $item->product_name
				);
				$this->cart->insert($data);
			}
		}
		$response = array(
				'data' => $this->cart->contents() ,
				'total_item' => $this->cart->total_items(),
				'total_price' => $this->cart->total()
			);
		return $response;
	}

	public function check_id(){
		$id = $this->input->post('id');
		$check_id = $this->penjualan_model->get_by_id($id);
		if(!$check_id){
			echo "available";
		}else{
			echo "unavailable";
		}
	}
	
	public function check_category_id($category_id){
		$products = $this->produk_model->get_by_category($category_id);
		echo json_encode($products);
	}
	public function check_product_id($product_id){
		$products = $this->produk_model->get_by_id($product_id);
		echo json_encode($products);
	}
	public function add_item(){
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$sale_price = $this->input->post('sale_price');

		$get_product_detail =  $this->produk_model->detail_by_id($product_id);
		if($get_product_detail){
			$data = array(
				'id'      => $product_id,
				'qty'     => $quantity,
				'price'   => $sale_price,
				'category_id' => $get_product_detail[0]['category_id'],
				'category_name' => $get_product_detail[0]['category_name'],
				'name'    => $get_product_detail[0]['product_name']
			);
			$this->cart->insert($data);
			echo json_encode(array('status' => 'ok',
							'data' => $this->cart->contents() ,
							'total_item' => $this->cart->total_items(),
							'total_price' => $this->cart->total()
						)
				);
		}else{
			echo json_encode(array('status' => 'error'));
		}

	}
	public function delete_item($rowid){
		if($this->cart->remove($rowid)) {
			echo number_format($this->cart->total());
		}else{
			echo "false";
		}
	}

	public function add_process(){
		$return_is = $this->input->post('is_return');
		$idr = $this->input->post('retur_id');
		$retur_code = $this->input->post('retur_code');
		$idx = $this->input->post('idx');
		$qty = $this->input->post('qty');
		$total_price = $this->input->post('total_price');
		$d = count($idx);
		$z = count($idx);
		
		for($e=0;$e<$z;$e++){
			$data_qty_retur = array (
				'qty' => $qty[$e],
				'total_price' => $total_price[$e]
			);
			$val[$e] = $data_qty_retur['qty'];
			$total_price_f[$e] = $data_qty_retur['total_price'];

		}
		$sum_2 = array_sum($total_price_f);
		$sum = count($val);
		// $sum = array_sum($val);
		$update_is = array (
			'id' => $idr,
			'sales_retur_id' => $retur_code,
			'total_price' => $sum_2,
			'total_item' => $sum,
			'is_return' => 0
		);
		$this->db->insert("purchase_retur", $update_is);
			for($x=0;$x<$d;$x++){
				$data_product = array (
					'id' => $idx[$x],
					'product_qty' => $qty[$x],
				);
				$product = $this->produk_model->get_by_id($data_product['id']);
				foreach ($product as $v) {
					$qty_product = $v['product_qty'];
				}
				$fix_data_product = array (
					'id' =>$idx[$x],
					'product_qty' => $qty_product-$qty[$x],
				);
				$this->db->where("id", $idx[$x]);
				$this->db->update("product", $fix_data_product);
			}
			redirect(site_url('retur_purchase'));

		// $this->form_validation->set_rules('retur_id', 'retur_id', 'required');
		// $this->form_validation->set_rules('retur_code', 'retur_code', 'required');
		// $this->form_validation->set_rules('retur_date', 'retur_date', 'required');

		// $carts =  $this->cart->contents();

		// if($this->form_validation->run() != FALSE && !empty($carts) && is_array($carts)){
		// 	$data['id'] = escape($this->input->post('retur_id'));
		// 	$data['sales_retur_id'] = escape($this->input->post('retur_code'));
		// 	$data['total_price'] = $this->cart->total();
		// 	$data['total_item'] = $this->cart->total_items();
		// 	$data['is_return'] = "0";
		// 	$data['date'] = escape($this->input->post('retur_date'));

		// 	$this->retur_purchase->insert($data);
		// 	if($data['id']){
		// 		$this->_insert_purchase_data($data['id'],$carts);
		// 	}
		// 	echo json_encode(array('status' => 'ok'));
		// 	redirect(site_url('retur_purchase'));
		// }else{
		// 	echo json_encode(array('status' => 'error', 'carts' => $carts));
		// }
	}

	public function edit($retur_id){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		// destry cart
		$this->cart->destroy();

		$details = $this->retur_purchase->get_detail_by_id($retur_id);
		$details_sales = $this->retur_purchase->get_detail_by_sales_id($retur_id);
		if((!$details || $details[0]->is_return == 1) && (!$details_sales || $details_sales[0]->is_return == 1)){
			redirect(site_url('retur_purchase'));
		}
		if(!$details){
			$details = $details_sales;
		}
		$cart_data = $this->_process_cart($details);
		//print_r($this->db); exit;
		$data['edit'] = true;
		$data['carts'] = $cart_data;
		$data['code_penjualan'] = $details[0]->sales_retur_id;
		$data['code_retur_penjualan'] = $details[0]->id;
		$data['date'] = $details[0]->date;
		$data['details'] = $details;
		$this->load->view('retur_purchase/form',$data);
	}

	public function update($retur_id = 0){
		$return_is = $this->input->post('is_return');
		$idx = $this->input->post('idx');
		$qty = $this->input->post('qty');
		$d = count($idx);
		$z = count($idx);
		for($e=0;$e<$z;$e++){
			$data_qty_retur = array (
				'qty' => $qty[$e]
			);
			$val[$e] = $data_qty_retur['qty'];
		}
		$sum = array_sum($val);
		$update_is = array (
			'id' => $retur_id,
			'total_item' => $sum,
			'is_return' => $return_is
		);
		$this->db->where("id", $retur_id);
		$this->db->update("purchase_retur", $update_is);
		if ($return_is == 1) {
			for($x=0;$x<$d;$x++){
				$data_product = array (
					'id' => $idx[$x],
					'product_qty' => $qty[$x],
				);
				$product = $this->produk_model->get_by_id($data_product['id']);
				foreach ($product as $v) {
					$qty_product = $v['product_qty'];
				}
				$fix_data_product = array (
					'id' =>$idx[$x],
					'product_qty' => $qty_product+$qty[$x],
				);
				$this->db->where("id", $idx[$x]);
				$this->db->update("product", $fix_data_product);
			}
			redirect(site_url('retur_purchase'));
		}else{
			redirect(site_url('retur_purchase'));
		}	
	}

	private function _check_qty($carts){
		$result = true;
		foreach($carts as $cart) {
			// Check Quantity Product
			$product = $this->produk_model->get_by_id($cart['id']);
			$qty = $product[0]['product_qty'];
			if($cart['qty'] > $qty){
				$result = false;
				break;
			}
		}
		return $result;
	}

	private function _insert_purchase_data($sales_id,$carts){
		foreach($carts as $key => $cart){
			$purchase_data = array(
				'transaction_id' => $sales_id,
				'product_id' => $cart['id'],
				'category_id' => $cart['category_id'],
				'quantity' => $cart['qty'],
				'price_item' => $cart['price'],
				'subtotal' => $cart['subtotal']
			);
			$this->transaksi_model->insert_purchase_data($purchase_data);

			$this->produk_model->update_qty_min($cart['id'],array('product_qty' => $cart['qty']));
		}
		$this->cart->destroy();
	}
	public function delete($retur_id){
		$details = $this->retur_purchase->get_detail_by_id($retur_id);
		$details_sales = $this->retur_purchase->get_detail_by_sales_id($retur_id);

		$this->retur_purchase->delete($retur_id);

		if((!$details || $details[0]->is_return == 1) && (!$details_sales || $details_sales[0]->is_return == 1)){
			redirect(site_url('retur_purchase'));
		}
		if(!$details){
			$details = $details_sales;
		}

		// Delete Row on sales_data table
		foreach($details as $detail){
			$this->retur_purchase->delete_data($detail->sales_id);
		}
		$this->retur_purchase->delete($retur_id);
		redirect(site_url('retur_purchase'));
	}
	public function export_csv(){
		$data = $this->retur_purchase->get_filter('',url_param(),true);
		$this->csv_library->export('retur_purchase.csv',$data);
	}
}
