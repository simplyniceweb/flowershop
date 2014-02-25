<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("login");
		
		$user_id = $this->uri->segment(2);
		
		$this->db->select('*, message.id AS main_id');
		$this->db->from('message');
		$this->db->join('users', 'users.user_id = message.user_id', 'left');
		if(!empty($user_id)) {
			$this->db->where("message.user_id", $user_id);
			$this->db->where("users.user_id", $user_id);
		} else {
			$user_id = 0;
		}
		$message = $this->db->get();

		$data = array(
			'action'   => $user_id,
			'session'  => $mysession,
			'messages' => $message->result()
		);

		$this->load->view('admin/message', $data);
	}

	public function contact() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("login");
		
		$data = array(
			'session'  => $mysession,
		);
		$this->load->view('user/message', $data);
	}

	public function process() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("login");

		// main message
		$main = array(
			'user_id'       => $mysession["user_id"],
			'message_title' => $this->input->post("subject"),
			'date_created'  => date("Y-m-d h:i:s")
		);
		$this->db->insert("message", $main);

		// record message
		$data = array(
			'user_id'    => $mysession["user_id"],
			'message_id' => $this->db->insert_id(),
			'message'    => $this->input->post("message"),
			'message_datetime' => date("Y-m-d")
		);
		$this->db->insert("message_record", $data);

		redirect("message/contact?msg=sent");
	}
	
	public function view() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("login");

		$message_id = $this->uri->segment(3);
		$this->db->select('*, message.id AS main_id');
		$this->db->from('message');
		// $this->db->join('message_record', 'message_record.message_id = message.id', 'left');
		// $this->db->join('users', 'users.user_id = message.user_id', 'left');
		$this->db->where("message.id", $message_id);
		// $this->db->where("message_record.message_id", $message_id);
		$message = $this->db->get();

		$this->db->select('*');
		$this->db->from('message_record');
		$this->db->join('users', 'users.user_id = message_record.user_id', 'left');
		$this->db->where("message_id", $message_id);
		$this->db->order_by("message_datetime", "ASC"); 
		$record = $this->db->get();
		
		$data = array(
			'session'  => $mysession,
			'messages' => $message->result(),
			'record'   => $record->result()
		);

		$this->load->view('user/message_view', $data);
	}
	
	public function reply() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("login");

		$data = array(
			'user_id'          => $mysession["user_id"],
			'message_id'       => $this->input->post("message_id"),
			'message'          => $this->input->post("reply"),
			'message_datetime' => date("Y-m-d h:i:s")
		);
		
		$this->db->insert("message_record", $data);
		redirect("message/view/". $this->input->post("message_id") ."?reply=added");
	}
	
	public function delete() {
		$message_id = $this->uri->segment(3);
		
		$this->db->where("id", $message_id);
		$this->db->delete("message");
		
		$this->db->where("message_id", $message_id);
		$this->db->delete("message_record");
		
		redirect("message?del=true");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
