
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forecasting extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('forecasting_model');
    }
    
    public function index(){
		$data['title'] = "Forecasting";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		//$data['orders'] = $this->display_model->get_orders();
		$this->load->view('forecasting/main', $data);
	}
}