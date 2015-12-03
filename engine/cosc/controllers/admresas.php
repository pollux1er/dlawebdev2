<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admresas extends CI_Controller {

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
		$this->load->model('reservation_model', 'reservation');
		$this->load->model('saison_model', 'saison');
		$this->load->model('user_model', 'user');
		$this->load->helper('url');
	}
	
	
	// Logs des demandes
	public function index()
	{
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			redirect('/authentication/');
		}
		
		$data['title'] = 'Administration des demandes';
		$data['nom'] = $this->user->get_nom();
		$data['logs'] = $this->demande->get_all();
		$this->load->view('logs-adm', $data);
	}
	
	// Rapport d'occupations
	public function booking_report()
	{
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			redirect('/authentication/');
		}
		
		$data['resac'] = $this->reservation->nb_resa_confirme();
		$data['resanc'] = $this->reservation->nb_resa_nconfirme();
		$data['resaat'] = $this->reservation->nb_resa_enattente();
		$data['resaan'] = $this->reservation->nb_resa_annulee();
		$data['quotas'] = $this->user->get_quotas();
		//var_dump($data['quotas']); die;
		$data['title'] = "Gestion - Rapports d'occupation - Base Loisirs";
		$data['nom'] = $this->user->get_nom();
		$data['logs'] = $this->demande->get_all();
		$this->load->view('adm/rapports', $data);
	}
	
	// Liste les Ayants droits
	public function users()
	{
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			redirect('/authentication/');
		}
		
		$data['users'] = $this->user->get_all_ayant_droits();
		//var_dump($data['users']); die;
		$data['title'] = "Gestion - Ayants droits - Base Loisirs";
		$data['nom'] = $this->user->get_nom();
		$this->load->view('adm/users', $data);
	}
	
	// Gere les Ayants droits
	public function manage_users()
	{
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			redirect('/authentication/');
		}
		
		$data['users'] = $this->user->get_all_ayant_droits();
		$data['all_non_users'] = $this->user->get_all_n_ayant_droits();
		//var_dump($data['users']); die;
		$data['title'] = "Administration - Ayants droits - Base Loisirs";
		$data['nom'] = $this->user->get_nom();
		
		if($this->input->post('attribution_id')) {
			if($this->user->add_to_ayant_droit($this->input->post('attribution_id')))
				$data['message'] = $this->input->post('attribution_name') . " a été ajouté aux ayants droits"; 
			else
				$data['message'] = "";
			redirect('/admresas/manage_users/');
		}
		else	
			$data['message'] = count($data['users']) . " ayants droits";
		
		$this->load->view('adm/adm_users', $data);
	}
	
	// Gere les Ayants droits
	public function manage_roles()
	{
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			
			redirect('/authentication/');
		}
		
		$data['users'] = $this->user->get_all_ayant_droits();
		$data['all_hr_users'] = $this->user->get_all_ayant_droits_hr();
		//var_dump($data['users']); die;
		$data['title'] = "Administration - Roles - Base Loisirs";
		$data['nom'] = $this->user->get_nom();
		
		if($this->input->post('manager')) {
			$this->user->set_manager($this->input->post('manager'));
			$this->user->set_hr_manager($this->input->post('hr_manager'));
			$data['message'] = "L'attribution des rôles a été effectuée.";
			redirect('/admresas/manage_roles/?message=success');
		}
		if($this->input->get('message'))
			$data['message'] = "L'attribution des rôles a été effectuée.";
			
		$this->load->view('adm/adm_roles', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */