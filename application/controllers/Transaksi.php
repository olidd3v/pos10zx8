<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('auth_model');
        $this->load->library('form_validation');
		$this->load->model('transaksi_model');
		$this->load->model('supplier_model');
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
				$filter['purchase_transaction.id LIKE'] = "%".$_GET['id']."%";
			}
			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['DATE(purchase_transaction.date) >='] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['DATE(purchase_transaction.date) <='] = $_GET['date_end'];
			}

			$total_row = $this->transaksi_model->count_total_filter($filter);
			$data['transaksis'] = $this->transaksi_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->transaksi_model->count_total();
			$data['transaksis'] = $this->transaksi_model->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());
		$this->load->view('transaksi/index',$data);
	}

	function confirm_index(){
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
			$data['transaksis'] = $this->transaksi_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->transaksi_model->count_total();
			$data['transaksis'] = $this->transaksi_model->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());
		$this->load->view('transaksi/confirm_index',$data);
	}

	function report(){
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
			$data['transaksis'] = $this->transaksi_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->transaksi_model->count_total();
			$data['transaksis'] = $this->transaksi_model->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());
		$this->load->view('transaksi/report',$data);
	}

	function print_report(){
		$app = $this->setting_model->get_by_id(1);
		$data['app'] = $app;
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
			$data['transaksis'] = $this->transaksi_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->transaksi_model->count_total();
			$data['transaksis'] = $this->transaksi_model->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());
		$this->load->view('transaksi/print_report',$data);
	}
	
	function create(){
		// destry cart
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		$this->cart->destroy();
		$data['suppliers'] = $this->supplier_model->get_all();
		$data['kategoris'] = $this->kategori_model->get_all();
		$data['produks'] = $this->produk_model->get_all();
		$data['code_pembelian'] = "INP".strtotime(date("Y-m-d H:i:s"));
		$this->load->view('transaksi/form',$data);
	}

	function create_po($id){
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
		$data['code_po'] = "PO".strtotime(date("Y-m-d H:i:s"));
		$data['kategoris'] = $this->kategori_model->get_all();
		$data['details'] = $details;
		$this->load->view('transaksi/form_po',$data);
	}

	public function add_process_po(){
		$id_po = $this->input->post('id_pox');
		$product_id = $this->input->post('product_id');
		$qty = $this->input->post('qty');
		$po_price = $this->input->post('po_price');
			// $data = array(
			// 	'id' => $id_po,
			// 	'po_price' => $po_price
			// );
		// echo json_encode($data);
		$d = count($id_po);
		$c = count($id_po);

		for($z=0;$z<$c;$z++){
			$data_product = array (
				'id' => $product_id[$z],
				'product_qty' => $qty[$z],
			);
			$product = $this->produk_model->get_by_id($data_product['id']);
			foreach ($product as $v) {
				$qty_product = $v['product_qty'];
			}
			$fix_data_product = array (
				'id' =>$product_id[$z],
				'product_qty' => $qty_product+$qty[$z],
			);
			$this->db->where("id", $product_id[$z]);
			$this->db->update("product", $fix_data_product);
		}
		for($x=0;$x<$d;$x++){
            $data = array(
				'transaction_id' => $id_po[$x],
				'product_id' => $product_id[$x],
				'quantity' => $qty[$x],
				'price_item' => $po_price[$x],
				'subtotal' => $qty[$x]*$po_price[$x]
			);
		$this->db->where("transaction_id", $id_po[$x]);
		$this->db->where("product_id", $product_id[$x]);
		$this->db->update("purchase_data", $data);
		$val[$x]= $data['subtotal'];
		$qt[$x]= $data['quantity'];
		$idx = $data['transaction_id'];
		}
		$sum = array_sum($val);
		$sum_3 = count($qt);
		$arr = array('total_price' => $sum, 'total_item' => $sum_3);
		$this->db->where("id", $idx);
		$this->db->update("purchase_transaction", $arr);
		if ($data == TRUE) {
			redirect(site_url('transaksi/confirm_index'));
		}
	}
	private function _insert_purchase_data_po($transaction_id,$carts){
		foreach($carts as $key => $cart){
			$purchase_data = array(
				'transaction_id' => $transaction_id,
				'product_id' => $cart['id'],
				'category_id' => $cart['category_id'],
				'quantity' => $cart['qty'],
				'price_item' => $cart['price'],
				'subtotal' => $cart['subtotal']
			);
			// $this->transaksi_model->insert_purchase_data($purchase_data);

			$this->produk_model->update_qty_add($cart['id'],array('product_qty' => $cart['qty']));
		}
		$this->cart->destroy();
	}
	
	public function detail($id){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		$details = $this->transaksi_model->get_detail($id);
		if($details){
			$data['details'] = $details;
			$this->load->view('transaksi/detail',$data);
		}else{
			redirect(site_url('transaksi'));
		}
	}
	public function edit($id){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		// destry cart
		$this->cart->destroy();
		$data['suppliers'] = $this->supplier_model->get_all();
		$data['kategoris'] = $this->kategori_model->get_all();

		$transaksi = $this->transaksi_model->get_detail($id);
		if($transaksi){
			//print_r($transaksi); exit;
			$data['carts'] = $this->_process_cart($transaksi);
			$data['transaksi'] = $transaksi;
			$this->load->view('transaksi/form',$data);
		}else{
			redirect(site_url('transaksi'));
		}
	}

	private function _process_cart($transaksi = ''){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		if($transaksi & is_array($transaksi)){
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
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		$id = $this->input->post('id');
		$check_id = $this->transaksi_model->get_by_id($id);
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
		$data['judul_app'] = $this->setting_model->get_by_id(1);
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
		$this->form_validation->set_rules('transaction_id', 'transaction_id', 'required');
		$this->form_validation->set_rules('supplier_id', 'supplier_id', 'required');

		$carts =  $this->cart->contents();
		if($this->form_validation->run() != FALSE && !empty($carts) && is_array($carts)){
			$data['id'] = escape($this->input->post('transaction_id'));
			$data['supplier_id'] = escape($this->input->post('supplier_id'));
			$data['total_price'] = $this->cart->total();
			$data['total_item'] = count($carts);
			// $data['total_item'] = $this->cart->total_items();

			$this->transaksi_model->insert($data);
			if($data['id']){
				$this->_insert_purchase_data($data['id'],$carts);
			}
			echo json_encode(array('status' => 'ok'));
		}else{
			echo json_encode(array('status' => 'error'));
		}
	}
	private function _insert_purchase_data($transaction_id,$carts){
		foreach($carts as $key => $cart){
			$purchase_data = array(
				'transaction_id' => $transaction_id,
				'product_id' => $cart['id'],
				'category_id' => $cart['category_id'],
				'quantity' => $cart['qty'],
				'price_item' => $cart['price'],
				'subtotal' => $cart['subtotal']
			);
			$this->transaksi_model->insert_purchase_data($purchase_data);

			// $this->produk_model->update_qty_add($cart['id'],array('product_qty' => $cart['qty']));
		}
		$this->cart->destroy();
	}
	public function delete($transaction_id){
		$transaksi = $this->transaksi_model->get_detail($transaction_id);
		foreach($transaksi as $trans){
			$product = $this->produk_model->get_by_id($trans->product_id);
			$total = $product[0]['product_qty'] - $trans->quantity;
			$this->produk_model->update_qty($product[0]['id'] ,array('product_qty' => $total));
		}
		$this->transaksi_model->delete($transaction_id);
		$this->transaksi_model->delete_purchase_data_trx($transaction_id);
		redirect(site_url('transaksi'));
	}

	public function delete_po($transaction_id){
		$transaksi = $this->transaksi_model->get_detail($transaction_id);
		foreach($transaksi as $trans){
			$product = $this->produk_model->get_by_id($trans->product_id);
			$total = $product[0]['product_qty'] - $trans->quantity;
			$this->produk_model->update_qty($product[0]['id'] ,array('product_qty' => $total));
		}
		$this->transaksi_model->delete($transaction_id);
		$this->transaksi_model->delete_purchase_data_trx($transaction_id);
		redirect(site_url('transaksi/confirm_index'));
	}

	public function export_csv(){
		$filter = '';
		if(isset($_GET['search'])) {
			if (!empty($_GET['id']) && $_GET['id'] != '') {
				$filter['purchase_transaction.id LIKE'] = "%" . $_GET['id'] . "%";
			}

			if (!empty($_GET['date_from']) && $_GET['date_from'] != '') {
				$filter['DATE(purchase_transaction.date) >='] = $_GET['date_from'];
			}

			if (!empty($_GET['date_end']) && $_GET['date_end'] != '') {
				$filter['DATE(purchase_transaction.date) <='] = $_GET['date_end'];
			}
		}
		$result = $this->transaksi_model->get_filter_csv($filter);
		if($result){
			$result = $this->_set_csv_format($result);
		}
		//echo json_encode($result);
		$this->csv_library->export('transaksi.csv',$result);
	}

	private function _set_csv_format($datas){
		$result = false;
		if(is_array($datas)){
			$data_before = "";
			foreach($datas as $k => $data){
				$datas[$k]['date'] = date("Y-m-d H:i:s",strtotime($data['date']));
				if($data['id'] == $data_before) {
					$datas[$k]['id'] = "";
					$datas[$k]['total_price'] = "";
					$datas[$k]['total_item'] = "";

					$datas[$k]['date'] = "";
					$datas[$k]['supplier_id'] = "";
					$datas[$k]['supplier_name'] = "";
					$datas[$k]['supplier_phone'] = "";
					$datas[$k]['supplier_address'] = "";
					$datas[$k]['transaction_id'] = "";
					$datas[$k]['category_name'] = "";
				}
				$data_before = $data['id'];
			}
			$result = $datas;
		}
		return $result;
	}
	public function print_now($id = ""){
		$datax = $this->setting_model->get_by_id(1);
		$details = $this->transaksi_model->get_detail($id);
		if($details){
			$data['details'] = $details;
			$data['toko'] = $datax;
			$this->load->view("transaksi/print",$data);
		}else{
			redirect(site_url('transaksi'));
		}
	}
}
