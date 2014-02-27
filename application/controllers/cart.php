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
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'left');
		$this->db->join('category', 'category.category_id = flower.category', 'left');
		$this->db->where("cart.user_id", $mysession['user_id']);
		$this->db->where("flower.flower_status", 0);
		$this->db->group_by("flower.flower_id"); 
		$flower = $this->db->get();
		
		$fee = $this->db->get("fee");
		$add_ons = $this->db->get("add_ons");

		$data = array(
			'session' => $mysession,
			'flower'  => $flower->result(),
			'fee'     => $fee->result(),
			'add_ons' => $add_ons->result(),
			'payment' => $this->db->get("payment"),
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
			'flower_id' => $this->input->post("id"),
			'quantity'  => 1
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
		$this->db->where("cart_id", $cart_id);
		$cart_count = $this->db->get("cart");
		if( $cart_count->num_rows() < 1 ) {
			echo 0;
			return 0;
		}

		$this->db->delete('cart', array("cart_id" => $cart_id)); 
		echo 0; return 0;
	}
	
	public function quantity() {
		$quantity = $this->input->post("quantity");
		$cart_id = $this->input->post("cart_id");
		$this->db->where("cart_id", $cart_id);
		$this->db->update("cart", array("quantity" => $quantity));
		
		return TRUE;
	}
	
	public function order_all() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) return false;

		$cart_ids = $this->input->post("order_all");
		$cart_ids = explode(',', $cart_ids);
		$payment = $this->input->post("payment");
		$fee = $this->input->post("delivery_fee");
		$receiver = $this->input->post("receiver");
		$receiver_no = $this->input->post("receiver_no");
		$delivery_date = $this->input->post("delivery_date");
		$receiver_address = $this->input->post("receiver_address");
		$card_message = $this->input->post("card_message");
		$suggestions = $this->input->post("suggestions");
		if($delivery_date <= date("Y-m-d")) {
			$invalid = "invalid_date";
			echo $invalid;
			return $invalid;
		}

		foreach($cart_ids as $ci) {
			$this->db->where("cart_id", $ci);
			$cart = $this->db->get("cart");
			foreach($cart->result() as $ct) {
				$data = array(
					'user_id' => $ct->user_id,
					'payment' => $payment,
					'flower_id' => $ct->flower_id,
					'receiver' => $receiver,
					'receiver_no' => $receiver_no,
					'delivery_date' => $delivery_date,
					'quantity' => $ct->quantity,
					'receiver_address' => $receiver_address,
					'card_message' => $card_message,
					'delivery_fee' => $fee,
					'order_status' => 1, // 0 cancel, 1 pending , 2 = On delivery, 3 = Delivered, 4 = Processing
					'order_date' => date("Y-m-d"),
					'suggestions' => $suggestions,
				);
				// insert to orders
				$this->db->insert("orders", $data);
				// get order id and own the add_ons
				$order_id = $this->db->insert_id();
				$addons = array("cart_id" => NULL, "order_id" => $order_id);
				$this->db->where("cart_id", $ct->cart_id);
				$this->db->update("order_add_ons", $addons);

				// Delete the cart after insert to order tabl
				$this->db->delete('cart', array("cart_id" => $ct->cart_id));
			}
			echo print_r($cart->result());
		}
		return TRUE;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */