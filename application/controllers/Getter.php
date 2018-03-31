<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Getter extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('citizen_model');
		$this->load->model('address_model');
		$this->load->model('property_model');
		$this->load->model('blotter_model');
	}

	public function get_citizen(){
		$data['info'] = $this->citizen_model->get_citizen_info($this->input->post('id', TRUE));
		$data['currentAddress'] = $this->address_model->get_address($data['info'][0]->Citizen_CurrentAddress);
		$data['permanentAddress'] = $this->address_model->get_address($data['info'][0]->Citizen_PermanentAddress);
		echo json_encode($data);
	}

	public function get_person(){
		if($this->input->post('type', TRUE) == 'complainant'){
			$table = 'tbl_blotter_complainant';
			$field = 'Blotter_Complainant_ID';
			$prefix = 'Com_';
		}
		if($this->input->post('type', TRUE) == 'respondent'){
			$table = 'tbl_blotter_respondent';
			$field = 'Blotter_Respondent_ID';
			$prefix = 'Res_';
		}

		$data['info'] = $this->blotter_model->get_person_info($table, $field, $prefix, $this->input->post('id', TRUE));
		echo json_encode($data);
	}
}