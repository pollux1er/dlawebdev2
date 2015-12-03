<?php

class Ajax extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('demande_model', 'demande');
		$this->load->model('user_model', 'user');
		$this->load->helper('date_fr');
		//$this->load->helper('url');
	}
	
	function envoyer_demande()
	{
		
		if($this->input->post('demande_id') != '') {
			if(!$this->demande->periode_occupee($this->input->post())) {
				echo '2';
				$this->demande->modifier_reservation($this->input->post()); 
				return;
			} else { 
				echo '1';
				return;
				//return $this->demande->modifier_reservation($this->input->post(), 1);
			}
		}
		if(!$this->demande->periode_occupee($this->input->post()))
		{	//echo '44';
			$this->demande->enregistrer_reservation($this->input->post());
			echo '0';return;
		}
		else
		{	//echo '43';
			// if($this->demande->enregistrer_reservation($this->input->post()))
			echo '1';return;
		}
		
		if($this->demande->verifier_si_periode_demande())
		{	
			//return $this->demande->enregistrer_demande($this->input->post());
		}
		else
		{
			// $this->load->model('saison_model', 'saison');
			// $s = $this->saison->saison_encours();
			
			// $s2 = (int) $this->demande->get_saison_from_date($this->demande->get_date_format($this->input->post('bl_date_arr'), $this->input->post('bl_heure_arr')));
			// $s3 = (int) $this->demande->get_saison_from_date($this->demande->get_date_format($this->input->post('bl_date_dep'), $this->input->post('bl_heure_dep')));
			
			// $s1 = (int) $s['id_saison'];
			// var_dump($s1);
			// var_dump($s2);
			// var_dump($s3);
			// die;
			// if($s1 == $s2 && $s1 == $s3) {
				// return $this->demande->enregistrer_demande($this->input->post());
			// }
			//else
			//{
			//	echo "rejette";
			//}
		}
	}
	
	public function liste_attente()
	{
		if($this->input->post('demande_id') != '') {
			if(!$this->demande->periode_occupee($this->input->post())) 
				echo '2';
			else {
				echo '4';
				return $this->demande->modifier_reservation($this->input->post(), 1);
			}
		} else {
				echo '4';
				if($this->demande->enregistrer_reservation($this->input->post(), 1) == 'Impossible') {
					echo 'Impossible';
				}
				return;
		}
	}
	
	public function check_case_libre()
	{
		//echo datetime_to_mysql($this->input->post('bl_date_arr'), $this->input->post('bl_heure_arr'));
		$cases = $this->demande->check_case_libre(datetime_to_mysql($this->input->post('bl_date_arr'), $this->input->post('bl_heure_arr')), datetime_to_mysql($this->input->post('bl_date_dep'), $this->input->post('bl_heure_dep')), $this->input->post('id_case'), $this->input->post('id_user_staff'));
		//var_dump($cases);
		if(is_int($cases)) {
			$html = '<div class="broadcast"><strong>Base de loisir info :</strong> La case '.$this->demande->get_couleur($cases).' est libre pour la période ci dessus.</div>';
		} else {
			if(empty($cases))
				$html = "<div class='broadcast'><strong>Base de loisir info : Aucune case n'est libre pour la période sélectionnée</strong>";
			else {
				$html = '<div class="broadcast"><strong>Base de loisir info : ';
				$html .= 'Les suivantes : ';
				foreach($cases as $case)
					$html .= $this->demande->get_couleur($case) . ', ';
				$html .= ' sont libres pour la période ci dessus.</div>';
			}
		}
		
		echo $html;
	}
	
	public function url_get_id_resa()
	{
		echo $this->demande->get_id_demande();
	}
	
	public function confirm_resa()
	{
		$ret = $this->demande->change_reservation_en_demande($this->input->get('id_resa'));
		if($ret == 0)
			echo '0';
		else
			echo $this->input->get('id_resa');
	}
	
	public function cancel_resa()
	{
		$idr = substr($this->input->get('id_resa'), 1, 3);
		//var_dump($idr); die;
		$ret = $this->demande->cancel_demande($idr);
		if($ret == 0)
			echo '0';
		else
			echo $idr;
	}
	
	public function user_cancel_resa()
	{
		$idr = $this->input->post('demande_id');
		
		$ret = $this->demande->annuler_demande($idr);
		if($ret == 0)
			echo '0';
		else
			echo $idr;
	}
	
	public function user_data()
	{
		$search = $this->input->get('user');
		$users = $this->user->get_all_n_ayant_droits($search);
		
		header('Content-Type: text/xml');
		$xml_response = "<?xml version='1.0' encoding='UTF-8' ?>";
		$xml_response .= "<users>";
		foreach($users as $u){
			$xml_response .= '<user value="'.$u->user_id.'">';
			$xml_response .= '<name><![CDATA['.$u->nom.']]></name>';
			$xml_response .= '<email><![CDATA['.$u->email.']]></email>';
			$xml_response .= '</user>';
		}
		$xml_response .= '</users>';
		echo $xml_response;
		//return;
	}
	
	public function user_remove_from_executive()
	{
		$id = $this->input->get('user');
		$this->user->remove_from_executive($id);
		echo $id;
		//return;
	}
	
	public function receipt_resa()
	{
		 
		//$this->load->library('cezpdf');
		//$this->load->library('CezTableImage');
		
		//$data['users'] = $this->user->get_all_ayant_droits();
		
		// foreach($data['users'] as $user) {
			// $db_data[] = array('name' => $user->nom, 'department' => $user->Department, 'status' => $user->Status, 'test' => 'test');
		// }
		
		// $db_data[] = array('name' => 'tutu', 'department' => 'Management subsidiaries', 'status' => 'National', 'age' => '29');
		// $db_data[] = array('name' => 'ABDOULAYE Wadjiri', 'department' => 'Management subsidiaries', 'status' => 'National', 'age' => '29');
		// $db_data[] = array('name' => 'ABDOULAYE Wadjiri', 'department' => 'Management subsidiaries', 'status' => 'National', 'age' => '29');
		// $db_data[] = array('name' => 'ABDOULAYE Wadjiri', 'department' => 'Management subsidiaries', 'status' => 'National', 'age' => '29');
		
		// $col_names = array(
			// 'name' => 'Noms et Prenoms',
			// 'department' => 'Département',
			// 'status' => 'Status',
			// 'age' => 'Age'
		// );
		// $this->cezpdf->ezImage('http://dlawebqal2.cm.perenco.co/asstes/base_loisirs/images/LOGO-PERENCO_dark_grey.png',0,0,'none','right');
		// $this->cezpdf->ezTable($db_data, $col_names, 'Ayant droit Base Loisirs de Kribi', array('width'=>570, 'showLines'=>3));
		
		// $this->cezpdf->ezStream(array('download'=>1, 'compress'=>0));		
		
		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$filename = 'test';
		$pdfFilePath = FCPATH."downloads/reports/$filename.pdf";
		//$data['page_title'] = 'rtyry'; // pass data to the view
		
		$data['demande'] = $this->demande->afficher(substr($this->input->get('id_resa'), 1, 3));
		 
		 
		if (file_exists($pdfFilePath) == FALSE)
		{
			//ini_set('memory_limit','8M'); // boost the memory limit if it's low <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			$html = $this->load->view('pdf_report', $data, true); // render the view into HTML
			 
			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'D'); // save to file because we can
		}
		 
		//redirect("downloads/reports/$filename.pdf");
	}
}
