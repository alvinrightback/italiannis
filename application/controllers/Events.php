<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('events_model');
	}

	public function index(){
		$data['title'] = "Events";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['events'] = $this->events_model->get_events();
		$this->render('events/main', $data);
	}

	public function add(){
		$data['title'] = "Events";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['barangay'] = $this->get_data->get_all_value('tbl_barangay');
		$this->render('events/add', $data);
	}

	public function add_now(){
		$this->load->library('form_validation');
	  	$this->form_validation->set_rules('Event_Name', 'Event Name', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Event_Start', 'Start Date', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Event_End', 'End Date', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Event_Location', 'Location', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Event_Description', 'Description', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Event_Barangay_ID', 'Event Barangay ID', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->add();
		}
		else{	
			$barangay_ID = $this->get_data->get_value('Barangay_ID','tbl_users',array('User_ID'=>$this->session->userdata('user_id')));
			$query = $this->events_model->do_upload($barangay_ID);
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('events/view/'.$query);
			}
			else{
				if($this->session->flashdata('upload_error')){
					$this->session->set_flashdata('failed', 'Failed!');
				}
				$this->add();
			}
		}
	}

	public function view(){
		$data['title'] = "Events";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['event_data'] = $this->get_data->get_value_where('tbl_events', array('Event_ID'=>$this->uri->segment(3)));
		$this->render('events/view', $data);
	}

	public function edit(){
		$data['title'] = "Events";
		$data['barangay'] = $this->get_data->get_all_value('tbl_barangay');
		$data['event_data'] = $this->get_data->get_value_where('tbl_events', array('Event_ID'=>$this->uri->segment(3)));
		$this->render('events/edit', $data);
	}

	public function edit_now(){
		$this->load->library('form_validation');
	  	$this->form_validation->set_rules('Event_Name', 'Event Name', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Event_Start', 'Start Date', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Event_End', 'End Date', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Event_Location', 'Location', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Event_Description', 'Description', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Event_Barangay_ID', 'Event Barangay ID', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			redirect('events/edit/'.$this->input->post('Event_ID', TRUE));
		}
		else{	
			$query = $this->events_model->edit_event($this->input->post('Event_ID', TRUE));
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('events/view/'.$query);
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('events/edit/'.$query);
			}
		}
	}
}