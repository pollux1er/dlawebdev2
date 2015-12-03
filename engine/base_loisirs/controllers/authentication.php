<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}
	
	public function index()
	{	//die('222222222222222222222222222');
		// Si on vient de l'authentification
		//if($this->input->get('id_user_staff')) {
			
			// $this->session->set_userdata('id_user_staff', $this->input->get('id_user_staff'));
			
			// if($this->session->userdata('saved_url'))
				// redirect($this->session->userdata('saved_url'));
			// else	
				redirect('/base_loisirs/');
			
		//} elseif ($this->session->userdata('id_user_staff')) { // Si notre session existe
			
		//	if($this->session->userdata('saved_url'))
			//	redirect($this->session->userdata('saved_url'));
		//	else	
		//		redirect('/attendance/');
				
		//} else { // Sinon on a rien à faire la
		
			//redirect('../../index2.php');
		
		//}
		
	}
	
}

/* End of file authentication.php */
/* Location: ./application/controllers/authentication.php */