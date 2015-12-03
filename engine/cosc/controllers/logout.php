<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('demande_model', 'demande');
	}
	
	function index()
	{
		$this->session->sess_destroy();
		redirect('../../index2.php');
	}
}

/* End of file calendar.php */
/* Location: ./application/controllers/calendar.php */