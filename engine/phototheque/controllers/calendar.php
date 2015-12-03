<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('demande_model', 'demande');
		$this->load->model('user_model', 'user');
	}
	
	function index()
	{
		// Au cas ou la case serait
		/* $case_id = $this->uri->segment(3, 0);
		
		$data = array(
					 2  => '<span class="debut">Minsilli Kissinger</span>',
					 3  => '<span style="background-color: green; margin-top: 4px; float: right; color: green; padding: 2px 6px; margin-left: -6px; width: 91%;">Minsilli Kissinger</span>',
					 4  => '<span class="fin">Minsilli Kissinger</span>
							<div style="z-index: 90; width: 0px; position: absolute; height: 0px; right: 0px; bottom: 0px; border-width: 10px; border-style: solid; border-color: transparent rgb(47, 75, 127) rgb(47, 75, 127) transparent;" class="bug"></div>',
					// 13 => 'Construction Finished',
					// 26 => 'Kill All Humans!'
				);

		$this->load->library('calendar');

		$vars['calendar'] = $this->calendar->generate('', '', $data);
		$vars['title'] = "Base de Loisirs - Calendrier Pr&eacute;visionnel";
			
		//$this->load->view('templates/header', $vars);
		$this->load->view('saison_en_cours', $vars); */
		if (!$this->session->userdata('id_user_staff')) {
			redirect('/authentication/');
		}
		$today = getdate();
		redirect('calendar/kase/'.$today['mon']);
	}
	
	public function kase()
	{
		// on enregistre l'url
		$this->session->set_userdata('saved_url', current_url());
		
		// Check de la session et redirection si non connecté
		if (!$this->session->userdata('id_user_staff')) {
			redirect('/authentication/');
		}
		//var_dump($this->uri->segment(4)); die;
		$mois = $this->uri->segment(3, '');
		
		if($this->uri->segment(4))
			$case = $this->uri->segment(4);
		else
			$case = $this->input->post('case');
			
		$params = array(
						'month' => $this->uri->segment(3, ''), 
						'case' => $case
						);
		
		
		//var_dump($this->input->post('case'));
		$resas = $this->demande->tableau_resas($params);
		
		if($this->input->post('case'))
			switch($this->input->post('case')) {
				case 'verte' : $vars['case'] = "case verte"; $color = 'vert'; $case = 'verte'; break;
				case 'bleue' : $vars['case'] = "case bleue"; $color = 'bleue'; $case = 'bleue'; break;
				case 'jaune' : $vars['case'] = "case jaune"; $color = 'jaune'; $case = 'jaune'; break;
				case 'grande' : $vars['case'] = "grande case"; $color = 'grande'; $case = 'grande'; break;
				case '' : $vars['case'] = "case verte"; $color = 'vert'; $case = 'grande'; break;
			}
		
		if($this->uri->segment(4))
			switch($this->uri->segment(4)) {
				case 'verte' : $vars['case'] = "case verte"; $color = 'vert'; $case = 'verte'; break;
				case 'bleue' : $vars['case'] = "case bleue"; $color = 'bleue'; $case = 'bleue'; break;
				case 'jaune' : $vars['case'] = "case jaune"; $color = 'jaune'; $case = 'jaune'; break;
				case 'grande' : $vars['case'] = "grande case"; $color = 'grande'; $case = 'grande'; break;
				case '' : $vars['case'] = "case verte"; $color = 'vert'; $case = 'grande'; break;
			}
		
		// if(empty($case)) {
			// $vars['case'] = "case verte";
			// $case = 'verte';
			// $color = 'vert';
		// }
		
		//var_dump($case); die;
		if(!isset($color)) {
			$color = 'vert';
			$case = 'verte';
			$vars['case'] = "case verte";
		}
		// 
		$program = array();
		reset($resas);
		foreach($resas as $d => $n) {
			
			if($n != '' && $d == 1) // Le 1er jour du calendrier
			{
				$program[$d] = '<span class="debut '.$color.'">' . $n . '</span>';
			}
			elseif($n != '' && $d > 1 && isset($resas[$d+1])) // Les jours suivants
			{
				if($resas[$d+1] == '') // Si le jour suivant est vide alors on est en fin de programme
				{
					$program[$d] = '<span class="fin '.$color.'">' . $n . '</span>';
				}
				elseif($resas[$d+1] != '') // sinon le jour suivant n'est pas vide
				{
					if($resas[$d+1] == $n && $resas[$d-1] == '') // si c'est le meme occupant
						$program[$d] = '<span class="debut '.$color.'">' . $n . '</span>';
					if($resas[$d+1] == $n && $resas[$d-1] != '')
						$program[$d] = '<span class="milieu '.$color.'">' . $n . '</span>';
					else // sinon
						$program[$d] = '<span class="debut '.$color.'">' . $n . '</span>';
				}
			}
			elseif($n != '' && $d == 31)
			{
				$program[$d] = '<span class="fin '.$color.'">' . $n . '</span>';
			}
		}
		
		$data = array(
					 2  => '<span class="debut">Minsilli Kissinger</span>',
					 3  => '<span class="milieu">Minsilli Kissinger</span>',
					 4  => '<span class="fin">Minsilli Kissinger</span>
							<div style="z-index: 90; width: 0px; position: absolute; height: 0px; right: 0px; bottom: 0px; border-width: 10px; border-style: solid; border-color: transparent rgb(47, 75, 127) rgb(47, 75, 127) transparent;" class="bug"></div>',
				
				);
		if($params['month'] == '') {
			$vars['mois'] = $this->demande->get_mois_encour();
			$m = date('n');
		} else {
			$vars['mois'] = $this->demande->get_mois_encour($params['month']);
			$m = $params['month'];
		}
		$vars['month'] = $m;
			
		if( $m & 1 ) {
			if( $m == 1 ) {
				$lien_precedent = '';
				$m = $m + 1;
				$lien_suivant = '{heading_next_cell}<th><a target="_self" href="' . base_url("calendar/kase/$m/$case") . '" class="prochain_mois">Mois suivant</a></th>{/heading_next_cell}';
			
			} else {
				$m = $m - 1;
				$lien_precedent = '{heading_previous_cell}<th><a target="_self" href="' . base_url("calendar/kase/$m/$case") . '" class="prochain_mois">Mois precedent</a></th>{/heading_previous_cell}';
				$m = $m + 2;
				$lien_suivant = '{heading_next_cell}<th><a target="_self" href="' . base_url("calendar/kase/$m/$case") . '" class="prochain_mois">Mois suivant</a></th>{/heading_next_cell}';
			}
			
		} else {
			if( $m == 12 ) {
				$m = $m - 1;
				$lien_suivant = '';
				$lien_precedent = '{heading_previous_cell}<th><a target="_self" href="' . base_url("calendar/kase/$m/$case") . '" class="prochain_mois">Mois precedent</a></th>{/heading_previous_cell}';
			} else {
				$m = $m + 1;
				$lien_suivant = '{heading_next_cell}<th><a target="_self" href="' . base_url("calendar/kase/$m/$case") . '" class="prochain_mois">Mois suivant</a></th>{/heading_next_cell}';
				$m = $m - 2;
				$lien_precedent = '{heading_previous_cell}<th><a target="_self" href="' . base_url("calendar/kase/$m/$case") . '" class="prochain_mois">Mois precedent</a></th>{/heading_previous_cell}';
			}
			
		}
		
		// Prise en compte du 1er mois et du dernier
		
		
		//var_dump($m); die;
		////////////////////////////////////////////////

		$prefs['start_day'] = 'monday';
		$prefs['show_next_prev']  = TRUE;
		$prefs['next_prev_url']  = base_url('calendar/kase/');
		
		//////////////// Preference du calendrier$config['day_type'] = 'long';
		$prefs['template'] = '
			{table_open}<table class="calendar">{/table_open}
			{heading_row_start}<tr class="head_row">{/heading_row_start}
			'.$lien_precedent.$lien_suivant.'{week_day_cell}<th class="day_header head_row">{week_day}</th>{/week_day_cell}
			{cal_cell_content}<div style="position: relative; width: 100%; height: 100%;"><span class="day_listing">{day}</span>&nbsp; {content}&nbsp;</div>{/cal_cell_content}
			{cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span> {content}</div>{/cal_cell_content_today}
			{cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
		';
		///////////////////////////////////////
		
		$this->load->library('calendar', $prefs);
		
		if($params['month'] == '') {
			$vars['calendar'] = $this->calendar->generate('', '', $program);
		} else {
			$vars['calendar'] = $this->calendar->generate('', $params['month'], $program);
		}
		
		$vars['title'] = "Base de Loisirs - Calendrier Pr&eacute;visionnel";
		$vars['nom'] = $this->user->get_nom();
		
			
		//$this->load->view('templates/header', $vars);
		$this->load->view('saison_en_cours', $vars);
	}
}

/* End of file calendar.php */
/* Location: ./application/controllers/calendar.php */