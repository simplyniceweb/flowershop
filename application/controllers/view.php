<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		$flower_id = $this->uri->segment(2);

		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id');
		$this->db->where("flower.flower_id", $flower_id);
		$this->db->where("flower.flower_availability >", 1);
		$this->db->where("flower_image.flower_main", 1);
		$flower = $this->db->get('flower');	
		
		$this->db->where("flower_id", $flower_id);
		$images = $this->db->get("flower_image");	
		
		$data = array(
			'session' => $mysession,
			'flower'  => $flower->result(),
			'images'  => $images->result()
		);

		$this->load->view('pages/view', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */