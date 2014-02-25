<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delivery extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }
	// Index
	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("login");
		if($mysession['user_level'] != 1) redirect("home");
		
		$fee = $this->db->get("fee");
		
		$data = array(
			'session' => $mysession,
			'fee'     => $fee->result()
		);

		$this->load->view('admin/delivery', $data);
	}
	
	public function add() {
		$data = array(
			'location' => $this->input->post("location"),
			'fee'      => $this->input->post("fee")
		);
		
		$this->db->insert("fee", $data);
		redirect("delivery?add=true");
	}
	
	public function update() {
		$location_id = $this->input->post("location");
		$data = array(
			'location' => $this->input->post("new_location"),
			'fee'      => $this->input->post("fee")
		);
		
		$this->db->where("id", $location_id);
		$this->db->update("fee", $data);
		redirect("delivery?update=true");
	}
	
	public function delete() {
		$location_id = $this->input->post("location");
		$this->db->where("id", $location_id);
		$this->db->delete("fee");
		redirect("delivery?delete=true");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
