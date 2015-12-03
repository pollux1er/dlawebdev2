<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Induction extends CI_Controller {

	/**
	 *
	 */
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}
	
	public function index()
	{
		if($this->session->userdata('iduser')) 
		{
			
			$this->load->view('induction');
		}
		else { // Sinon il vient probablement d'un des liens de mail, auquel cas on lui exige une authentification à partir du groupe
			//$this->session->set_userdata('last_url', current_url());
			redirect(base_url("accueil.php/login/enter"));			
		}
	}

	public function procedure()
	{
		if($this->session->userdata('iduser')) 
		{
			
			$this->load->view('procedure');
		}
		else { // Sinon il vient probablement d'un des liens de mail, auquel cas on lui exige une authentification à partir du groupe
			//$this->session->set_userdata('last_url', current_url());
			redirect(base_url("accueil.php/login/enter"));			
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url("accueil.php/login/enter"));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */