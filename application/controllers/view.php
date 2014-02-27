<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		$flower_id = $this->uri->segment(2);

		$this->db->select('*, flower.flower_id, cart.flower_id AS c_flower_id, flower.flower_id AS f_flower_id');
		$this->db->from('flower');
		$this->db->join('flower_image', 'flower_image.flower_id = flower.flower_id', 'left');
		$this->db->join('cart', 'cart.flower_id = flower.flower_id', 'left');
		$this->db->where("flower.flower_id", $flower_id);
		$this->db->where("flower_image.flower_main", 1);
		$this->db->where("flower.flower_status",0);
		$this->db->limit(1);
		$flower = $this->db->get();	
		
		$this->db->where("flower_id", $flower_id);
		$images = $this->db->get("flower_image");	
		
		$data = array(
			'session' => $mysession,
			'flower'  => $flower->result(),
			'images'  => $images->result()
		);

		$this->load->view('pages/view', $data);
	}
	
	public function delete() {
		$flower_id = $this->input->post("id");
		$data = array(
			'flower_status' => 1
		);
		
		$this->db->where("flower_id", $flower_id);
		$this->db->update("flower", $data);
		return TRUE;
	}
	
	public function img_delete() {
		$img_id = $this->input->post("id");
		$src = $this->input->post("img");
		if( file_exists($src) ) {
			unlink($src);
		}

		$this->db->where('flower_img_id', $img_id);
		$this->db->delete('flower_image');
		return TRUE;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */