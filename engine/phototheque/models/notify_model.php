<?php

class Notify_model extends CI_Model {
	
	private $username;
	private $password;
	private $host;
	private $from;
	private $from_name;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('user_model', 'user');
		$this->load->model('log_model', 'log');
		$this->load->model('saison_model', 'saison');
		$this->username = "-adm-delta@cm.perenco.com";
		$this->password = "+perenco2013";
		$this->host = "10.52.64.60";
		$this->from = "cm_baseloisirs@cm.perenco.com";
		$this->from_name = "CAMEROON-COMMUNICATION";
		$this->load->library ( 'phpmailer' );
		$this->load->library ( 'smtp' );
	}
	
	public function reservation_effectuee($id_resa)
	{
		// On selectionne la derniere reservation effectuée par l'utilisateur
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query(" SELECT u.First_Name, u.`Professional E-mail`, frais, DATE_FORMAT(`date_arrivee`, '%W %d %M %Y') as date_arr, statut, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arr, DATE_FORMAT(`date_depart`, '%W %d %M %Y') as date_dep, DATE_FORMAT(`date_depart`, '%H:%i') as heure_dep, datediff(DATE_FORMAT(`date_arrivee`, '%Y-%m-%d'), now()) as days, c.nom as nomcase FROM bl_demandes AS rv 
									LEFT JOIN userscm AS u ON u.user_id = rv.id_user_staff 
									LEFT JOIN bl_case AS c ON c.id_case = rv.id_case 
									WHERE id_user_staff = '".$this->session->userdata('iduser')."' ORDER BY id_demandes DESC LIMIT 1;");
		$row = $query->row_array();
		$trans = get_html_translation_table(HTML_ENTITIES);
		$message = "<p><strong>Votre r&eacute;servation est pour le planning suivant :</strong></p>";
		$message .= "<ul>";
		$message .= "<li><strong>".strtr(ucwords($row['date_arr']), $trans). " &agrave " . $row['heure_arr'] ."</strong> (Date et heure d'arriv&eacute;e &agrave; la base de Kribi)</li>";
		$message .= "<li><strong>".strtr(ucwords($row['date_dep']), $trans). " &agrave " . $row['heure_dep'] ."</strong> (Date et heure de d&eacute;part de la base de Kribi)</li>";
		$message .= "</ul>";
		
		//$delais = '';
		if($row['days'] > 6) {
			//$delais = "<br />Vous avez " . ($row['days'] - 5) . " jours pour confirmer votre r&eacute;servation!<br />";
			$d = "Vous avez " . ($row['days'] - 5) . " jours pour confirmer votre r&eacute;servation en r&eacute;glant vos frais (".$row['frais']." Fcfa) aupr&egrave;s de Marie AVA ATANGA (porte 338).<br /> Apr&egrave;s ce d&eacute;lai, votre r&eacute;servation sera automatiquement annul&eacute;e.";
		}
		else {
			//$delais = "<br /><span style='color:red:'>Vous avez cette journ&eacute;e pour confirmer votre r&eacute;servation!</span><br />";
			$d = "Vous avez cette journ&eacute;e pour confirmer votre r&eacute;servation en r&eacute;glant vos frais (".$row['frais']." Fcfa) aupr&egrave;s de Marie AVA ATANGA (porte 338).<br /> Apr&egrave;s ce d&eacute;lai, votre r&eacute;servation sera automatiquement annul&eacute;e.";
		}
				
		$Titre = "[Base Loisirs] Réservation effectuée";
		
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->Host     = $this->host; 
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->IsSMTP();                 	
		$mail->SMTPAuth = true;     		
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		
		$To = $row['Professional E-mail'];
		$ToName = strtr($row['First_Name'], $trans);
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		$mail->AddAddress($To , $ToName);
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');	
		$mail->AddBCC('ggwanen@cm.perenco.com', 'Gwanen Gael');
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';/*
		$mail->Body     =  "Bonjour $ToName, <br />
							Votre r&eacute;servation pour la ".$row['nomcase']." a &eacute;t&eacute; effectu&eacute;e. <br /> 
							$message <br />
							Si oui, les frais de r&eacute;servation (".$row['frais']." Fcfa) sont attendus au bureau 338. <br />
							$delais							
							<br />
							Vous pouvez encore <a href='".base_url()."base_loisirs.php/demande/'>annuler ou modifier votre r&eacute;servation</a> maintenant.<br />
							Pour consulter le <a href='".base_url()."base_loisirs.php/attendance/'>Planning des cases</a>, 
							vous devrez ouvrir le lien via votre poste de travail PERENCO CAMEROON.
							<br /><br />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";*/
		
		$mail->Body     =  "
							<style type='text/css'>
							*
							{
								font-family: Tahoma, Arial, Helvetica, sans-serif;
								font-size: 12px;
							}
							div.red, div.orange, div.green, div.blue
							{
								font-weight: bold;
							}
							div.red
							{
								color: #cc0000;
							}
							.bleu
							{
								color: #3A5795;
							}
							div.orange
							{
								color: #dd4411;
							}
							div.green
							{
								color: #006600;
							}
							div.blue
							{
								color: #003399;
							}
							table.project_info
							{
								width: 90%;
								border: 0;
								margin: auto;
								border-top: 1px solid #bbbbbb !important;
								border-bottom: 1px solid #bbbbbb !important;
								border-collapse: collapse;
							}
							table.project_info th
							{
								width: 220px;
								background-color: #e9eeee;
								color: #666;
								text-align: right;
								font-weight: bold;
								padding: 5px;
								vertical-align: top;
							}
							table.project_info td
							{
								text-align: left;
								background-color: #fcffff;
								font-weight: normal;
								padding: 5px;
								vertical-align: top;
							}
							</style>
							Bonjour $ToName, <br />
							<div class='blue'>Vous avez fait la r&eacute;servation suivante : </div> 
							<br />
							<table class='project_info'>
								<tr>
									<th>Case</th>
									<td><strong>".$row['nomcase']."</strong></td>
								</tr>
								<tr>
									<th>Arriv&eacute;e</th>
									<td><strong>".strtr(ucwords($row['date_arr']), $trans). " &agrave " . $row['heure_arr'] ."</strong></td>
								</tr>
								<tr>
									<th>D&eacute;part</th>
									<td><strong>".strtr(ucwords($row['date_dep']), $trans). " &agrave " . $row['heure_dep'] ."</strong></td>
								</tr>
							</table><br />
							$d							
							<br />
							Cliquez sur les liens suivants pour <a href='".base_url()."base_loisirs.php/demande/'>annuler ou modifier votre r&eacute;servation</a> ou consulter <a href='".base_url()."base_loisirs.php/attendance/'>le Planning des cases</a>.<br /><br />
							<strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail.<br /><br />
							<hr size=100% class='bleu' />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";/**/
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
		
	}
	
	public function reservation_confirmee($id_resa)
	{
		// On selectionne la derniere reservation effectuée par l'utilisateur
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query(" SELECT u.First_Name, u.`Professional E-mail`, frais, details, DATE_FORMAT(`date_arrivee`, '%W %d %M %Y') as date_arr, statut, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arr, DATE_FORMAT(`date_depart`, '%W %d %M %Y') as date_dep, DATE_FORMAT(`date_depart`, '%H:%i') as heure_dep, datediff(DATE_FORMAT(`date_arrivee`, '%Y-%m-%d'), now()) as days, c.nom as nomcase FROM bl_demandes AS rv 
									LEFT JOIN userscm AS u ON u.user_id = rv.id_user_staff 
									LEFT JOIN bl_case AS c ON c.id_case = rv.id_case 
									WHERE id_demandes = '".$id_resa."' LIMIT 1;");
		$row = $query->row_array();
		$trans = get_html_translation_table(HTML_ENTITIES);
		$message = "<p><strong>Le planning d'occupation est le suivant :</strong></p>";
		$message .= "<ul>";
		$message .= "<li><strong>".strtr(ucwords($row['date_arr']), $trans). " &agrave " . $row['heure_arr'] ."</strong> (Date et heure d'arriv&eacute;e &agrave; la base de Kribi)</li>";
		$message .= "<li><strong>".strtr(ucwords($row['date_dep']), $trans). " &agrave " . $row['heure_dep'] ."</strong> (Date et heure de d&eacute;part de la base de Kribi)</li>";
		$message .= "</ul>";
		if($row['details'] != "") 
			$message .= "<strong>Details</strong> : " . strtr(ucwords($row['details']), $trans);
		
		$delais = '';
		if($row['days'] > 6) {
			$delais = "Vous avez encore " . ($row['days']) . " jours avant votre arriv&eacute;e &agrave; la base loisirs!<br />";
			$delais .= "A moins de 5 jours, votre r&eacute;servation ne sera plus modifiable, vous pourrez juste l'annuler.<br />"; }
		elseif($row['days'] < 5)
			$delais = "<span style='color:red:'>Votre r&eacute;servation n'est plus modifiable!</span><br />";
				
		$Titre = "[Base Loisirs] Réservation confirmée";
		
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->Host     = $this->host; 
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->IsSMTP();                 	
		$mail->SMTPAuth = true;     		
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		
		$To = $row['Professional E-mail'];
		$ToName = $ToName = strtr($row['First_Name'], $trans);
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		$mail->AddAddress($To , $ToName);
		$mail->AddCC('mravaatanga@cm.perenco.com', 'Marie-Roselyne AVA ATANGA');	
		//$mail->AddCC('thamadou@cm.perenco.com', 'Tarfa HAMADOU');	
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		$mail->Body     =  "Cher(e) $ToName, <br />
							Votre r&eacute;servation pour la ".$row['nomcase']." a &eacute;t&eacute; confirm&eacute;e. <br /> 
							$message <br />
							$delais							
							<br />
							Pour consulter le <a href='".base_url()."base_loisirs.php/attendance/'>Planning des cases</a>, 
							vous devrez ouvrir le lien via votre poste de travail PERENCO CAMEROON.
							<br /><br />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.
							";
	
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
		
	}
	
	public function modification_effectuee($id_resa)
	{
		// On selectionne la derniere reservation effectuée par l'utilisateur
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query(" SELECT u.First_Name, u.`Professional E-mail`, frais, DATE_FORMAT(`date_arrivee`, '%W %d %M %Y') as date_arr, statut, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arr, DATE_FORMAT(`date_depart`, '%W %d %M %Y') as date_dep, DATE_FORMAT(`date_depart`, '%H:%i') as heure_dep, datediff(DATE_FORMAT(`date_arrivee`, '%Y-%m-%d'), now()) as days, c.nom as nomcase FROM bl_demandes AS rv 
									LEFT JOIN userscm AS u ON u.user_id = rv.id_user_staff 
									LEFT JOIN bl_case AS c ON c.id_case = rv.id_case 
									WHERE id_user_staff = '".$this->session->userdata('iduser')."' ORDER BY id_demandes DESC LIMIT 1;");
		$row = $query->row_array();
		$trans = get_html_translation_table(HTML_ENTITIES);
		$message = "<p><strong>Votre r&eacute;servation est maintenant pour le planning suivant :</strong></p>";
		$message .= "<ul>";
		$message .= "<li><strong>".strtr(ucwords($row['date_arr']), $trans). " &agrave " . $row['heure_arr'] ."</strong> (Date et heure d'arriv&eacute;e &agrave; la base de Kribi)</li>";
		$message .= "<li><strong>".strtr(ucwords($row['date_dep']), $trans). " &agrave " . $row['heure_dep'] ."</strong> (Date et heure de d&eacute;part de la base de Kribi)</li>";
		$message .= "</ul>";
		
		$delais = "Si oui, les frais de r&eacute;servation (".$row['frais']." Fcfa) sont attendus au bureau 338. <br />";
		
		if($row['days'] > 6) {
			//$delais = "<br />Vous avez " . ($row['days'] - 5) . " jours pour confirmer votre r&eacute;servation!<br />";
			$d = "Vous avez " . ($row['days'] - 5) . " jours pour confirmer votre r&eacute;servation en r&eacute;glant vos frais (".$row['frais']." Fcfa) aupr&egrave;s de Marie AVA ATANGA (porte 338).<br /> Apr&egrave;s ce d&eacute;lai, votre r&eacute;servation sera automatiquement annul&eacute;e.";
		}
		else {
			//$delais = "<br /><span style='color:red:'>Vous avez cette journ&eacute;e pour confirmer votre r&eacute;servation!</span><br />";
			$d = "Vous avez cette journ&eacute;e pour confirmer votre r&eacute;servation en r&eacute;glant vos frais (".$row['frais']." Fcfa) aupr&egrave;s de Marie AVA ATANGA (porte 338).<br /> Apr&egrave;s ce d&eacute;lai, votre r&eacute;servation sera automatiquement annul&eacute;e.";
		}
			
		$Titre = "[Base Loisirs] Réservation modifiée";
		
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->Host     = $this->host; 
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->IsSMTP();                 	
		$mail->SMTPAuth = true;     		
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true); 						
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		$To = $row['Professional E-mail'];
		//$To = 'passontia@cm.perenco.com';
		$ToName = $ToName = strtr($row['First_Name'], $trans);
		
		$mail->AddAddress($To , $ToName);
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';		
		$mail->Body     =  "
							<style type='text/css'>
							*
							{
								font-family: Tahoma, Arial, Helvetica, sans-serif;
								font-size: 12px;
							}
							div.red, div.orange, div.green, div.blue
							{
								font-weight: bold;
							}
							div.red
							{
								color: #cc0000;
							}
							.bleu
							{
								color: #3A5795;
							}
							div.orange
							{
								color: #dd4411;
							}
							div.green
							{
								color: #006600;
							}
							div.blue
							{
								color: #003399;
							}
							table.project_info
							{
								width: 90%;
								border: 0;
								margin: auto;
								border-top: 1px solid #bbbbbb !important;
								border-bottom: 1px solid #bbbbbb !important;
								border-collapse: collapse;
							}
							table.project_info th
							{
								width: 220px;
								background-color: #e9eeee;
								color: #666;
								text-align: right;
								font-weight: bold;
								padding: 5px;
								vertical-align: top;
							}
							table.project_info td
							{
								text-align: left;
								background-color: #fcffff;
								font-weight: normal;
								padding: 5px;
								vertical-align: top;
							}
							</style>
							Bonjour $ToName, <br />
							<div class='blue'>Vous avez modifi&eacute; votre r&eacute;servation et &ecirc;tes programm&eacute; pour le planning suivant : </div> 
							<br />
							<table class='project_info'>
								<tr>
									<th>Case</th>
									<td><strong>".$row['nomcase']."</strong></td>
								</tr>
								<tr>
									<th>Arriv&eacute;e</th>
									<td><strong>".strtr(ucwords($row['date_arr']), $trans). " &agrave " . $row['heure_arr'] ."</strong></td>
								</tr>
								<tr>
									<th>D&eacute;part</th>
									<td><strong>".strtr(ucwords($row['date_dep']), $trans). " &agrave " . $row['heure_dep'] ."</strong></td>
								</tr>
							</table><br />
							$d							
							<br />
							Cliquez sur les liens suivants pour <a href='".base_url()."base_loisirs.php/demande/'>annuler ou modifier votre r&eacute;servation</a> ou consulter <a href='".base_url()."base_loisirs.php/attendance/'>le Planning des cases</a>.<br /><br />
							<strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail.<br /><br />
							<hr size=100% class='bleu' />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
	
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
		
	}
	
	public function mise_en_attente($id_resa)
	{
		
		// On selectionne la derniere reservation effectuée par l'utilisateur
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query(" SELECT u.First_Name, u.`Professional E-mail`, frais, DATE_FORMAT(`date_arrivee`, '%W %d %M %Y') as date_arr, statut, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arr, DATE_FORMAT(`date_depart`, '%W %d %M %Y') as date_dep, DATE_FORMAT(`date_depart`, '%H:%i') as heure_dep, datediff(DATE_FORMAT(`date_arrivee`, '%Y-%m-%d'), now()) as days, c.nom as nomcase FROM bl_demandes AS rv 
									LEFT JOIN userscm AS u ON u.user_id = rv.id_user_staff 
									LEFT JOIN bl_case AS c ON c.id_case = rv.id_case 
									WHERE id_user_staff = '".$this->session->userdata('iduser')."' ORDER BY id_demandes DESC LIMIT 1;");
		$row = $query->row_array();
		$trans = get_html_translation_table(HTML_ENTITIES);
		$message = "<p><strong>Votre r&eacute;servation est pour le planning suivant :</strong></p>";
		$message .= "<ul>";
		$message .= "<li><strong>".strtr(ucwords($row['date_arr']), $trans). " &agrave " . $row['heure_arr'] ."</strong> (Date et heure d'arriv&eacute;e &agrave; la base de Kribi)</li>";
		$message .= "<li><strong>".strtr(ucwords($row['date_dep']), $trans). " &agrave " . $row['heure_dep'] ."</strong> (Date et heure de d&eacute;part de la base de Kribi)</li>";
		$message .= "</ul>";
		
		$delais = '';
		
		// if($row['days'] > 5)
			// $delais = "<br />Vous avez " . ($row['days'] - 5) . " jours pour confirmer votre r&eacute;servation!<br />";
		// else
			// $delais = "<br /><span style='color:red:'>Vous avez cette journ&eacute;e pour confirmer votre r&eacute;servation!</span><br />";
				
		$Titre = "[Base Loisirs] Réservation mise en attente";
		
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "UTF-8");
		
		$mail->Host     = $this->host; 
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->IsSMTP();                 	
		$mail->SMTPAuth = true;     		
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		
		
		$To = $row['Professional E-mail'];
		$ToName = strtr($row['First_Name'], $trans);
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		$mail->AddAddress($To , $ToName);
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		$mail->Body     =  "Cher(e) $ToName, <br /><br />
							Votre r&eacute;servation pour la ".$row['nomcase']." a &eacute;t&eacute;  mise en attente. <br /> 
							$message							
							<br />
							Vous pouvez encore <a href='".base_url()."base_loisirs.php/attendance/'>annuler ou modifier votre r&eacute;servation</a> maintenant.<br /><br />
							Pour consulter le <a href='".base_url()."base_loisirs.php/attendance/'>Planning des cases</a>, 
							vous devrez ouvrir le lien via votre poste de travail PERENCO CAMEROON.<br /><br />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
	
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
		
	}
	
	public function reservation_annulee($id_user = null)
	{
		$trans = get_html_translation_table(HTML_ENTITIES);
		if(is_null($id_user))
			$user = $this->user->get_infos();
		else	
			$user = $this->user->get_infos($id_user);
			
		$Titre = "[Base Loisirs] Réservation annulée";
		
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		
		$mail->Host     = $this->host; 
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->IsSMTP();                 	
		$mail->SMTPAuth = true;     		
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true); 
		
		
		//$To = "passontia@cm.perenco.com";
		$To = $user['Professional E-mail'];
		$ToName = strtr($user['First_Name'], $trans);
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		$mail->AddAddress($To , $ToName);
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');
		$mail->AddBCC('ggwanen@cm.perenco.com', 'Gwanen Gael');
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		$mail->Body     =  "
							<style type='text/css'>
							*
							{
								font-family: Tahoma, Arial, Helvetica, sans-serif;
								font-size: 12px;
							}
							.bleu
							{
								color: #3A5795;
							}
							</style>
							Bonjour $ToName, <br /><br />
							Vous avez annul&eacute; votre r&eacute;servation.<br />
							<br />
							Vous pouvez encore faire une r&eacute;servation maintenant.<br /><br />
							Pour acc&eacute;der au <a href='".base_url()."base_loisirs.php/demande/'>Formulaire de r&eacute;servation</a>.<br /> 
							<strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail.<br /><br />
							<hr size=100% class='bleu' />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
	
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	
	public function reservation_annulee_admin($idd, $qui = null)
	{
		$trans = get_html_translation_table(HTML_ENTITIES);
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query(" SELECT u.First_Name, u.`Professional E-mail`,  DATE_FORMAT(`date_arrivee`, '%W %d %M %Y') as date_arr, statut, DATE_FORMAT(`date_arrivee`, '%H:%i') as heure_arr, DATE_FORMAT(`date_depart`, '%W %d %M %Y') as date_dep, DATE_FORMAT(`date_depart`, '%H:%i') as heure_dep, datediff(DATE_FORMAT(`date_arrivee`, '%Y-%m-%d'), now()) as days FROM bl_demandes AS rv 
									LEFT JOIN userscm AS u ON u.user_id = rv.id_user_staff 
									WHERE id_demandes = '".$idd."' LIMIT 1;");
		$row = $query->row_array();
		
		if(is_null($qui))
			$qui = 'le Gestionnaire de la base vie';
		else	
			$qui = 'le Syst&egrave;me';
			
		$Titre = "[Base Loisirs] Réservation annulée";
		
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		
		$mail->Host     = $this->host; 
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->IsSMTP();                 	
		$mail->SMTPAuth = true;     		
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true); 
		
		//$To = "passontia@cm.perenco.com";
		$To = $row['Professional E-mail'];
		$ToName = strtr($row['First_Name'], $trans);
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		$mail->AddAddress($To , $ToName);
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		$mail->Body     =  "<style type='text/css'>
							*
							{
								font-family: Tahoma, Arial, Helvetica, sans-serif;
								font-size: 12px;
							}
							.bleu
							{
								color: #3A5795;
							}
							</style>	
							Cher(e) $ToName, <br /><br />
							Votre r&eacute;servation a &eacute;t&eacute; annul&eacute;e par $qui.<br />
							<br />
							Pour acc&eacute;der au <a href='".base_url()."base_loisirs.php/demande/'>Planning des r&eacute;servations</a>.<br />
							<br /><strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail.<br /><br />
							<hr size=100% class='bleu' />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
	
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
		if($this->session->userdata('iduser'))
			$id_user = $this->session->userdata('iduser');
		else
			$id_user = 0;
		//$this->log->log(array('id_user' => $id_user, 'id_reservation' => $idd, 'actions' => 'cancel', 'description' => 'Annulation de la réservation par le gestionnaire'));
		
	}
	
	public function alerte_7jrs($donnees_pers)
	{
		$Titre = "[Base Loisirs] Confirmez-vous votre réservation ?";
		$trans = get_html_translation_table(HTML_ENTITIES);
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->IsSMTP();                 	
		$mail->Host     = $this->host; 
		$mail->SMTPAuth = true;     		
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		
		//$To = "passontia@cm.perenco.com";
		$To = $donnees_pers['Professional E-mail'];
		$ToName = strtr($donnees_pers['First_Name'], $trans);
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		$mail->AddAddress($To , $ToName);
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');
		$mail->AddBCC('ggwanen@cm.perenco.com', 'Gwanen Gael');
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		 
		$mail->Body     =  "Bonjour $ToName, <br /><br />
							Il vous reste 2 jours pour confirmer votre r&eacute;servation.<br />
							<br />
							Vous devez confirmer votre r&eacute;sservation en r&eacute;glant vos frais aupr&egrave;s du gestionnaire de la base de Kribi (Porte 338). <br />
							Apr&egrave;s ce d&eacute;lai, votre r&eacute;servation sera automatiquement mise en attente et la case remise &agrave; disposition.<br />
							Cliquez sur les liens suivants pour <a href='".base_url()."base_loisirs.php/demande/'>annuler ou modifier votre r&eacute;servation</a> ou consulter <a href='".base_url()."base_loisirs.php/attendance/'>le Planning des cases</a>.<br /><br />
							<strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail.<br /><br />
							<hr size=100% />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
	
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	
	public function alerte_6jrs($donnees_pers)
	{
		$Titre = "[Base Loisirs] Confirmez-vous votre réservation ?";
		$trans = get_html_translation_table(HTML_ENTITIES);
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->IsSMTP();                 	
		$mail->Host     = $this->host; 
		$mail->SMTPAuth = true;     		
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		
		//$To = "passontia@cm.perenco.com";
		$To = $donnees_pers['Professional E-mail'];
		$ToName = strtr($donnees_pers['First_Name'], $trans);
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		$mail->AddAddress($To , $ToName);
		//$mail->AddAddress('passontia@cm.perenco.com' , 'Patient Assontia');
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');
		$mail->AddBCC('ggwanen@cm.perenco.com', 'Gwanen Gael');
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		$mail->Body     =  "
							<style type='text/css'>
							*
							{
								font-family: Tahoma, Arial, Helvetica, sans-serif;
								font-size: 12px;
							}
							.bleu
							{
								color: #3A5795;
							}
							</style>	
							Bonjour $ToName, <br /><br />
							Le d&eacute;lai pour confirmer votre r&eacute;servation expire dans 24h;<br />
							Vous devez confirmer votre r&eacute;servation en r&eacute;glant vos frais aupr&egrave;s du gestionnaire de la base de Kribi (Porte 338). <br />
							Apr&egrave;s ce d&eacute;lai, votre r&eacute;servation sera automatiquement mise en attente et la case remise &agrave; disposition.<br />
							Cliquez sur les liens suivants pour <a href='".base_url()."base_loisirs.php/demande/'>annuler ou modifier votre r&eacute;servation</a> ou consulter <a href='".base_url()."base_loisirs.php/attendance/'>le Planning des cases</a>.<br /><br />
							<strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail.<br /><br />
							<hr size=100% class='bleu' />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
	
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	
	public function alerte_5jrs($donnees_pers)
	{
		$Titre = "[Base Loisirs] Réservation mise en attente!";
		$trans = get_html_translation_table(HTML_ENTITIES);
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->IsSMTP();                 	
		$mail->Host     = $this->host; 
		$mail->SMTPAuth = true;     		
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		
		//$To = "passontia@cm.perenco.com";
		$To = $donnees_pers['Professional E-mail'];
		$ToName = strtr($donnees_pers['First_Name'], $trans);
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		$mail->AddAddress($To , $ToName);
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		$mail->Body     =  "
							<style type='text/css'>
							*
							{
								font-family: Tahoma, Arial, Helvetica, sans-serif;
								font-size: 12px;
							}
							.bleu
							{
								color: #3A5795;
							}
							</style>	
							Bonjour $ToName, <br /><br />
							Votre r&eacute;servation a &eacute;t&eacute; mise en attente par le Syst&egrave;me, <br />
							Vous pouvez encore confirmer ou annuler votre r&eacute;servation (Porte 338) ou consulter le planning en cliquant sur le lien suivant : <a href='".base_url()."base_loisirs.php/attendance/'>Planning des cases</a>.<br /><br />
							<strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail.<br /><br />
							<hr size=100% class='bleu' />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
	
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	
	public function alerte_3jrs($donnees_pers)
	{
		$Titre = "COS - Base Loisir Kribi - Votre réservation expire dans 24h!";
		$trans = get_html_translation_table(HTML_ENTITIES);
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->IsSMTP();                 	
		$mail->Host     = $this->host; 
		$mail->SMTPAuth = true;     		
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		
		//$To = "passontia@cm.perenco.com";
		$To = $donnees_pers['Professional E-mail'];
		$ToName = strtr($donnees_pers['First_Name'], $trans);
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		$mail->AddAddress($To , $ToName);
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		$mail->Body     =  "Bonjour $ToName, <br /><br />
							Le d&eacute;lai pour confirmer votre r&eacute;servation expire dans 24h; <br />
							Vous devez confirmer votre r&eacute;sservation en r&eacute;sglant vos frais aupr&egrave;s du gestionnaire de la base de Kribi (porte 338). <br />
							Apr&egrave;s ce d&eacute;lai, votre r&eacute;servation sera automatiquement mise en attente et la case remise &agrave; disposition.<br />
							Cliquez sur les liens suivants pour annuler ou modifier votre réservation ou consulter le Planning des cases.<br /><br />
							<hr size=100% />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
	
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
	}
		
	public function alerte_case_libres_we($cases, $ayants_droits)
	{
		$datelibre = '';
		
		if(count($cases) == 1) {
			$text_case = "La ".$cases[0]." est libre ce week-end.";
		} else {
			$text_case = "Les cases suivantes sont libres ce week-end :";
			$text_case .= '<ul>';
			foreach($cases as $c)
				$text_case .= "<li>$c</li>";
			$text_case .= "</ul>";
		}
		
		$Titre = "[Base Loisirs] Etes-vous libre ce week end ?";
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->IsSMTP();                 	
		$mail->Host     = $this->host; 
		$mail->SMTPAuth = true;     		
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		//var_dump($text_case); die;
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		//var_dump($ayants_droits); die;
		foreach($ayants_droits as $ad) {
			$mail->AddAddress($ad->email , $ad->nom);
		}
		//$mail->AddAddress('passontia@cm.perenco.com', 'Patient Assontia');
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		 
		$mail->Body     =  "
							<style type='text/css'>
							*
							{
								font-family: Tahoma, Arial, Helvetica, sans-serif;
								font-size: 12px;
							}
							.bleu
							{
								color: #3A5795;
							}
							</style>	
							Bonjour ayant-droits, <br />
							$text_case <br />
							Vous pouvez faire une nouvelle r&eacute;servation ou consulter le planning en cliquant sur les liens suivants : <br /><a href='".base_url()."base_loisirs.php/demande/'>Formulaire de r&eacute;servation</a> ou <a href='".base_url()."base_loisirs.php/attendance/'>Planning des cases</a>.<br />
							<br /><strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail.<br /><br />
							<hr size=100% class='bleu' />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
	
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
		
	}
	
	public function saison_ouverte($saison, $ayants_droits)
	{
		$Titre = "[Base Loisirs] Ouverture saison ".$saison['mois1']."/".$saison['mois2']." ".$saison['annee'];
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->IsSMTP();                 	
		$mail->Host     = $this->host; 
		$mail->SMTPAuth = true;     		
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		
		//$To = $donnees_pers['Professional E-mail'];
		//$ToName = 'Assontia';
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		// echo "<pre>";
		// var_dump($ayants_droits);
		// die;
		foreach($ayants_droits as $ad) {
			$mail->AddAddress($ad->email , $ad->nom);
			//$mail->AddAddress('passontia@cm.perenco.com', 'Patient Assontia');
		}
		
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');
		//$mail->AddBCC('ggwanen@cm.perenco.com', 'Gael Gwanen');
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		 
		$mail->Body     =  "
							<style type='text/css'>
							*
							{
								font-family: Tahoma, Arial, Helvetica, sans-serif;
								font-size: 12px;
							}
							.bleu
							{
								color: #3A5795;
							}
							</style>	
							Bonjour ayant-droits, <br />
							Les r&eacute;servations pour le compte de la saison ".utf8_decode($saison['mois1'])."/".utf8_decode($saison['mois2'])." ".$saison['annee']." sont ouvertes.<br />
							Faire votre r&eacute;servation ou consulter le planning en cliquant sur les liens suivants : <br /><a href='".base_url()."base_loisirs.php/demande/'>Formulaire de r&eacute;servation</a> ou <a href='".base_url()."base_loisirs.php/attendance/'>Planning des cases</a>.<br /><br />
							<strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail dans le r&eacute;seau de l'entreprise.<br /><br />
							<hr size=100% class='bleu' />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
		
	}
	
	public function communique($ayants_droits)
	{
		$Titre = "COS - Section Kribi";
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->IsSMTP();                 	
		$mail->Host     = $this->host; 
		$mail->SMTPAuth = true;     		
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		
		$mail->From     = 'djongo@cm.perenco.com';
		$mail->FromName = 'Dora JONGO';
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		
		foreach($ayants_droits as $ad) {
			$mail->AddAddress($ad->email , $ad->nom);
		}
		
		$mail->AddCC('cm.it.development@cm.perenco.com', 'Cameroon IT Development');
		
		$mail->Body     =  $this->load->view('communique', '' , TRUE); 
		
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	
}
?>