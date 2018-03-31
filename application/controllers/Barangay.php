<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barangay extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('barangay_model');
	}

	public function index(){
		$data['title'] = "Barangay";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['barangay'] = $this->get_data->get_all_value('tbl_barangay');
		$this->render('barangay/main', $data);
	}

	public function add(){
		$data['title'] = "Barangay";
		$this->render('barangay/add', $data);

	}

	public function add_now(){
		$this->load->library('form_validation');
	  	$this->form_validation->set_rules('Barangay_Name', 'Barangay Name', 'trim|required|strip_tags');
	  	$this->form_validation->set_rules('Barangay_Chairman', 'Barangay Chairman', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Barangay_Telephone', 'Barangay Telephone', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Barangay_Zipcode', 'Barangay Zip Code', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->add();
		}
		else{	
			$query = $this->barangay_model->add();
			if($query){
				$this->session->set_flashdata('success', 'Barangay Registration Successful!');
				$this->index();
			}
			else{
				$this->session->set_flashdata('failed', 'Barangay Registration Failed!');
				$this->index();
			}
		}
	}

	public function view(){
		$data['title'] = "Barangay";
		$data['barangay_data'] = $this->get_data->get_value_where('tbl_barangay', array('Barangay_ID' => $this->uri->segment(3)));
		$this->render('barangay/view', $data);
	}

	public function edit(){
		$data['title'] = "Barangay";
		$data['barangay_data'] = $this->get_data->get_value_where('tbl_barangay', array('Barangay_ID' => $this->uri->segment(3)));
		$this->render('barangay/edit', $data);
	}

	public function edit_now(){
		$this->load->library('form_validation');
	  	$this->form_validation->set_rules('Barangay_Name', 'Barangay Name', 'trim|required|strip_tags');
	  	$this->form_validation->set_rules('Barangay_Chairman', 'Barangay Chairman', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Barangay_Telephone', 'Barangay Telephone', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Barangay_Zipcode', 'Barangay Zip Code', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->edit();
		}
		else{	
			$query = $this->barangay_model->edit($this->input->post('Barangay_ID', TRUE));
			if($query){
				$this->session->set_flashdata('success', 'Update Successful!');
				$this->index();
			}
			else{
				$this->session->set_flashdata('failed', 'Updated Failed!');
				$this->index();
			}
		}
	}
}
