<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|===============================================================================
| Classe de mise en place des différents composants de la fenêtre du site
|===============================================================================
*/
class Layout{

	private $CI;
	private $var = array();

	private $theme = 'default';
 
/*
|===============================================================================
| Constructeur
|===============================================================================
*/

	public function __construct(){
		$this->CI =& get_instance();
 
		$this->var['output'] = '';
 
		// Le titre est composé du nom de la méthode et du nom du contrôleur
		// La fonction ucfirst permet d'ajouter une majuscule
		$this->var['titre'] = ucfirst($this->CI->router->fetch_method()) . ' - ' . ucfirst($this->CI->router->fetch_class());

		//l'icon du site
		$this->var['icon'] = img_url('perenco1/favicon.ico');
 
		// Nous initialisons la variable $charset avec la même valeur que
		// la clé de configuration initialisée dans le fichier config.php
		$this->var['charset'] = $this->CI->config->item('charset');

 
		$this->var['css'] = array();
		$this->var['js'] = array();

		$this->var['logo'] = img_url('perenco_intranet/logo_v2.gif');
		$this->var['vignette'] = img_url('perenco_intranet/vignette.jpg');

		$this->var['menu'] = array();
		// $this->var['sous_menu'] = array();
	}
 
/*
|===============================================================================
| Méthodes pour charger les vues
| . view
| . views
|===============================================================================
*/
 
	public function view($name, $data = array()){
		$this->var['output'] .= $this->CI->load->view($name, $data, true);
 
		$this->CI->load->view('themes/' . $this->theme, $this->var);
	}
 
	public function views($name, $data = array()){
		$this->var['output'] .= $this->CI->load->view($name, $data, true);
		return $this;
	}
 
 
 /*
|===============================================================================
| Méthodes pour modifier les variables envoyées au layout
| . set_titre
| . set_charset
|===============================================================================
*/
	public function set_titre($titre){
		if(is_string($titre) AND !empty($titre)){
			$this->var['titre'] = $titre;
			return true;
		}
		return false;
	}
	
	public function set_charset($charset){
		if(is_string($charset) AND !empty($charset)){
			$this->var['charset'] = $charset;
			return true;
		}
		return false;
	}

/*
|===============================================================================
| Méthodes pour ajouter des feuilles de CSS et de JavaScript
| . ajouter_css
| . ajouter_js
|===============================================================================
*/

	public function ajouter_css($nom){
		if(is_string($nom) AND !empty($nom) AND file_exists('./assets/intranet/css/' . $nom .'.css')){
			$this->var['css'][] = css_url($nom);
			return true;
		}
		return false;
	}

	public function ajouter_js($nom){
		if(is_string($nom) AND !empty($nom) AND file_exists('./assets/intranet/javascript/' .$nom . '.js')){
			$this->var['js'][] = js_url($nom);
			return true;
		}
		return false;
	}

/*
|===============================================================================
| Méthodes pour changer le theme du site
| . set_theme
|===============================================================================
*/

	public function set_theme($theme){
		if(is_string($theme) AND !empty($theme) AND file_exists('./application/views/themes/' . $theme . '.php')){
			$this->theme = $theme;
			return true;
		}
		return false;
	}

/*
|===============================================================================
| Méthodes pour ajouter des menus et sous menus
| . ajouter_menu
|===============================================================================
*/

	public function ajouter_menu($menu){
		if(is_array($menu) AND !empty($menu)){
			$men = array('nom' => $menu['nom'], 'lien' => $menu['lien'], 'sous_menu' => $menu['sous_menu']);
			$this->var['menu'][] = $men;
			// $this->var['sous_menu'][] = $menu['sous_menu'];
			return true;
		}
		return false;
	}
	
	public function ajouter_lmenu($menu){
		if(is_array($lmenu) AND !empty($lmenu)){
			$lmen = array('nom' => $lmenu['nom'], 'lien' => $lmenu['lien']);
			$this->var['menu'][] = $lmen;
			$this->var['sous_menu'][] = $lmenu['sous_menu'];
			return true;
		}
		return false;
	}
}