<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('MY_Upload');
    }
	// Index
	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("login");
		if($mysession['user_level'] != 1) redirect("home");
		
		$data = array(
			'session' => $mysession
		);

		$this->load->view('adminpage', $data);
	}
	
	// Category
	public function category() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("");
		if($mysession['user_level'] != 1) redirect("home");

		$data = array(
			'session' => $mysession
		);

		$this->load->view('admin/category', $data);
	}
	
	public function new_category() {
		$data = array(
			'category_name' => $this->input->post("new_category"),
			'category_type' => $this->input->post("category_type")
		);

		$this->db->insert("category", $data);
		redirect("admin/category?add=true");
	}
	
	public function update_category() {
		$category_id = $this->input->post("category");
		$category_type = $this->input->post("category_type");
		$data = array(
			'category_name' => $this->input->post("new_categ_name")
		);

		$this->db->where("category_id", $category_id);
		$this->db->where("category_type", $category_type);
		$this->db->update("category", $data);
		
		return TRUE;
	}
	
	public function check_archive() {
		$category_id =  $this->input->post("category_id");
		$this->db->where('category', $category_id);
		$is_use = $this->db->get("flower");
		if($is_use->num_rows() > 0) {
			$data["is_use"] = 1;
		} else {
			$data["is_use"] = 0;
		}
		echo json_encode($data);
	}

	public function archive_category() {
		$category_id =  $this->input->post("id");

		$this->db->where('category_id', $category_id);
		$this->db->delete('category');
		
		return TRUE;
	}

	public function append_category() {
		$type = $this->input->post("type");
		$this->db->where("category_type", $type);
		$category = $this->db->get("category");
		
		$data = array(
			'category' => $category
		);
		
		$this->load->view("admin_append/category", $data);
	}

	// Payment
	public function payment() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("");
		if($mysession['user_level'] != 1) redirect("home");

		$data = array(
			'session' => $mysession,
			'payment' => $this->db->get("payment")
		);

		$this->load->view('admin/payment', $data);
	}
	
	public function new_payment() {		
		$data = array(
			'payment_name' => $this->input->post("new_payment")
		);

		$this->db->insert("payment", $data);
		redirect("admin/payment?add=true");
	}
	
	public function archive_payment() {
		$payment_id =  $this->input->post("payment");
		
		$this->db->where('payment_id', $payment_id);
		$this->db->delete('payment');
		
		redirect("admin/payment?del=true");
	}
	
	// Product
	public function product() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("");
		if($mysession['user_level'] != 1) redirect("home");

		$flower = NULL;
		$flower_id = $this->uri->segment(3);
		$this->db->where("category_type", 1);
		$category = $this->db->get("category");
		$payment = $this->db->get("payment");
		
		if(!empty($flower_id)) {
			$this->db->where("flower_id", $flower_id);
			$this->db->where("flower_status",0);
			$flower = $this->db->get('flower');
			$flower = $flower->result();
		} else {
			$flower_id = 0;
		}

		$data = array(
			'id'      => $flower_id,
			'flower'  => $flower,
			'category' => $category,
			'session' => $mysession,
			'flower_category' => 1,
			'payment' => $payment,
		);

		$this->load->view('admin/product', $data);
	}
	
	// New product
	public function new_product() {
		$pick = 0;
		$mysession = $this->session->userdata('logged');
		$type = $this->input->post('flower_type');
		$action = $this->input->post('flower_action');
		if(empty($type) || is_null($type)) $type = 0;

		$data = array(
			'category'           => $this->input->post('category'),
			// 'payment'            => $this->input->post('payment'),
			'flower_name'        => $this->input->post('flower_name'),
			'flower_description' => $this->input->post('flower_description'),
			'flower_price'       => $this->input->post('flower_price'),
			'flower_type'        => $type,
			'flower_category'    => $this->input->post('flower_category')
		);
		
		if($action == 0) {
			$this->db->insert("flower", $data);
			$flower_id = $this->db->insert_id();
		} else {
			$this->db->where("flower_id", $action);
			$this->db->update("flower", $data);
			$flower_id = $action;
		}

		$this->upload->initialize(array(
			"upload_path" => "assets/flower/",
			"allowed_types" => 'gif|jpg|png|jpeg',
			"max_size" => '2000',
			"encrypt_name" => 'TRUE',
			"remove_spaces" => 'TRUE',
			"is_image" => '1'
		));
		
		if($this->upload->do_multi_upload("flower_images")){
			$image = $this->upload->get_multi_upload_data();
			foreach($image as $array) {
				$upload = array(
					'flower_img_name'  => $array['file_name'],
					'flower_id'        => $flower_id
				);
				
				$this->db->where("flower_main", 1);
				$has_main = $this->db->get("flower_image");

				if($has_main->num_rows() > 0) {
					$upload['flower_main'] = 0;
				} else {
					$upload['flower_main'] = 1;
				}
				$pick = 1;

				$this->db->insert('flower_image', $upload);
			}
		}

		if($action == 0) {
			if($data['flower_category'] == 1) redirect("admin/product?add=true");
			if($data['flower_category'] == 2) redirect("admin/package?add=true");
		} else {
			if($data['flower_category'] == 1) redirect("admin/product/".$action."/?update=true");
			if($data['flower_category'] == 2) redirect("admin/package/".$action."/?update=true");
		}
	}

	// Package
	public function package() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("");
		if($mysession['user_level'] != 1) redirect("home");

		$flower = NULL;
		$flower_id = $this->uri->segment(3);
		$this->db->where("category_type", 2);
		$category = $this->db->get("category");

		$payment = $this->db->get("payment");

		if(!empty($flower_id)) {
			$this->db->where("flower_id", $flower_id);
			$this->db->where("flower_status",0);
			$flower = $this->db->get('flower');
			$flower = $flower->result();
		} else {
			$flower_id = 0;
		}

		$data = array(
			'id'      => $flower_id,
			'flower'  => $flower,
			'category' => $category,
			'session' => $mysession,
			'flower_category' => 2,
			'payment' => $payment,
		);

		$this->load->view('admin/product', $data);
	}
	
	// Suggestion
	public function suggest() {
		$mysession = $this->session->userdata('logged');
		$flower_id = $this->input->post("flower_id");
		$suggest = $this->input->post("suggest");

		$data = array(
			'user_id'   => $mysession['user_id'],
			'flower_id' => $flower_id,
			'suggestion'   => $suggest
		);
		
		$this->db->insert("suggestions", $data);
		return TRUE;
	}
	
	// Orders
	public function orders() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("");
		if($mysession['user_level'] != 1) redirect("home");
		$ym = date("Y-m");

		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'left');
		$this->db->join('category', 'category.category_id = flower.category', 'left');
		// $this->db->join('users', 'users.user_id = orders.user_id', 'left');
		$this->db->where("flower.flower_status", 0);
		$this->db->where("flower.flower_category", 1);
		$this->db->where("orders.order_status", 1);
		$this->db->like('orders.order_date', $ym);
		$flower = $this->db->get();

		$data = array(
			'session' => $mysession,
			'flower'  => $flower->result()
		);
		
		$this->load->view('admin/orders', $data);
	}
	
	public function change_status() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) return false;
		if($mysession['user_level'] != 1) return false;
		
		$order_id = $this->input->post("order_id");
		$data = array(
			'order_status' => $this->input->post("stats")
		);
		
		$this->db->where("order_id", $order_id);
		$this->db->update("orders", $data);
		
		return TRUE;
	}
	
	public function users() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect('home');

		$this->load->library('pagination');
		$start = $this->uri->segment(3);
		if(!$start) $start = 0;
		$config = array(
			'base_url'    => 'admin/users',
			'uri_segment' => 3,
			'total_rows'  => $this->db->count_all('users'),
			'per_page'    => 15,
			'cur_tag_open' => '<li class="active"><a href="javascript:;">',
			'cur_tag_close' => '</a></li>'
		);

		$this->db->limit($config['per_page'], $start);
		$user = $this->db->get('users');
		$this->pagination->initialize($config);

		$data = array(
			'session'     => $mysession,
			'pagination'  => $this->pagination->create_links(),
			'user'        => $user->result()
		);

		$this->load->view('user/users', $data);
	}
	
	public function favorite() {
		$action = $this->input->post("action");
		$user_id = $this->input->post("user_id");
		
		$this->db->where("user_id", $user_id);
		$this->db->update("users", array("user_favorite" => $action));
		return TRUE;
	}
	
	public function archive() {
		$action = $this->input->post("action");
		$user_id = $this->input->post("user_id");
		$this->db->where("user_id", $user_id);
		$this->db->update("users", array("user_status" => $action));
		return TRUE;
	}

	public function bydate() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) return false;
		if($mysession['user_level'] != 1) return false;
		$ym = $this->input->post("date");

		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'left');
		$this->db->join('category', 'category.category_id = flower.category', 'left');
		$this->db->where("flower.flower_status", 0);
		$this->db->where("flower.flower_category", 1);
		$this->db->where("orders.order_status", 1);
		$this->db->like('orders.order_date', $ym); 
		//$this->db->group_by("flower.flower_id"); 
		$flower = $this->db->get();

		$data = array(
			'session' => $mysession,
			'counter' => $flower->num_rows(),
			'flower'  => $flower->result(),
			'status'  => 1,
			'category' => 1
		);
		
		$this->load->view("user_append/orders", $data);
	}
	
	public function history() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("login");
		
		$this->db->select('*');
		$this->db->from('login_history');
		$this->db->join('users', 'users.user_id = login_history.user_id', 'left');
		$this->db->order_by("login_history.login_datetime"); 
		$history = $this->db->get();
		
		$data = array(
			'history' => $history->result()
		);
		
		$this->load->view('admin/history', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
