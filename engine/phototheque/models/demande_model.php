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
		$this->load->model('log_model', 'log');
		$this->load->model('notify_model', 'notify');
		$this->load->model('saison_model', 'saison');
		$s = $this->saison->saison_encours();
		$this->session->set_userdata('id_saison', $s['id_saison']);
		$this->reservation = false;
	}
	
	public function enregistrer_reservation($data, $statut = null)
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
		//var_dump($data); die;
		$id_user = $data['id_user_staff'];
		$id_case = $data['id_case'];
		$arr = $data['bl_date_arr'];
		$h_arr = $data['bl_heure_arr'];
		$dep = $data['bl_date_dep'];
		$h_dep = $data['bl_heure_dep'];
		$details = $data['invite_cmt'];
		if($this->user->is_manager($this->session->userdata('iduser')))
		{
			if($data['motif_name'] != $data['motif'])
				$data['motif'] = $data['motif_name'];
			else	
				$data['motif'] = '';
		} else	
			$data['motif'] = '';
		
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
		
		//Changer la saison de la demande au cas ou on serait en periode de demande et ke le demandeur demande pour la saison prochaine
		if($this->verifier_si_periode_demande()) {
			$saison = $this->get_saison_from_date($dep_date);
			if(!$saison)
				$saison = $this->session->userdata('id_saison');
		} else	
			$saison = $this->session->userdata('id_saison');
		
		$montant = $data['montant'];
		
		$statut = is_null($statut) ? 2 : $statut; // On donne 2 à la valeur null de statut
		
		$sql = "INSERT INTO `bl_demandes` (`id_user_staff`, `date_arrivee`, `date_depart`, `invites`, `nb_invites`, `details`, `statut`, `id_case`, 
				`id_saison`, `frais`, `ip_user`, `motif`) 
				VALUES (".$this->db->escape($id_user).", 
				".$this->db->escape($arr_date).", 
				".$this->db->escape($dep_date).", 
				".$this->db->escape($inv).", 
				".$this->db->escape($data['nb_famille']).", 
				".$this->db->escape($details).", ".$this->db->escape($statut).", 
				".$this->db->escape($id_case).", 
				".$this->db->escape($saison).", 
				".$this->db->escape($montant).", 
				".$this->db->escape($this->input->ip_address()).", 
				".$this->db->escape($data['motif']).");";
		
		
		$this->db->query($sql);
		
		$id_resa = $this->db->insert_id();
		
		
		if($statut == '1') { //var_dump($id_resa); die;
			if($this->mettre_en_liste($id_resa, $arr_date, $dep_date, $id_case, $saison)) {
				$this->session->set_userdata('mise', 'oui');
				$this->notify->mise_en_attente($id_resa);
				$this->log->log(array('id_user' => $this->session->userdata('iduser'), 'id_reservation' => $id_resa, 'actions' => 'book', 'description' => 'Enregistrement de la réservation'));
		
			} else {
				$this->log->log(array('id_user' => $this->session->userdata('iduser'), 'id_reservation' => $id_resa, 'actions' => 'book', 'description' => 'Mise en attente impossible'));
		
				return "Impossible";
			}
		} else {
			$this->log->log(array('id_user' => $this->session->userdata('iduser'), 'id_reservation' => $id_resa, 'actions' => 'book', 'description' => 'Enregistrement de la réservation'));
		
			$this->notify->reservation_effectuee($id_resa);
			
		}
		
		return $this->db->affected_rows();		
	}
	
	// Met la personne en liste d'attente
	public function mettre_en_liste($idresa, $datearr, $datedep, $case, $saison)
	{			
		$sql = "SELECT id_demandes FROM `bl_demandes` 
				WHERE id_saison = ".$this->db->escape($saison)." AND statut IN ('1', '2', '3') AND
				((date_arrivee BETWEEN '$datearr' AND '$datedep') 
				OR (date_depart BETWEEN  '$datearr' AND '$datedep') 
				OR ('$datearr' >= date_arrivee AND '$datedep' <= date_depart)) 
				AND id_user_staff NOT IN(".$this->db->escape($this->session->userdata('iduser')).") 
				AND id_case = ".$this->db->escape($case)." ORDER BY date_created ASC LIMIT 1";
		//var_dump
		$query = $this->db->query($sql);
		
		$row = $query->row_array();
		//if(empty($row))
			
			
		$sql2 = "SELECT id_demande FROM `bl_liste_dattente` la 
				WHERE la.id_reservation = ".$this->db->escape($row['id_demandes'])." LIMIT 4";
		//var_dump($sql2); die;
		$query2 = $this->db->query($sql2);
		
		if ($query2->num_rows() == 0 || $query2->num_rows() < 4) {
			if($query2->num_rows() == 3)
				return false;
			$ordre = $query2->num_rows() + 1;
			$sql3 = "INSERT INTO `bl_liste_dattente` (`id_demande`, `ordre`, `id_reservation`) 
				VALUES (".$this->db->escape($idresa).", ".$this->db->escape($ordre).", ".$this->db->escape($row['id_demandes']).");";
			
			$this->db->query($sql3);
			
		} else {
			return false;
		}
		
		return true;
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
				((date_arrivee BETWEEN '$arr_date' AND '$dep_date') 
				OR
				(date_depart BETWEEN  '$arr_date' AND '$dep_date') 
				OR 
				('$arr_date' >= date_arrivee AND '$dep_date' <= date_depart)) 
				AND id_user_staff NOT IN(".$this->db->escape($data['id_user_staff']).") 
				AND id_case = ".$this->db->escape($data['id_case'])." 
				ORDER BY date_created ASC 
				LIMIT 1
				";
		//var_dump($sql); die;	
		$query = $this->db->query($sql);
		
		if ($query->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}
	
	// Check les cases libres pour une période données
	public function check_case_libre($arr, $dep, $id_case_exclue, $iduser)
	{
		// Toutes les cases, à améliorer plus tard via la BD!!!
		$cases = array(1, 2, 3, 4);
		//var_dump($cases);
		if(($key = array_search($id_case_exclue, $cases)) !== false) {
			unset($cases[$key]);
		}
		//var_dump($cases);
		///////////////////////////
		if($this->verifier_si_periode_demande()) {
			$saison = $this->get_saison_from_date($dep);
			if(!$saison)
				$saison = $this->session->userdata('id_saison');
		//	var_dump($saison);
		} else	
			$saison = $this->session->userdata('id_saison');
		$sql = "SELECT blc.id_case FROM `bl_case` blc 
				LEFT JOIN `bl_demandes` bld ON bld.id_case = blc.id_case  
				WHERE (bld.id_saison = ".$this->db->escape($saison)." AND blc.id_case NOT IN ($id_case_exclue)) AND ((date_arrivee BETWEEN '$arr' AND '$dep') OR
				(date_depart BETWEEN  '$arr' AND '$dep') OR ('$arr' >= date_arrivee AND '$dep' <= date_depart)) AND (id_user_staff NOT IN(".$this->db->escape($iduser).")) AND bld.statut NOT IN('0')  
				GROUP BY blc.id_case LIMIT 4;
				";
		$query = $this->db->query($sql);
		
		foreach ($query->result() as $row)
		{
			if(($key = array_search($row->id_case, $cases)) !== false) {
				unset($cases[$key]);
			}
		}
		//var_dump($sql);
		if(count($cases) == 1) {
			reset($cases);
			return current($cases);
		}
		//var_dump($cases);	
		return $cases;
	}
	
	public function modifier_reservation($data, $statut = null)
	{
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
		
		//$statut = is_null($statut) ? 2 : $statut; // On donne 2 à la valeur null de statut
		
		$montant = $data['montant'];
		if(is_null($statut))
			$sql = "UPDATE `bl_demandes` SET 
				`date_arrivee` = ".$this->db->escape($arr_date).", `date_depart` = ".$this->db->escape($dep_date).", 
				`invites` = ".$this->db->escape($inv).", `nb_invites` = ".$this->db->escape($data['nb_famille']).", 
				`details` = ".$this->db->escape($details).", `id_case` = ".$this->db->escape($id_case).", 
				`frais` = ".$this->db->escape($montant)."  
				WHERE `bl_demandes`.`id_demandes` = ". $data['demande_id'] .";";
		else	
			$sql = "UPDATE `bl_demandes` SET 
				`date_arrivee` = ".$this->db->escape($arr_date).", `date_depart` = ".$this->db->escape($dep_date).", 
				`invites` = ".$this->db->escape($inv).", `nb_invites` = ".$this->db->escape($data['nb_famille']).", 
				`details` = ".$this->db->escape($details).", `id_case` = ".$this->db->escape($id_case).", 
				`statut` = ".$this->db->escape($statut).", `frais` = ".$this->db->escape($montant)."  
				WHERE `bl_demandes`.`id_demandes` = ". $data['demande_id'] .";";
		
		$this->db->query($sql);
	
		$this->log->log(array('id_user' => $this->session->userdata('iduser'), 'id_reservation' => $data['demande_id'], 'actions' => 'update', 'description' => 'Modification de la réservation'));
		$id_resa = $data['demande_id'];
		if($this->verifier_si_periode_demande()) {
			$saison = $this->get_saison_from_date($dep_date);
			if(!$saison)
				$saison = $this->session->userdata('id_saison');
		} else	
			$saison = $this->session->userdata('id_saison');
		if($statut == '1') {
			if($this->mettre_en_liste($id_resa, $arr_date, $dep_date, $id_case, $saison)) {
				$this->session->set_userdata('mise', 'oui');
				$this->notify->mise_en_attente($id_resa);
				$this->log->log(array('id_user' => $this->session->userdata('iduser'), 'id_reservation' => $id_resa, 'actions' => 'book', 'description' => 'Modification de la réservation'));
		
			} else {
				$this->log->log(array('id_user' => $this->session->userdata('iduser'), 'id_reservation' => $id_resa, 'actions' => 'book', 'description' => 'Mise en attente impossible'));
		
				return "Impossible";
			}
		} else
			$this->notify->modification_effectuee($id_resa);		
		
		return $this->db->affected_rows();	
	}
	
	public function get_all($get = null)
	{
		$where = '';
		
		
		$resas = array();	
		$this->load->model('saison_model', 'saison');
		$s = $this->saison->saison_encours();
		$this->session->set_userdata('id_saison', $s['id_saison']);
		
		if($this->saison->periode_presaison()) {
			$sa = $s['id_saison'] + 1;
			$where .= " (id_saison = '".$s['id_saison']."' OR id_saison = '$sa')";
		} else {
			$where .= " (id_saison = '".$s['id_saison']."') ";
		}
		if(!is_null($get)) {
			if(isset($get['statut']) && $get['statut'] != '*') {
				$where .= " AND statut = ".$this->db->escape($get['statut'])." ";
			}
			if(isset($get['idcase']) && $get['idcase'] != '*') {
				$where .= " AND bl.id_case = ".$this->db->escape($get['idcase'])." ";
			}
		}	
		
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query(" SELECT bl.id_demandes, bc.nom as nomcase, Last_Name, First_Name, DATE_FORMAT(`date_arrivee`, '%d %M') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%H:%i') as heure_depart, DATE_FORMAT(`date_depart`, '%d %M') as date_depart, `statut`, DATE_FORMAT(`date_created`, '%W %d %M') as date, DATE_FORMAT(`date_created`, '%H:%i:%s') as heure, bl.id_case, statut, datediff(DATE_FORMAT(`date_arrivee`, '%Y-%m-%d'), now()) as days   
									FROM `bl_demandes` AS bl 
									INNER JOIN userscm AS u ON u.user_id = id_user_staff 
									LEFT JOIN bl_case AS bc ON bc.id_case = bl.`id_case` 
									WHERE $where
									ORDER BY `date_created` ASC
									");
		//var_dump($s['id_saison']); die;
		foreach($query->result() as $row) {
			$logs = array();
			$q = $this->db->query("SET lc_time_names = 'fr_FR'");
			$q = $this->db->query(" SELECT `id_reservation`, First_Name as name, DATE_FORMAT(`date`, '%W %d %M') as date, `date`, `id_user_staff`, `actions`, `description`, DATE_FORMAT(`date`, '%H:%i') as heure    
										FROM `bl_logs` AS l 
										LEFT JOIN userscm AS u ON u.user_id = l.id_user_staff  
										WHERE id_reservation = '".$row->id_demandes."' 
										ORDER BY `id_log` DESC
									");
			foreach($q->result() as $r){
				$logs[] = $r;
			}
			$row->logs = $logs;
			$resas[] = $row;
		}
		
		return $resas;
	
	}
	
	public function get_all_adm()
	{
		$this->load->model('saison_model', 'saison');
		$s = $this->saison->saison_encours();
		$this->session->set_userdata('id_saison', $s['id_saison']);
		
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query(" SELECT bl.id_demandes, bc.nom as nomcase, Last_Name, First_Name, DATE_FORMAT(`date_arrivee`, '%d %M') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%H:%i') as heure_depart, DATE_FORMAT(`date_depart`, '%d %M') as date_depart, `statut`, DATE_FORMAT(`date_created`, '%W %d %M') as date, DATE_FORMAT(`date_created`, '%H:%i:%s') as heure, bl.id_case, statut, datediff(DATE_FORMAT(`date_arrivee`, '%Y-%m-%d'), now()) as days   
									FROM `bl_demandes` AS bl 
									INNER JOIN userscm AS u ON u.user_id = id_user_staff 
									LEFT JOIN bl_case AS bc ON bc.id_case = bl.`id_case` 
									WHERE id_saison = '".$s['id_saison']."' AND statut IN ('1', '2', '3')   
									ORDER BY `date_created` ASC
									");
		return $query;
	
	}
	
	public function afficher($id_resa = null)
	{
		if(!is_null($id_resa)) {
			$s = $this->saison->saison_encours();
			$this->session->set_userdata('id_saison', $s['id_saison']);
			
			$query = $this->db->query("SELECT `id_demandes`, DATE_FORMAT(`date_arrivee`, '%d/%m/%Y') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%d/%m/%Y') as date_depart, `invites`, `nb_invites`, `details`, `statut`, `id_case`, `id_saison`, `frais`, `ip_user` FROM `bl_demandes` WHERE id_demandes = '".$id_resa."' LIMIT 1;");
			$this->session->set_userdata($query->row_array());
			return $query->row_array();
		}
		
		$s = $this->saison->saison_encours();
		$this->session->set_userdata('id_saison', $s['id_saison']);
		
		$query = $this->db->query("SELECT `id_demandes`, DATE_FORMAT(`date_arrivee`, '%d/%m/%Y') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%d/%m/%Y') as date_depart, `invites`, `nb_invites`, `details`, `statut`, `id_case`, `id_saison`, `frais`, `ip_user` FROM `bl_demandes` WHERE id_saison = '".$this->session->userdata('id_saison')."' AND id_user_staff = '".$this->session->userdata('iduser')."' AND statut NOT IN (0) ORDER BY id_demandes DESC LIMIT 1;");
		if($this->input->ip_address() == '10.52.66.8') {
			// echo "<pre>";
				// $sqq = "SELECT `id_demandes`, DATE_FORMAT(`date_arrivee`, '%d/%m/%Y') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%d/%m/%Y') as date_depart, `invites`, `nb_invites`, `details`, `statut`, `id_case`, `id_saison`, `frais`, `ip_user` FROM `bl_demandes` WHERE id_saison = '".$this->session->userdata('id_saison')."' AND id_user_staff = '".$this->session->userdata('iduser')."' AND statut NOT IN (0) ORDER BY id_demandes DESC LIMIT 1;";
			// var_dump($sqq); die;
			// var_dump($query->row_array()); die;
		}
		$this->session->set_userdata($query->row_array());
		return $query->row_array();
		
	}
	
	public function message_demande($id_resa = null)
	{
		if(!is_null($id_resa)) {
			$query = $this->db->query("SET lc_time_names = 'fr_FR'");
			$query = $this->db->query(" SELECT `id_demandes`, DATE_FORMAT(`date_arrivee`, '%W %d %M %Y') as date_arr, statut, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arr, DATE_FORMAT(`date_depart`, '%W %d %M %Y') as date_dep, DATE_FORMAT(`date_depart`, '%H:%i') as heure_dep FROM bl_demandes WHERE id_demandes = '".$id_resa."' LIMIT 1;");
			$row = $query->row_array();
			
			if($row['statut'] == '1')
				$message = "<p><strong>La r&eacute;servation est en liste d'attente. Vous pouvez toujours la modifier.</strong></p> ";
			else	
				$message = "<p>Vous avez d&eacute;j&agrave; une <strong>r&eacute;servation</strong> sur la saison en cours.</p>";
			if($row['statut'] == '1')
				$message .= "<p><strong>La reservation est la suivante :</strong></p>";
			else
				$message .= "<p><strong>La reservation est pour le planing suivant :</strong></p>";
				$message .= "<ul>";
				$message .= "<li><strong>".ucwords($row['date_arr']). " &agrave " . $row['heure_arr'] ."</strong> (Date et heure d'arrivee &agrave; la base de Kribi)</li>";
				$message .= "<li><strong>".ucwords($row['date_dep']). " &agrave " . $row['heure_dep'] ."</strong> (Date et heure de d&eacute;part de la base de Kribi)</li>";
				$message .= "</ul>";
			
			return $message;
		}
		//SET lc_time_names = 'fr_FR';
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query(" SELECT `id_demandes`, DATE_FORMAT(`date_arrivee`, '%W %d %M %Y') as date_arr, statut, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arr, DATE_FORMAT(`date_depart`, '%W %d %M %Y') as date_dep, DATE_FORMAT(`date_depart`, '%H:%i') as heure_dep FROM bl_demandes WHERE id_saison = '".$this->session->userdata('id_saison')."' AND id_user_staff = '".$this->session->userdata('iduser')."' AND statut NOT IN (0) ORDER BY id_demandes DESC LIMIT 1;");
		$row = $query->row_array();
		
		// if(!$this->saison_suivante && count($row) != 0) {
			// if($this->demande_reservation_attend_occupation()) {
				// $message = "<p>Vous avez d&eacute;j&agrave; une demande valid&eacute;e et une <strong>r&eacute;servation</strong> en cours.</p>";
				// $message .= "<p><strong>Vous avez demand&eacute; une reservation pour le planing suivant :</strong></p>";
				// $message .= "<ul>";
				// $message .= "<li><strong>".ucwords($row['date_arr']). " &agrave " . $row['heure_arr'] ."</strong> (Date et heure d'arrivee &agrave; la base de Kribi)</li>";
				// $message .= "<li><strong>".ucwords($row['date_dep']). " &agrave " . $row['heure_dep'] ."</strong> (Date et heure de d&eacute;part de la base de Kribi)</li>";
				// $message .= "</ul>";
				// $message .= '<p>Vous pouvez encore <strong>annuler votre r&eacute;servation</strong>.</p>';
				// $this->reservation = false;
			// } else {
				// $message = "<p>Vous avez d&eacute;j&agrave; une demande en cours de traitement.</p>";
				// $message .= "<p><strong>Vous avez demand&eacute; une reservation pour le planing suivant :</strong></p>";
				// $message .= "<ul>";
				// $message .= "<li><strong>".ucwords($row['date_arr']). " &agrave " . $row['heure_arr'] ."</strong> (Date et heure d'arrivee &agrave; la base de Kribi)</li>";
				// $message .= "<li><strong>".ucwords($row['date_dep']). " &agrave " . $row['heure_dep'] ."</strong> (Date et heure de d&eacute;part de la base de Kribi)</li>";
				// $message .= "</ul>";
				// $message .= '<p>Vous pouvez encore modifier votre demande.</p>';
				// $message .= "<p>En attendant la sortie du calendrier provisoire, vous ne pouvez plus faire une autre demande. Merci.</p>";
				// $this->reservation = true;		
			// }
		// } else {
		if($row['statut'] == '1')
			$message = "<p><strong>Votre r&eacute;servation est en liste d'attente. Vous pouvez toujours la modifier.</strong></p> ";
		else	
			$message = "<p>Vous avez d&eacute;j&agrave; une <strong>r&eacute;servation</strong> sur la saison en cours.</p>";
		if($row['statut'] == '1')
			$message .= "<p><strong>Votre reservation actuelle est la suivante :</strong></p>";
		else
			$message .= "<p><strong>Votre reservation est pour le planing suivant :</strong></p>";
			$message .= "<ul>";
			$message .= "<li><strong>".ucwords($row['date_arr']). " &agrave " . $row['heure_arr'] ."</strong> (Date et heure d'arrivee &agrave; la base de Kribi)</li>";
			$message .= "<li><strong>".ucwords($row['date_dep']). " &agrave " . $row['heure_dep'] ."</strong> (Date et heure de d&eacute;part de la base de Kribi)</li>";
			$message .= "</ul>";
		//	$message .= '<p>Vous pouvez encore <strong>annuler votre r&eacute;servation</strong>.</p>';
		//}	
			
		
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
		$this->notify->reservation_annulee($this->session->userdata('iduser'));
		$this->log->log(array('id_user' => $this->session->userdata('iduser'), 'id_reservation' => $idd, 'actions' => 'cancel', 'description' => 'Annulation de la réservation'));
		
		return $this->db->affected_rows();
	
	}
	
	public function annuler_demande_sans_notif($idd)
	{
		$sql2 = "UPDATE `bl_demandes` SET `statut` = 0 
				WHERE `id_demandes` = ". $this->db->escape($idd) .";";
		
		//var_dump($sql2); die;
		
		$this->db->query($sql2);
		//$this->notify->reservation_annulee($this->session->userdata('iduser'));
		$this->log->log(array('id_user' => $this->session->userdata('iduser'), 'id_reservation' => $idd, 'actions' => 'cancel', 'description' => 'Annulation de la réservation'));
		
		$pendings = $this->check_pending_list_next($idd);
		
		if($pendings) {
			if(count($pendings == 1)) {
				$this->switch_to_booked($pendings[0]->id_demande);
			} else {
			
			}
		}
		
		return $this->db->affected_rows();
	
	}
	
	// Fait passer une demande de en attente à réservé
	public function switch_to_booked($idd)
	{
		$sql = "UPDATE `bl_demandes` SET `statut` = '2' WHERE `id_demandes` = ". $this->db->escape($idd) .";";
		$sql2 = "DELETE FROM bl_liste_dattente WHERE `id_reservation` = ". $this->db->escape($idd) ." ORDER BY `ordre` ASC LIMIT 1;";
		
		$qui = 0;
			
		$this->db->query($sql);
		$this->db->query($sql2);
		$this->log->log(array('id_user' => $qui, 'id_reservation' => $idd, 'actions' => 'book', 'description' => 'Changement de statut de la résa par le système'));
	}
	
	// Utilisé uniquement par le gestionnaire ou le système
	public function cancel_demande($idd)
	{//var_dump($idd); die;
		$sql2 = "UPDATE `bl_demandes` SET `statut` = 0 
				WHERE `id_demandes` = ". $this->db->escape($idd) .";";
		if($this->session->userdata('iduser'))
			$qui = $this->session->userdata('iduser');
		else	
			$qui = 0;
			
		$this->db->query($sql2);
		$this->log->log(array('id_user' => $qui, 'id_reservation' => $idd, 'actions' => 'cancel', 'description' => 'Annulation de la réservation'));
		
		if($qui == 0)
			$this->notify->reservation_annulee_admin($idd, $qui);
		else	
			$this->notify->reservation_annulee_admin($idd);
		
		return $this->db->affected_rows();
	}
	
	// Utilisé uniquement par le système
	public function passe_en_attente($idd)
	{//var_dump($idd); die;
		$sql2 = "UPDATE `bl_demandes` SET `statut` = 1 WHERE `id_demandes` = ". $this->db->escape($idd) .";";
		
		$qui = 0;
			
		$this->db->query($sql2);
		$this->log->log(array('id_user' => $qui, 'id_reservation' => $idd, 'actions' => 'queue', 'description' => 'Mise en attente de la réservation par le système'));
		
		// if($qui == 0)
			// $this->notify->alerte_5jrs($idd);
		
		return $this->db->affected_rows();
	}
	
	// A modifier plus tard
	public function demande_saison_exists($id_user = null)
	{
		// if(is_null($id_user))
			// $id_user = $this->session->userdata('id_user_staff') ? $this->session->userdata('id_user_staff') : $_SESSION['id_user_staff'];
		//var_dump($id_user); die;
		$this->load->model('saison_model', 'saison');
		$s = $this->saison->saison_encours();
		$this->session->set_userdata('id_saison', $s['id_saison']);
		//
		$query = "SELECT *, DATE_FORMAT(`date_arrivee`, '%m/%d/%Y') as date_arrivee, DATE_FORMAT(`date_depart`, '%m/%d/%Y') as date_depart, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%H:%i') as heure_depart FROM bl_demandes 
									WHERE (id_saison = '".$s['id_saison']."' OR id_saison = ('".$s['id_saison']."' + 1)) 
									AND id_user_staff = '".$this->session->userdata('iduser')."' 
									AND (statut = 2 OR statut = 3 OR statut = 1) 
									AND date_depart > CURDATE() ORDER BY `date_arrivee` ASC  
									LIMIT 1;";
		//var_dump($query); die;
		$sql = $this->db->query($query);
	
		if ($sql->num_rows() == 0) { //die;
			// On check aussi la saison suivante
			$saison = $s['id_saison'] + 1;
			//var_dump($saison); die;
			$query2 = $this->db->query("SELECT `id_demandes`, `invites`, `nb_invites`, `details`, `statut`, `id_case`, `id_saison`, `frais`, DATE_FORMAT(`date_arrivee`, '%m/%d/%Y') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%m/%d/%Y') as date_depart, DATE_FORMAT(`date_depart`, '%H:%i') as heure_depart FROM bl_demandes WHERE id_saison = '".$saison."' AND id_user_staff = '".$this->session->userdata('iduser')."' AND statut NOT IN (0) ORDER BY `date_created` ASC LIMIT 1;");
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
				$this->session->set_userdata($sql->row_array());
				return true;
			}
			$this->session->set_userdata($data);
			
			return false;
		} else { //die;
		//echo "<pre>";
			//var_dump($sql->row_array()); die;
			$this->session->set_userdata($sql->row_array());
			return true;	
		}
	}
	
	// Slelectionner l'ID de la demande
	public function get_id_demande()
	{
		$this->load->model('saison_model', 'saison');
		$s = $this->saison->saison_encours();
		$this->session->set_userdata('id_saison', $s['id_saison']);
		//
		$query = "SELECT id_demandes FROM bl_demandes 
					ORDER BY  id_demandes DESC 
					LIMIT 1;";
		$sql = $this->db->query($query);
		
		$row = $sql->row_array();
		
		return $row['id_demandes'];
	}
	
	// Verifier si une demande existe deja pour la saison prochaine
	public function demande_next_saison_exist($saison)
	{
		$sql = "SELECT `id_demandes`, `invites`, `nb_invites`, `details`, `statut`, `id_case`, `id_saison`, `frais`, DATE_FORMAT(`date_arrivee`, '%m/%d/%Y') as date_arrivee, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arrivee, DATE_FORMAT(`date_depart`, '%m/%d/%Y') as date_depart, DATE_FORMAT(`date_depart`, '%H:%i') as heure_depart FROM bl_demandes WHERE id_saison = '".$saison."' AND id_user_staff = '".$this->session->userdata('iduser')."' AND statut NOT IN (0) ORDER BY `date_created` DESC LIMIT 1;";
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
		if(!$this->demande_saison_exists())
			return false;
		///////////////////
		$this->load->model('saison_model', 'saison');
		$s = $this->saison->saison_encours();
		$this->session->set_userdata('id_saison', $s['id_saison']);
		//var_dump($this->session->all_userdata()); die;
		$query = $this->db->query("SELECT `id_demandes`, DATE_FORMAT(`date_depart`, '%m/%d/%Y') as date_depart, 
										DATE_FORMAT(`date_depart`, '%H:%i') as heure_depart 
									FROM bl_demandes WHERE id_saison = '".$s['id_saison']."' 
									AND id_user_staff = '".$this->session->userdata('iduser')."' AND statut NOT IN (0)  
									AND date_depart <= CURDATE() OR date_arrivee >= CURDATE() LIMIT 1;");
	
		if ($query->num_rows() == 0) {
			return false;
		} else {
			/* $saison = $s['id_saison'] + 1;
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
			} */
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
		
		$query = $this->db->query("SELECT `id_demandes` 
									FROM bl_demandes 
									WHERE id_saison = '".$s['id_saison']."' 
									AND id_user_staff = '".$this->session->userdata('iduser')."' 
									AND statut = 2 OR statut = 3  
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
		//return true; // temporairement pour test
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
		$sql2 = "UPDATE `bl_demandes` SET `statut` = '3' 
				WHERE `id_demandes` = ". $this->db->escape($idd) .";";
		//var_dump($sql2); die;
		if($this->session->userdata('iduser'))
			$qui = $this->session->userdata('iduser');
		else	
			$qui = 0;
		$this->db->query($sql2);
		$this->log->log(array('id_user' => $qui, 'id_reservation' => $idd, 'actions' => 'confirm', 'description' => 'Confirmation de la réservation par le gestionnaire'));
		$this->notify->reservation_confirmee($idd);
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
		//INNER JOIN bl_demandes AS bd ON demande_id = id_demandes 
									
		$sql = "SELECT date_arrivee, date_depart, br.statut, Last_Name 
									FROM bl_demandes AS br 
									INNER JOIN userscm AS u ON user_id = id_user_staff 
									WHERE (date_arrivee BETWEEN '$sdate' AND '$edate' 
										OR date_depart BETWEEN '$sdate' AND '$edate' 
										OR (date_arrivee < '$sdate' AND date_depart > '$edate')) 
										AND (id_case = $case) 
										AND (br.statut IN ('2', '3') )
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
	
	public function get_couleur($num)
	{
		switch($num) {
			case 2 : return 'Case bleue';
			case 1 : return 'Case verte';
			case 3 : return 'Grande case';
			case 4 : return 'Case jaune';
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
		$sql = "SELECT br.id_user_staff, u.Last_Name, u.First_Name, br.statut, br.id_demandes, br.motif, DATE_FORMAT(br.`date_depart`, '%H:%i') as heure_depart, DATE_FORMAT(br.`date_arrivee`, '%H:%i') as heure_arrivee  FROM `bl_demandes` AS br 
				INNER JOIN userscm AS u ON u.user_id = br.id_user_staff 
				WHERE id_case = '$id_case'  
					AND ('$date' >= DATE_FORMAT(`date_arrivee`, '%Y-%m-%d') 
					AND '$date' <= DATE_FORMAT(`date_depart`, '%Y-%m-%d') ) 
					AND br.statut NOT IN (0) ORDER BY statut DESC, id_demandes ASC
				LIMIT 4";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0) { // Si on n'a aucune reservation alors false
			
			return false;
			
		} elseif($query->num_rows() == 1) { // Si on a une réservtion alors on lecrit
			
			$row = $query->row_array();
			if($row['statut'] == '2' || $row['statut'] == '3') {
				if(is_null($row['motif']) || empty($row['motif'])) 
					$name = $row['Last_Name']." ".$row['First_Name'];
				else
					$name = $row['motif'];
					
				$html = $row['statut'] . "<br><b>".$name."</b><div></div>" . $name[0];
				
			} else {
				$html = $row['statut'] . "<br>En attente : <b>".$row['Last_Name']." ".$row['First_Name']."</b><div></div>" . $row['Last_Name'][0];
			}
			
			return $html;
			
		} elseif($query->num_rows() == 2) { // Si on a 2 réservtions alors on lecrit
			// Les 2 sont elles réservées ou confirmée ?
			$r = 0; $j = 1;
			foreach ($query->result() as $ligne)
			{
				$resas[$j] = $ligne;
				if($ligne->statut == '2' || $ligne->statut == '3')
					$r++;
				$j++;
			} $ju = $r;
			// Si les 2 sont resas
			if($r == 2) {
				$html = 'X' . "<br><b style=\'color:white\'>Entree et Sortie</b>";
				$html .= "<br />";
				$html .= "<u style=\'color:white\'>DEPART " . $resas[2]->Last_Name . ' : ' . $resas[2]->heure_depart ."</u><br />";
				$html .= "<u style=\'color:white\'>ARRIVEE " . $resas[1]->Last_Name . ' : ' . $resas[1]->heure_arrivee . "</u><br />";
				$html .= "<div></div>";
				
			} elseif($r == 1) { // Une seule est confirmée
				$row = $query->row_array();
				$motif = ($row['motif'] == "") ? $row['Last_Name']." ".$row['First_Name'] : $row['motif'];
				$html = $row['statut'] . "<br><b>$motif</b>";
				$html .= "<br />";
				$html .= "<u>En attente</u><br />";
				
				foreach ($query->result() as $ligne)
				{
				   $resasc[] = $ligne;
				}
				$resa = array_shift($resasc);
				
				$html .= '<ol>';
				foreach($resasc as $rc) {
					$html .= "<li><b>".$rc->Last_Name." ".$rc->First_Name."</b></li>";
				}
				$html .= '</ol>';
				
				$html .= "<div></div>" . $row['Last_Name'][0];
			} elseif($r == 0) { // Si la ou les réservation sont en attente
				$row = $query->row_array();
				
				$html = "1<br />";;
				$html .= "<u>En attente</u><br />";
				
				foreach ($query->result() as $ligne)
				{
				   $resas2[] = $ligne;
				}
				
				$html .= '<ol>';
				foreach($resas2 as $rs) {
					$html .= "<li><b>".$rs->Last_Name." ".$rs->First_Name."</b></li>";
				}
				$html .= '</ol>';
				
				$html .= "<div></div>" . $row['Last_Name'][0];
			}
			return $html;
			
		} else {
			$row = $query->row_array();
			if($row['statut'] == '2' || $row['statut'] == '3') {
				$html = $row['statut'] . "<br><b>".$row['Last_Name']." ".$row['First_Name']."</b>";
				$html .= "<br />";
				$html .= "<u>En attente</u><br />";
				
				foreach ($query->result() as $ligne)
				{
				   $resas[] = $ligne;
				}
				$resa = array_shift($resas);
				
				$html .= '<ol>';
				foreach($resas as $r) {
					$html .= "<li><b>".$r->Last_Name." ".$r->First_Name."</b></li>";
				}
				$html .= '</ol>';
				
				$html .= "<div></div>" . $row['Last_Name'][0];
			} else {
				$html = '<br /><u>En attente :</u>';
				foreach ($query->result() as $ligne)
				{
				   $resas[] = $ligne;
				}
				//$resa = array_shift($resas);
				
				$html .= '<ol>';
				foreach($resas as $r) {
					$html .= "<li><b>".$r->Last_Name." ".$r->First_Name."</b></li>";
				}
				$html .= '</ol>';
				$html .= "<div></div>" . $row['Last_Name'][0];
			}
			return $html;
		}
	}
	
	// Verifie si une case est demandé pour un jour donné
	public function check_case_jour_pending($date, $ordre = null)
	{
		if(is_null($ordre))
			$ordre = 1;
		$sql = "SELECT br.id_user_staff, u.Last_Name, u.First_Name, br.id_case FROM `bl_demandes` AS br 
				INNER JOIN userscm AS u ON u.user_id = br.id_user_staff 
				LEFT JOIN bl_liste_dattente AS la ON la.id_demande = br.id_demandes 
				WHERE 
					('$date' >= DATE_FORMAT(`date_arrivee`, '%Y-%m-%d') 
					AND '$date' <= DATE_FORMAT(`date_depart`, '%Y-%m-%d') ) 
					AND br.statut IN (1) AND la.ordre = '".$ordre."' 

				LIMIT 1";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0) 
			return false;
		else {
			$row = $query->row_array();
			//$row['id_user_staff'];
			$html = $row['id_case'] . "<br><b>".$row['Last_Name']." ".$row['First_Name']."</b><div></div>" . $row['Last_Name'][0];
			return $html;
		}
	}
	
	// Verifie si une case est demandé pour un jour donné
	public function check_case_jour_attente($date, $id_case, $ordre = null)
	{
		if(is_null($ordre))
			$ordre = 1;
		$sql = "SELECT br.id_user_staff, u.Last_Name, u.First_Name, br.id_case FROM `bl_demandes` AS br 
				INNER JOIN userscm AS u ON u.user_id = br.id_user_staff 
				LEFT JOIN bl_liste_dattente AS la ON la.id_demande = br.id_demandes 
				WHERE id_case = '$id_case' AND 
					('$date' >= DATE_FORMAT(`date_arrivee`, '%Y-%m-%d') 
					AND '$date' <= DATE_FORMAT(`date_depart`, '%Y-%m-%d') ) 
					AND br.statut IN (1) AND la.ordre = '".$ordre."' 

				LIMIT 1";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0) 
			return false;
		else {
			$row = $query->row_array();
			//$row['id_user_staff'];
			$html = $row['id_case'] . "<br><b>".$row['Last_Name']." ".$row['First_Name']."</b><div></div>" . $row['Last_Name'][0];
			return $html;
		}
	}
	
	// Check les cases libre le week end à venir
	public function check_cases_libres_we()
	{
		$date_start = date("Y-m-d 00:00:00", strtotime("next Saturday"));
		$date_end = date("Y-m-d 23:59:00", strtotime("next Sunday"));
		
		$sql_case_oqp = "SELECT distinct(d.id_case) FROM `bl_demandes` d 
				LEFT JOIN bl_case bc ON bc.id_case = d.id_case 
				WHERE statut IN ('2', '3') AND  
				((date_arrivee BETWEEN '$date_start' AND '$date_end') OR
				(date_depart BETWEEN  '$date_start' AND '$date_end') OR 
				('$date_start' >= date_arrivee AND '$date_end' <= date_depart))";
		
		
		$sql_case_libre = "SELECT nom FROM `bl_case` c  WHERE c.id_case NOT IN($sql_case_oqp)";
		//var_dump($sql_case_libre);
		$query = $this->db->query($sql_case_libre);
		
		foreach ($query->result() as $row)
		{
			$cases[] = $row->nom;
		}
		return $cases;
		
	}
	
	//Vérifier le prochain sur la liste d'attente d'une résa donnée
	public function check_pending_list_next($idresa)
	{
		$sql = "SELECT `id_log`, `id_demande` FROM `bl_liste_dattente` WHERE `id_reservation` = '$idresa' ORDER BY `ordre` ASC LIMIT 3";
		
		$query = $this->db->query($sql);
		
		$query->num_rows();
		
		if($query->num_rows() > 0){
			return $query->result() ;
		}
		
		return false;
	}
	
}

?>