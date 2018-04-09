
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('mobile_model');
	}


	public function get_menu(){
		$data['menu'] = $this->mobile_model->get_menu();
		if($data['menu']){
			$data['status'] = 1;
			$data['message'] = 'success';
			echo json_encode($data);
		}
		else{
			$data['status'] = 0;
			$data['message'] = 'failed';
			echo json_encode($data);
 		}
	}

	public function submit_orders(){
		$query = $this->mobile_model->submit_orders();
		if($query){
			$data['status'] = 1;
			$data['message'] = 'success';
			echo json_encode($data);
		}
		else{
			$data['status'] = 0;
			$data['message'] = 'failed';
			echo json_encode($data);
 		}
	}

	public function check_availability(){
		$data['availability'] = $this->mobile_model->check_availability();
		if($query){
			$data['status'] = 1;
			$data['message'] = 'success';
			echo json_encode($data);
		}
		else{
			$data['status'] = 0;
			$data['message'] = 'failed';
			echo json_encode($data);
 		}
	}
}