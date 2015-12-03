<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demande extends CI_Controller {

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
		$this->load->model('reservation_model', 'resa');
		$this->load->model('saison_model', 'saison');
		$this->load->helper('url');
	}
	
	
	public function index()
	{
		$this->load->library('session');
		//$this->load->model('demande_model', 'demande');
		$this->load->helper('form');
		$this->session->set_userdata('saved_url', current_url());

		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser') && $this->input->get('iduser')) {
			//redirect('/authentication/?id_user_staff='.$this->input->get('id_user_staff'));
		}
		
		// Verifier la session de l'utilisateur sans login
		if (!$this->session->userdata('iduser')) {
			redirect('/authentication/');
		}
		
		if ($this->input->get('cancel_resa')) {
			$this->demande->annuler_demande_sans_notif($this->input->get('cancel_resa'));
			//redirect('/authentication/?id_user_staff='.$this->input->get('id_user_staff'));
		}
		
		// Sil n'est pas autorisé
		if (!$this->user->is_athorized_user($this->session->userdata('iduser'))) {
				redirect('/authentication/');
		
		}
		
		$data = array();
		$data['nom'] = $this->user->get_nom();
		//if($this->demande->verifier_si_periode_demande()) { // Si on est en période d'admissibilité des demandes, on présente le formulaire
			
		$data['title'] = "Base de Loisirs - Faire une r&eacute;servation";
		
		if ($this->session->userdata('invited')) {
			redirect('/reservation/invitation/');
		}
		if($this->saison->periode_presaison()) 
			$this->session->set_userdata('session_prochaine', 1);
		
		if($this->session->userdata('id_demandes'))
			$data['id_resa'] = $this->session->userdata('id_demandes');
		elseif($this->input->get('id_resa'))
			$data['id_resa'] = $this->input->get('id_resa');
		else	
			$data['id_resa'] = null;
		
		//var_dump($this->session->userdata('session_prochaine')); die;
		if($this->user->is_manager($this->session->userdata('iduser')))
		{
			if($this->input->get('id_resa'))
			{ 
				$is_editable = false;
				if($this->session->userdata('id_demandes'))
					$is_editable = $this->resa->reservation_est_modifiable($this->input->get('id_resa'));
			
				$data['message'] = $this->demande->message_demande($this->input->get('id_resa'));
				$data['demande'] = $this->demande->afficher($this->input->get('id_resa'));
				//var_dump( $data['demande']['statut']); die;
				$data['modifier'] = $data['annuler'] = $this->demande->demande_saison_depassee();
				if($data['demande']['statut'] == '1')
					$data['modifier'] = $data['annuler'] = true;
				$this->load->view('formulaire_gestionnaire_edit', $data);
			} 
			else 
			{ 
				$data['ad'] = $this->user->get_ayant_droits();
				$data['modifier'] = $data['annuler'] = '';
				$data['message'] = '';
				$this->load->view('formulaire_gestionnaire', $data);
			}
			return;
		}
		
		if($this->demande->demande_saison_exists())
		{ 
			$is_editable = false;
			if($this->session->userdata('id_demandes'))
				$is_editable = $this->resa->reservation_est_modifiable($this->session->userdata('id_demandes'));
		
			$data['message'] = $this->demande->message_demande();
			$data['demande'] = $this->demande->afficher();
			if($this->input->ip_address() == '10.52.66.78') {
				// echo "<pre>"; var_dump( $data['demande']);
				// echo "<pre>"; var_dump( $this->session->all_userdata()); 
				// die;
			}
			$data['modifier'] = $data['annuler'] = $this->demande->demande_saison_depassee();
			if($this->session->userdata('statut') == '1')
				$data['modifier'] = $data['annuler'] = true;
			$this->load->view('formulaire_demande', $data);
			// Ajout permettant de mettre en stock les données déjà présente pour les comparer à cell que l'utilisateur va rentrer
			$this->session->set_userdata('id_case_old', $data['demande']['id_case']);
			$this->session->set_userdata('date_depart_old', $data['demande']['date_depart']);
			$this->session->set_userdata('heure_depart_old', $data['demande']['heure_depart']);
			$this->session->set_userdata('date_arrivee_old', $data['demande']['date_arrivee']);
			$this->session->set_userdata('heure_arrivee_old', $data['demande']['heure_arrivee']);
			$this->session->set_userdata('arrivee_old', $data['demande']['arrivee']);
			$this->session->set_userdata('depart_old', $data['demande']['depart']);
		} 
		else 
		{ 
			$data['modifier'] = $data['annuler'] = $this->demande->demande_saison_depassee();
			$data['message'] = '';
			$this->load->view('formulaire_demande', $data);
		}
	}
	
	// Cron executé pendant la période d'admissibilité des demandes
	public function cron_alerter_si_demande_possible()
	{
		$this->load->library('input');
		
		if(!$this->input->is_cli_request())
		{
			echo "This script can only be accessed via the command line" . PHP_EOL;
			return;
		}

		if($this->demande->verifier_si_periode_demande())
		{
			$this->load->library ( 'phpmailer' );
			$this->load->library ( 'smtp' );
				
			$Host = "10.52.64.60";						// SMTP servers
			$Username = "passontia@cm.perenco.com";						// SMTP password
			$Password = "27fevrier";							// SMTP username
			
			$From = "cm_baseloisirs@cm.perenco.com";
			$FromName = "COS - Base de Loisir";
			
			$To = "passontia@cm.perenco.com";
			$To1 = "ggwanen@cm.perenco.com";
			$To2 = "djongo@cm.perenco.com";
			$To3 = "andjengwes@cm.perenco.com";
			$To4 = "embussiotto@cm.perenco.com";
			$To5 = "mravaatanga@cm.perenco.com";
			$To6 = "jndjaya@cm.perenco.com";
			$ToName = "Patient Assontia";
			$ToName1 = "Gael Gwanen";
			$ToName2 = "Dora Jongo";
			$ToName3 = "Antoine Ndjengwes";
			$ToName4 = "Emmanuel MBUSSI Otto";
			$ToName5 = "Marie-Roselyne AVA ATANGA";
			$ToName6 = "Junior NDJAYA";
			
			$mail = new PHPMailer();
			iconv_set_encoding("internal_encoding", "ISO-8859-1");
			iconv_set_encoding("output_encoding", "ISO-8859-1");
			//var_dump(iconv_get_encoding('all'));
			$mail->IsSMTP();                 	// send via SMTP
			$mail->Host     = $Host; 
			$mail->SMTPAuth = true;     		// turn on SMTP authentication
			$mail->Username = $Username;  
			$mail->Password = $Password; 
			
			$mail->From     = $From;
			$mail->FromName = $FromName;
			
			$mail->AddAddress($To , $ToName);
			$mail->AddAddress($To1 , $ToName1);
			$mail->AddAddress($To2 , $ToName2);
			$mail->AddAddress($To3 , $ToName3);
			$mail->AddAddress($To4 , $ToName4);
			$mail->AddAddress($To5 , $ToName5);
			$mail->AddAddress($To6 , $ToName6);
			
			$mail->WordWrap = 50;				// set word wrap
			$mail->Priority = 1; 
			$mail->IsHTML(true);  
			if(date('w') == '5')
				$day = "<br />N.B : Les r&eacute;servations se terminent aujourd'hui.<br />";
			else $day = "";
			$mail->Subject  =  '=?UTF-8?B?'.base64_encode("Période de Réservation ouverte!").'?=';
			$mail->Body     =  "Bonjour &agrave; tous, <br />Le COS informe les ayants droits que la p&eacute;riode de r&eacute;servation des cases de la base de loisir est ouverte pour la saison prochaine. <br />Toute personne d&eacute;sireuse de faire une r&eacute;servation est pri&eacute;e de se rendre &agrave; l'adresse suivante: <br /><br /> <a href='http://dladev1/base_loisirs/'>Formulaire de r&eacute;servation</a><br /> <br />
								Pour faire votre r&eacute;servation, vous devrez ouvrir ce lien via votre poste de travail PERENCO.<br />$day<br />
								<br /> <br />Cordialement.<br /><br />
								<i><span style='font-size:14.0pt;font-family:\"Calibri\",\"sans-serif\";color:red'>Les activit&eacute;s du Comit&eacute; des &#338;uvres Sociales sont ouvertes &agrave; tous les salari&eacute;s de Perenco et leurs familles.</span></i>";
		
			if(!$mail->Send())
			{
				$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
			}
			//var_dump($param['err_mess']);
		}
	}
	
	// Cron executé pour avertir les gens avant les 3jrs minimum pour payer
	public function cron_rappel_payement()
	{
		$demandes = $this->demande->recense_demandes_4jrs();
		//var_dump($demandes); 
		if(count($demandes) > 0) {
			$this->load->library ( 'phpmailer' );
			$this->load->library ( 'smtp' );
				
			$Host = "10.52.64.60";						
			$Username = "passontia@cm.perenco.com";						
			$Password = "27fevrier";							
			
			$From = "cm_baseloisirs@cm.perenco.com";
			$FromName = "COS - Base de Loisir";
			
			$mail = new PHPMailer();
			iconv_set_encoding("internal_encoding", "ISO-8859-1");
			iconv_set_encoding("output_encoding", "ISO-8859-1");
			
			$mail->IsSMTP();                 	
			$mail->Host     = $Host; 
			$mail->SMTPAuth = true;     		
			$mail->Username = $Username;  
			$mail->Password = $Password; 
			
			$mail->WordWrap = 50;			
			$mail->Priority = 1; 
			$mail->IsHTML(true);  
			
			foreach($demandes as $d) {
				$u = $this->user->get_infos($d->id_user_staff);
				//var_dump($u); die;
				$To = "passontia@cm.perenco.com";
				$ToName = $u['Last_Name'] . " " . $u['First_Name'];
				$mail->From     = $From;
				$mail->FromName = $FromName;
				
				$mail->AddAddress($To , $ToName);
				
				$mail->Subject  =  '=?UTF-8?B?'.base64_encode("Veuillez confirmer votre réservation!").'?=';
				$mail->Body     =  "Bonjour cher(e) $ToName, <br />
									Confirmez-vous votre réservations ? <br />
									Si oui les frais de réservations ($d->frais Fcfa) sont attendus au bureau 338. 
									
									Vous pouvez encore annuler votre demande maintenant.<br />
									<a href='http://dladev1/base_loisirs/calendar/kase/'>Calendrier Pr&eacute;visionnel des cases</a><br /> <br />
									Pour le consulter, vous devrez ouvrir ce lien via votre poste de travail PERENCO.<br />
									<br /> <br />Cordialement.<br /><br />
									<i><span style='font-size:14.0pt;font-family:\"Calibri\",\"sans-serif\";color:red'>Les activit&eacute;s du Comit&eacute; des &#338;uvres Sociales sont ouvertes &agrave; tous les salari&eacute;s de Perenco et leurs familles.</span></i>";
			
				if(!$mail->Send())
				{
					$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
				}
			}
		}
		
	}
	
	// Cron executé après la période d'admissibilité des demandes pour sortir le programme de la saison prochaine
	public function cron_alerter_calendrier()
	{
		$this->load->library('input');
		
		if(!$this->input->is_cli_request())
		{
			echo "This script can only be accessed via the command line" . PHP_EOL;
			return;
		}
		
		$demandes = $this->demande->recense_demandes_saison_prochaine();
		//echo "<pre>";
		//var_dump($demandes); die;
		foreach($demandes as $d) {
			if(!$this->demande->check_if_periode_occupee($d->date_arrivee, $d->date_depart, $d->id_saison, $d->id_case))
			{
				$this->demande->change_demande_en_reservation($d->id_demandes);
			} 
			else
			{
				$p1 = $this->user->indice_doccupation($this->demande->id_occupant);
				$p2 = $this->user->indice_doccupation($d->id_user_staff);
				if($p1 > $p2)
				{
					$this->demande->change_reservation_en_demande($this->demande->id_occupant);
					$this->demande->change_demande_en_reservation($d->id_demandes);
				}
				
				$this->demande->id_occupant = 0;
			}
		}
		
		if($this->demande->verifier_si_lundi_calendrier())
		{
			$this->load->library ( 'phpmailer' );
			$this->load->library ( 'smtp' );
				
			$Host = "10.52.64.60";						
			$Username = "passontia@cm.perenco.com";						
			$Password = "27fevrier";							
			
			$From = "cm_baseloisirs@cm.perenco.com";
			$FromName = "COS - Base de Loisir";
			
			$To = "passontia@cm.perenco.com";
			$To1 = "ggwanen@cm.perenco.com";
			$To2 = "djongo@cm.perenco.com";
			$To3 = "andjengwes@cm.perenco.com";
			$To4 = "embussiotto@cm.perenco.com";
			$To5 = "mravaatanga@cm.perenco.com";
			$To6 = "jndjaya@cm.perenco.com";
			$ToName = "Patient Assontia";
			$ToName1 = "Gael Gwanen";
			$ToName2 = "Dora Jongo";
			$ToName3 = "Antoine Ndjengwes";
			$ToName4 = "Emmanuel MBUSSI Otto";
			$ToName5 = "Marie-Roselyne AVA ATANGA";
			$ToName6 = "Junior NDJAYA";
			
			$mail = new PHPMailer();
			iconv_set_encoding("internal_encoding", "ISO-8859-1");
			iconv_set_encoding("output_encoding", "ISO-8859-1");
			
			$mail->IsSMTP();                 	
			$mail->Host     = $Host; 
			$mail->SMTPAuth = true;     		
			$mail->Username = $Username;  
			$mail->Password = $Password; 
			
			$mail->From     = $From;
			$mail->FromName = $FromName;
			
			$mail->AddAddress($To , $ToName);
			$mail->AddAddress($To1 , $ToName1);
			$mail->AddAddress($To2 , $ToName2);
			$mail->AddAddress($To3 , $ToName3);
			$mail->AddAddress($To4 , $ToName4);
			$mail->AddAddress($To5 , $ToName5);
			$mail->AddAddress($To6 , $ToName6);
			
			$mail->WordWrap = 50;			
			$mail->Priority = 1; 
			$mail->IsHTML(true);  
			
			$m = date('n') + 1;
				
			$mail->Subject  =  '=?UTF-8?B?'.base64_encode("Calendrier Provisoire d'occupation!").'?=';
			$mail->Body     =  "Bonjour &agrave; tous, <br />Le COS informe les ayants droits que le calendrier de r&eacute;servation des cases de la base de loisir pour la saison prochaine est d&eacute;sormais disponible. <br />Pour le consulter, vous pouvez vous rendre &agrave; l'adresse suivante: <br /><br /> <a href='http://dladev1/base_loisirs/calendar/kase/$m/'>Calendrier Pr&eacute;visionnel des cases</a><br /> <br />
								Vous devrez ouvrir ce lien via votre poste de travail PERENCO.<br />
								<br /> <br />Cordialement.<br /><br />
								<i><span style='font-size:14.0pt;font-family:\"Calibri\",\"sans-serif\";color:red'>Les activit&eacute;s du Comit&eacute; des &#338;uvres Sociales sont ouvertes &agrave; tous les salari&eacute;s de Perenco et leurs familles.</span></i>";
		
			if(!$mail->Send())
			{
				$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
			}
			
		}
	}
	
	public function test()
	{
		//var_dump($this->user->indice_doccupation()); die;
		$this->load->library ( 'phpmailer' );
		$this->load->library ( 'smtp' );
			
		$Host = "10.52.64.60";						// SMTP servers
		$Username = "-adm-delta@cm.perenco.com";						// SMTP password
		$Password = "+perenco2013";							// SMTP username
		
		$From = "carservice_cm@do_not_reply.com";
		$FromName = "CarService PERENCO CAMEROUN";
		
		$To = "passontia@cm.perenco.com";
		$To1 = "ggwanen@cm.perenco.com";
		$ToName = "Patient Assontia";
		$ToName1 = "Gael Gwanen";
		
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		//var_dump(iconv_get_encoding('all'));
		$mail->IsSMTP();                 	// send via SMTP
		$mail->Host     = $Host; 
		$mail->SMTPAuth = true;     		// turn on SMTP authentication
		$mail->Username = $Username;  
		$mail->Password = $Password; 
		
		$mail->From     = $From;
		$mail->FromName = $FromName;
		
		$mail->AddAddress($To , $ToName);
		$mail->AddAddress($To1 , $ToName1);
		
		$mail->WordWrap = 50;				// set word wrap
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		$mail->Subject  =  $Subject;
		$mail->Body     =  $Body;
		var_dump($mail);
		
		var_dump($mail->Send()); die;
		if($mail->Send())
		{
			
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	
	// Cron executé pour sortir le calendrier provisoire de la saison à venir
	public function cron_generer_calendrier_provisoire()
	{
		 

		foreach ( $period as $dt ) 
		  echo $dt->format( "l Y-m-d H:i:s\n" ) . "<br />";
	}
	
	public function annuler_demande()
	{
		return $this->demande->annuler_demande($this->input->post('demande_id'));
	}
	
	public function notif_cancel()
	{
		$this->notify->reservation_annulee($this->session->userdata('id_user_staff'));
	}
	
	public function afficher_demande_attente()
	{
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */