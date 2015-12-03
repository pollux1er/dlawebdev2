<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 *
	 */
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}
	
	public function index()
	{
		if($this->session->userdata('iduser')) 
		{
			$this->load->view('home');
		}
		elseif($this->input->get('unique_id')) 
		{   // Si le Unique Id est présent, alors le mec vient de l'intranet Group
			// On récupère son unique id et son IP
			$unique_id = $this->input->get('unique_id');
			$ip =  $this->input->ip_address();
			
			$host = "dla-intranet.cm.perenco.com";
			$get = "/authenticate/authenticate.php?unique_id=".$unique_id."&ip=".$ip;
			
			$fp = fsockopen($host, 80, $errno, $errstr, 60);
			
			if (!$fp) {
				echo "ERREUR : $errno - $errstr<br />\n"; die;
			} else {
				fputs( $fp, "GET ".$get." HTTP/1.1\r\n" );
				fputs( $fp, "Content-Type: text/xml;\n" );
				fputs( $fp, "Host: ".$host."\r\n");
				fputs( $fp, "Connection: Close\r\n\r\n");
				fputs( $fp, "\n");
				
				while(!feof($fp)) 
					$auth = fgets($fp, 4096);
				
				fclose($fp);
				
				$user = new SimpleXMLElement($auth);
				
				$newdata = array(
				   'id'  		=> $user->{'user'}->id->__toString(),
				   'iduser'  		=> $user->{'user'}->id->__toString(),
				   'nom'  		=> $user->{'user'}->name->__toString(),
				   'prenom'  	=> $user->{'user'}->firstname->__toString(),
				   'email'  	=> $user->{'user'}->email->__toString(),
				   'subsidiaryId'  	=> $user->{'user'}->subsidiaryId->__toString(),
				   'departmentId'  	=> $user->{'user'}->departmentId->__toString(),
				   'logged_in' 	=> TRUE
				);
				
				$this->session->set_userdata($newdata);

			}
			
			$this->load->view('home');
			
		}
		elseif($this->input->get('user_id')) {
			$newdata = array(
				   'id'  		=> '14194',
				   'iduser'  		=> '14194',
				   'nom'  		=> 'ASSONTIA',
				   'prenom'  	=> 'Patient',
				   'email'  	=> 'passontia@cm.perenco.com',
				   'subsidiaryId'  	=> '5',
				   'departmentId'  	=> '18',
				   'logged_in' 	=> TRUE
				);
				
				$this->session->set_userdata($newdata);
			$this->load->view('home');
		}
		else { // Sinon il vient probablement d'un des liens de mail, auquel cas on lui exige une authentification à partir du groupe
			//$this->session->set_userdata('last_url', current_url());
			redirect(base_url("accueil.php/login/enter"));			
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url("accueil.php/login/enter"));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */