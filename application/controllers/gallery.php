<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		/*
		$category = $this->uri->segment(2);

		$this->db->select('*');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id', 'left');
		$this->db->where("flower.category", $category);
		$this->db->where("flower_image.flower_main", 1);
		$this->db->where("flower.flower_status",0);
		$this->db->group_by("flower.flower_id");
		$flower = $this->db->get();
		*/
		
		$this->db->where("type", 1);
		$gallery = $this->db->get("advertisement");

		$data = array(
			'session' => $mysession, 
			'gallery' => $gallery->result()
		);
		
		$this->load->view("user/gallery", $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */