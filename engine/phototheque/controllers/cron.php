<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {

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
		$s = $this->saison->saison_encours();
		$this->session->set_userdata('id_saison', $s['id_saison']);
		$this->load->model('user_model', 'user');
		$this->load->model('notify_model', 'notify');
	}
	
	
	// Cron executé pendant la période d'admissibilité des demandes
	public function cron_alerter_si_demande_possible()
	{
		$this->load->library('input');
		
		// if(!$this->input->is_cli_request())
		// {
			// echo "This script can only be accessed via the command line" . PHP_EOL;
			// return;
		// }
		$this->load->model('saison_model', 'saison');
		if($this->saison->jour_ouverture_saison_prochaine())
		{
			
			$saison = $this->saison->saison_prochaine();
			
			$ayant_droits = $this->user->get_ayant_droits();
			//var_dump($ayant_droits); die;
			
			$this->notify->saison_ouverte($saison, $ayant_droits);
		}
	}
	
	// Cron executé pour avertir les gens avant les 7jrs minimum pour payer
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
	
	
	// Cron pour alerter lorsque les cases sont libres le week end
	public function cases_libres()
	{
		//if(date("w") == 2) { // S'assurer qu'on est un mardi
						
			$cases = $this->demande->check_cases_libres_we();
			
			if(count($cases) == 0) {
				
				exit;
			} else {
				$ayant_droits = $this->user->get_ayant_droits();
				//echo "<pre>"; var_dump($ayant_droits); die;
				$this->notify->alerte_case_libres_we($cases, $ayant_droits);
			}
		//} else {
			return;
		//}
	}
	
	public function alerte_7jrs()
	{
		$pers = $this->user->liste_des_pers_7jrs();
		
		foreach($pers as $a) {
			$this->notify->alerte_7jrs($a);
		}
		
	}
	
	public function alerte_6jrs()
	{
		$pers = $this->user->liste_des_pers_6jrs();
		
		foreach($pers as $a) {
			$this->notify->alerte_6jrs($a);
		}
		
	}
	
	public function alerte_5jrs()
	{
		$pers = $this->user->liste_des_pers_5jrs();
		
		foreach($pers as $a) {
		
			// Mise en attente de la reservation
			$this->demande->passe_en_attente($a['id_demandes']);
			
			// Notifier l'utilisateur
			$this->notify->alerte_5jrs($a);
		}
	}
	
	public function communique()
	{
		$ayant_droits = $this->user->get_ayant_droits();
		$this->notify->communique($ayant_droits);
	}
	
	// Cron executé après la période d'admissibilité des demandes pour sortir le programme de la saison prochaine
	public function test_mail()
	{
	$this->load->library ( 'phpmailer' );
		$this->load->library ( 'smtp' );
			
		$Host = "10.52.64.60";						
		$Username = "passontia@cm.perenco.com";						
		$Password = "26fevrier";							
		
		$From = "cm_baseloisirs@cm.perenco.com";
		$FromName = "Test";
		
		$To = "passontia@cm.perenco.com";
	
		$ToName = "Patient Assontia";
		
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
		
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
			
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("Test!").'?=';
		$mail->Body     =  '
							<table cellspacing="0" cellpadding="0" border="1" style="margin-left:77.75pt;border-collapse:collapse;border:none">
	<tbody>
		<tr style="height:20.9pt">
			<td width="586" style="width:439.4pt;border:solid white 1.0pt; background:#4472C4;padding:0cm 5.4pt 0cm 5.4pt;height:20.9pt" colspan="4">
			<p align="center" style="margin-bottom:0cm;margin-bottom:.0001pt; text-align:center;line-height:normal">
			<b><span style="color: white; font-family: &quot;Comic Sans MS&quot;; font-size: 11pt;">MisterMaint X (version 10.14.Cb)</span></b></p>
			</td>
		</tr>
		<tr>
			<td width="130" style="width:97.15pt;border:solid white 1.0pt;border-top:none; background:#1F3864;padding:0cm 5.4pt 0cm 5.4pt">
			<p style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal"><b>
			<span style="font-family: &quot;Comic Sans MS&quot;; color: white; font-size: 11pt;">FILIALE :</span></b></p>
			</td>
			<td width="163" style="width:122.55pt;border-top:none;border-left:none;border-bottom:solid white 1.0pt;border-right:solid white 1.0pt;background:#8EAADB;padding:0cm 5.4pt 0cm 5.4pt">
			<p style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal"><b>
			<span style="font-family: &quot;Comic Sans MS&quot;; color: white; font-size: 11pt;">Cameroun</span></b></p>
			</td>
			<td width="161" style="width:120.5pt;border-top:none;border-left:none;border-bottom:solid white 1.0pt;border-right:solid white 1.0pt;background:#1F3864;padding:0cm 5.4pt 0cm 5.4pt">
			<p style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal"><b>
			<span style="font-family: &quot;Comic Sans MS&quot;; color: white; font-size: 11pt;">DATE :</span></b></p>
			</td>
			<td width="132" style="width:99.2pt;border-top:none;border-left:none;border-bottom:solid white 1.0pt;border-right:solid white 1.0pt;background:#8EAADB;padding:0cm 5.4pt 0cm 5.4pt">
			<p style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal"><b><span style="font-family:&quot;Comic Sans MS&quot;;color:white">&nbsp;</span></b></p>
			</td>
		</tr>
		<tr>
			<td width="586" style="width:439.4pt;border:solid white 1.0pt;border-top:none;background:#A5A5A5;padding:0cm 5.4pt 0cm 5.4pt" colspan="4">
			<p style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal"><b><span style="color:white">&nbsp;</span></b></p>
			</td>
		</tr>
		<tr>
			<td width="293" style="width:219.7pt;border:solid white 1.0pt;border-top:none;background:#1F3864;padding:0cm 5.4pt 0cm 5.4pt" colspan="2">
			<p align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal"><b><span style="font-family: &quot;Comic Sans MS&quot;; color: white; font-size: 11pt;">NAVIRES</span></b></p>
			</td>
			<td width="161" style="width:120.5pt;border-top:none;border-left:none;border-bottom:solid white 1.0pt;border-right:solid white 1.0pt;background:#1F3864;padding:0cm 5.4pt 0cm 5.4pt">
			<p align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal"><b><span style="font-family: &quot;Comic Sans MS&quot;; color: white; font-size: 11pt;">Fichier Zip</span></b></p>
			</td>
			<td width="132" style="width:99.2pt;border-top:none;border-left:none;border-bottom:solid white 1.0pt;border-right:solid white 1.0pt;background:#1F3864;padding:0cm 5.4pt 0cm 5.4pt">
			<p align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal"><b><span style="font-family: &quot;Comic Sans MS&quot;; color: white; font-size: 11pt;">Dossier</span></b></p>
			</td>
		</tr>
		<tr>
			<td width="293" style="width:219.7pt;border:solid white 1.0pt;border-top:none;background:#4472C4;padding:0cm 5.4pt 0cm 5.4pt" colspan="2">
			<p style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal"><b><span style="color: white; font-family: calibri; font-size: 11pt;">LA LOBE</span></b></p>
			</td>
			<td width="161" style="width:120.5pt;border-top:none;border-left:none;border-bottom:solid white 1.0pt;border-right:solid white 1.0pt;background:#D9E2F3;padding:0cm 5.4pt 0cm 5.4pt">
			<p style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal"><a href="">Lien.zip</a></p>
			</td>
			<td width="132" style="width:99.2pt;border-top:none;border-left:none;border-bottom:solid white 1.0pt;border-right:solid white 1.0pt;background:#D9E2F3;padding:0cm 5.4pt 0cm 5.4pt">
			<p style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal">&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td width="293" style="width:219.7pt;border:solid white 1.0pt;border-top:none;background:#4472C4;padding:0cm 5.4pt 0cm 5.4pt" colspan="2">
			<p style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal"><b><span style="color: white; font-family: calibri; font-size: 11pt;">MASSONGO</span></b></p>
			</td>
			<td width="161" style="width:120.5pt;border-top:none;border-left:none;border-bottom:solid white 1.0pt;border-right:solid white 1.0pt;background:#B4C6E7;padding:0cm 5.4pt 0cm 5.4pt">
			<p style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal">&nbsp;</p>
			</td>
			<td width="132" style="width:99.2pt;border-top:none;border-left:none;border-bottom:solid white 1.0pt;border-right:solid white 1.0pt;background:#B4C6E7;padding:0cm 5.4pt 0cm 5.4pt">
			<p style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:normal">&nbsp;</p>
			</td>
		</tr>
		<tr style="height:28.95pt">
			<td width="586" style="width:439.4pt;border:solid white 1.0pt;border-top:none;background:#A6A6A6;padding:0cm 5.4pt 0cm 5.4pt;height:28.95pt" colspan="4">
			<p align="center" style="font-family: Calibri,sans-serif;font-size: 11pt;margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal"><b><span style="color:#002060">Toutes les bases de donn&eacute;es se trouvent dans ce dossier</span></b></p>
			</td>
		</tr>
	</tbody>
</table>	';
	
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */