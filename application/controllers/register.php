<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		require_once APPPATH.'libraries/swift_mailer/swift_required.php';
		require_once APPPATH.'libraries/php_mailer/class.phpmailer.php';
    }

	public function index() {
		// phpinfo();
		$mysession = $this->session->userdata('logged');
		if($mysession && $mysession['user_level'] == 0) redirect('home');

		if(!$mysession) $action = 0;
		if($mysession && $mysession['user_level'] == 1) $action = 1;
	
		$data = array(
			'action' => $action
		);

		$this->load->view('register', $data);
	}

	public function verify() {
		$use_mail = 0; // 0 if you don't want to use email and 1 if you want
		$action = $this->input->post("action");
		$data = array(
			'user_name'     => $this->input->post("user_name"),
			'user_email'    => $this->input->post("user_email"),
			'user_address'  => $this->input->post("user_address"),
			'user_password' => sha1($this->input->post("user_password")),
			'user_level'    => 0,
			'user_status'   => 0 // 2
		);
		
		if($data["user_password"] != sha1($this->input->post("confirm_user_password"))) {
			redirect("register?pass=fail");
		}
		
		// checks if email is valid
		$this->db->from('users');
		$this->db->where('user_email', $data['user_email']);
		$check = $this->db->get();
		if($check->num_rows() > 0) redirect("register?email=false");
		
		// insert to database
		$this->db->insert("users", $data);
		
		if($action == 1) redirect("admin");
		// send an email
		if($use_mail == 1) {

			$email_config = array(
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => '465', //587
				'smtp_user' => 'dummyofruben@gmail.com',
				'smtp_pass' => 'varikas12345',
				'mailtype'  => 'html',
				'charset'   => 'iso-8859-1',
				'newline'   => "\r\n"
			);
	
			$this->load->library('email', $email_config);
	
			$link = base_url() . "login?verify=" . $user_id;
			$anchor = "<a href='". $link ."'>Click to verify your account.</a>";
			$anchor .= "<br /><ul><li>Full Name: ".$data['user_name']."</li><li>Email Address: ".$data['user_email']."</li><li>Address: ".$data['user_address']."</li><li>Password: ".$this->input->post("user_password")."</li></ul>";
	
			$this->email->from('dummyofruben@gmail.com', 'Keanna\'s Flowershop');
			$this->email->to($data["user_email"]);
			$this->email->subject('Account verification');
			$this->email->message('To verify your account please click the link below. <br /> '. $anchor);
			$this->email->send();
			
			redirect('login?notif=email');

		} else if($use_mail == 0){

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
			
			redirect('home');

		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

?>