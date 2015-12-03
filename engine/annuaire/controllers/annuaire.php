<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Annuaire extends CI_Controller {

	/**
	 *
	 */
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('user_model', 'user');
		$this->load->model('annuaire_model', 'annuaire');
	}
	
	public function index()
	{
		if($this->session->userdata('iduser')) 
		{
			$data['title'] = 'Annuaire Perenco Cameroun';
			$data['nom'] = $this->user->get_nom();
			
			$data['annuaire'] = $this->annuaire->get_directory($this->input->get('departement'));
			$data['departements'] = $this->annuaire->get_department_directory();

			$this->load->view('annuaire', $data);
		}
		else { // Sinon il vient probablement d'un des liens de mail, auquel cas on lui exige une authentification à partir du groupe
			//$this->session->set_userdata('last_url', current_url());
			redirect(base_url("accueil.php/login/enter"));			
		}
	}

	public function cout_pabx()
	{
		if($this->session->userdata('iduser')) 
		{
			$data['title'] = 'Annuaire Perenco Cameroun';
			$data['nom'] = $this->user->get_nom();
			
			$data['annuaire'] = $this->annuaire->get_pabx_directory_alldata($this->input->get('departement'));
			$data['departements'] = $this->annuaire->get_department_directory();

			$this->load->view('cout_pabx', $data);
		}
		else { // Sinon il vient probablement d'un des liens de mail, auquel cas on lui exige une authentification à partir du groupe
			//$this->session->set_userdata('last_url', current_url());
			redirect(base_url("accueil.php/login/enter"));			
		}
	}

	public function admin_cout_pabx()
	{
		if($this->session->userdata('iduser')) 
		{
			if($this->input->post('pabx') != '') {
				$this->annuaire->set_user_pabx();
				redirect($this->uri->uri_string());
			}	
			$data['title'] = 'Annuaire Perenco Cameroun';
			$data['nom'] = $this->user->get_nom();
			
			$data['annuaire'] = $this->annuaire->get_pabx_alluser($this->input->get('departement'));
			$data['departements'] = $this->annuaire->get_department_directory();

			$this->load->view('adm/admin_cout_pabx', $data);
		}
		else { // Sinon il vient probablement d'un des liens de mail, auquel cas on lui exige une authentification à partir du groupe
			//$this->session->set_userdata('last_url', current_url());
			redirect(base_url("accueil.php/login/enter"));			
		}
	}

	public function add_new_pabx()
	{
		if($this->session->userdata('iduser')) 
		{
			$data['title'] = 'Attibuer un PABX - Perenco Cameroun';
			$data['nom'] = $this->user->get_nom();
			$data['type'] = 'pabx';
			$this->load->view('adm/formulaire_', $data);
		}
		else { 
			redirect(base_url("accueil.php/login/enter"));			
		}
	}
	
	public function add_new_gsm()
	{
		if($this->session->userdata('iduser')) 
		{
			$data['title'] = 'Ajouter une nouvelle SIM - Perenco Cameroun';
			$data['nom'] = $this->user->get_nom();
			$data['type'] = 'gsm';
			$this->load->view('adm/formulaire_', $data);
		}
		else { 
			redirect(base_url("accueil.php/login/enter"));			
		}
	}

	public function load_csv()
	{
		if($this->session->userdata('iduser')) 
		{
			$this->load->helper(array('form', 'url'));

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'csv';
			$config['max_size']	= '100';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';

			$this->load->library('upload', $config);

			// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
			$this->upload->initialize($config);


			$data['title'] = 'Annuaire Perenco Cameroun - Importer les PABX';
			$data['nom'] = $this->user->get_nom();
			
			//$data['annuaire'] = $this->annuaire->get_pabx_directory_alldata($this->input->get('departement'));
			//$data['departements'] = $this->annuaire->get_department_directory();
			$data['error'] = '';    //initialize image upload error array to empty
 
	       	if (!$this->upload->do_upload('filename'))
			{	

				$data = array('error' => $this->upload->display_errors());
				//var_dump($data); die('erreur upload');
            	$this->load->view('adm/admin_new_pabx1', $data);
			}
			else
			{
				$upload_data = $this->upload->data();
				//var_dump($upload_data);
				$data['upload_data'] = $upload_data;
	            $data['success_msg'] = '<div class="alert alert-success text-center">Le fichier <strong>' . $upload_data['file_name'] . '</strong> a été téléchargé avec succès!</div>';
            	$data['csv'] = array_map('str_getcsv', file($upload_data['full_path']));
				$data['title'] = 'Annuaire Perenco Cameroun - Importer les PABX';
	            $this->load->view('adm/admin_new_pabx1', $data);
			}
		 		
		}
		else { 
			redirect(base_url("accueil.php/login/enter"));			
		}
	}
	
	public function load_csv_gsm()
	{
		if($this->session->userdata('iduser')) 
		{
			$this->load->helper(array('form', 'url'));

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'csv';
			$config['max_size']	= '100';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';

			$this->load->library('upload', $config);

			// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
			$this->upload->initialize($config);


			$data['title'] = 'Annuaire Perenco Cameroun - Importer les PABX';
			$data['nom'] = $this->user->get_nom();
			
			//$data['annuaire'] = $this->annuaire->get_pabx_directory_alldata($this->input->get('departement'));
			//$data['departements'] = $this->annuaire->get_department_directory();
			$data['error'] = '';    //initialize image upload error array to empty
 
	       	if (!$this->upload->do_upload('filename'))
			{	

				$data = array('error' => $this->upload->display_errors());
				$data['title'] = 'Annuaire Perenco Cameroun - Importer les consomations GSM';
				$data['nom'] = $this->user->get_nom();
				//var_dump($data); die('erreur upload');
            	$this->load->view('adm/admin_load_csv_gsm', $data);
			}
			else
			{
				$upload_data = $this->upload->data();
				//var_dump($data); die;
				$data['upload_data'] = $upload_data;
	            $data['success_msg'] = '<div class="alert alert-success text-center">Le fichier <strong>' . $upload_data['file_name'] . '</strong> a été téléchargé avec succès!</div>';
            	$data['csv'] = array_map('str_getcsv', file($upload_data['full_path']));
				$data['title'] = 'Annuaire Perenco Cameroun - Importer les consomations GSM';
	            $this->load->view('adm/admin_load_csv_gsm', $data);
			}
		 		
		}
		else { 
			redirect(base_url("accueil.php/login/enter"));			
		}
	}

	public function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);
		}
	}

	public function cout_gsm_pabx()
	{
		if($this->session->userdata('iduser')) 
		{
			$data['title'] = 'Annuaire Perenco Cameroun';
			$data['nom'] = $this->user->get_nom();
			
			$data['annuaire'] = $this->annuaire->get_gsm_pabx_alldata($this->input->get('departement'));
			$data['departements'] = $this->annuaire->get_department_directory();

			$this->load->view('cout_gsm_pabx', $data);
		}
		else { // Sinon il vient probablement d'un des liens de mail, auquel cas on lui exige une authentification à partir du groupe
			//$this->session->set_userdata('last_url', current_url());
			redirect(base_url("accueil.php/login/enter"));			
		}
	}

	public function admin_cout_gsm()
	{
		if($this->session->userdata('iduser')) 
		{
			if($this->input->post('gsm') != '') {
				//var_dump($this->input->post()); die;
				$this->annuaire->add_new_gsm();
				redirect($this->uri->uri_string());
			}
			if($this->input->post('new_user') != '') {
				//var_dump($this->input->post()); die;
				$this->annuaire->update_gsm_user();
				redirect($this->uri->uri_string());
			}
			$data['title'] = 'Annuaire Perenco Cameroun';
			$data['nom'] = $this->user->get_nom();
			
			$data['annuaire'] = $this->annuaire->get_gsm_directory_alldata($this->input->get('departement'));
			$data['departements'] = $this->annuaire->get_department_directory();
			$data['formules'] = $this->annuaire->get_fotmula_directory();
			$data['statuses'] = $this->annuaire->get_status_directory();

			$this->load->view('adm/admin_gsm', $data);
		}
		else { // Sinon il vient probablement d'un des liens de mail, auquel cas on lui exige une authentification à partir du groupe
			//$this->session->set_userdata('last_url', current_url());
			redirect(base_url("accueil.php/login/enter"));			
		}
	}

	public function cout_gsm()
	{
		if($this->session->userdata('iduser')) 
		{
			$data['title'] = 'Annuaire Perenco Cameroun';
			$data['nom'] = $this->user->get_nom();
			
			$data['annuaire'] = $this->annuaire->get_gsm_directory_alldata($this->input->get('departement'));
			$data['departements'] = $this->annuaire->get_department_directory();
			$data['formules'] = $this->annuaire->get_fotmula_directory();
			$data['statuses'] = $this->annuaire->get_status_directory();

			$this->load->view('cout_gsm', $data);
		}
		else { // Sinon il vient probablement d'un des liens de mail, auquel cas on lui exige une authentification à partir du groupe
			//$this->session->set_userdata('last_url', current_url());
			redirect(base_url("accueil.php/login/enter"));			
		}
	}

	public function admin_tiers()
	{
		if($this->session->userdata('iduser')) 
		{
			if($this->input->post('user') != '') {
				$this->annuaire->add_user_third_party();
				redirect($this->uri->uri_string());
			}
			$data['title'] = 'Annuaire des tierces personnes';
			$data['nom'] = $this->user->get_nom();
			
			$data['annuaire'] = $this->annuaire->get_all_third_party_users();

			$this->load->view('annuaire_third_party', $data);
		}
		else { // Sinon il vient probablement d'un des liens de mail, auquel cas on lui exige une authentification à partir du groupe
			//$this->session->set_userdata('last_url', current_url());
			redirect(base_url("accueil.php/login/enter"));			
		}
	}
	
	public function admin_add_tiers()
	{
		if($this->session->userdata('iduser')) 
		{
			$data['title'] = 'Ajouter une nouvel utilisateur tiers - Perenco Cameroun';
			$data['nom'] = $this->user->get_nom();
			$data['type'] = 'user';
			$this->load->view('adm/formulaire_', $data);
		}
		else { 
			redirect(base_url("accueil.php/login/enter"));			
		}
	}
	
	public function set_gsm_to_user()
	{
		if($this->session->userdata('iduser')) 
		{
			$data['title'] = 'Atribuer un téléphone à un utilisateur - Perenco Cameroun';
			$data['nom'] = $this->user->get_nom();
			$data['type'] = 'gsm';
			if($this->input->get('gsm')) {
				$data['id_user'] = $this->annuaire->get_user_from_number($this->input->get('gsm'));
			}
			$this->load->view('adm/form_', $data);
		}
		else { 
			redirect(base_url("accueil.php/login/enter"));			
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */