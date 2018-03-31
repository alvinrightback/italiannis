<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('jobs_model');
	}

	public function index(){
		$data['title'] = "Jobs";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['jobs'] = $this->jobs_model->get_jobs();
		$this->render('jobs/main', $data);
	}

	public function add(){
		$data['title'] = "Jobs";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['employment_type'] = $this->get_data->get_value_where('ref_auxillary', array('Aux_Group'=>'Employment_Type'));
		$data['barangay'] = $this->get_data->get_all_value('tbl_barangay');
		$this->render('jobs/add', $data);
	}

	public function add_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Job_Employment_Type_ID', 'Employment Type', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Name', 'Job Name', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Description', 'Job Description', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Qualification', 'Job Qualification', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Benefits', 'Benefits', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Working_Hours', 'Working Hours', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Date_Closed', 'Closing Date', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Dress_Code', 'Dress Code', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Minimum_Year_Exp', 'Minimum Years Experience', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Salary_Rate_Range', 'Salary Rate Range', 'trim|strip_tags');
		$this->form_validation->set_rules('Job_Barangay_ID', 'Job Barangay ID', 'trim|strip_tags');
		$this->form_validation->set_rules('Job_Location', 'Location', 'trim|strip_tags');
		
		if($this->form_validation->run() == FALSE){
			$this->add();
		}
		else{	
			$barangay_ID = $this->get_data->get_value('Barangay_ID','tbl_users',array('User_ID'=>$this->session->userdata('user_id')));
			$query = $this->jobs_model->add_job($barangay_ID);
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				$this->index();
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				$this->add();
			}
		}
	}

	public function view(){
		$data['title'] = "Jobs";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['job_data'] = $this->jobs_model->get_job($this->uri->segment(3));
		$this->render('jobs/view', $data);
	}

	public function edit(){
		$data['title'] = "Jobs";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['employment_type'] = $this->get_data->get_value_where('ref_auxillary', array('Aux_Group'=>'Employment_Type'));
		$data['barangay'] = $this->get_data->get_all_value('tbl_barangay');
		$data['job_data'] = $this->get_data->get_value_where('tbl_job_listing', array('Job_ID'=> $this->uri->segment(3)));
		$this->render('jobs/edit', $data);
	}

	public function edit_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Job_Employment_Type_ID', 'Employment Type', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Name', 'Job Name', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Description', 'Job Description', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Qualification', 'Job Qualification', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Benefits', 'Benefits', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Working_Hours', 'Working Hours', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Date_Closed', 'Closing Date', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Dress_Code', 'Dress Code', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Minimum_Year_Exp', 'Minimum Years Experience', 'trim|strip_tags');
	  	$this->form_validation->set_rules('Job_Salary_Rate_Range', 'Salary Rate Range', 'trim|strip_tags');
		$this->form_validation->set_rules('Job_Barangay_ID', 'Job Barangay ID', 'trim|strip_tags');
		$this->form_validation->set_rules('Job_Location', 'Location', 'trim|strip_tags');
		
		if($this->form_validation->run() == FALSE){
			redirect('jobs/edit/'.$this->input->post('Job_ID'));
		}
		else{	
			$barangay_ID = $this->get_data->get_value('Barangay_ID','tbl_users',array('User_ID'=>$this->session->userdata('user_id')));
			$query = $this->jobs_model->edit_job($barangay_ID);
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('jobs/view/'.$query);
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('jobs/edit/'.$query);
			}
		}
	}

}