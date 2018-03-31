<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('property_model');
		$this->load->model('address_model');
	}

	public function index(){
		$data['title'] = "Property";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['citizens'] = $this->get_data->get_all_value('tbl_citizens');
		$data['property'] = $this->property_model->get_properties();
		$this->render('property/main', $data);
	}


	public function add(){
		$data['title'] = "Property";
		$conditions = array('Citizen_ID' => $this->uri->segment(3));
		$data['citizen_data'] = $this->get_data->get_value_where('tbl_citizens', $conditions);
		$data['address'] = $this->address_model->get_address_with_barangay();
		$data['barangay'] = $this->get_data->get_all_value('tbl_barangay');
		$data['unittype'] = $this->get_data->get_value_where('ref_auxillary', array('Aux_Group' => 'Unit_Type'));
		$this->render('property/add', $data);
	}

	public function property_add_now(){
		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('REP_Name', 'Property Name', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Barangay_ID', 'Barangay ID', 'trim|required|strip_tags');
		if($this->input->post('Address_ID', TRUE) == NULL){	
			$data['property_address'] = $this->address_model->add_address($this->input->post('Property_Address_Name', TRUE), $this->input->post('Barangay_ID', TRUE));
		}
		else{
			$this->form_validation->set_rules('Address_ID', 'Property Address', 'trim|required|strip_tags');
		}
		$this->form_validation->set_rules('Citizen_ID', 'Citizen ID', 'trim|required|strip_tags');
		$this->form_validation->set_rules('REP_No_Of_Units', 'Number of units', 'trim|required|strip_tags');
		$this->form_validation->set_rules('REP_Unit_Type', 'Unit Type', 'trim|required|strip_tags');
		$this->form_validation->set_rules('REP_Submission_Date', 'Submission Date', 'trim|required|strip_tags');

		if($this->form_validation->run() == FALSE){
			redirect('property/add/'.$this->input->post('Citizen_ID', TRUE));
		}
		else{	
			$query = $this->property_model->add_property($data);
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('property/view/'.$query);
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('property/add/'.$this->input->post('Citizen_ID', TRUE));
			}
		}
	}

	public function view(){
		$data['title'] = "Property";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['property_data'] = $this->property_model->get_property($this->uri->segment(3));
		$data['current_renters'] = $this->property_model->get_renters($this->uri->segment(3));
		$data['renter_history'] = $this->property_model->get_renter_history($this->uri->segment(3));
		$data['rentertype'] = $this->get_data->get_value_where('ref_auxillary', array('Aux_Group' => 'Renter_Type'));
		$data['citizens'] = $this->get_data->get_all_value('tbl_citizens');
		if(isset($data['current_renters'])){
			foreach ($data['current_renters'] as $value) {
	    		$data['existingRenters'][] = $value->Citizen_ID;
			}
			array_push($data['existingRenters'], $data['property_data'][0]->Citizen_ID);
		}
		else{
			$data['existingRenters'][] = $data['property_data'][0]->Citizen_ID;
		}

		$this->render('property/view', $data);
	}

	public function edit(){
		$data['title'] = "Property";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['property_data'] = $this->property_model->get_property($this->uri->segment(3));
		$data['address'] = $this->address_model->get_address_with_barangay();
		$data['barangay'] = $this->get_data->get_all_value('tbl_barangay');
		$data['unittype'] = $this->get_data->get_value_where('ref_auxillary', array('Aux_Group' => 'Unit_Type'));
		$this->render('property/edit', $data);
	}

	public function property_edit_now(){
		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('REP_Name', 'Property Name', 'trim|required|strip_tags');
		if($this->input->post('Address_ID', TRUE) == NULL){	
			$data['property_address'] = $this->address_model->add_address($this->input->post('Property_Address_Name', TRUE), $this->input->post('Barangay_ID', TRUE));
		}
		else{
			$this->form_validation->set_rules('Address_ID', 'Property Address', 'trim|required|strip_tags');
		}
		$this->form_validation->set_rules('Barangay_ID', 'Barangay ID', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Citizen_ID', 'Citizen ID', 'trim|required|strip_tags');
		$this->form_validation->set_rules('REP_No_Of_Units', 'Number of units', 'trim|required|strip_tags');
		$this->form_validation->set_rules('REP_Unit_Type', 'Unit Type', 'trim|required|strip_tags');
		$this->form_validation->set_rules('REP_Submission_Date', 'Submission Date', 'trim|required|strip_tags');

		if($this->form_validation->run() == FALSE){
			redirect('property/edit/'.$this->input->post('REP_ID', TRUE));
		}
		else{	
			$query = $this->property_model->edit_property($data);
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('property/view/'.$query);
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('property/edit/'.$this->input->post('REP_ID', TRUE));
			}
		}
	}

	public function property_leave_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Departure_Date', 'Citizen ID', 'trim|required|strip_tags');
		$this->form_validation->set_rules('REP_Renter_ID', 'Renter Type ID', 'trim|required|strip_tags');
		if($this->form_validation->run() == FALSE){
			redirect('property/view/'.$this->input->post('REP_ID'));
		}
		else{
			$query = $this->property_model->leave_renter();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('property/view/'.$this->input->post('REP_ID'));
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('property/view/'.$this->input->post('REP_ID'));
			}
		}
	}


	public function property_add_renter_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Citizen_ID', 'Citizen ID', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Renter_Type_ID', 'Renter Type ID', 'trim|strip_tags');
		$this->form_validation->set_rules('Arrival_Date', 'Arrival_Date', 'trim|strip_tags');
		if($this->form_validation->run() == FALSE){
			redirect('property/view/'.$this->input->post('REP_ID'));
		}
		else{
			$query = $this->property_model->add_renter();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('property/view/'.$this->input->post('REP_ID'));
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('property/view/'.$this->input->post('REP_ID'));
			}
		}

	}



	public function edit_renter(){
		$data['title'] = "Property";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['renter_data'] = $this->get_data->get_value_where('tbl_real_estate_property_renter', array('REP_Renter_ID' => $this->uri->segment(3)));
		$data['rentertype'] = $this->get_data->get_value_where('ref_auxillary', array('Aux_Group' => 'Renter_Type'));
		$this->render('property/edit_renter', $data);
	}

	public function property_edit_renter_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('REP', 'REP ID', 'trim|strip_tags');
		$this->form_validation->set_rules('Renter_Type_ID', 'Renter Type ID', 'trim|strip_tags');
		$this->form_validation->set_rules('Arrival_Date', 'Arrival_Date', 'trim|strip_tags');
		if($this->form_validation->run() == FALSE){
			redirect('property/view/'.$this->input->post('REP_ID'));
		}
		else{
			$query = $this->property_model->edit_renter();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('property/view/'.$this->input->post('REP_ID'));
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('property/view/'.$this->input->post('REP_ID'));
			}
		}

	}

}