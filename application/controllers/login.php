<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if($mysession) redirect('home');

		$this->load->view('login');
	}

	public function verify() {
		$email = $this->input->post("user_email");
		$password = $this->input->post("user_password");
		
		$this->db->from('users');
		$this->db->where('user_email', $email);
		$this->db->where('user_password', sha1($password));
		$login = $this->db->get();
		if($login->num_rows() <= 0) redirect("login?login=false");

		foreach($login->result() as $row) {
			if($row->user_status == 1)  redirect("login?block=true");
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
		if($sess_array['user_level'] == 0) redirect("home");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
