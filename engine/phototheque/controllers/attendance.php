<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('user_model', 'user');
		$this->load->model('demande_model', 'demande');
	}
	
	public function index()
	{ 
		if (!$this->session->userdata('iduser')) {
			
			$this->session->set_userdata('saved_url', current_url());
						
			redirect(base_url('/index.php'));
			
		}
		if (!$this->user->is_athorized_user($this->session->userdata('iduser'))) {
				redirect('/authentication/');
		
		}
		$vars['title'] = "Base de Loisirs - Calendrier de la Base";
		$vars['nom'] = $this->user->get_nom();
		
			
		//$this->load->view('templates/header', $vars);
		$this->load->view('planning_case', $vars);
		
	}
	
	// Calendrier planning en Ajax call
	public function planning()
	{
		$data['title'] = 'Planning des cases';
		$data['post'] = $this->input->post();
		$this->load->view('planning', $data);
	}
	
	// Remnder pour relancer 3 jours avant la réservation
	public function reminder_payement()
	{
		$sql = "SELECT * FROM `bl_demandes` WHERE DATE(date_arrivee) = curdate() + interval 3 day";
		$query = $this->db->query($sql);
		
		$demandes = array();
		
		foreach ($query->result() as $row)
		{
		   $demandes[] = $row;
		}
		
		return $demandes;
	}
	
}

/* End of file authentication.php */
/* Location: ./application/controllers/authentication.php */