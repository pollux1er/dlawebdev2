<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	/*
	 * Fonction d'entrée sur les demandes
	 * affiche le formulaire de demandes de réservations
	 * 
	 */
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('demande_model', 'demande');
		$this->load->model('user_model', 'user');
		$this->load->helper('url');
	}
	
	
	public function index()
	{
		$this->load->library('session');
		//$this->load->model('demande_model', 'demande');
		$this->load->helper('form');
		
		
		$session_id = $this->session->userdata('session_id');
		
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			redirect('/authentication/');
		}
		
		if (!$this->user->is_athorized_user($this->session->userdata('iduser'))) {
				redirect('/authentication/');
		
		}
		$data = array();
		$data['nom'] = $this->user->get_nom();
		//if($this->demande->verifier_si_periode_demande()) { // Si on est en période d'admissibilité des demandes, on présente le formulaire
			
		$data['title'] = "Base de Loisirs - Faire une r&eacute;servation";
		// Code temporaire /////////////
		//$this->load->view('templates/header', $data);
		
		if($this->demande->demande_saison_exists())
		{
			
			if($this->demande->demande_saison_depassee())
			{
				$this->load->model('saison_model', 'saison');
				$s = $this->saison->saison_encours();
				$saison = $s['id_saison'] + 1;
				if($this->demande->demande_next_saison_exist($saison))
				{
					$data['message'] = $this->demande->message_demande();
					$data['demande'] = $this->demande->afficher();
					$data['resa'] = $this->demande->reservation;
					$this->load->view('formulaire_demande', $data);
				}
				else
				{
					$data['message'] = '';
					$data['resa'] = $this->demande->reservation = true;
					$this->load->view('formulaire_demande', $data);
				}
			}
			else
			{
				$data['message'] = $this->demande->message_demande();
				$data['demande'] = $this->demande->afficher();
				$data['resa'] = $this->demande->reservation = true;
				$this->load->view('formulaire_demande', $data);
			}
			
		} 
		else 
		{
			////////////////////////////////////
			$data['resa'] = true;
			$data['message'] = '';
			$this->load->view('formulaire_demande', $data);
		}
		//}
	}
	
	// Logs des demandes
	public function demandes()
	{
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			redirect('/authentication/');
		}
		if (!$this->user->is_athorized_user($this->session->userdata('iduser'))) {
				redirect('/authentication/');
		
		}
		$data['title'] = 'Historique des réservations';
		$data['nom'] = $this->user->get_nom();
		$data['logs'] = $this->input->get() ? $this->demande->get_all($this->input->get()) : $this->demande->get_all();
		//if($this->input->ip_address() == '10.52.66.78') {
			// echo "<pre>";
			// var_dump($data['logs']);
			// die;
		//}
		$this->load->view('logs', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */