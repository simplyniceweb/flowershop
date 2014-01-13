<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		
		$this->db->select('*, flower.flower_id, cart.flower_id AS c_flower_id, flower.flower_id AS f_flower_id');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id', 'left');
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'left');
		$this->db->where("flower.flower_type", 1);
		$this->db->where("flower.flower_availability >", 1);
		$this->db->where("flower_image.flower_main", 1);
		$this->db->where("flower.flower_status",0);
		$this->db->group_by("flower.flower_id"); 
		$featured = $this->db->get();

		$this->db->select('*, flower.flower_id, cart.flower_id AS c_flower_id, flower.flower_id AS f_flower_id');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id', 'left');
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'left');
		$this->db->where("flower.flower_type", 2);
		$this->db->where("flower.flower_availability >", 1);
		$this->db->where("flower_image.flower_main", 1);
		$this->db->where("flower.flower_status",0);
		$this->db->group_by("flower.flower_id");
		$promo = $this->db->get();

		$data = array(
			'session'   => $mysession,
			'featured'  => $featured->result(),
			'promo'     => $promo->result()
		);

		$this->load->view('homepage', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */