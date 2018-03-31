<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blotter extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('blotter_model');
	}

	public function index(){
		$data['title'] = "Blotter";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['blotters'] = $this->blotter_model->get_blotters();
		$this->render('blotter/main', $data);
	}

	public function add(){
		$data['title'] = "Blotter";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['citizens'] = $this->get_data->get_all_value('tbl_citizens');
		$data['nationality'] = $this->get_data->get_all_value('tbl_nationality');
		$data['complaint_status_type'] = $this->get_data->get_value_where('ref_auxillary', array('Aux_Group'=>'Complaint_Status_Type'));
		$this->render('blotter/add', $data);	
	}

	public function add_now(){
		$this->load->library('form_validation');
	  	$this->form_validation->set_rules('Incident_Date_From', 'Incident Date From', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Incident_Date_To', 'Incident Date To', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Complaint_Status_ID', 'Complaint Status', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Nature_Of_Complaint', 'Nature Of Complaint', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Remarks', 'Remarks', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->add();
		}
		else{	
			$barangay_ID = $this->get_data->get_value('Barangay_ID','tbl_users',array('User_ID'=>$this->session->userdata('user_id')));
			$query = $this->blotter_model->add($barangay_ID);
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('blotter/view/'.$query);
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				$this->add();
			}
		}
	}

	public function view(){
		$data['title'] = "Blotter";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['citizens'] = $this->get_data->get_all_value('tbl_citizens');
		$data['nationality'] = $this->get_data->get_all_value('tbl_nationality');
		$data['blotter_data'] = $this->blotter_model->get_blotter($this->uri->segment(3));
		$data['complainants'] = $this->blotter_model->get_people($this->uri->segment(3), 'tbl_blotter_complainant');
		$data['respondents'] = $this->blotter_model->get_people($this->uri->segment(3), 'tbl_blotter_respondent');
		$this->render('blotter/view', $data);	
	}

	public function add_people_now(){
		$this->load->library('form_validation');
	  	$this->form_validation->set_rules('Last_Name', 'Last Name', 'trim|strip_tags|required');
	  	$this->form_validation->set_rules('First_Name', 'First Name', 'trim|strip_tags|required');
	  	$this->form_validation->set_rules('Middle_Name', 'Middle Name', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Nationality_ID', 'Nationality ID', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Complete_Address', 'Complete Address', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Contact_Number', 'Contact Number', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			redirect('blotter/view/'.$this->input->post('Blotter_ID', TRUE));
		}
		else{	
			$query = $this->blotter_model->add_people();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('blotter/view/'.$query);
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('blotter/view/'.$query);
			}
		}
	}

	public function delete_people_now($type, $id, $blotter_ID){
		if($type == 'complainant'){
			$table = 'tbl_blotter_complainant';
			$field = 'Blotter_Complainant_ID';
		}
		if($type == 'respondent'){
			$table = 'tbl_blotter_respondent';
			$field = 'Blotter_Respondent_ID';
		}

		$query = $this->blotter_model->delete_people($table, $field, $id);
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('blotter/view/'.$blotter_ID);
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('blotter/view/'.$blotter_ID);
			}


	}
}