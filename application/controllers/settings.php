<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect('home');
		
		$this->db->where("user_id", $mysession["user_id"]);
		$user = $this->db->get("users");
		
		$data = array(
			'session' => $mysession,
			'user' => $user->result()
		);

		$this->load->view('user/settings', $data);
	}
	
	public function update() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect('home');

		$data = array(
			'user_name' => $this->input->post("user_name"),
			'user_email' => $this->input->post("user_email"),
			'user_address' => $this->input->post("user_address"),
			'user_birthday' => $this->input->post("user_birthday")
		);
		
		$this->db->where("user_id", $mysession["user_id"]);
		$this->db->update("users", $data);
		
		redirect("settings?update=true");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */