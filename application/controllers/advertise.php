<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertise extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('MY_Upload');
    }
	// Index
	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("login");
		if($mysession['user_level'] != 1) redirect("home");
		
		$data = array(
			'session' => $mysession
		);

		$this->load->view('admin/advertise', $data);
	}
	
	public function process() {
		$type = $this->input->post("type");		
		if(!is_numeric($type)) {
			redirect("advertise?fields=required");
		}

		$this->upload->initialize(array(
			"upload_path" => "assets/flower/",
			"allowed_types" => 'gif|jpg|png|jpeg',
			"max_size" => '2000',
			"encrypt_name" => 'TRUE',
			"remove_spaces" => 'TRUE',
			"is_image" => '1'
		));

		if($this->upload->do_multi_upload("advertise_file")){
			$image = $this->upload->get_multi_upload_data();
			foreach($image as $array) {
				$upload = array(
					'type' => $type,
					'image' => $array['file_name']
				);

				$this->db->insert('advertisement', $upload);
			}
		} else {
			redirect("advertise?fields=required");
		}
		
		redirect("advertise?add=true");
	}
	
	public function getem() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("login");

		$type = $this->input->post("val");
		$this->db->where("type", $type);
		$advert = $this->db->get("advertisement");

		$data = array(
			"session" => $mysession,
			"advert" => $advert->result(),
			"result" => $advert->num_rows()
		);
		
		$this->load->view("admin_append/advert", $data);
	}
	
	public function img_delete() {
		$img_id = $this->input->post("id");
		$this->db->where("id", $img_id);
		$this->db->delete("advertisement");

		return TRUE;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
