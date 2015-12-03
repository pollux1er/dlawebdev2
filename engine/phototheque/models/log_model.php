<?php

class Log_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
	}
	
	public function log($array)
	{
		if(isset($array['id_user']))
			$id_user = $array['id_user'];
		else if($this->session->userdata('iduser'))
			$id_user = $this->session->userdata('iduser');
		else	
			$id_user = 0;
		
		$actions = $array['actions'];
		$description = $array['description'];
		if($array['id_reservation'])
			$id_reservation = $array['id_reservation'];
		else	
			$id_reservation = '';
			
		$sql = "INSERT INTO `bl_logs` (`id_reservation`, `date`, `id_user_staff`, `actions`, `description`) 
							VALUES ('$id_reservation', CURRENT_TIME(), '$id_user', '$actions', ".$this->db->escape($description).");";
		
		//var_dump($sql); die;
		
		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	
	public function get_log_resa($id_resa)
	{
		$query = $this->db->query("SELECT id_user_staff, id_reservation, actions, description FROM bl_logs WHERE id_reservation = '$id_resa';");
				
		return $query->row_array();
	}
	
	public function fin_saison($id_saison)
	{
		$query = $this->db->query("SELECT date_fin FROM bl_saison WHERE id_saison = $id_saison LIMIT 1;");
		$date = $query->row_array();
		return $date['date_fin'];
	}
	
	public function afficher_tout()
	{
	
	}
	
	public function afficher()
	{
	
	}
	
}

?>