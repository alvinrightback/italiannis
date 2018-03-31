<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrants extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('citizen_model');
		$this->load->model('address_model');
		$this->load->model('property_model');
		$this->load->model('migrant_model');
	}

	
	public function index(){
		$data['title'] = "Migrants";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['property'] = $this->property_model->get_properties();
		$data['migrants'] = $this->migrant_model->get_migrants();
		$this->render('migrants/main', $data);
	}
}