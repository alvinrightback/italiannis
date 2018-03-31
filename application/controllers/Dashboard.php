<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct(){
		parent::__construct();
		//$this->load->model('dashboard_model');
	}


	public function index(){
		 $data['title'] = "Dashboard";
		// $data['citizen_count'] = $this->get_data->get_count('tbl_citizens');
		// $data['citizen_per_barangay'] = $this->dashboard_model->get_citizen_per_barangay();
		// $data['trm_count'] = $this->get_data->get_count('tbl_trm');
		// $data['trm_per_barangay'] = $this->dashboard_model->get_trm_per_barangay();
		// $data['job_per_type'] = $this->dashboard_model->get_job_per_type();
		// $data['job_count'] = $this->get_data->get_count('tbl_job_listing');
		$this->render('dashboard/main', $data);
	}

}
