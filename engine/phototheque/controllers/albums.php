<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model', 'user');
		$this->load->library('session');
	}
	
	public function index()
	{
		// if($this->input->ip_address() == '10.52.65.39') {
			// echo "<pre>"; 
			// var_dump($this->session->all_userdata());
			// die;
		// }
		//if($this->input->ip_address() == '10.52.66.100') {
			// echo "<pre>"; var_dump($this->session->all_userdata());
			// die;
		//}
		//var_dump($this->user->get_infos_group($this->session->userdata('iduser'))); 
		
		//die;
		if (!$this->session->userdata('iduser')) {
			
			if($this->input->get('sid')) {
				if($this->decrypt($this->input->get('sid')))
					$this->session->set_userdata('iduser', $this->decrypt($this->input->get('sid')));
				else {
					$this->session->set_userdata('saved_url', current_url());
					redirect(base_url('/index.php'));
				}
			} else {
				$this->session->set_userdata('saved_url', current_url());
				redirect(base_url('/index.php'));
			}
			
		}
		
		$vars['title'] = "Base de Loisirs de Kribi - Perenco Cameroun";
		$vars['nom'] = $this->user->get_nom();
		if (!$this->user->is_athorized_user($this->session->userdata('iduser'))) {
				$this->load->view('access_denied', $vars);
		
		} else {	
		//$this->load->view('templates/header', $vars);
			$this->load->view('base_loisir', $vars);
		
		}
		
	}
	
	function about()
	{
		
		if (!$this->session->userdata('iduser')) {
			redirect(base_url('/index.php'));
		}
		if (!$this->user->is_athorized_user($this->session->userdata('iduser'))) {
				redirect('/authentication/');
		
		}
		$vars['title'] = "About - Base de Loisirs - Perenco Intranet Cameroon";
		//$vars['nom'] = $this->user->get_nom();
		$vars['nom'] = $this->user->get_nom();
		
			
		//$this->load->view('templates/header', $vars);
		$this->load->view('about', $vars);
	}
	
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
		// if($this->input->ip_address() == '10.52.66.172') {
			// var_dump($data);
			// die;
		// }
		$key = "secret";
		$td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,"");
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td,$key,$iv);
		// mcrypt_generic_deinit($td);
		// if($this->input->ip_address() == '10.52.66.172') {
			// var_dump($data);
			// die;
		// }
		
		$data = mdecrypt_generic($td, base64_decode($data));
		// if($this->input->ip_address() == '10.52.66.172') {
			// var_dump($data);
			// die;
		// }
		mcrypt_generic_deinit($td);
		if (substr($data,0,1) != '!')
			return false;
	 
		$data = substr($data,1,strlen($data)-1);
		return unserialize($data);
	}
	
}

/* End of file calendar.php */
/* Location: ./application/controllers/calendar.php */