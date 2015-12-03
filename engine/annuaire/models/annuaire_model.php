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

class Annuaire_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('saison_model', 'saison');
		$this->load->library('session');
		$this->load->database();
	}
	
	public function get_all_user_directory($dep = null)
	{
		
	}
	
	public function get_pabx_directory($dep = null)
	{
		//var_dump($dep); die;
		if(is_null($dep) || $dep == "*" || !$dep)
			$dep = "1";
		else
			$dep = "department = '$dep'";

		if(is_null($dep) || $dep == "*" || !$dep)
			$where = " WHERE 1 ";
		else
			$where = " WHERE $dep ";

		$sql = "SELECT up.`id_user`, up.`id_pabx`, u.last_name, u.first_name, u.`job_title`, u.`department`, p.extension, p.habilitation, p.mouchard, u.batiment, u.bureau, ug.id_gsm   
				FROM `sct_user_pabx` up 
				LEFT JOIN userscm u ON u.id = up.id_user 
				LEFT JOIN sct_pabx p ON p.extension = up.id_pabx 
				INNER JOIN sct_user_gsm_asset ug ON ug.id_user = u.id 
				$where 
				ORDER BY u.last_name ASC";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
		$users = $query->result();
		return $users;
	}
	
	public function get_directory($dep = null)
	{
		if(is_null($dep) || $dep == "*" || !$dep)
			$dep = "1";
		else
			$dep = "department = '$dep'";

		if(is_null($dep) || $dep == "*" || !$dep)
			$where = " WHERE 1 ";
		else
			$where = " WHERE $dep ";
		
		$sql ="SELECT u.`id`, `last_name`, `first_name`, `job_title`, `department`, `batiment`, `bureau`, up.id_pabx as extension, ug.id_gsm 
				FROM `userscm` u
				LEFT JOIN sct_user_pabx up ON u.id = up.id_user 
				LEFT JOIN sct_user_gsm_asset ug ON u.id = ug.id_user 
				$where AND up.id_pabx IS NOT NULL 
				ORDER BY u.last_name ASC";
		$query = $this->db->query($sql);
		$users = $query->result();
		return $users;
	}

	public function get_pabx_directory_alldata($dep = null)
	{
		//var_dump($dep); die;
		if(is_null($dep) || $dep == "*" || !$dep)
			$dep = "1";
		else
			$dep = "department = '$dep'";

		if(is_null($dep) || $dep == "*" || !$dep)
			$where = " WHERE 1 ";
		else
			$where = " WHERE $dep ";

		$sql = "SELECT u.id, u.last_name, u.first_name, u.`job_title`, u.`department`, p.extension, p.habilitation, p.mouchard, FORMAT(c.juin, 0) as jf, c.juin, c.juil, c.aou, c.sep  
				FROM `sct_user_pabx` up 
				LEFT JOIN userscm u ON u.id = up.id_user 
				LEFT JOIN sct_pabx p ON p.extension = up.id_pabx 
				LEFT JOIN sct_conso_2015 c ON p.extension = c.number
				$where 
				ORDER BY u.last_name ASC";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
		$users = $query->result();
		return $users;
	}
	
	public function get_all_intranet()
	{
		$sql = "SELECT `id`, `last_name`, `first_name` 
					FROM `userscm` 
					WHERE `status` NOT IN ('Ex-Expatriate Rotation', 'Ex-Contracted', 'Ex-Employee', 'Ex-National') 
					ORDER BY last_name ASC ";
		
		$query = $this->db->query($sql);
		
		$users = $query->result();
		return $users;
	}
	
	public function get_all_intranet_and_third()
	{
		$sql = "SELECT `id`, concat (`last_name`, ' ' , `first_name`) as nom, 'user' as type 
				FROM `userscm` 
				WHERE `status` NOT IN ('Ex-Expatriate Rotation', 'Ex-Contracted', 'Ex-Employee', 'Ex-National') 
				UNION 
				SELECT `id`, nom, 'external' as type 
				FROM sct_third_party_gsm 
				ORDER BY nom";
		
		$query = $this->db->query($sql);
		
		$users = $query->result();
		return $users;
	}
	
	public function get_user_from_number($numero)
	{
		$sql = "SELECT COALESCE(
								(SELECT concat(u.first_name, ' ', u.last_name) as nom FROM `sct_user_gsm_asset` ug LEFT JOIN userscm u ON ug.id_user = u.id WHERE id_gsm = $numero), 
								(SELECT nom FROM `sct_user_gsm_asset` ug LEFT JOIN sct_third_party_gsm tp ON tp.id = ug.id_third_party WHERE `id_gsm` = $numero)
								) as user 
				";
		$query = $this->db->query($sql);
		
		$users = $query->result();
		return $users;
	}
	
	public function get_all_third_party_users()
	{
		$sql = "SELECT tp.`id`, tp.`nom`, tp.`ticket_id`, tp.`id_user_accountable`, tp.`comment`, tp.`email`, concat(u.last_name, ' ',  u.first_name) as accountable    
				FROM `sct_third_party_gsm` tp 
				LEFT JOIN userscm u ON tp.`id_user_accountable` = u.`id`  
					ORDER BY last_name ASC ";
		
		$query = $this->db->query($sql);
		
		$users = $query->result();
		return $users;
	}
	
	public function get_all_users_without_pabx($search = null)
	{
		if(is_null($search))
			$sql = "SELECT `id`, `last_name`, `first_name` 
					FROM `userscm` 
					WHERE id NOT IN (
						SELECT up.`id_user`    
						FROM `sct_user_pabx` up) 
					ORDER BY last_name ASC ";
		
		$query = $this->db->query($sql);
		
		$users = $query->result();
		return $users;
	}
	
	public function set_user_pabx()
	{
		if($this->input->post()) {
			$id_user = $this->input->post('iduser');		
			$id_pabx = $this->input->post('pabx');
			$sql = "INSERT INTO `sct_user_pabx`(`id_user`, `id_pabx`) VALUES ('$id_user', '$id_pabx')";
			return $this->db->query($sql);
		} else {
			return false;
		}
	}

	public function get_pabx_alluser($dep = null)
	{
		//var_dump($dep); die;
		if(is_null($dep) || $dep == "*" || !$dep)
			$dep = "1";
		else
			$dep = "department = '$dep'";

		if(is_null($dep) || $dep == "*" || !$dep)
			$where = " WHERE 1 ";
		else
			$where = " WHERE $dep ";

		$sql = "SELECT u.id, u.last_name, u.first_name, u.`job_title`, u.`department`, p.extension, p.habilitation, p.mouchard, p.abrege  
				FROM `sct_user_pabx` up 
				LEFT JOIN userscm u ON u.id = up.id_user 
				LEFT JOIN sct_pabx p ON p.extension = up.id_pabx 
				$where 
				ORDER BY u.last_name ASC ";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
		$users = $query->result();
		return $users;
	}
	public function get_gsm_directory_alldata($dep = null)
	{
		//var_dump($dep); die;
		if(is_null($dep) || $dep == "*" || !$dep)
			$dep = "1";
		else
			$dep = "department = '$dep'";
		
		$formula = ''; $status = '';
		if($this->input->get('formule') && $this->input->get('formule') != '*')
			$formula = " AND formula = '".$this->input->get('formule')."' ";
		if($this->input->get('status')  && $this->input->get('status') != '*')
			$status = " AND g.status = '".$this->input->get('status')."' ";
			

		if(is_null($dep) || $dep == "*" || !$dep)
			$where = " WHERE 1 ";
		else
			$where = " WHERE $dep $formula $status";

		$sql = "SELECT u.id, COALESCE(CONCAT(u.last_name, ' ', u.first_name), tpg.nom ) as nom, u.`job_title`, u.`department`, g.number, g.formula, g.quota, g.status, g.provider, g.puk_code, g.international, g.sn, g.roaming, c.`January`, c.`February`, c.`March`, c.`April`, c.`May`, c.`June`, c.`July`, c.`August`, c.`September`, c.`October`, c.`November`, c.`December`      
				FROM `sct_gsm` g 
				LEFT JOIN sct_user_gsm_asset ug ON ug.id_gsm = g.number 
				LEFT JOIN userscm u ON u.id = ug.id_user 
                LEFT JOIN sct_third_party_gsm tpg ON ug.id_third_party = tpg.id 
				LEFT JOIN sct_conso_2015 c ON g.number = c.number 
				$where 
				ORDER BY u.last_name ASC";
		//echo $sql; var_dump($sql); die;
		$query = $this->db->query($sql);
		$users = $query->result();
		return $users;
	}
	
	public function get_the_last_gsm_month_bill_updated()
	{
		$sql = "SELECT 
					CASE 
						WHEN December IS NOT NULL THEN 'December' 
						WHEN November IS NOT NULL THEN 'November' 
						WHEN October IS NOT NULL THEN 'October' 
						WHEN September IS NOT NULL THEN 'September' 
						WHEN August IS NOT NULL THEN 'August' 
						WHEN July IS NOT NULL THEN 'July' 
						WHEN June IS NOT NULL THEN 'June' 
						WHEN May IS NOT NULL THEN 'May' 
						WHEN April IS NOT NULL THEN 'April' 
						WHEN March IS NOT NULL THEN 'March' 
						WHEN February IS NOT NULL THEN 'February' 
						WHEN January IS NOT NULL THEN 'January' 
					ELSE NULL 
					END as 'Mois' 
				FROM sct_conso_2015 
				WHERE type = 'gsm' 
				LIMIT 1 ";
		
		$query = $this->db->query($sql);
		$month = $query->result();
		return $month[0]->Mois;		
	}
	
	public function get_gsm_pabx_alldata($dep = null)
	{
		//var_dump($dep); die;
		if(is_null($dep) || $dep == "*" || !$dep)
			$dep = "1";
		else
			$dep = "department = '$dep'";

		if(is_null($dep) || $dep == "*" || !$dep)
			$where = " WHERE 1 ";
		else
			$where = " WHERE $dep ";
		
		// Stocke les GSM dans un tableau
		$sql = "SELECT c.`id_user`, c.`juin`, c.`juil`, c.`aou`, c.`sep`, `number` FROM `sct_conso_2015` c  where c.`type` = 'gsm' ";
		$query = $this->db->query($sql);
		
		$tableau_gsm = array();
		if ($query->num_rows() > 0) {
			// output data of each row
			foreach($query->result() as $row) {
				$tableau_gsm[] = $row;
			}
		}
		$query->free_result();		

		// Stocke les taxations dans un tableau aussi
		$sql = "SELECT c.`id_user`, c.`juin`, c.`juil`, c.`aou`, c.`sep`, `number` FROM `sct_conso_2015` c where c.`type` = 'pabx';";
		$query = $this->db->query($sql);
		$tableau_tax = array();
		if ($query->num_rows() > 0) {
			// output data of each row
			foreach($query->result() as $row) {
				$tableau_tax[] = $row;
			}
		}
		$query->free_result();
		// Dans un tableau d'ID on se rassure qu'on n'a aucun doublon d'ID des 2 tableaux
		$tableau_ids = array();
		foreach ($tableau_gsm as $k => $t) {
			if (!in_array($t->id_user, $tableau_ids)) {
				$tableau_ids[] = $t->id_user;
			}
		}
		foreach ($tableau_tax as $k => $t) {
			if (!in_array($t->id_user, $tableau_ids)) {
				$tableau_ids[] = $t->id_user;
			}
		}

		// On balance les id des tax dans un tableau incrémental automatique
		foreach($tableau_tax as $tab) {
			$id_tax[] = $tab->id_user;
		}

		// Dans un tableau final, pour chaque élément de notre tableau, on y ajoute sa consomation des 3 derniers mois 
		$tableau_final = array();
		$i = 1;
		foreach($tableau_ids as $k => $v) {
			$sql = "SELECT  u.id, `last_name`, `first_name`, c.number, c.juin, c.juil, c.aou, c.sep FROM `userscm` u LEFT JOIN sct_conso_2015 c ON c.id_user = u.id WHERE c.type='gsm' AND u.`id` = '$v'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				foreach($query->result() as $row) {
					$tableau['id'] = $row->id;
					$tableau['Nom'] = $row->last_name;
					$tableau['Prenom'] = $row->first_name;
					$tableau['GSM'] = $row->number;
					$tableau['GSM_juin'] = $row->juin;
					$tableau['GSM_Juillet'] = $row->juil;
					$tableau['GSM_aout'] = $row->aou;
					$tableau['GSM_sept'] = $row->sep;
					$tableau_final[] = $tableau;
				}
				$i++;
			}
		}
		$query->free_result();	
		

		// Pour chaque élément des GSM déjà présent dans le tableau final, on ajoute ses taxations, 
		foreach ($tableau_final as &$t) {
			$flag = $id_tax;
			$sql = "SELECT  u.id, `last_name`, `first_name`, c.number, c.juin, c.juil, c.aou, c.sep FROM `userscm` u LEFT JOIN sct_conso_2015 c ON c.id_user = u.id WHERE c.type='pabx' AND u.`id` = '".$t['id']."'";
			$query = $this->db->query($sql);
			$row_cnt = $query->num_rows();
			if($row_cnt == 1 && in_array($t['id'], $id_tax)) {
				foreach($query->result() as $row) {
					$t['Extension'] = $row->number;
					$t['Tax_juin'] = $row->juin;
					$t['Tax_Juillet'] = $row->juil;
					$t['Tax_aout'] = $row->aou;
					$t['Tax_sept'] = $row->sep;
				}
				if(($key = array_search($t['id'], $id_tax)) !== false) {
					unset($id_tax[$key]);
				}
			} else { //ceux n'ayant pas de taxation, on met le vide
				$t['Extension'] = '';
				$t['Tax_juin'] = '';
				$t['Tax_Juillet'] = '';
				$t['Tax_aout'] = '';
				$t['Tax_sept'] = '';
			}
		}
		$query->free_result();

		// Les éléments de taxation restants qui n'ont aucun GCM sont ajoutés au bas de la liste 
		foreach ($id_tax as $c => $v) {
			$flag = $id_tax;
			$sql = "SELECT  u.id, `last_name`, `first_name`, c.number, c.juin, c.juil, c.aou, c.sep FROM `userscm` u LEFT JOIN sct_conso_2015 c ON c.id_user = u.id WHERE c.type='pabx' AND u.`id` = '".$v."'";
			$query = $this->db->query($sql);
			foreach($query->result() as $row) {
				$tableau['id'] = $row->id;
				$tableau['Nom'] = $row->last_name;
				$tableau['Prenom'] = $row->first_name;
				$tableau['GSM'] = '';
				$tableau['GSM_juin'] = '';
				$tableau['GSM_Juillet'] = '';
				$tableau['GSM_aout'] = '';
				$tableau['GSM_sept'] = '';
				$tableau['Extension'] = $row->number;
				$tableau['Tax_juin'] = $row->juin;
				$tableau['Tax_Juillet'] = $row->juil;
				$tableau['Tax_aout'] = $row->aou;
				$tableau['Tax_sept'] = $row->sep;
				$tableau_final[] = $tableau;
			}
			unset($id_tax[$c]);
		}

		// echo '<pre>'; var_dump($tableau_final);
		// var_dump($id_tax); die; 
		return $tableau_final;
	}
	
	public function get_department_directory()
	{
		$sql = "SELECT distinct `department` FROM `userscm` WHERE 1";
				
		$query = $this->db->query($sql);
		
		$departments = $query->result();
		return $departments;
	}
	
	public function get_fotmula_directory()
	{
		$sql = "SELECT distinct `formula` FROM `sct_gsm`";
				
		$query = $this->db->query($sql);
		
		$departments = $query->result();
		return $departments;
	}
	
	public function get_status_directory()
	{
		$sql = "SELECT distinct `status` FROM `sct_gsm`";
				
		$query = $this->db->query($sql);
		
		$departments = $query->result();
		return $departments;
	}

	// Met à jour des infos PABX pour un utilisateur
	public function update_pabx_info($id_pabx, $mouchard, $habilitation, $abrege)
	{
		$sql = "UPDATE `sct_pabx` SET `extension` = '$id_pabx', `abrege` = '$abrege', `habilitation` = '$habilitation', `mouchard` = '$mouchard' WHERE extension = '$id_pabx'";
		if($this->db->query($sql))
			return true;
		return false;
	}
	
	// Met à jour des infos PABX pour un utilisateur
	public function update_gsm_info($number, $package, $puk, $serial)
	{
		$sql = "UPDATE `sct_gsm` SET `sn` = '$serial', `quota` = '$package', `puk_code` = '$puk' WHERE `number` = '$number';";
		//var_dump($sql); die;
		if($this->db->query($sql))
			return true;
		return false;
	}
	
	public function importcsv() {
        $data['addressbook'] = $this->csv_model->get_addressbook();
        $data['error'] = '';    //initialize image upload error array to empty
 
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
 
        $this->load->library('upload', $config);
 
 
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
 
            $this->load->view('csvindex', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'firstname'=>$row['firstname'],
                        'lastname'=>$row['lastname'],
                        'phone'=>$row['phone'],
                        'email'=>$row['email'],
                    );
                    $this->csv_model->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                redirect(base_url().'csv');
                //echo "<pre>"; print_r($insert_data);
            } else 
                $data['error'] = "Error occured";
                $this->load->view('csvindex', $data);
            }
 
        } 
	
	public function delete_pabx_info($user, $pabx)
	{
		$sql = "DELETE FROM `sct_user_pabx` WHERE `id_user`= '$user' AND `id_pabx` = '$pabx';";
			
		if($this->db->query($sql))
			return true;
		return false;
	}
	
	public function add_new_gsm()
	{
		if($this->input->post()) {
			$sql = "INSERT INTO `sct_gsm`(`number`, `provider`, `puk_code`, `sn`, `formula`, `quota`, `roaming`, `international`) 
					VALUES ('".$this->input->post('gsm')."',
							'".$this->input->post('provider')."',
							'".$this->input->post('sn')."',
							'".$this->input->post('puk')."',
							'".$this->input->post('formula')."',
							'".$this->input->post('forfait')."',
							'".$this->input->post('roaming')."',
							'".$this->input->post('inter')."')";
			return $this->db->query($sql);
		} else {
			return false;
		}
	}
	
	public function add_user_third_party()
	{
		if($this->input->post()) {
			$nom = $this->input->post('user');		
			if($this->input->post('accountable') != '')
				$id_accountable = $this->input->post('accountable');
			$sql = "INSERT INTO `intranet`.`sct_third_party_gsm` (`id`, `nom`, `ticket_id`, `id_user_accountable`, `comment`, `email`) VALUES (NULL, '$nom', NULL, '$id_accountable', NULL, NULL);";
			return $this->db->query($sql);
		} else {
			return false;
		}
	}
	public function delete_gsm($gsm)
	{
		$sql = "DELETE FROM `sct_user_pabx` WHERE `id_user`= '$user' AND `id_pabx` = '$pabx';";
			
		if($this->db->query($sql))
			return true;
		return false;
	}
	
	public function delete_gsm_info($user, $gsm)
	{
		$sql = "DELETE FROM `sct_user_pabx` WHERE `id_user`= '$user' AND `id_pabx` = '$pabx';";
			
		if($this->db->query($sql))
			return true;
		return false;
	}
	
	public function terminate_gsm($number)
	{
		$sql = "UPDATE `sct_gsm` SET `status`='terminated' WHERE `number`=$number";
		if($this->db->query($sql)) {
			$this->log('terminate', $number, '', '');
			return true;
		}
		return false;
	}
	
	public function spare_gsm($number)
	{
		$sql = "UPDATE `sct_gsm` SET `status`='spare' WHERE `number`=$number";
		if($this->db->query($sql)) {
			$this->log('spared', $number, '', '');
			return true;
		}
		return false;
	}
	
	public function update_gsm_user()
	{
		$data = explode( '.', $this->input->post('new_user'));

		if($data[1] == 'user') {
			$sql = "INSERT INTO sct_user_gsm_asset (id_user, id_gsm) values ('".$data[0]."', '".$this->input->post('number_to_set')."')
						ON DUPLICATE KEY UPDATE id_user= '".$data[0]."';";
			
		}
		if($data[1] == 'external') {
			$sql = "INSERT INTO sct_user_gsm_asset (id_user, id_gsm, id_third_party) values (NULL, '".$this->input->post('number_to_set')."', '".$data[0]."') 
					ON DUPLICATE KEY UPDATE id_third_party = '".$data[0]."', id_user = NULL";
		}
		//var_dump($sql); die;
		if($this->db->query($sql)) {
			$this->log('assign', $this->input->post('number_to_set'), $this->input->post('ticket'), $this->input->post('comment'));
			return true;
		}
		return false;
	}
	
	public function log($action, $gsm, $ref_ticket_id, $commentaire, $assign_to = null)
	{
		if($this->session->userdata('iduser'))
			$id_user = $this->session->userdata('iduser');
		else	
			$id_user = 0;
		
		if(!is_null($assign_to))
			$sql = "INSERT INTO `sct_gsm_logs` (`id_gsm`, `action`, `commentaire`, `updated_by`, `ref_ticket_id`, `assign_to`) 
					VALUES ('$gsm', '$action', '$commentaire', '$id_user', '$ref_ticket_id', '$assign_to');";
		else
			$sql = "INSERT INTO `sct_gsm_logs` (`id_gsm`, `action`, `commentaire`, `updated_by`, `ref_ticket_id`) 
					VALUES ('$gsm', '$action', '$commentaire', '$id_user', '$ref_ticket_id');"; 
		
		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	
	public function is_super_admin($id)
	{
		$sql = "SELECT u.id FROM `userscm` AS u  WHERE sct IN ('4') AND id IN ('$id') LIMIT 1 ";
			
		$query = $this->db->query($sql);
		
		if ($query->num_rows() == 0) 
			return false;
	
		return true;
	}
	
	public function load_csv_gsm_to_DB()
	{
		$sql = "UPDATE sct_conso_2015 t1 
				INNER JOIN conso_octobre t2 
						ON t1.number = t2.num
				SET t1.oct = t2.conso 
				WHERE t1.type = 'gsm'";
		
		
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
		$sql = "SELECT u.user_id, u.First_Name, u.Last_Name FROM `userscm` AS u  WHERE bl IN ('4') AND user_id IN ('$id') LIMIT 1 ";
			
		$query = $this->db->query($sql);
		
		if ($query->num_rows() == 0) 
			return false;
	
		return true;
	}
	
	public function is_administrator($id)
	{
		$sql = "SELECT u.user_id, u.First_Name, u.Last_Name FROM `userscm` AS u  WHERE bl IN ('5') AND user_id IN ('$id') LIMIT 1 ";
			
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
		$sql = "SELECT `Last_Name`, `First_Name`, `Professional E-mail` FROM userscm WHERE `user_id` = ".$id_user." LIMIT 1;";
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
		$sql = "SELECT br.id_demandes, u.First_Name, u.Last_Name, u.`Professional E-mail`, br.date_arrivee, ((DATEDIFF(DATE(date_arrivee), curdate())) -
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
	
	public function liste_des_pers_6jrs()
	{
		$sql = "SELECT br.id_demandes, u.First_Name, u.Last_Name, u.`Professional E-mail`, br.date_arrivee, ((DATEDIFF(DATE(date_arrivee), curdate())) -
				((WEEK(DATE(date_arrivee)) - WEEK(curdate())) * 2) -
				(case when weekday(DATE(date_arrivee)) = 6 then 1 else 0 end) -
				(case when weekday(curdate()) = 5 then 1 else 0 end)) as DifD FROM `bl_demandes` AS br 
				LEFT JOIN userscm AS u ON br.id_user_staff = u.user_id  
				WHERE statut = '2' AND ((DATEDIFF(DATE(date_arrivee), curdate())) -
				((WEEK(DATE(date_arrivee)) - WEEK(curdate())) * 2) -
				(case when weekday(DATE(date_arrivee)) = 6 then 1 else 0 end) -
				(case when weekday(curdate()) = 5 then 1 else 0 end) - (SELECT COUNT(*) FROM holidays WHERE date>=curdate() and date<=DATE(date_arrivee))) = 6 ";
		$query = $this->db->query($sql);
		
		$ayants_droits = $query->result_array();
		return $ayants_droits;
	}
	
	public function liste_des_pers_5jrs()
	{
		$sql = "SELECT id_demandes, u.First_Name, u.Last_Name, u.`Professional E-mail`, br.date_arrivee, ((DATEDIFF(DATE(date_arrivee), curdate())) -
				((WEEK(DATE(date_arrivee)) - WEEK(curdate())) * 2) -
				(case when weekday(DATE(date_arrivee)) = 6 then 1 else 0 end) -
				(case when weekday(curdate()) = 5 then 1 else 0 end)) as DifD FROM `bl_demandes` AS br 
				LEFT JOIN userscm AS u ON br.id_user_staff = u.user_id  
				WHERE statut = '2' AND ((DATEDIFF(DATE(date_arrivee), curdate())) -
				((WEEK(DATE(date_arrivee)) - WEEK(curdate())) * 2) -
				(case when weekday(DATE(date_arrivee)) = 6 then 1 else 0 end) -
				(case when weekday(curdate()) = 5 then 1 else 0 end) - (SELECT COUNT(*) FROM holidays WHERE date>=curdate() and date<=DATE(date_arrivee))) = 5 ";
		$query = $this->db->query($sql);
		
		$ayants_droits = $query->result_array();
		return $ayants_droits;
	}
	
	public function liste_des_pers_2jrs()
	{
		
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
	
	// Quotas des utilisateurs
	public function get_quotas($id_user = null)
	{
		if(is_null($id_user))
		{
			$sql = "SELECT u.user_id, SUM(1) as unit, u.First_Name, u.Last_Name, u.`Professional E-mail` FROM `bl_demandes` AS br 
					LEFT JOIN userscm AS u ON br.id_user_staff = u.user_id  
					WHERE br.statut = '3' AND  br.id_saison = '".$this->saison->get_id_saison_encours()."' GROUP BY u.user_id ORDER BY unit DESC";
					//
				$query = $this->db->query($sql);
				
				$quotas = $query->result_array();
				//var_dump($ayants_droits); die;
				return $quotas;
		}
		else
		{
		
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
	
	public function get_all_ng_ayant_droits($search = null)
	{
		$group_db = $this->load->database('group', TRUE);
		$sql = "SELECT u.id, u.firstname, CONCAT(u.name, ' ', u.firstname) as nom, u.`email` as email FROM sub_staff.v_staff_user AS u WHERE (u.name LIKE '$search%' OR u.firstname LIKE '$search%') ORDER BY name LIMIT 10;";
		
		$query = $group_db->query($sql);
		
		$ayants_droits = $query->result();
		$group_db->close();
		return $ayants_droits;
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