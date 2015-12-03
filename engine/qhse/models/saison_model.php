<?php

class Saison_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
	}
	
	/*
	 * Methode qui crée automatiquement la saison lorsque celle ci est n'existe pas encore
	 * Retourne un vide
	 */
	public function initialiser()
	{
		
	}
	
	public function saison_encours()
	{
		$query = $this->db->query("SELECT * FROM bl_saison WHERE CURDATE() between date_debut and date_fin LIMIT 1;");
		if ($query->num_rows() == 0) 
		{
			$this->initialiser();
		}
		
		return $query->row_array();
	}
	
	public function fin_saison($id_saison)
	{
		$query = $this->db->query("SELECT date_fin FROM bl_saison WHERE id_saison = $id_saison LIMIT 1;");
		$date = $query->row_array();
		return $date['date_fin'];
	}
	
	public function debut_saison($id_saison)
	{
		$query = $this->db->query("SELECT date_debut FROM bl_saison WHERE id_saison = $id_saison LIMIT 1;");
		$date = $query->row_array();
		return $date['date_fin'];
	}
	
	// Verifie si nous sommes le jour d'ouverture de la saison prochaine
	public function jour_ouverture_saison_prochaine()
	{
		$m = date('m', strtotime("now"));
		$m = ( int ) $m;
		
		if( $m & 1 ) {
			return false;
		} else {
			$mois = date('F', strtotime("now"));
			$annee = date('Y', strtotime("now"));
			$mercredi = date('d', strtotime("last Wednesday of $mois $annee"));
			$mercredi = ( int ) $mercredi - 7;
			$jrNow = date('d', strtotime("now"));
			$jj = ( int ) $jrNow;
			
			if($jj == $mercredi)
				return true;
			else
				return false;
		}
	}
	
	public function get_jour_ouverture_saison_prochaine()
	{
		$s = $this->saison_encours();
		$f_s = $this->fin_saison($s['id_saison']);
		
		return date('Y-m-d', strtotime('-2 week Wednesday', strtotime($f_s)));
		//$m = date('Y-m-d', strtotime('-2 week Wednesday', strtotime($f_s)));
		// $m = date('Y-m-d', strtotime('previous Wednesday', strtotime($f_s)));
		// $m = date('Y-m-d', strtotime('previous Wednesday', strtotime($m)));
		
	}
	
	public function periode_presaison()
	{
		if($this->jour_ouverture_saison_prochaine())
			return true;
		
		$m = date('m', strtotime("now"));
		$today = date("Y-m-d", strtotime("now"));
		
		$d_s = $this->get_jour_ouverture_saison_prochaine();
		$s = $this->saison_encours();
		$f_s = $this->fin_saison($s['id_saison']);
		
		$today = new DateTime($today);
		$d_s = new DateTime($d_s);
		$f_s = new DateTime($f_s);

		if ($today >= $d_s && $today <= $f_s) {
			return true;
		}
		
	}
	
	public function debut_saison_prochaine()
	{
		$id_next_saison = $this->session->userdata('id_saison') + 1;
		$query = $this->db->query("SELECT date_debut FROM bl_saison WHERE id_saison IN ('$id_next_saison') LIMIT 1;");
		$date = $query->row_array();
		return $date['date_debut'];
	}
	
	public function fin_saison_prochaine()
	{
		$id_next_saison = $this->session->userdata('id_saison') + 1;
		$query = $this->db->query("SELECT date_fin FROM bl_saison WHERE id_saison IN ('$id_next_saison') LIMIT 1;");
		$date = $query->row_array();
		return $date['date_fin'];
	}
	
	public function saison_prochaine()
	{
		$id_next_saison = $this->session->userdata('id_saison') + 1;
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query("SELECT DATE_FORMAT(date_debut, '%M') as mois1, DATE_FORMAT(date_debut, '%Y') as annee, DATE_FORMAT((SELECT INTERVAL 1 MONTH + date_debut), '%M') as mois2 FROM bl_saison WHERE id_saison IN ('$id_next_saison') LIMIT 1;");
		
		return $query->row_array();
	}
	
	public function afficher()
	{
	
	}
	
	public function annuler()
	{
	
	}
	
	public function get_id_saison_encours()
	{
		$query = $this->db->query("SELECT id_saison as id FROM bl_saison WHERE CURDATE() between date_debut and date_fin LIMIT 1;");
		if ($query->num_rows() == 1) 
		{
			$row = $query->row_array();
			return $row['id'];
		}
	}
	
	public function get_current_year()
	{
		return date('Y');
	}
	
}

?>