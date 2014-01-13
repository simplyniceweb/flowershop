<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		
		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id');
		$this->db->where("flower.flower_category", 1);
		$this->db->where("flower.flower_availability >", 1);
		$this->db->where("flower_image.flower_main", 1);
		$flower = $this->db->get();	
		
		$data = array(
			'session' => $mysession,
			'flower'  => $flower->result()
		);

		$this->load->view('pages/product', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */