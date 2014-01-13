<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if($mysession) redirect('home');

		$this->load->view('register');
	}

	public function verify() {
		$data = array(
			'user_name'     => $this->input->post("user_name"),
			'user_email'    => $this->input->post("user_email"),
			'user_password' => sha1($this->input->post("user_password")),
			'user_level '   => 0
		);
		
		$this->db->from('users');
		$this->db->where('user_email', $data['user_email']);
		$check = $this->db->get();
		if($check->num_rows() > 0) redirect("register?email=false");
		
		$this->db->insert("users", $data);
		
		$user_id = $this->db->insert_id();
		$this->db->where('user_id', $user_id);
		$login = $this->db->get("users");

		foreach($login->result() as $row) {
			$sess_array = array(
				'logged'          => TRUE,
				'user_id'         => $row->user_id,
				'user_name'       => $row->user_name,
				'user_email'      => $row->user_email,
				'user_level'      => $row->user_level,
			);
		}
		
		$this->session->set_userdata('logged', $sess_array);
		if($sess_array['user_level'] == 1) redirect("admin");
		if($sess_array['user_level'] == 0) redirect('home');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */