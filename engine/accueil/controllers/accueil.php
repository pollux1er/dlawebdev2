<?php
class Accueil extends PRDR_Controller{
	public function __construct(){
		// Obligatoire
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array( 'form', 'url', 'html', 'text'));
		
		$this->layout->ajouter_css('List/top_menu');
		$this->layout->ajouter_css('List/left_menu');
		$this->layout->ajouter_css('List/main');
		$this->layout->ajouter_css('List/datepicker');
		$this->layout->ajouter_css('perenco2/generic');
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
		// var_dump( $this->session->all_userdata() ); die;
		$this->layout->ajouter_css('jquery.datepick');
			
		$this->define_header();
		//$this->define_left_menu('intranet/left_menu0');
		// $this->define_right_menu('auto/right_menu0');
		
		$param = array();
		
		$param['message'] = "";
		
		if ( isset( $_GET['err'] ) )
		{
			$param['message'] = "ACCESS DINIED";
		}
		
		$param['method'] = "Acceuil";
		
		$actus = $this->doctrine->em->getRepository("Entities\intranet\Actualite")->findBy(array( 'select' => 1 ));
		
		if( count($actus) != 0 )
		{
			if( count($actus) >= 5 )
			{
				$mx = 5;
			}else{
				$mx = count($actus);
			}
			
			$param['frst'] = $actus[0]->getIdactualite();
			
		}else{
			$param['frst'] = "";
			$mx = 0;
		}
		$param['max_actu'] = $mx;
		$param['id_actus'] = array();
		
		$i = 1;
		
		foreach( $actus as $act )
		{
			$param['id_actus'] [] = $i."_".$act->getIdactualite();
			$i++;
			
			if( $i > 5 )
			{
				break;
			}
		}
		
		$this->define_view('intranet/templates/accueil', $param);
	}
	
	function slide_img()
	{	
		header('Content-type:text/javascript; $charset=iso-8859-1');
		
			$id = $_POST['actu'];
			
			$actu = $this->doctrine->em->getRepository("Entities\intranet\Actualite")->findOneBy(array( "idactualite" => $id ));
			
			$ret = array();
			
			if( $actu )
			{
			
				$ret["success"] = true;
				$ret["title"] = $actu->getTitre();
				
				if( strlen($actu->getContenu()) > 660  )
				{
					$contenu = character_limiter($actu->getContenu(), 660);
					$ret['suite'] = array( "lien" => base_url()."working_area", "lib" => ">> Lire la suite" );
				}else{
					$contenu = $actu->getContenu();
					$ret['suite'] = "";
				}
				
				$ret["contenu"] = $contenu;
				$ret["image"] = img_url( "actu/".$actu->getLienPhoto() );
				
			}else{
				$ret["success"] = false;
			}
		
		echo json_encode($ret);
		
	}
	
	function reloadA()
	{
		header('Content-type:text/plain; $charset=iso-8859-1');
		
		$actus = $this->doctrine->em->getRepository("Entities\intranet\Actualite")->findBy(array( 'select' => 1 ));
		
		// $out = count( $actus );
		
		if( count($actus) != 0 )
		{
			if( count($actus) >= 5 )
			{
				$out = 5;
			}else{
				$out = count($actus);
			}
			
			$text = "";
			$i = 1;
			foreach( $actus as $act )
			{
				if( $act->getIdactualite() != intval( $_POST['num_id'] ) )
				{
					$text .= '<a id="step_'.$i.'" onclick="_step(\''.$i.'_'.$act->getIdactualite().'\')">'.$i.'</a>';
				}else{
					$text .= '<strong>'.$i.'</strong>';
				}
				
				$i++;
			
				if( $i > 5 )
				{
					break;
				}
				
			}
		}
		
		echo $text;
	}
}