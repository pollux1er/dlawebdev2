<?php
class Accueil2 extends PRDR_Controller{
	public function __construct(){
		// Obligatoire
		parent::__construct();
		$this->load->library('session');
		
		$this->load->helper(array('form', 'url','html'));
		
		$this->layout->ajouter_css('List/top_menu2');
		$this->layout->ajouter_css('List/left_menu');
		$this->layout->ajouter_css('List/main');
		$this->layout->ajouter_css('List/datepicker');
		$this->layout->ajouter_css('perenco2/generic2');
		$this->layout->ajouter_css('perenco2/print');
		$this->layout->ajouter_css('List/sprites-general');
		$this->layout->ajouter_css('List/style');
		$this->layout->ajouter_css('List/style_002');
		$this->layout->ajouter_css('List/style-dynamic');
		$this->layout->ajouter_css('List/datepicker_002');
		$this->layout->ajouter_css('List/SqueezeBox');
		$this->layout->ajouter_css('it_assets/message');
		// $this->layout->ajouter_css('auto/reservation');
		// $this->layout->ajouter_css('auto/prop_user');
		
		
		
		$this->imgtop = 'perenco_intranet/set_user.png';
		$this->titre = 'Administration';
		
		$this->load->library ( 'form_validation' );
	}

	public function index(){
		$this->layout->ajouter_css('jquery.datepick');
			
		$this->define_header();
		$this->define_left_menu('intranet/left_menu0');
		// $this->define_right_menu('auto/right_menu0');
		
		$param = array();
		
		$param['method'] = "Acceuil";
		
		$this->define_view('intranet/templates/accueil2', $param);
	}
}