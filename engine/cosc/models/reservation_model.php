<?php

class Reservation_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('date');
		$this->load->database();
		$this->load->model('demande_model', 'demande');
	}
	
	public function enregistrer_reservation()
	{
			
	}
	
	public function confirmer_reservation($data)
	{
		
	}
	
	public function afficher_tout()
	{
		
	}
	
	public function afficher()
	{
		if($this->session->userdata('id_demandes')) 
		{
			
		}
		else 
		{
			$this->load->model('saison_model', 'saison');
			$s = $this->saison->saison_encours();
			$this->session->set_userdata('id_saison', $s['id_saison']);
			
			$query = $this->db->query("SELECT `id_demandes`, `id_user_staff`, DATE_FORMAT(`date_arrivee`, '%d/%m/%Y') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%d/%m/%Y') as date_depart, `invites`, `nb_invites`, `details`, `statut`, `id_case`, `id_saison`, `frais`, `ip_user` FROM `bl_demandes` FROM bl_demandes WHERE id_saison = '".$this->session->userdata('id_saison')."' AND ip_user = '".$this->session->userdata('ip')."' LIMIT 1;");
			$this->session->set_userdata($query->row_array());
		}
	}
	
	public function reservation_est_modifiable($id_reservation)
	{
		// Le gestionnaire peut modifier une reservation quelque soit la date
		if($this->user->is_manager($this->session->userdata('iduser')))
		{
			return true;
		}
		
		// autres utilisateurs
		$query = $this->db->query("SELECT `id_demandes`,statut, datediff(DATE_FORMAT(`date_arrivee`, '%Y-%m-%d'),  now()) as days, `2jr_avant`  
									FROM `bl_demandes` 
									WHERE id_demandes = '".$id_reservation."' LIMIT 1;");
		$resa = $query->row_array();
		
		if($resa['2jr_avant'] == 'o')
			return true;
		
		if($resa['statut'] == '1')
			return true;
		
		if($resa['days'] > 5)
			return true;
		
		return false;		
	}
	
	
	
	public function annuler()
	{
	
	}
	
	public function rappel_confirmation()
	{
		
	}
	
	public function nb_resa_confirme()
	{
		$query = $this->db->query("SELECT u.user_id, u.First_Name, u.Last_Name, u.`Professional E-mail` FROM `bl_demandes` AS br 
									LEFT JOIN userscm AS u ON br.id_user_staff = u.user_id  
									WHERE br.statut = '3' AND  br.id_saison = '".$this->saison->get_id_saison_encours()."'");
		return $query->num_rows();
	}
	
	public function nb_resa_nconfirme()
	{
		$query = $this->db->query("SELECT u.user_id, u.First_Name, u.Last_Name, u.`Professional E-mail` FROM `bl_demandes` AS br 
									LEFT JOIN userscm AS u ON br.id_user_staff = u.user_id  
									WHERE br.statut = '2' AND  br.id_saison = '".$this->saison->get_id_saison_encours()."'");
		return $query->num_rows();
	}
	
	public function nb_resa_enattente()
	{
		$query = $this->db->query("SELECT u.user_id, u.First_Name, u.Last_Name, u.`Professional E-mail` FROM `bl_demandes` AS br 
									LEFT JOIN userscm AS u ON br.id_user_staff = u.user_id  
									WHERE br.statut = '1' AND  br.id_saison = '".$this->saison->get_id_saison_encours()."'");
		return $query->num_rows();
	}
	
	public function nb_resa_annulee()
	{
		$query = $this->db->query("SELECT u.user_id, u.First_Name, u.Last_Name, u.`Professional E-mail` FROM `bl_demandes` AS br 
									LEFT JOIN userscm AS u ON br.id_user_staff = u.user_id  
									WHERE br.statut = '0' AND  br.id_saison = '".$this->saison->get_id_saison_encours()."'");
		return $query->num_rows();
	}
	
	
}

?>