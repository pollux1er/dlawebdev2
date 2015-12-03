<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admresas extends CI_Controller {

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
		//parent::CI_Controller();
		
		parent::__construct();
		$this->load->model('demande_model', 'demande');
		$this->load->model('reservation_model', 'reservation');
		$this->load->model('saison_model', 'saison');
		$this->load->model('user_model', 'user');
		$this->load->model('statistics_model', 'stats');
		$this->load->helper('url');
	}
	
	
	// Logs des demandes
	public function index()
	{
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			redirect('/authentication/');
		}
		
		$data['title'] = 'Administration des demandes';
		$data['nom'] = $this->user->get_nom();
		$data['logs'] = $this->demande->get_all();
		$this->load->view('logs-adm', $data);
	}
	
	// Rapport d'occupations
	public function booking_report()
	{
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			redirect('/authentication/');
		}
		
		$data['resac'] = $this->reservation->nb_resa_confirme();
		$data['resanc'] = $this->reservation->nb_resa_nconfirme();
		$data['resaat'] = $this->reservation->nb_resa_enattente();
		$data['resaan'] = $this->reservation->nb_resa_annulee();
		$data['quotas'] = $this->user->get_quotas();
		//var_dump($data['quotas']); die;
		$data['title'] = "Gestion - Rapports d'occupation - Base Loisirs";
		$data['nom'] = $this->user->get_nom();
		$data['logs'] = $this->demande->get_all();

		$this->load->view('adm/rapports', $data);
	}
	
	// Rapport d'occupations
	public function booking_stats()
	{
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			redirect('/authentication/');
		}
		
		$data['quotas'] = $this->user->get_quotas();
		//var_dump($data['quotas']); die;
		$data['title'] = "Gestion - Statistiques d'occupation - Base Loisirs";
		
		$data['nom'] = $this->user->get_nom();
		
		$data['logs'] = $this->demande->get_all();
		
		$data['population'] = $this->stats->taux_population();
		$data['occupation'] = $this->stats->pourcentage_occupation_annuel($this->saison->get_current_year());
		$data['occupation_case'] = $this->stats->occupation_case($this->saison->get_current_year());
		$data['top_10_users'] = $this->stats->top_10_users($this->saison->get_current_year());
		$data['top_10_less_users'] = $this->stats->top_10_less_users($this->saison->get_current_year());

		$this->load->view('adm/stats', $data);
	}
	
	// Liste les Ayants droits
	public function users()
	{
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			redirect('/authentication/');
		}
		
		$data['users'] = $this->user->get_all_ayant_droits();
		//var_dump($data['users']); die;
		$data['title'] = "Gestion - Ayants droits - Base Loisirs";
		$data['nom'] = $this->user->get_nom();
		$this->load->view('adm/users', $data);
	}
	
	// Gere les Ayants droits
	public function manage_users()
	{
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			redirect('/authentication/');
		}
		
		$data['users'] = $this->user->get_all_ayant_droits();
		$data['all_non_users'] = $this->user->get_all_n_ayant_droits();
		//var_dump($data['users']); die;
		$data['title'] = "Administration - Ayants droits - Base Loisirs";
		$data['nom'] = $this->user->get_nom();
		
		if($this->input->post('attribution_id')) {
			if($this->user->add_to_ayant_droit($this->input->post('attribution_id')))
				$data['message'] = $this->input->post('attribution_name') . " a été ajouté aux ayants droits"; 
			else
				$data['message'] = "";
			redirect('/admresas/manage_users/');
		}
		else	
			$data['message'] = count($data['users']) . " ayants droits";
		
		$this->load->view('adm/adm_users', $data);
	}
	
	// Gere les Ayants droits
	public function manage_roles()
	{
		// Verifier la session de l'utilisateur
		if (!$this->session->userdata('iduser')) {
			
			redirect('/authentication/');
		}
		
		$data['users'] = $this->user->get_all_ayant_droits();
		$data['all_hr_users'] = $this->user->get_all_ayant_droits_hr();
		//var_dump($data['users']); die;
		$data['title'] = "Administration - Roles - Base Loisirs";
		$data['nom'] = $this->user->get_nom();
		
		if($this->input->post('manager')) {
			$this->user->set_manager($this->input->post('manager'));
			$this->user->set_hr_manager($this->input->post('hr_manager'));
			$data['message'] = "L'attribution des rôles a été effectuée.";
			redirect('/admresas/manage_roles/?message=success');
		}
		if($this->input->get('message'))
			$data['message'] = "L'attribution des rôles a été effectuée.";
			
		$this->load->view('adm/adm_roles', $data);
	}
	
	// Afficher le pdf des ayants droits
	public function users_to_pdf()
	{
		$this->load->library('cezpdf');
		//$this->load->helper('download');
		$this->load->helper('pdf');
		//prep_pdf();
		$data['users'] = $this->user->get_all_ayant_droits();
		
		foreach($data['users'] as $user) {
			$db_data[] = array('name' => $user->nom, 'department' => $user->Department, 'status' => $user->Status);
		}
		//$db_data[] = array('name' => 'ABDOULAYE Wadjiri', 'department' => 'Management subsidiaries', 'status' => 'National');
		
		$col_names = array(
			'name' => 'Noms et Prenoms',
			'department' => 'Département',
			'status' => 'Status'
		);
		
		$this->cezpdf->ezTable($db_data, $col_names, 'Ayant droit Base Loisirs de Kribi', array('width'=>550));
		
		$this->cezpdf->ezStream(array('download'=>1));		
	}

	function chart(){
       // $this->load->add_package_path(APPPATH.'third_party/pchart/');

        $this->load->library('pchart');  

        echo "<pre>";
        /* Add data in your dataset */ 
        $PDA = $this->pchart->pData();
       
        $PDA->addPoints(array(VOID,3,4,3,5));  
        /* Create a pChart object and associate your dataset */ 
        $PDI = $this->pchart->pImage(700,230,$PDA); 
        /* Choose a nice font */
        $PDI->setFontProperties(array("FontName"=>APPPATH.'third_party/chart/fonts/Forgotte.ttf',"FontSize"=>11));

        /* Define the boundaries of the graph area */
        $PDI->setGraphArea(60,40,670,190);

        /* Draw the scale, keep everything automatic */ 
        $PDI->drawScale();

        /* Draw the scale, keep everything automatic */ 
        $PDI->drawSplineChart();

        /* Build the PNG file and send it to the web browser */ 
        $PDI->Render("assets/base_loisirs/images/charts/basic.png");
        $image = "assets/base_loisirs/images/charts/basic.png";
        $data['html'] = "<img src='".base_url()."$image' />";

        $this->load->view('adm/test', $data);

    }

    function Statisitics(){
    	$this->user->get_percentage_executives();
    	

    	//////////////////////////
        $this->load->library('pchart');  

    	/* Create and populate the pData object */
		$MyData = $this->pchart->pData();   
		$MyData->addPoints(array($this->user->get_percentage_executives()->Expats,$this->user->get_percentage_executives()->National),"ScoreA");  
		$MyData->setSerieDescription("ScoreA","Application A");

		/* Define the absissa serie */
		$MyData->addPoints(array("Expats","Nationaux"),"Labels");
		$MyData->setAbscissa("Labels");

		/* Create the pChart object */
		$myPicture = $this->pchart->pImage(330,230,$MyData,TRUE);

		/* Draw a solid background */
		$Settings = array("R"=>173, "G"=>152, "B"=>217, "Dash"=>1, "DashR"=>193, "DashG"=>172, "DashB"=>237);
		$myPicture->drawFilledRectangle(0,0,330,230,$Settings);

		/* Draw a gradient overlay */
		$Settings = array("StartR"=>209, "StartG"=>150, "StartB"=>231, "EndR"=>111, "EndG"=>3, "EndB"=>138, "Alpha"=>50);
		$myPicture->drawGradientArea(0,0,330,230,DIRECTION_VERTICAL,$Settings);
		$myPicture->drawGradientArea(0,0,330,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));

		/* Add a border to the picture */
		$myPicture->drawRectangle(0,0,329,229,array("R"=>0,"G"=>0,"B"=>0));

		/* Write the picture title */ 
		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/Silkscreen.ttf","FontSize"=>6));
		$myPicture->drawText(10,13,"Ayant droits",array("R"=>255,"G"=>255,"B"=>255));

		/* Set the default font properties */ 
		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/Forgotte.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80)); 

		 /* Create the pPie object */ 
		$PieChart = $this->pchart->pPie($myPicture,$MyData);

		/* Define the slice color */
		$PieChart->setSliceColor(0,array("R"=>143,"G"=>197,"B"=>0));
		$PieChart->setSliceColor(1,array("R"=>97,"G"=>77,"B"=>63));
		$PieChart->setSliceColor(2,array("R"=>97,"G"=>113,"B"=>63));

		/* Draw a simple pie chart */ 
		//$PieChart->draw3DPie(120,125,array("SecondPass"=>FALSE));

		/* Draw an AA pie chart */ 
		//$PieChart->draw3DPie(140,125,array("DrawLabels"=>TRUE,"Border"=>TRUE));

		/* Enable shadow computing */ 
		$myPicture->setShadow(TRUE,array("X"=>3,"Y"=>3,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

		/* Draw a splitted pie chart */ /* Position du graphe */
		$PieChart->draw3DPie(160,125,array("WriteValues"=>TRUE,"DataGapAngle"=>10,"DataGapRadius"=>6,"Border"=>TRUE, "DrawLabels"=>TRUE));

		/* Write the legend */
		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/pf_arma_five.ttf","FontSize"=>6));
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>20));
		//$myPicture->drawText(120,200,"Single AA pass",array("DrawBox"=>TRUE,"BoxRounded"=>TRUE,"R"=>0,"G"=>0,"B"=>0,"Align"=>TEXT_ALIGN_TOPMIDDLE));
		$myPicture->drawText(160,200,"Representations des populations",array("DrawBox"=>TRUE,"BoxRounded"=>TRUE,"R"=>0,"G"=>0,"B"=>0,"Align"=>TEXT_ALIGN_TOPMIDDLE));

		/* Write the legend box */ 
		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/Silkscreen.ttf","FontSize"=>6,"R"=>255,"G"=>255,"B"=>255));
		$PieChart->drawPieLegend(190,8,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

		/* Render the picture (choose the best way) */
		$myPicture->Render("assets/base_loisirs/images/charts/example.draw3DPie.png"); 

		/* Build the PNG file and send it to the web browser */ 
		$image = "assets/base_loisirs/images/charts/example.draw3DPie.png";
		$data['html'] = "<img src='".base_url()."$image' />";

		$this->load->view('adm/test', $data);

    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */