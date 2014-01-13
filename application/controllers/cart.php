<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
	}
	
	public function add_cart() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) return "off-session";

		$data = array(
			'user_id'   => $mysession['user_id'],
			'flower_id' => $this->input->post("id")
		);

		$this->db->insert("cart", $data);
		$id = $this->db->insert_id();
		echo $id;
		return $id;
	}
	
	public function remove_cart() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) return "off-session";
		
		$cart_id = $this->input->post("id");
		//$data = array(
		//	'cart_status' => 1
		//);

		//$this->db->where("cart_id", $cart_id);
		//$this->db->update("cart", $data);
		$this->db->delete('cart', array("cart_id" => $cart_id)); 
		echo 0;
		return 0;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */