<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("");
		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'inner');
		$this->db->join('category', 'category.category_id = flower.category', 'inner');
		$this->db->where("cart.user_id", $mysession['user_id']);
		$this->db->where("flower.flower_status", 0);
		$this->db->group_by("flower.flower_id"); 
		$flower = $this->db->get();

		$data = array(
			'session' => $mysession,
			'flower'  => $flower->result()
		);
		
		$this->load->view('pages/cart', $data);
	}

	public function add_cart() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) {
			$off = "off-session";
			echo $off;
			return $off;
		}

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
		if(!$mysession) {
			$off = "off-session";
			echo $off;
			return $off;
		}
		
		$cart_id = $this->input->post("id");

		$this->db->delete('cart', array("cart_id" => $cart_id)); 
		echo 0;
		return 0;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */