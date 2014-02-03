<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("");

		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'inner');
		$this->db->join('category', 'category.category_id = flower.category', 'inner');
		$this->db->where("flower.flower_status", 0);
		$this->db->where("orders.order_status", 1);
		$this->db->where("orders.user_id", $mysession['user_id']);
		$this->db->group_by("flower.flower_id"); 
		$flower = $this->db->get();

		$data = array(
			'session' => $mysession,
			'flower'  => $flower->result()
		);
		
		$this->load->view('pages/orders', $data);
	}
	
	public function cancel_order() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) return false;

		$id = $this->input->post("order_id");
		$data = array(
			'order_status' => 0
		);
		
		$this->db->where("order_id", $id);
		$this->db->update("orders", $data);
		
		return TRUE;
	}
	
	public function append() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) return false;

		$order_status = $this->input->post("order_status");
		$f_categ = $this->input->post("f_categ");
		$date = $this->input->post("date");
		$action = $this->input->post("action");

		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'inner');
		$this->db->join('category', 'category.category_id = flower.category', 'inner');
		if($action == 1) {
			$this->db->like('orders.order_date', $date);
			$this->db->where("flower.flower_category", $f_categ);
		}
		$this->db->where("flower.flower_status", 0);
		$this->db->where("orders.order_status", $order_status);
		if($action == 0) {
			$this->db->where("orders.user_id", $mysession['user_id']);
		}
		$this->db->group_by("flower.flower_id"); 
		$flower = $this->db->get();

		$data = array(
			'counter' => $flower->num_rows(),
			'flower' => $flower->result(),
			'status'  => $order_status,
			'category' => $f_categ
		);
		
		$this->load->view("user_append/orders", $data);
	}
	
	public function order() {
		$mysession = $this->session->userdata('logged');
		$flower_id = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id', 'left');
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'left');
		$this->db->join('category', 'category.category_id = flower.category', 'left');
		if($action == 1):
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'left');
		endif;
		$this->db->where("flower.flower_id", $flower_id);
		$this->db->where("flower_image.flower_main", 1);
		$this->db->where("flower.flower_status",0);
		$flower = $this->db->get();
		// var_dump($flower->result());
		
		$this->db->where("user_id", $mysession["user_id"]);
		$user = $this->db->get("users");

		$data = array(
			'action'  => $action,
			'user'    => $user->result(),
			'session' => $mysession,
			'flower'  => $flower->result(),
			'payment' => $this->db->get("payment")
		);
		
		$this->load->view('pages/order', $data);
	}

	public function add_order() {
		$action = $this->input->post("action");
		$flower_id = $this->input->post("flower_id");
		$user_id = $this->input->post("user_id");
		// $payment = $this->input->post("payment");
		$receiver = $this->input->post("receiver");
		$receiver_no = $this->input->post("receiver_no");
		$delivery_date = $this->input->post("delivery_date");
		$quantity = $this->input->post("quantity");
		$receiver_address = $this->input->post("receiver_address");
		$card_message = $this->input->post("card_message");
		$suggestions = $this->input->post("suggestions");

		if($action == 0) {
			$this->db->delete('cart', array("user_id" => $user_id, "flower_id" => $flower_id));
		}

		$data = array(
			'user_id' => $user_id,
			// 'payment' => $payment,
			'flower_id' => $flower_id,
			'receiver' => $receiver,
			'receiver_no' => $receiver_no,
			'delivery_date' => $delivery_date,
			'quantity' => $quantity,
			'receiver_address' => $receiver_address,
			'card_message' => $card_message,
			'order_status' => 1, // 0 cancel, 1 pending , 2 = On delivery, 3 = Delivered, 4 = Processing
			'order_date' => date("Y-m-d"),
			'suggestions' => $suggestions,
		);

		if($action == 0) {
			$this->db->insert("orders", $data);
		} else {
			$order_id = $this->input->post("order_id");
			$this->db->where("order_id", $order_id);
			$this->db->update("orders", $data);
		}

		echo $action;
		return $action;
	}
	
	public function details() {
		$order_id = $this->input->post("order_id");
		$flower_id = $this->input->post("flower_id");
		
		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id', 'left');
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'left');
		$this->db->join('category', 'category.category_id = flower.category', 'left');
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'left');
		$this->db->where("flower.flower_id", $flower_id);
		$this->db->where("orders.order_id", $order_id);
		$this->db->where("flower_image.flower_main", 1);
		$this->db->where("flower.flower_status",0);
		$flower = $this->db->get();
		
		$data = array(
			'flower' => $flower->result()
		);
		
		$this->load->view("user_append/modal", $data);
	}
	
	public function billing() {
		$order_id = $this->input->post("order_id");
		$flower_id = $this->input->post("flower_id");
		
		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id', 'left');
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'left');
		$this->db->join('category', 'category.category_id = flower.category', 'left');
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'left');
		$this->db->where("flower.flower_id", $flower_id);
		$this->db->where("orders.order_id", $order_id);
		$this->db->where("flower_image.flower_main", 1);
		$this->db->where("flower.flower_status",0);
		$flower = $this->db->get();
		
		$data = array(
			'flower' => $flower->result()
		);
		
		$this->load->view("user_append/billing", $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
