<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	function __construct(){
        parent::__construct();
	}
	
	public function check_login($username,$password){
		$query = $this->db->get_where("user",array("username" => $username, "password" => $password) );
		return $query->result();
	}

	public function prof(){
		$query = $this->db->get_where("user",array("id" => $_SESSION['id']) );
		return $query->result();
	}

	public function get_profile($user_id){
		$query = $this->db->get_where("user",array("id" => $user_id) );
		return $query->result();
	}
	
	public function set_session($id,$username,$role){
		$this->db->select('role');
    $this->db->from('user');
    $this->db->where('id',$id);
		$newdata = array(
			'id'		=> $id,
			'username'  => $username,
			'role'  => $this->db->get()->row()->role,
			'logged_in' => TRUE
		);
		$this->session->set_userdata($newdata);
	}
	public function unset_session(){
		session_destroy();
	}
	public function set_cookie_remember($username){
		setcookie('remember_me',$username, time() + (86400 * 30), "/");
	}	
	public function unset_cookie_remember(){
		setcookie('remember_me','',0,'/');
	}
}