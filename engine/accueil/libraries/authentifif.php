<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Authentifif{
	
	private $user = array('login'=>'toto', 'password' =>'tata');
 
/*
|===============================================================================
| Constructeur
|===============================================================================
*/

	public function __construct(){
		
	}

/*
|===============================================================================
| M�thodes valider une authentification
| . valid_user
|===============================================================================
*/
 
	public function valid_user($data = array()){
		return false;
	}
 
 
 /*
|===============================================================================
| M�thode qui dit si un utilisateur est loguer ou pas
| . is_login
|===============================================================================
*/
	public function is_login(){
		return true;
	}
}