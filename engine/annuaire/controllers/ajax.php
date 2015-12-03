<?php

class Ajax extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('annuaire_model', 'annuaire');
		$this->load->model('user_model', 'user');
		//$this->load->helper('date_fr');
		$this->load->helper('url');
	}
	
	function update_taxation_infos()
	{
		$_POST = json_decode(file_get_contents('php://input'), true);
		//var_dump($this->input->post('id')); die;
		if($this->input->post('id')) {
			if(!$this->annuaire->update_pabx_info($this->input->post('id'), $this->input->post('Mouchard'), $this->input->post('Habilitation'), $this->input->post('Abrege'))) {
				echo '2';
				return;
			}
		}
	}
	
	function update_gsm_infos()
	{
		$_POST = json_decode(file_get_contents('php://input'), true);
		//var_dump($this->input->post('id')); die;
		if($this->input->post('id')) {
			if(!$this->annuaire->update_gsm_info($this->input->post('id'), $this->input->post('Forfait'), $this->input->post('Puk'), $this->input->post('Serial'))) {
				echo '2';
				return;
			}
		}
	}
	
	function terminate_gsm()
	{
		$_POST = json_decode(file_get_contents('php://input'), true);
		//var_dump($this->input->post('id')); die;
		if($this->input->post('gsm')) {
			if(!$this->annuaire->terminate_gsm($this->input->post('gsm'))) {
				echo '2';
				return;
			}
		}
	}
	
	function spare_gsm()
	{
		$_POST = json_decode(file_get_contents('php://input'), true);
		//var_dump($this->input->post('id')); die;
		if($this->input->post('gsm')) {
			if(!$this->annuaire->spare_gsm($this->input->post('gsm'))) {
				echo '2';
				return;
			}
		}
	}
	function delete_taxation_infos()
	{
		$_POST = json_decode(file_get_contents('php://input'), true);
		//var_dump($this->input->post()); die;
		if($this->input->post('id_user') != '') {
			if($this->annuaire->delete_pabx_info($this->input->post('id_user'), $this->input->post('ext'))) {
				echo true;
			}
		}
	}
	
	public function delete_gsm_infos()
	{
		$_POST = json_decode(file_get_contents('php://input'), true);
		//var_dump($this->input->post()); die;
		if($this->input->post('id_user') != '') {
			if($this->annuaire->delete_gsm_info($this->input->post('id_user'), $this->input->post('gsm'))) {
				echo true;
			}
		}
	}
}
