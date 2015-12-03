<?php
//application\core\my_Controller.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class PRDR_Controller extends CI_Controller{

/*
|===============================================================================
| $menu : contient l'ensemble des menus et sous menus de la page qu'on va affiché
|===============================================================================
*/
	private $menus = array();
/*
|===============================================================================
| Constructeur : sera appelé par tous les controllers du site
| Il permet de :
	* tester l'authentification de l'utilisateur
	* charger les librairie communes a tous les controllers
|===============================================================================
*/		
	public function __construct(){
	
		parent::__construct();
		
		$this->load->library('authentifif');
				
		if(!$this->authentifif->is_login()){
			if(!$this->authentifif->valid_user()){
				redirect('login');
			}
		}
		
		$this->set_menu();
		$this->load->library('layout');
		$this->load->helper(array('form','html','assets'));
		$this->layout->ajouter_css('intranet/alert_late');
		
		$this->layout->ajouter_css('it_assets/style (2)');
		$this->layout->ajouter_js('ong_selection');	
		$this->layout->ajouter_js('it_assets/cut_space');
		$this->layout->ajouter_js('general/enc_dec');			
	}	
	
	public function index(){
		$this->load->view('perenco\index');;
	}

/*
|===============================================================================
| .define_header : methode permettant de charger l'entete du site
|===============================================================================
*/	
	public function define_header(){
 
		$this->layout->ajouter_js('it_assets/message');
		$img = array('grdtitre'=>$this->titre,'logo'=>img_url('perenco_intranet/logo_v2.gif'), 'vignette' => img_url($this->imgtop));
	
		foreach($this->menus as $menu){
			$this->layout->ajouter_menu($menu);
		}
	
		//$this->layout->views('perenco/top_menu', $img);
	}

/*
|===============================================================================
| methodes permettant de charger les menus de gauche et de droite
|.define_left_menu 
|.define_right_menu 
|===============================================================================
*/	
	public function define_left_menu($lm, $dat = array()){
		$data ['contenu'] = $this->load->view($lm, $dat,true);
		$this->layout->views('themes/left_menu', $data);
		
	}
	
	public function define_right_menu($rl){
		$data ['contenu'] = $this->load->view($rl, array(),true);
		$this->layout->views('themes/right_menu', $data);
	}

/*
|===============================================================================
| .define_view : methode permettant de charger la vue principale du site
| param $view : chemin vers la vue a charger
| param $param : liste des paramètres a envoyer a la vue
|===============================================================================
*/	
	public function define_view($view, $param= array()){
		if(is_string($view) AND !empty($view) AND file_exists('./engine/accueil/views/'.$view.'.php')){
			$this->layout->view($view,$param);
			return true;
		}else{
			$this->layout->view('perenco/view_construct');
			return false;
		}
	}
/*
|===============================================================================
| .set_menu : fixe au paramètre $menu la liste des menus que l'utilisateur
|			 pourra voir en fonction de ses droits
|===============================================================================
*/	
	public function set_menu(){
		/* $sous_menu1 = array('nom' => 'Communautés (D.D.)', 'lien'=> base_url () .'working_area');
		$sous_menu2 = array('nom' => 'Projets', 'lien'=> base_url () .'working_area');
		$sous_menu3 = array('nom' => 'Opérations', 'lien'=> base_url().'working_area'); */
		$sous_menus = array(/* $sous_menu1, $sous_menu2, $sous_menu3 */);
		$this->menus[] = array ('nom' =>'Parc Auto', 'lien'=> 'parc_auto.php', 'sous_menu'=>$sous_menus);
		
		/* $sous_menu1 = array('nom' => 'Organigrammes', 'lien'=> base_url () .'working_area');
		$sous_menu2 = array('nom' => 'Notes de Services', 'lien'=> base_url () .'working_area');
		$sous_menu3 = array('nom' => 'Politiques', 'lien'=> base_url () .'working_area');
		$sous_menu4 = array('nom' => 'Règlement Intérieur', 'lien'=> base_url () .'working_area'); */
		$sous_menus = array(/* $sous_menu1, $sous_menu2, $sous_menu3, $sous_menu4 */);
		$this->menus[] = array ('nom' =>'Base Loisirs', 'lien'=> 'base_loisirs.php', 'sous_menu'=>$sous_menus);
		
		/* $sous_menu1 = array('nom' => 'Organisation', 'lien'=> base_url () .'working_area');
		$sous_menu2 = array('nom' => 'Sections', 'lien'=> base_url().'working_area');
		$sous_menu3 = array('nom' => 'Communication', 'lien'=> base_url().'working_area');
		$sous_menu4 = array('nom' => 'Base Loisirs KRIBI', 'lien'=> base_url().'base_loisirs'); */
		// $sous_menu5 = array('nom' => 'Foyer Bassa', 'lien'=> base_url () .'foyer_bassa');
		/* $sous_menus = array($sous_menu1, $sous_menu2, $sous_menu3, $sous_menu4 *//* , $sous_menu5 *//* ); */
		/* $this->menus[] = array ('nom' =>'COS', 'lien'=> current_url(), 'sous_menu'=>$sous_menus); */
		
		/* $sous_menu1 = array('nom' => 'Parc Auto', 'lien'=> '../parc_auto/login/enter?ID='.$this->session->userdata ( "iduser" )); */
		// $sous_menu2 = array('nom' => 'Accomodation', 'lien'=> base_url().'accomodation');
		/* $sous_menus = array($sous_menu1 *//* , $sous_menu2 *//* );
		$this->menus[] = array ('nom' =>'Outils de gestion', 'lien'=> current_url(), 'sous_menu'=>$sous_menus); */
	}
	
	
/*
|===============================================================================
| .wd_remove_accents : enlève les accents des mots qui sont passés en paramètres
		
|===============================================================================
*/		
	
	public function wd_remove_accents($str, $charset='utf-8')
	{
		$str = htmlentities($str, ENT_NOQUOTES, $charset);
		
		$str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
		$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
		$str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
		
		return $str;
	}

/*
|===============================================================================
| .delete : Fonction de suppression que les autres classes vont hériter
		
|===============================================================================
*/	
	
	public function delete($table, $id) {
		if (is_array ( $id )) {
			foreach ( $id as $del )
				$this->doctrine->em->remove ( $del );
		} else {
			$entitie = $this->doctrine->em->getRepository ( $table )->find ( $id );
			$this->doctrine->em->remove ( $entitie );
		}
		$this->doctrine->em->flush ();
	}
	
/*
|===============================================================================
| .fonctions de cryptage et de décryptage des variables (utilisé pour les passwords)
|===============================================================================
*/	

	public function encrypt($data) {
		$key = "secret";  // Clé de 8 caractères max
		$data = serialize($data);
		$td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,"");
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td,$key,$iv);
		$data = base64_encode(mcrypt_generic($td, '!'.$data));
		mcrypt_generic_deinit($td);
		return $data;
	}
 
	public function decrypt($data) {
		$key = "secret";
		$td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,"");
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td,$key,$iv);
		$data = mdecrypt_generic($td, base64_decode($data));
		mcrypt_generic_deinit($td);
	 
		if (substr($data,0,1) != '!')
			return false;
	 
		$data = substr($data,1,strlen($data)-1);
		return unserialize($data);
	}

	/*
|===============================
| .fonction de pagination 
|===============================
*/

	public function pagination( $step, $pages, $c )
	{
		$page_links = "";
		$links = "";
		if( $pages > 5 )
		{
			$hide = "";
			$_hide = "";
			$__hide = "";
			for ($i = 0; $i < $pages; $i++)
			{
				if($i == ( $step - 1))
				{
					$page_links .= '<strong name="numb_'.$c.'">'.$step.'</strong>';
				}else{
					if( $step > 3 )
					{
						if( ($i < ($step - 3)) || ($i > ($step + 2)) ){
							$hide = 'style="display:none;"';
						}
					}else if ( $step == 3 )
					{
						if( $i > ($step + 1) )
						{
							$hide = 'style="display:none;"';
						}
					}else
					{
						if( $i > 2 )
						{
							$hide = 'style="display:none;"';
							$_hide = 'style="display:none;"';
							// if( $i == 1 )
							// $__hide = 'style="display:none;"';
						}
					}
					$page_links .= '<a name="step_'.$c.'_'.$i.'" '.$hide.' onclick="_step(this)">'.($i+1).'</a>';
				}
			}
			
			$links = '<a name="deb_'.$c.'" '.$_hide.' onclick="_deb(this)"> &lsaquo; Debut </a><a name="prec_'.$c.'" '.$_hide.' onclick="_prec(this)"> &lt; </a>'.$page_links.'<a name="suiv_'.$c.'" onclick="_suiv(this)"> &gt; </a><a name="fin_'.$c.'" onclick="_fin(this)"> Fin &rsaquo; </a>';
			
		}else if( $pages > 1 ){
			for ($i = 0; $i < $pages; $i++)
			{
				if($i == ($step - 1))
				{
					$page_links .= '<strong name="numb_'.$c.'">'.$step.'</strong>';
				}else{
					$page_links .= '<a name="step_'.$c.'_'.$i.'" onclick="_step(this)">'.($i+1).'</a>';
				}
			}
			$links = $page_links;
		}
	
		return $links;
	}
}

