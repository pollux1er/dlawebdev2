<?php

/*
 * Les types d'utilisateurs sont différenciés sur la table userscm par le champ 'bl'
 * On a 5 niveaux d'utilisateurs :
 * 0 = Non ayant droit
 * 1 = Ayant droit
 * 2 = Ayant droit gestionnaire de la base de kribi (Gère les réservations)
 * 3 = Ayant droit gestionnaire RH (Capable d'ajouter et de supprimer les ayant droits pour kribi, à la base des ayant droit appartenant au département HR)
 * 4 = Ayant droit administrateur RH (Capable de désigner tous les précédents et ayant droit du département HR à la base)
 */

class User_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('saison_model', 'saison');
		$this->load->library('session');
		$this->load->database();
	}
	
	public function get_nom($id_user = null)
	{
		if(is_null($id_user))
			$id_user = $this->session->userdata('iduser');
		$sql = "SELECT `last_name`, `first_name` FROM userscm WHERE `id` = ".$id_user." LIMIT 1;";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$nom = $row['last_name'] . " " . $row['first_name'];
		$this->session->set_userdata('last_name', $row['last_name']);
		$this->session->set_userdata('first_name', $row['first_name']);
		return $nom;
	}
	
	
	
	public function get_all_users($search = null)
	{
		if(is_null($search))
			$sql = "SELECT `id`, `last_name`, `first_name`, `job_title`, `location`, `department`, `line_id`, `back_to_back_id`, `email` FROM `userscm` ORDER BY last_name ASC ";
		
		$query = $this->db->query($sql);
		
		$users = $query->result();
		return $users;
	}
	
	public function get_all_ayant_droits_hr()
	{
		$sql = "SELECT u.user_id, u.first_name, u.last_name, CONCAT(u.last_name, ' ', u.first_name) as nom, bl FROM `userscm` AS u  WHERE bl IN ('3') OR (bl IN ('1') AND Department = 'Human Resources') ORDER BY last_name";
		
		$query = $this->db->query($sql);
		
		$ayants_droits = $query->result();
		return $ayants_droits;
	}
	
	public function get_ayant_droits_admin()
	{
		$sql = "SELECT u.user_id, u.first_name, u.last_name, CONCAT(u.first_name, ' ', u.last_name) as nom, u.`Professional E-mail` as email FROM `userscm` AS u  WHERE bl IN ('2') ";
				
		$query = $this->db->query($sql);
		
		$ayants_droits = $query->result();
		return $ayants_droits;
	}
	
	public function is_manager($id)
	{
		$sql = "SELECT u.user_id, u.first_name, u.last_name FROM `userscm` AS u  WHERE bl IN ('2', '5') AND user_id IN ('$id') LIMIT 1 ";
			
		$query = $this->db->query($sql);
		
		if ($query->num_rows() == 0) 
			return false;
	
		return true;
	}
	
	public function set_manager($id) {
		$sql = "UPDATE `userscm` SET `bl`='1' WHERE `bl`='2';";
		$sql2 = "UPDATE `userscm` SET `bl`='2' WHERE `user_id`='$id';";
			//
		$query = $this->db->query($sql);
		$query2 = $this->db->query($sql2);

		return true;
	}
	
	public function is_hr_manager($id)
	{
		$sql = "SELECT u.user_id, u.first_name, u.last_name FROM `userscm` AS u  WHERE bl IN ('3') AND user_id IN ('$id') LIMIT 1 ";
			
		$query = $this->db->query($sql);
		
		if ($query->num_rows() == 0) 
			return false;
	
		return true;
	}
	
	public function set_hr_manager($id)
	{
		$sql = "UPDATE `userscm` SET `bl`='1' WHERE `bl`='3';";
		$sql2 = "UPDATE `userscm` SET `bl`='3' WHERE `user_id`='$id';";
			//
		$query = $this->db->query($sql);
		$query2 = $this->db->query($sql2);

		return true;
	}
	
	public function is_hr_administrator($id)
	{
		$sql = "SELECT u.user_id, u.first_name, u.last_name FROM `userscm` AS u  WHERE bl IN ('4') AND user_id IN ('$id') LIMIT 1 ";
			
		$query = $this->db->query($sql);
		
		if ($query->num_rows() == 0) 
			return false;
	
		return true;
	}
	
	public function is_administrator($id)
	{
		$sql = "SELECT u.user_id, u.first_name, u.last_name FROM `userscm` AS u  WHERE bl IN ('5') AND user_id IN ('$id') LIMIT 1 ";
			
		$query = $this->db->query($sql);
		
		if ($query->num_rows() == 0) 
			return false;
	
		return true;
	}
	
	public function is_athorized_user($id)
	{
		$sql = "SELECT u.user_id FROM `userscm` AS u  WHERE bl IN ('1', '2', '3', '4', '5') AND user_id IN ('$id') LIMIT 1 ";
			
		$query = $this->db->query($sql);
		
		if ($query->num_rows() == 0) 
			return false;
	
		return true;
	}
	
	public function is_local_user($id)
	{
		$sql = "SELECT u.user_id FROM `userscm` AS u  WHERE user_id IN ('$id') LIMIT 1 ";
			
		$query = $this->db->query($sql);
		
		if ($query->num_rows() == 0) 
			return false;
	
		return true;
	}
	
	public function get_infos($id_user = null)
	{
		if(is_null($id_user))
			$id_user = $this->session->userdata('id_user_staff');
		$sql = "SELECT `last_name`, `first_name`, `Professional E-mail` FROM userscm WHERE `user_id` = ".$id_user." LIMIT 1;";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}
	
	// Retourne le nombre de fois que l'utilisateur a occupé les case en 1 an
	public function indice_doccupation($id_user = null)
	{
		// Si l'id utilisateur n'est pas passé, alors on utilise l'ID de session
		if(is_null($id_user))
			$id_user = $this->session->userdata('id_user_staff');
		$time = strtotime("-1 year", time());
		$date = date("Y-m-d h:i:s", $time);
  
		$sql = "SELECT id_reservation  FROM bl_occupations AS bo
				LEFT JOIN bl_reservations AS br ON br.id_reservations = bo.id_reservation  
				LEFT JOIN bl_demandes AS bd ON bd.id_demandes = br.demande_id 
				WHERE bd.id_user_staff = '".$id_user."' 
				AND bd.date_arrivee > '$date' ";
		$query = $this->db->query($sql);
		return $query->num_rows(); 
	}
	
	public function liste_des_pers_7jrs()
	{
		$sql = "SELECT br.id_demandes, u.first_name, u.last_name, u.`Professional E-mail`, br.date_arrivee, ((DATEDIFF(DATE(date_arrivee), curdate())) -
				((WEEK(DATE(date_arrivee)) - WEEK(curdate())) * 2) -
				(case when weekday(DATE(date_arrivee)) = 6 then 1 else 0 end) -
				(case when weekday(curdate()) = 5 then 1 else 0 end)) as DifD FROM `bl_demandes` AS br 
				LEFT JOIN userscm AS u ON br.id_user_staff = u.user_id  
				WHERE statut = '2' AND ((DATEDIFF(DATE(date_arrivee), curdate())) -
				((WEEK(DATE(date_arrivee)) - WEEK(curdate())) * 2) -
				(case when weekday(DATE(date_arrivee)) = 6 then 1 else 0 end) -
				(case when weekday(curdate()) = 5 then 1 else 0 end) - (SELECT COUNT(*) FROM holidays WHERE date>=curdate() and date<=DATE(date_arrivee))) = 7 ";
		$query = $this->db->query($sql);
		
		$ayants_droits = $query->result_array();
		return $ayants_droits;
	}
	
	public function count_users_by_status()
	{
		$sql = "SELECT Status, count(bl) FROM `userscm` WHERE bl IN('1') GROUP BY Status";
	}
	
	// En recommendation de Paris
	public function get_profile($id_user_staff)
	{
		if($id_user_staff == '8944' || $id_user_staff == '9041') // ID Mr MBUSSI et Mme AVA // Temporairement!!!
			return 'gestionnaire';
		else
			return 'cadre';
	}
	
	
	// Ajoute un utilisateur à la liste des ayants droits
	public function add_to_ayant_droit($id)
	{
		if($this->is_local_user($id)) {
			$sql = "UPDATE `userscm` SET `bl`='1' WHERE `user_id`='$id';";
				//
			$query = $this->db->query($sql);

			return true;
		} 
		else {
			//$this->insert_to_local_users($id) {
				
			}
	}
	
	// Ajoute un utilisateur à la liste des ayants droits
	public function remove_from_executive($id)
	{
		$sql = "UPDATE `userscm` SET `bl`='0' WHERE `user_id`='$id';";
			//
		$query = $this->db->query($sql);

		return true;
	}
	
	public function get_user_from_hq_database() 
	{
		$group_db = $this->load->database('group', TRUE); 
		
		$query = $group_db->query("	
								SELECT v.*
								FROM sub_staff.v_staff_user v
								WHERE v.user_id IN ('".$this->session->userdata('iduser')."')
							");
							
		if ($query->num_rows() == 0) 
			return false;
		
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$group_db->close();
		
		return $row;
	}

	// Pourcentage des ayants droits expatriés et nationaux
	public function get_percentage_executives()
	{
		$sql = "SELECT Status, COUNT(*) as total FROM userscm WHERE bl <> '0' GROUP BY Status";
		$query = $this->db->query($sql);
		$somme = 0;
		foreach ($query->result() as $row)
		{
		    if($row->Status == 'Expatriate Base'){
		    	$total_expats = $row->total;
		    }
		     if($row->Status == 'National'){
		    	$total_nationaux = $row->total;
		    }
		}

		$total_users_bl = $total_expats + $total_nationaux;

		$percent_expat = ((100*$total_expats)/$total_users_bl);
		$percent_nat = ((100*$total_nationaux)/$total_users_bl);
		
		return (Object) array('Expats' => $percent_expat, 'National' => $percent_nat); 
	}

	// 

}

?>