<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addons extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('MY_Upload');
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("login");
		if($mysession['user_level'] != 1) redirect("home");
		
		$data = array(
			'session' => $mysession
		);

		$this->load->view('admin/addons', $data);
	}

	public function add() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect("login");
		if($mysession['user_level'] != 1) redirect("home");

		$this->upload->initialize(array(
			"upload_path" => "assets/addons/",
			"allowed_types" => 'gif|jpg|png|jpeg',
			"max_size" => '2000',
			"encrypt_name" => 'TRUE',
			"remove_spaces" => 'TRUE',
			"is_image" => '1'
		));
		
		$data = array(
			'item_name'  => $this->input->post("item_name"),
			'item_price' => $this->input->post("item_price")
		);
		
		$this->db->insert('add_ons', $data);
		$item_id = $this->db->insert_id();
		
		if($this->upload->do_multi_upload("item_image")){
			$image = $this->upload->get_multi_upload_data();
			foreach($image as $array) {
				$upload = array(
					'item_id'    => $item_id,
					'image' => $array['file_name']
				);

				$this->db->insert('add_ons_image', $upload);
			}
		}
		
		redirect("addons?add=true");
	}
	
	public function cartshow() {
		$cart_id= $this->input->post("cart_id");
		$this->db->select('*');
		$this->db->from('order_add_ons');
		$this->db->join('add_ons', 'add_ons.item_id = order_add_ons.item_id', 'left');
		$this->db->where("cart_id", $cart_id);
		$item = $this->db->get();
		
		if($item->num_rows() < 1) return false;

		$data = array(
			'item' => $item->result()
		);
		
		$this->load->view('user_append/list_addons', $data);
	}

	public function append() {
		$item_id = $this->input->post("item_id");
		$this->db->where("item_id", $item_id);
		$item = $this->db->get("add_ons");
		
		if($item->num_rows() < 1) return false;

		$data = array(
			'item' => $item->result()
		);
		
		$this->load->view('user_append/addons', $data);
	}
	
	public function save() {
		$item_id = $this->input->post("item_id");
		$item_price = $this->input->post("item_price");
		$quantity = $this->input->post("ao_quantity");
		$cart_id = $this->input->post("ao_cart_id");
		
		$this->db->delete("order_add_ons", array("cart_id" => $cart_id));

		foreach ($item_id as $key => $val) {

			$data = array(
				'item_id' => $item_id[$key],
				'cart_id' => $cart_id,
				'quantity' => $quantity[$key],
				'price' => $item_price[$key],
			);

			$this->db->insert("order_add_ons", $data);
			// echo print_r($data);
		}
		
		redirect("cart?add_ons=true");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
