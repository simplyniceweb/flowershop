<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("");

		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'inner');
		$this->db->join('category', 'category.category_id = flower.category', 'inner');
		$this->db->where("flower.flower_status", 0);
		$this->db->where("orders.order_status", 3);
		$this->db->like("orders.order_date", date("Y-m"));
		$flower = $this->db->get();

		$data = array(
			'session' => $mysession,
			'flower'  => $flower->result()
		);

		$this->load->view('sales', $data);
	}
	
	public function date() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("");

		$date = $this->input->post("date");
		$action = $this->input->post("action");
		if($action == 0) {
			$year = explode("-", $date);
			$date = $year[0];
		}

		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('orders', 'orders.flower_id = flower.flower_id', 'inner');
		$this->db->join('category', 'category.category_id = flower.category', 'inner');
		$this->db->where("flower.flower_status", 0);
		$this->db->where("orders.order_status", 3);
		$this->db->like("orders.order_date", $date);
		$flower = $this->db->get();

		if($flower->num_rows() < 1){
			 echo "none";
			 return "none";
		}

		$data = array(
			'session' => $mysession,
			'flower'  => $flower->result()
		);

		$this->load->view('admin_append/sales', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
