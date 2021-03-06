<?php

class Demande_model extends CI_Model {
	
	public $reservation;
	public $saison_suivante;
	public $id_occupant;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		
		$this->reservation = false;
	}
	
	public function enregistrer_demande($data)
	{
		if($data['demande_id'] != '')
		{
			//var_dump($data['demande_id']); die;
			if($this->modifier_demande($data))
			{
				return true;
			}
			else
			{
				return false;
			}
			
		}
		//var_dump($data);
		$id_user = $data['id_user_staff'];
		$id_case = $data['id_case'];
		$arr = $data['bl_date_arr'];
		$h_arr = $data['bl_heure_arr'];
		$dep = $data['bl_date_dep'];
		$h_dep = $data['bl_heure_dep'];
		$details = $data['invite_cmt'];
		
		$inv = (array_key_exists('chk_invites', $data)) ? 'o' : 'n';
		
		list($d, $m, $y) = preg_split('/\//', $arr);
		$arr_date = sprintf('%4d-%02d-%02d', $y, $m, $d);
		
		$match = "/^2[0-3]|[01][0-9]:[0-5][0-9]$/";

		if (preg_match($match, $h_arr)) {
			$arr_date = $arr_date . ' ' . $h_arr . ':00';
		}
		else
		{
			$arr_date = $arr_date . ' ' . '11:00:00';
		}
		
		list($d, $m, $y) = preg_split('/\//', $dep);
		$dep_date = sprintf('%4d-%02d-%02d', $y, $m, $d);
		
		if (preg_match($match, $h_dep)) {
			$dep_date = $dep_date . ' ' . $h_dep . ':00';
		}
		else
		{
			$dep_date = $dep_date . ' ' . '15:30:00';
		}
		
		//var_dump($arr_date); die;
		//Changer la saison de la demande au cas ou on serait en periode de demande et ke le demandeur demande pour la saison prochaine
		if($this->verifier_si_periode_demande()) {
			$saison = $this->get_saison_from_date($dep_date);
			if(!$saison)
				$saison = $this->session->userdata('id_saison');
		//	var_dump($saison);
		} else	
			$saison = $this->session->userdata('id_saison');
		//var_dump($saison); die;
		$montant = $data['montant'];
		$sql = "INSERT INTO `bl_demandes` (`id_user_staff`, `date_arrivee`, `date_depart`, `invites`, `nb_invites`, `details`, `statut`, `id_case`, 
				`id_saison`, `frais`, `ip_user`) 
				VALUES (".$this->db->escape($id_user).", 
				".$this->db->escape($arr_date).", 
				".$this->db->escape($dep_date).", 
				".$this->db->escape($inv).", 
				".$this->db->escape($data['nb_famille']).", 
				".$this->db->escape($details).", 1, 
				".$this->db->escape($id_case).", 
				".$this->db->escape($saison).", ".$this->db->escape($montant).", ".$this->db->escape($this->input->ip_address()).");";
		
		//var_dump($sql); die;
		
		$this->db->query($sql);

		return $this->db->affected_rows();		
	}
	
	// Check si une periode chevauche une autre
	public function periode_occupee($data)
	{
		$arr = $data['bl_date_arr'];
		$h_arr = $data['bl_heure_arr'];
		
		list($d, $m, $y) = preg_split('/\//', $arr);
		$arr_date = sprintf('%4d-%02d-%02d', $y, $m, $d);
		
		$match = "/^2[0-3]|[01][0-9]:[0-5][0-9]$/";

		if (preg_match($match, $h_arr)) {
			$arr_date = $arr_date . ' ' . $h_arr . ':00';
		}
		else
		{
			$arr_date = $arr_date . ' ' . '11:00:00';
		}
		
		$dep = $data['bl_date_dep'];
		$h_dep = $data['bl_heure_dep'];
		
		list($d, $m, $y) = preg_split('/\//', $dep);
		$dep_date = sprintf('%4d-%02d-%02d', $y, $m, $d);
		
		if (preg_match($match, $h_dep)) {
			$dep_date = $dep_date . ' ' . $h_dep . ':00';
		}
		else
		{
			$dep_date = $dep_date . ' ' . '15:30:00';
		}
		
		if($this->verifier_si_periode_demande()) {
			$saison = $this->get_saison_from_date($dep_date);
			if(!$saison)
				$saison = $this->session->userdata('id_saison');
		//	var_dump($saison);
		} else	
			$saison = $this->session->userdata('id_saison');
		
		$sql = "SELECT * FROM `bl_demandes` 
				WHERE id_saison = ".$this->db->escape($saison)." AND statut NOT IN ('0') AND
				(date_arrivee BETWEEN '$arr_date' AND '$dep_date') 
				OR
				(date_depart BETWEEN  '$arr_date' AND '$dep_date') 
				OR 
				('$arr_date' >= date_arrivee AND '$dep_date' <= date_depart) 
				LIMIT 4
				";
			var_dump($sql); die;
		$query = $this->db->query($sql);
		
		if ($query->num_rows() == 0) {
			return false;
		} else {
			var_dump($query->row_array()); die;
			return $query->row_array();
		}
		
	}
	
	public function modifier_demande($data)
	{
		$id_user = $data['id_user_staff'];
		$id_case = $data['id_case'];
		$arr = $data['bl_date_arr'];
		$h_arr = $data['bl_heure_arr'];
		$dep = $data['bl_date_dep'];
		$h_dep = $data['bl_heure_dep'];
		$details = $data['invite_cmt'];
		
		$inv = (array_key_exists('chk_invites', $data)) ? 'o' : 'n';
		
		// if($inv == 'o')
		// {
			// $details = "Nombre d'invit&eacute;s : " . $data['nb_famille'] . "<br />D&eacute;tails : " . $details;
		// }
		
		list($d, $m, $y) = preg_split('/\//', $arr);
		$arr_date = sprintf('%4d-%02d-%02d', $y, $m, $d);
		
		$match = "/^2[0-3]|[01][0-9]:[0-5][0-9]$/";

		if (preg_match($match, $h_arr)) {
			$arr_date = $arr_date . ' ' . $h_arr . ':00';
		}
		else
		{
			$arr_date = $arr_date . ' ' . '11:00:00';
		}
		
		list($d, $m, $y) = preg_split('/\//', $dep);
		$dep_date = sprintf('%4d-%02d-%02d', $y, $m, $d);
		
		if (preg_match($match, $h_dep)) {
			$dep_date = $dep_date . ' ' . $h_dep . ':00';
		}
		else
		{
			$dep_date = $dep_date . ' ' . '15:30:00';
		}
		
		//var_dump($arr_date); die;
		
		$montant = $data['montant'];
		$sql = "UPDATE `bl_demandes` SET 
				`date_arrivee` = ".$this->db->escape($arr_date).", 
				`date_depart` = ".$this->db->escape($dep_date).", 
				`invites` = ".$this->db->escape($inv).", 
				`nb_invites` = ".$this->db->escape($data['nb_famille']).", 
				`details` = ".$this->db->escape($details).", 
				`id_case` = ".$this->db->escape($id_case).", 
				`frais` = ".$this->db->escape($montant)."  
				WHERE `bl_demandes`.`id_demandes` = ". $data['demande_id'] .";";
		
		$this->db->query($sql);

		return $this->db->affected_rows();	
	}
	
	public function get_all()
	{
		$this->load->model('saison_model', 'saison');
		$s = $this->saison->saison_encours();
		$this->session->set_userdata('id_saison', $s['id_saison']);
		
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query(" SELECT bc.nom as nomcase, Last_Name, First_Name, DATE_FORMAT(`date_arrivee`, '%d %M') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%H:%i') as heure_depart, DATE_FORMAT(`date_depart`, '%d %M') as date_depart, `statut`, DATE_FORMAT(`date_created`, '%W %d %M') as date, DATE_FORMAT(`date_created`, '%H:%i:%s') as heure, bl.id_case, statut, datediff(DATE_FORMAT(`date_arrivee`, '%Y-%m-%d'), now()) as days   
									FROM `bl_demandes` AS bl 
									INNER JOIN userscm AS u ON u.user_id = id_user_staff 
									LEFT JOIN bl_case AS bc ON bc.id_case = bl.`id_case` 
									WHERE id_saison = '".$s['id_saison']."' 
									ORDER BY `date_created` ASC
									");
		return $query;
	
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
			
			$query = $this->db->query("SELECT `id_demandes`, DATE_FORMAT(`date_arrivee`, '%d/%m/%Y') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%d/%m/%Y') as date_depart, `invites`, `nb_invites`, `details`, `statut`, `id_case`, `id_saison`, `frais`, `ip_user` FROM `bl_demandes` WHERE id_saison = '".$this->session->userdata('id_saison')."' AND id_user_staff = '".$this->session->userdata('id_user_staff')."' LIMIT 1;");
			$this->session->set_userdata($query->row_array());
		}
	}
	
	public function message_demande()
	{
		//SET lc_time_names = 'fr_FR';
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query(" SELECT DATE_FORMAT(`date_arrivee`, '%W %d %M %Y') as date_arr, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arr, DATE_FORMAT(`date_depart`, '%W %d %M %Y') as date_dep, DATE_FORMAT(`date_depart`, '%H:%i') as heure_dep FROM bl_demandes WHERE id_user_staff = '".$this->session->userdata('id_user_staff')."' AND statut NOT IN (0) ORDER BY id_demandes DESC LIMIT 1;");
		$row = $query->row_array();
		
		if(!$this->saison_suivante && count($row) != 0) {
			if($this->demande_reservation_attend_occupation()) {
				$message = "<p>Vous avez d&eacute;j&agrave; une demande valid&eacute;e et une <strong>r&eacute;servation</strong> en cours.</p>";
				$message .= "<p><strong>Vous avez demand&eacute; une reservation pour le planing suivant :</strong></p>";
				$message .= "<ul>";
				$message .= "<li><strong>".ucwords($row['date_arr']). " &agrave " . $row['heure_arr'] ."</strong> (Date et heure d'arrivee &agrave; la base de Kribi)</li>";
				$message .= "<li><strong>".ucwords($row['date_dep']). " &agrave " . $row['heure_dep'] ."</strong> (Date et heure de d&eacute;part de la base de Kribi)</li>";
				$message .= "</ul>";
				$message .= '<p>Vous pouvez encore <strong>annuler votre r&eacute;servation</strong>.</p>';
				$this->reservation = false;
			} else {
				$message = "<p>Vous avez d&eacute;j&agrave; une demande en cours de traitement.</p>";
				$message .= "<p><strong>Vous avez demand&eacute; une reservation pour le planing suivant :</strong></p>";
				$message .= "<ul>";
				$message .= "<li><strong>".ucwords($row['date_arr']). " &agrave " . $row['heure_arr'] ."</strong> (Date et heure d'arrivee &agrave; la base de Kribi)</li>";
				$message .= "<li><strong>".ucwords($row['date_dep']). " &agrave " . $row['heure_dep'] ."</strong> (Date et heure de d&eacute;part de la base de Kribi)</li>";
				$message .= "</ul>";
				$message .= '<p>Vous pouvez encore modifier votre demande.</p>';
				$message .= "<p>En attendant la sortie du calendrier provisoire, vous ne pouvez plus faire une autre demande. Merci.</p>";
				$this->reservation = true;		
			}
		} else {
			$message = "<p>Vous avez d&eacute;j&agrave; une demande valid&eacute;e et une <strong>r&eacute;servation</strong> en cours.</p>";
			$message .= "<p><strong>Vous avez demand&eacute; une reservation pour le planing suivant :</strong></p>";
			$message .= "<ul>";
			$message .= "<li><strong>".ucwords($row['date_arr']). " &agrave " . $row['heure_arr'] ."</strong> (Date et heure d'arrivee &agrave; la base de Kribi)</li>";
			$message .= "<li><strong>".ucwords($row['date_dep']). " &agrave " . $row['heure_dep'] ."</strong> (Date et heure de d&eacute;part de la base de Kribi)</li>";
			$message .= "</ul>";
			$message .= '<p>Vous pouvez encore <strong>annuler votre r&eacute;servation</strong>.</p>';
		}	
			
		
		return $message;
	}
	
	//Lire le mois en cours à partir du serveur Mysql
	public function get_mois_encour($mois = null)
	{
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		if(is_null($mois))
			$query = $this->db->query(" SELECT MONTHNAME(CURDATE()) as mois;");
		else	
			$query = $this->db->query(" SELECT MONTHNAME(STR_TO_DATE($mois, '%m')) as mois;");
		$row = $query->row_array();
		return utf8_decode($row['mois']);
	}
	
	public function annuler_demande($idd)
	{
		$sql2 = "UPDATE `bl_demandes` SET `statut` = 0 
				WHERE `id_demandes` = ". $this->db->escape($idd) .";";
		
		//var_dump($sql2); die;
		
		$this->db->query($sql2);

		return $this->db->affected_rows();
	
	}
	
	// A modifier plus tard
	public function demande_saison_exists($id_user = null)
	{
		
		////// To alter
		if(is_null($id_user)){
			
			$query = $this->db->query("SELECT * FROM userscm WHERE user_id = '".$this->session->userdata('iduser')."' LIMIT 1;");
			if ($query->num_rows() == 0) 
			{
				$sql = "INSERT INTO utilisateur (nom, ip) VALUES (".$this->db->escape('User Test').", '" . $this->input->ip_address() . "' );";

				$this->db->query($sql);
				$data = array(
				   'nom' => 'User test',
				   'ip' => $this->input->ip_address()
				);

				$this->session->set_userdata($data) ;
			
			} else {
				$this->session->set_userdata($query->row_array());
				$nom = $this->input->ip_address();
			}
			
		}
		///////////////////
		$this->load->model('saison_model', 'saison');
		$s = $this->saison->saison_encours();
		$this->session->set_userdata('id_saison', $s['id_saison']);
		//var_dump($s['id_saison']); die;
		$sql = "SELECT `id_demandes`, `invites`, `nb_invites`, `details`, `statut`, `id_case`, `id_saison`, `frais`, DATE_FORMAT(`date_arrivee`, '%m/%d/%Y') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%m/%d/%Y') as date_depart, DATE_FORMAT(`date_depart`, '%H:%i') as heure_depart 
				FROM bl_demandes 
				WHERE id_saison = '".$s['id_saison']."' AND id_user_staff = '".$this->session->userdata('iduser')."' AND statut NOT IN (0)  
				ORDER BY `date_created` DESC LIMIT 1;";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
	
		if ($query->num_rows() == 0) {
			// On check aussi la saison suivante
			$saison = $s['id_saison'] + 1;
			//var_dump($saison); die;
			$query2 = $this->db->query("SELECT `id_demandes`, `invites`, `nb_invites`, `details`, `statut`, `id_case`, `id_saison`, `frais`, DATE_FORMAT(`date_arrivee`, '%m/%d/%Y') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%m/%d/%Y') as date_depart, DATE_FORMAT(`date_depart`, '%H:%i') as heure_depart FROM bl_demandes WHERE id_saison = '".$saison."' AND id_user_staff = '".$this->session->userdata('id_user_staff')."' AND statut NOT IN (0) ORDER BY `date_created` DESC LIMIT 1;");
			if ($query2->num_rows() == 0) {
				$data = array(
							'id_demandes' => '',
							'invites' => 'n',
							'details' => '',
							'id_case' => '1',
							'frais' => '5000',
							'date_arrivee' => '',
							'heure_arrivee' => '',
							'date_depart' => '',
							'heure_depart' => ''
						);
			} else { // Le mec a une demande la saison suivante
				$this->saison_suivante = true;
				$this->session->set_userdata($query->row_array());
				return true;
			}
			$this->session->set_userdata($data);
			//$query->row_array();
			return false;
		} else {
			$saison = $s['id_saison'] + 1;
			//var_dump($query->row_array()); die;
			if($this->demande_next_saison_exist($saison)) {
				//var_dump($this->session->userdata); die;
				$this->saison_suivante = true;
			} else {
				$this->session->set_userdata($query->row_array());
			}
			return true;	
		}
	}
	
	// Verifier si une demande existe deja pour la saison prochaine
	public function demande_next_saison_exist($saison)
	{
		$sql = "SELECT `id_demandes`, `invites`, `nb_invites`, `details`, `statut`, `id_case`, `id_saison`, `frais`, DATE_FORMAT(`date_arrivee`, '%m/%d/%Y') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%m/%d/%Y') as date_depart, DATE_FORMAT(`date_depart`, '%H:%i') as heure_depart FROM bl_demandes WHERE id_saison = '".$saison."' AND id_user_staff = '".$this->session->userdata('id_user_staff')."' AND statut NOT IN (0) ORDER BY `date_created` DESC LIMIT 1;";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0) {
			return false;
		} else {
			$this->session->set_userdata($query->row_array());
			return true;
		}
	}
	
	// Verifier si la demande en cours de l'utilisateur est deja depassée ou non
	public function demande_saison_depassee()
	{
		///////////////////
		$this->load->model('saison_model', 'saison');
		$s = $this->saison->saison_encours();
		$this->session->set_userdata('id_saison', $s['id_saison']);
		//var_dump($this->session->all_userdata()); die;
		$query = $this->db->query("SELECT `id_demandes`, DATE_FORMAT(`date_depart`, '%m/%d/%Y') as date_depart, 
										DATE_FORMAT(`date_depart`, '%H:%i') as heure_depart 
									FROM bl_demandes WHERE id_saison = '".$s['id_saison']."' 
									AND id_user_staff = '".$this->session->userdata('iduser')."' AND statut NOT IN (0)  
									AND date_depart < CURDATE() LIMIT 1;");
	
		if ($query->num_rows() == 0) {
			
			return false;
		} else {
			$saison = $s['id_saison'] + 1;
			if($this->demande_next_saison_exist($saison)) {
				//var_dump($this->session->userdata); die;
				$this->saison_suivante = true;
				return false;
			} else {
				$data = array(
						'id_demandes' => '',
						'invites' => 'n',
						'details' => '',
						'id_case' => '1',
						'frais' => '5000',
						'date_arrivee' => '',
						'heure_arrivee' => '',
						'date_depart' => '',
						'heure_depart' => ''
					);
			$this->session->set_userdata($data);
			}
			return true;	
		}
	}
	
	// Verifier si la demande en cours de l'utilisateur est deja validée et attends son occupation ou sa confirmations
	public function demande_reservation_attend_occupation()
	{
		///////////////////
		$this->load->model('saison_model', 'saison');
		$s = $this->saison->saison_encours();
		$this->session->set_userdata('id_saison', $s['id_saison']);
		//var_dump($this->session->all_userdata()); die;
		
		$query = $this->db->query("SELECT `id_demandes`, DATE_FORMAT(`date_depart`, '%m/%d/%Y') as date_depart, 
										DATE_FORMAT(`date_depart`, '%H:%i') as heure_depart 
									FROM bl_demandes 
									WHERE id_saison = '".$s['id_saison']."' 
									AND id_user_staff = '".$this->session->userdata('iduser')."' 
									AND statut = 2 
									LIMIT 1;");
		
		if ($query->num_rows() == 0) {
			
			return false;
		} else {
			
			$this->reservation = true;			
			return true;
		}
	}
	
	// Verifier si nous sommes dans la période d'admissibilité des demandes
	public function verifier_si_periode_demande()
	{
		return true; // temporairement pour test
		$m = date('m', strtotime("now"));
		$m = ( int ) $m;
		if( $m & 1 ) {
			return false;
		} else {
			$mois = date('F', strtotime("now"));
			$annee = date('Y', strtotime("now"));
			$lundi = date('d', strtotime("last Monday of $mois $annee"));
			$mercredi = ( int ) $lundi - 5;
			$vendredi = $mercredi + 2;
			$periode = "La periode d'admissibilite des demandes va du : $mercredi au $vendredi";
			
			$jrNow = date('d', strtotime("now"));
			$jj = ( int ) $jrNow;
			//var_dump($jj); die;
			if($jj >= $mercredi && $jj <= $vendredi)
				return true;
			else
				return false;
		}
	}
	
	// Verifier si nous sommes le lundi d'apres la période d'admissibilité des demandes
	public function verifier_si_lundi_calendrier()
	{
		return true; // temporairement pour test
		$m = date('m', strtotime("now"));
		$m = ( int ) $m;
		if( $m & 1 ) {
			return false;
		} else {
			$mois = date('F', strtotime("now"));
			$annee = date('Y', strtotime("now"));
			$lundi = date('d', strtotime("last Monday of $mois $annee"));
			$mercredi = ( int ) $lundi - 5;
			$vendredi = $mercredi + 2;
			$periode = "La periode d'admissibilite des demandes va du : $mercredi au $vendredi";
			$lundidapres = $vendredi + 3;
			$jrNow = date('d', strtotime("now"));
			$jj = ( int ) $jrNow;
			
			if($jj == $lundidapres)
				return true;
			else
				return false;
		}
	}
	
	// Transforme la date du calendrier Mootools en date Mysql pour appliquer la fonction get_saison_from_date($date)
	public function get_date_format($date, $heure)
	{
		list($d, $m, $y) = preg_split('/\//', $date);
		$arr_date = sprintf('%4d-%02d-%02d', $y, $m, $d);
		
		$match = "/^2[0-3]|[01][0-9]:[0-5][0-9]$/";

		if (preg_match($match, $heure)) {
			$arr_date = $arr_date . ' ' . $heure . ':00';
		}
		else
		{
			$arr_date = $arr_date . ' ' . '00:00:00';
		}
		return $arr_date;
	}
	
	// Détermine la saison en fonction de la date
	public function get_saison_from_date($date)
	{
		$query = $this->db->query("SELECT * FROM `bl_saison` WHERE '$date' BETWEEN date_debut AND date_fin LIMIT 1;");
		if ($query->num_rows() == 0) 
			return false;
		else {
			$row = $query->row_array();
			return $row['id_saison'];
		}
	}
	
	// Faire le tri des demandeurs du mois pour une case
	public function tri_prioritaire_du_mois()
	{
		$demandeurs = $this->recense_demandeurs_mois();
		
	}
	
	// Recencer les demandes de la saison en cours
	public function recense_demandes_saison_prochaine()
	{
		$this->load->model('saison_model', 'saison');
		$s = $this->saison->saison_encours();
		$id_s = $s['id_saison'] + 1;
		
		$sql = "SELECT * FROM `bl_demandes` WHERE id_saison = '$id_s' ORDER BY `date_created` ASC ";
		$query = $this->db->query($sql);
		
		$demandes = array();
		
		foreach ($query->result() as $row)
		{
		   $demandes[] = $row;
		}
		
		return $demandes;
	}
	
	// Recenser les demandes validées dont la date d'arrivée est prévu 4 jours à partir d'aujourdhui
	public function recense_demandes_4jrs()
	{
		$sql = "SELECT * FROM `bl_demandes` WHERE statut = '2' AND DATE(date_arrivee) = curdate() + interval 4 day";
		$query = $this->db->query($sql);
		
		$demandes = array();
		
		foreach ($query->result() as $row)
		{
		   $demandes[] = $row;
		}
		
		return $demandes;
	}
	
	// Check if periode deja occupée
	// Retourne l'id de l'utilisateur qui occupe la periode et false si celle ci n'est pas occupée
	public function check_if_periode_occupee($da, $dd, $ids, $idc)
	{
		$sql = "SELECT br.id_reservations, br.demande_id, bd.id_user_staff  FROM `bl_reservations` AS br 
				LEFT JOIN bl_demandes AS bd ON br.demande_id = bd.id_demandes 
				WHERE id_saison = '$ids' AND id_case = '$idc'  
					AND ('$da' BETWEEN date_arrivee AND date_depart OR '$dd' BETWEEN date_arrivee AND date_depart OR '$da' < date_arrivee AND '$dd' > date_depart) 
				LIMIT 1";
		//var_dump($sql);
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0) 
			return false;
		else {
			$row = $query->row_array();
			$this->id_occupant = $row['id_user_staff'];
			$this->id_demande_occupant = $row['demande_id'];
			//$this->id_reservation_occupant = $row['id_reservations'];
			return true;
		}
	}
	
	// changer reservation en reservation
	public function change_reservation_en_demande($idd)
	{
		$sql = "DELETE FROM `bl_reservations` WHERE `demande_id` = ".$this->db->escape($idd).";";
		
		$sql2 = "UPDATE `bl_demandes` SET `statut` = 1 
				WHERE `id_demandes` = ". $this->db->escape($idd) .";";
		
		//var_dump($sql); //die;
		
		$this->db->query($sql2);
		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	
	// changer demande en reservation
	public function change_demande_en_reservation($idd)
	{
		$sql = "INSERT INTO `bl_reservations` (`demande_id`, `statut`) 
				VALUES (".$this->db->escape($idd).", ".$this->db->escape('en attente').");";
		
		$sql2 = "UPDATE `bl_demandes` SET `statut` = 2 
				WHERE `id_demandes` = ". $this->db->escape($idd) .";";
		
		//var_dump($sql); //die;
		
		$this->db->query($sql2);
		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	
	// Recense les demandeurs figurant dans un mois
	public function recense_demandeurs_mois()
	{
		$demandeurs = array();
		
		
		
		return $demandeurs;
	}
	
	// Calcul priorité d'un utilisateur
	public function priorite_utilisateur()
	{
		$quota_occupation = array();
		$all_authorized_users = array();
		
		foreach($all_authorized_users as $user) {
			// Checker toutes ses occupations au courant de l'année en cours
			$resas = $this->get_all_resas();
			
			// 
		}
	}
	
	// Sommes toutes les réservations d'un utilisateur
	public function get_all_resas($data)
	{
		//var_dump($data); 
		//var_dump($data['case']); die;
		if(!$data['case'])
			$case = 1;
		else	
			$case = $this->get_case($data['case']);
		
		$today = getdate();
		if($data['month'] == '') { // si aucun mois n'est passé
			$sdate = $today['year'] . "-" . $today['mon'] . "-01";
			$edate = date("Y-m-t", strtotime($sdate));
		} else { // si un mois est envoyé
			$sdate = $today['year'] . "-" . $data['month'] . "-01";
			$edate = date("Y-m-t", strtotime($sdate));
		}
		
		$resas = array();
		
		$sql = "SELECT date_arrivee, date_depart, br.statut, Last_Name 
									FROM bl_reservations AS br 
									INNER JOIN bl_demandes AS bd ON demande_id = id_demandes 
									INNER JOIN userscm AS u ON user_id = id_user_staff 
									WHERE (date_arrivee BETWEEN '$sdate' AND '$edate' 
										OR date_depart BETWEEN '$sdate' AND '$edate' 
										OR (date_arrivee < '$sdate' AND date_depart > '$edate')) 
										AND id_case = $case 
								";
		//var_dump($sql);
		$query = $this->db->query($sql);
								
		foreach ($query->result() as $row)
		{
		   $resas[] = $row;
		}
		$t = array();
		foreach($resas as $r) {
			$date = explode(" ", $r->date_arrivee);
			$r->date_arrivee = $date[0];
			$date = explode(" ", $r->date_depart);
			$r->date_depart = $date[0];
			$t[$r->Last_Name] = $r;
		
		}
		
		return $t;
		
	}
	
	// Generer un tableau avec les date et les occupants
	public function tableau_resas($data)
	{
		$tableau_resas = array();
		$jr_du_mois = array();
		
		$today = getdate();
		if($data['month'] == '') { // si aucun mois n'est passé
			
			
			$sdate = $today['year'] . "-" . $today['mon'] . "-01";
			$edate = date("Y-m-t", strtotime($sdate));
		} else { // si un mois est envoyé
			$sdate = $today['year'] . "-" . $data['month'] . "-01";
			$edate = date("Y-m-t", strtotime($sdate));
		}
		
		//var_dump($sdate);
		
		$begin = new DateTime( $sdate );
		$end = new DateTime( $edate );
		$end = $end->modify( '+1 day' ); 

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);
		//var_dump($period);
		
		foreach ( $period as $dt ) {
		  
			$jr_du_mois[] = $dt->format( "Y-m-d" );
		
		}
		
		$resas = $this->get_all_resas($data);
		
		//var_dump($resas); 
		//var_dump($jr_du_mois); 
		
		foreach($jr_du_mois as $jr) {
			$flag = true;
			
			$timestamp = strtotime($jr);
			$day = (int) date('d', $timestamp);
			
			reset($resas);
			while(list($n, $r) = each($resas)) {
				$jr_encour = strtotime($jr);
				$date_debut_resa = strtotime($r->date_arrivee);
				$date_fin_resa = strtotime($r->date_depart);
				
				
				if($jr_encour >= $date_debut_resa && $jr_encour <= $date_fin_resa)
				{
					$nbl = str_word_count($r->Last_Name, 0);
					if($nbl > 1) {
						$n = explode(" ", $r->Last_Name);
						$r->Last_Name = $n[0];
					}
					$tableau_resas[$day] = $r->Last_Name;
					$flag = false;
				}
				else
				{
					$flag = true;
				}
			}
			if(empty($tableau_resas[$day]))
				$tableau_resas[$day] = '';
		}
		
		return $tableau_resas;
	}
	
	public function get_case($couleur)
	{
		switch($couleur) {
			case 'bleue' : return 2;
			case 'verte' : return 1;
			case 'grande' : return 3;
			case 'jaune' : return 4;
		}
	}
	
	public function debut_saison_prochaine()
	{
		$mois = date('m', strtotime("now")); // Mois
		
		$m = ( int ) $mois;
		
		if( $m & 1 ) { // Si le mois est impair
			if( $m < 11 ) { // Si le mois est inférieur au mois de Novembre
				$m = $m + 2;
			} else { // Sinon la prochaine saison est au mois de Janvier (On est au mois de Novembre)
				$m = 1; 
			}
		} else {
			if( $m < 10 ) { // Si le mois est inférieur au mois d'octobre
				$m = $m + 1;
			} else { // Sinon la prochaine saison est au mois de Janvier (On est au mois de décembre)
				$m = 1;
			}
		}
	}
	
	// Enregistrer les occupations
	public function enregistrer_occupation()
	{
		$sql = "INSERT INTO `base_loisir`.`bl_occupations` (`id_occupations`, `id_reservation`, `date_arrivee`, `date_depart`, `details`) VALUES (NULL, '2', '2014-08-14 16:17:00', '2014-08-15 16:37:00', 'RAS');";
	}
	
	// genere un compteur de jour entre les jours de la saison prochaine
	public function generer_calendrier_saison()
	{
		$date_debut = $this->debut_saison_prochaine();
		$date_fin = $this->fin_saison_prochaine();
		
		$begin = new DateTime( '2014-05-01' );
		$end = new DateTime( '2014-05-10' );

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);
	}
	
	// Compter le nombre de mois entre 2 dates
	public function nb_mois($date1, $date2)
	{
		
		$begin = new DateTime( $date1 );
		$end = new DateTime( $date2 );
		
		if(date_format($begin, 'm') == date_format($end, 'm'))
			return 1;
		
		//$end = $end->modify( '+1 month' );

		$interval = DateInterval::createFromDateString('1 month');

		$period = new DatePeriod($begin, $interval, $end);
		$counter = 1;
		foreach($period as $dt) {
			$counter++;
		}

		return $counter;
	}
	
	// Compter le nombre de mois entre 2 dates
	public function nb_jours($date1, $date2)
	{
		
		$begin = new DateTime( $date1 );
		$end = new DateTime( $date2 );
		$end = $end->modify( '+1 day' );

		// $date1 = (int) $begin->format( "m" );
		// $date2 = (int) $end->format( "m" );

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);
		
		$counter = 0;
		foreach($period as $dt) {
			$counter++;
		}

		return $counter;
	}
	
	// Verifie si une case est occupée pour un jour donné
	public function check_case_jour($id_case, $date)
	{
		$sql = "SELECT br.id_user_staff, u.Last_Name, u.First_Name FROM `bl_demandes` AS br 
				INNER JOIN userscm AS u ON u.user_id = br.id_user_staff 
				WHERE id_case = '$id_case'  
					AND ('$date' >= DATE_FORMAT(`date_arrivee`, '%Y-%m-%d') AND '$date' <= DATE_FORMAT(`date_depart`, '%Y-%m-%d') ) AND br.statut NOT IN (0) 

				LIMIT 1";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0) 
			return false;
		else {
			$row = $query->row_array();
			//$row['id_user_staff'];
			$html = "<br><b>".$row['Last_Name']." ".$row['First_Name']."</b><div></div>";
			return $html;
		}
	}
}

?>