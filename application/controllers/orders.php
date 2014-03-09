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
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'left');
		$this->db->join('category', 'category.category_id = flower.category', 'left');
		// $this->db->join('order_add_ons', 'order_add_ons.order_id = orders.order_id', 'left');
		$this->db->where("flower.flower_status", 0);
		$this->db->where("orders.order_status", 1);
		$this->db->where("orders.user_id", $mysession['user_id']);
		// $this->db->group_by("flower.flower_id"); 
		$flower = $this->db->get();
		// var_dump($flower->result());

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

		$data = array(
			'cancelled_order' => 1
		);
		
		$this->db->insert("notification", $data);

		return TRUE;
	}
	
	public function append() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) return false;

		$order_status = $this->input->post("order_status");
		$f_categ = $this->input->post("f_categ");
		$date = $this->input->post("date");
		$user_id = $this->input->post("user_id");
		$action = $this->input->post("action");

		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'left');
		$this->db->join('category', 'category.category_id = flower.category', 'left');
		if($action == 1) {
			$this->db->like('orders.order_date', $date);
			if($user_id != 0) {
				$this->db->where("orders.user_id", $user_id);
			}
			$this->db->where("flower.flower_category", $f_categ);
		}
		$this->db->where("flower.flower_status", 0);
		$this->db->where("orders.order_status", $order_status);
		if($action == 0) {
			$this->db->where("orders.user_id", $mysession['user_id']);
		}
		//$this->db->group_by("flower.flower_id"); 
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

		$this->db->select('*, cart.quantity AS cart_quantity');
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
		
		if($flower->num_rows < 1) {
			redirect("cart");
		}
		
		$this->db->where("user_id", $mysession["user_id"]);
		$user = $this->db->get("users");

		$fee = $this->db->get("fee");

		$data = array(
			'action'  => $action,
			'user'    => $user->result(),
			'session' => $mysession,
			'flower'  => $flower->result(),
			'payment' => $this->db->get("payment"),
			'fee'     => $fee->result()
		);
		
		$this->load->view('pages/order', $data);
	}

	public function add_order() {
		$action = $this->input->post("action");
		$payment = $this->input->post("payment");
		$flower_id = $this->input->post("flower_id");
		$user_id = $this->input->post("user_id");
		$receiver = $this->input->post("receiver");
		$receiver_no = $this->input->post("receiver_no");
		$delivery_date = $this->input->post("delivery_date");
		$quantity = $this->input->post("quantity");
		$receiver_address = $this->input->post("receiver_address");
		$card_message = $this->input->post("card_message");
		$suggestions = $this->input->post("suggestions");
		
		if($delivery_date <= date("Y-m-d")) {
			$invalid = "invalid_date";
			echo $invalid;
			return $invalid;
		}

		if($action == 0) {
			$this->db->delete('cart', array("user_id" => $user_id, "flower_id" => $flower_id));
		}

		$data = array(
			'user_id' => $user_id,
			'payment' => $payment,
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

			$the_data = array(
				'new_order' => 1
			);
			
			$this->db->insert("notification", $the_data);
		} else {
			$data['delivery_fee'] = $this->input->post("delivery_fee");
			$order_id = $this->input->post("order_id");
			$this->db->where("order_id", $order_id);
			$this->db->update("orders", $data);
			
			$the_data = array(
				'resched_order' => 1
			);
			
			$this->db->insert("notification", $the_data);
		}

		echo $action;
		return $action;
	}
	
	public function details() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) return false;
		$order_id = $this->input->post("order_id");
		$flower_id = $this->input->post("flower_id");
		
		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id', 'left');
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'left');
		$this->db->join('category', 'category.category_id = flower.category', 'left');
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'left');
		$this->db->join('payment', 'payment.payment_id = orders.payment', 'left');
		$this->db->join('users', 'users.user_id = orders.user_id', 'left');
		$this->db->where("flower.flower_id", $flower_id);
		$this->db->where("orders.order_id", $order_id);
		$this->db->where("flower_image.flower_main", 1);
		$this->db->where("flower.flower_status",0);
		$flower = $this->db->get();
		
		$data = array(
			'session' => $mysession,
			'flower' => $flower->result()
		);
		
		$this->load->view("user_append/modal", $data);
	}
	
	public function billing() {
		$order_id = $this->input->post("order_id");
		$flower_id = $this->input->post("flower_id");
		
		$this->db->select('flower.flower_name, orders.quantity, flower.flower_price, payment.payment_name, orders.delivery_fee, SUM(order_add_ons.quantity*order_add_ons.price) AS addons_total');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id', 'left');
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'left');
		$this->db->join('category', 'category.category_id = flower.category', 'left');
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'left');
		$this->db->join('payment', 'payment.payment_id = orders.payment', 'left');
		$this->db->join('order_add_ons', 'order_add_ons.order_id = orders.order_id', 'left');
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

	public function add_ticket() {
		$details = $this->input->post("ticket_details");
		$order_id = $this->input->post("order_id");
		$flower_id = $this->input->post("flower_id");

		$this->upload->initialize(array(
			"upload_path" => "assets/ticket/",
			"allowed_types" => 'bmp|jpg|png|jpeg|pdf',
			"max_size" => '2000',
			"encrypt_name" => 'TRUE',
			"remove_spaces" => 'TRUE',
			"is_image" => '1'
		));
		
		if($this->upload->do_multi_upload("ticket_proof")){
			$counter = 0;
			$file = $this->upload->get_multi_upload_data();
			foreach($file as $array) {
				if($counter > 0) {
					redirect("orders?payment=true");
				}
				$ticket = array(
					'ticket_details'   => $details,
					'ticket_proof'     => $array['file_name'],
					'order_id'         => $order_id,
					'flower_id'        => $flower_id,
					'ticket_date'      => date("Y-m-d")
				);
				$this->db->insert('ticket', $ticket);
				$counter = $counter + 1;
			}
		} else {
				$ticket = array(
					'ticket_details'   => $details,
					'ticket_proof'     => "blank",
					'order_id'         => $order_id,
					'flower_id'        => $flower_id,
					'ticket_date'      => date("Y-m-d")
				);
				$this->db->insert('ticket', $ticket);
		}
		
		$data = array(
			'new_payment' => 1
		);
		
		$this->db->insert("notification", $data);

		redirect("orders?payment=true");
	}

	public function ticket() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("");

		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id', 'left');
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'left');
		$this->db->join('category', 'category.category_id = flower.category', 'left');
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'left');
		$this->db->join('payment', 'payment.payment_id = orders.payment', 'left');
		$this->db->join('ticket', 'ticket.order_id = orders.order_id', 'inner');
		$this->db->join('users', 'users.user_id = orders.user_id', 'left');
		$this->db->where("flower.flower_status",0);
		$flower = $this->db->get();

		$data = array(
			'session' => $mysession,
			'flower'  => $flower->result()
		);
		
		$this->db->where("new_payment", 1);
		$this->db->delete("notification");

		$this->load->view("user/ticket", $data);
	}

	public function payment_status() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("");

		$order_id = $this->input->post("order_id");
		$status = $this->input->post("new_status");

		$data = array(
			'payment_status' => $status
		);

		$this->db->where("order_id", $order_id);
		$this->db->update("orders", $data);
		return TRUE;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
