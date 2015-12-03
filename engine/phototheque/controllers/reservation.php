<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('demande_model', 'demande');
		$this->load->model('user_model', 'user');
		$this->load->model('reservation_model', 'resa');
		$this->load->model('saison_model', 'saison');
	}
	
	public function index()
	{
		if($this->input->get('id_user_staff')) {
			//die('m');
			$this->session->set_userdata('id_user_staff', $this->input->get('id_user_staff'));
			
			
		} 
		else {
			if ($this->session->userdata('id_user_staff') !== FALSE) {
				if($this->session->userdata('url') !== FALSE)
					redirect($this->session->userdata('url'));
				else	
					redirect('/calendar/');
			}
			redirect('../../index2.php');
		}
		
		if ($this->session->userdata('id_user_staff') !== FALSE) {
			if($this->session->userdata('url') !== FALSE)
				redirect($this->session->userdata('url'));
			else	
				redirect('/calendar/');
		}
		
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
	
	// Formulaire d'invitation
	public function invitation()
	{
		$this->load->library('session');
		$this->load->helper('form');
		$this->session->set_userdata('saved_url', current_url());
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('id_user_staff')) {
			redirect('/authentication/?id_user_staff='.$this->input->get('id_user_staff'));
		}
		
		$this->session->set_userdata('invitation', '1');
		$data = array();
		$data['nom'] = $this->user->get_nom();
		$data['title'] = "Base de Loisirs - Faire une r&eacute;servation";
		$this->load->view('formulaire_reservation', $data);
	}
	
}

/* End of file authentication.php */
/* Location: ./application/controllers/authentication.php */