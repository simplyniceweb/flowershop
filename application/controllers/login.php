<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if($mysession) redirect('home');

		if(isset($_GET["verify"]) && is_numeric($_GET["verify"]) && !empty($_GET["verify"]) && $_GET["verify"] > 0) {
			$user_id = $_GET["verify"];
			$this->db->where('user_id', $user_id);
			$check = $this->db->get("users");

			if($check->num_rows() < 1) redirect("login");

			$data["user_status"] = 0;
			$this->db->where("user_id", $user_id);
			$this->db->update("users", $data);
			
			redirect("login?email=verified");
		}
		$data = array(
			'session' => $mysession
		);
		$this->load->view('login', $data);
	}

	public function verify() {
		$login_date = date("Y-m-d h:i:s");
		$email = $this->input->post("user_email");
		$password = $this->input->post("user_password");
		
		$this->db->from('users');
		$this->db->where('user_email', $email);
		$this->db->where('user_password', sha1($password));
		$login = $this->db->get();
		if($login->num_rows() <= 0) redirect("login?login=false");

		foreach($login->result() as $row) {
			if($row->user_status == 1)  redirect("login?block=true");
			if($row->user_status == 2)  redirect("login?valid=nope");

			$data = array(
				'user_id' => $row->user_id,
				'login_datetime' => $login_date = date("Y-m-d H:i:s")
			);
			
			$this->db->insert("login_history", $data);

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
