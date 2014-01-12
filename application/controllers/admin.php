<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
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