<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function about() {
		$mysession = $this->session->userdata('logged');
		$data = array('session'   => $mysession);
		$this->load->view("company/about", $data);
	}
	
	public function location() {
		$mysession = $this->session->userdata('logged');
		$data = array('session'   => $mysession);
		$this->load->view("company/location", $data);
	}
	
	public function terms_conditons() {
		$mysession = $this->session->userdata('logged');
		$data = array('session'   => $mysession);
		$this->load->view("company/tandc", $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */