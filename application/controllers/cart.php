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
		$this->db->where("cart.user_id", $mysession['user_id']);
		$this->db->where("flower.flower_availability >", 1);
		$this->db->where("flower.flower_status",0);
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
	
	public function order() {
		$mysession = $this->session->userdata('logged');
		$flower_id = $this->uri->segment(3);

		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id', 'left');
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'left');
		$this->db->join('category', 'category.category_id = flower.category', 'left');
		$this->db->where("flower.flower_id", $flower_id);
		$this->db->where("flower_image.flower_main", 1);
		$this->db->where("flower.flower_status",0);
		$flower = $this->db->get();
		
		$this->db->where("user_id", $mysession["user_id"]);
		$user = $this->db->get("users");

		$data = array(
			'user'    => $user->result(),
			'session' => $mysession,
			'flower'  => $flower->result(),
			'payment' => $this->db->get("payment")
		);
		
		$this->load->view('pages/order', $data);
	}
	
	public function add_order() {
		$flower_id = $this->input->post("flower_id");
		$user_id = $this->input->post("user_id");
		$payment = $this->input->post("payment");
		$receiver = $this->input->post("receiver");
		$receiver_no = $this->input->post("receiver_no");
		$delivery_date = $this->input->post("delivery_date");
		$receiver_address = $this->input->post("receiver_address");
		$card_message = $this->input->post("card_message");

		$this->db->delete('cart', array("user_id" => $user_id, "flower_id" => $flower_id));

		$data = array(
			'user_id' => $user_id,
			'flower_id' => $flower_id,
			'payment' => $payment,
			'receiver' => $receiver,
			'receiver_no' => $receiver_no,
			'delivery_date' => $delivery_date,
			'receiver_address' => $receiver_address,
			'card_message' => $card_message,
			'order_status' => 0,
		);
		$this->db->insert("orders", $data);
		
		redirect("cart");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */