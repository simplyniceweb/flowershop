<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('MY_Upload');
    }

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

		$data = array(
			'session' => $mysession,
			'category' => $this->db->get("category")
		);

		$this->load->view('admin/category', $data);
	}
	
	public function new_category() {
		$data = array(
			'category_name' => $this->input->post("new_category")
		);

		$this->db->insert("category", $data);
		redirect("admin/category?add=true");
	}
	
	public function archive_category() {
		$category_id =  $this->input->post("category");
		
		$this->db->where('category_id', $category_id);
		$this->db->delete('category');
		
		redirect("admin/category?del=true");
	}

	// Payment
	public function payment() {
		$mysession = $this->session->userdata('logged');

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

		$data = array(
			'session' => $mysession,
			'flower_category' => 1,
			'category' => $this->db->get("category")
		);

		$this->load->view('admin/product', $data);
	}
	
	public function new_product() {
		$pick = 0;
		$mysession = $this->session->userdata('logged');
		$type = $this->input->post('flower_type');
		if(empty($type) || is_null($type)) $type = 0;

		$data = array(
			'category'           => $this->input->post('category'),
			'flower_name'        => $this->input->post('flower_name'),
			'flower_description' => $this->input->post('flower_description'),
			'flower_price'       => $this->input->post('flower_price'),
			'flower_availability' => $this->input->post('flower_availability'),
			'flower_type'        => $type,
			'flower_category'    => $this->input->post('flower_category')
		);

		$this->db->insert("flower", $data);
		$flower_id = $this->db->insert_id();

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

				if($pick == 0) {
					$upload['flower_main'] = 1;
				} else {
					$upload['flower_main'] = 0;
				}
				$pick = 1;

				$this->db->insert('flower_image', $upload);
			}
		}

		redirect("admin/product?add=true");
	}

	// Package
	public function package() {
		$mysession = $this->session->userdata('logged');

		$data = array(
			'session' => $mysession,
			'flower_category' => 2,
			'category' => $this->db->get("category")
		);

		$this->load->view('admin/product', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */