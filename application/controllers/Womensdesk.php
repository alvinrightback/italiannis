<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Womensdesk extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('womensdesk_model');
	}

	public function index(){
		$data['title'] = "Womens Desk";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['citizens'] = $this->get_data->get_all_value('tbl_citizens');
		$data['womensdesk'] = $this->womensdesk_model->get_apprehensions();
		$this->render('womensdesk/main', $data);
	}

	public function add(){
		$data['title'] = "Womens Desk";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['citizens'] = $this->get_data->get_value_where('tbl_citizens', array('Citizen_ID !='=> $this->uri->segment(3)));
		$data['citizen_data'] = $this->get_data->get_value_where('tbl_citizens', array('Citizen_ID'=>$this->uri->segment(3)));
		$data['guardian_type'] = $this->get_data->get_value_where('ref_auxillary', array('Aux_Group'=> 'Guardian_Type'));
		$this->render('womensdesk/add', $data);	
	}

	public function add_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Apprehension_ID', 'Apprension ID', 'trim|strip_tags');
		$this->form_validation->set_rules('Citizen_ID', 'Citizen ID', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Apprehension_DateTime', 'Apprension Date and Time', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Apprehension_Location', 'Apprehension Location', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Apprehension_Narrative', 'Apprehension Narrative', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Apprehension_Remarks', 'Apprehension Remarks', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Guardian_Type_ID', 'Guardian Type ID', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Guardian_Type_ID_Name', 'Guardian Type ID Name', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Guardian_Citizen_ID', 'Guardian Citizen ID', 'trim|strip_tags');
	  	$this->form_validation->set_rules('OIC_FullName', 'OIC Full Name', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->add();
		}
		else{	
			$query = $this->womensdesk_model->add();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('womensdesk/view/'.$query);
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				$this->add();
			}
		}
	}

	public function view(){
		$data['title'] = "Womens Desk";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['apprehension_data'] = $this->womensdesk_model->get_apprehension($this->uri->segment(3));
		$data['guardian_data'] = $this->womensdesk_model->get_guardian($this->uri->segment(3));
		$this->render('womensdesk/view', $data);
	}

	public function edit(){
		$data['title'] = "Womens Desk";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['apprehension_data'] = $this->womensdesk_model->get_apprehension($this->uri->segment(3));
		$data['guardian_data'] = $this->womensdesk_model->get_guardian($this->uri->segment(3));
		$data['guardian_type'] = $this->get_data->get_value_where('ref_auxillary', array('Aux_Group'=> 'Guardian_Type'));
		$this->render('womensdesk/edit', $data);
	}
}