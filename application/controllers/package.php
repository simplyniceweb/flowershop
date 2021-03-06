<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$package_categ = $this->uri->segment(2);
		$mysession = $this->session->userdata('logged');

		$this->db->select('*, flower.flower_id, cart.flower_id AS c_flower_id, flower.flower_id AS f_flower_id');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id', 'left');
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'left');
		$this->db->where("flower.flower_category", 2);
		$this->db->where("flower.category", $package_categ);
		$this->db->where("flower_image.flower_main", 1);
		$this->db->or_where("flower_image.flower_main is null");
		$this->db->where("flower.flower_status",0);
		$flower = $this->db->get();
		
		$data = array(
			'session' => $mysession,
			'flower'  => $flower->result()
		);

		$this->load->view('pages/package', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */