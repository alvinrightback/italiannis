<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->check_admin();
	}


	public function index(){
		$data['title'] = "Dashboard";
		$data['pending_orders'] = $this->dashboard_model->get_pending_orders();
		$data['occupied_tables'] = $this->dashboard_model->get_today_occupied_tables();
		$data['today_sales'] = $this->dashboard_model->get_today_sales();
		$this->render('dashboard/main', $data);
	}

}
