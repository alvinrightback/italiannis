
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

	public function display_orders(){
		$query = $this->mobile_model->display_orders();
		if($query){
			$data['status'] = 1;
			$data['message'] = 'success';
			$data['order_details'] = $query;
			echo json_encode($data);
		}
		else{
			$data['status'] = 0;
			$data['message'] = 'failed';
			$data['order_details'] = $query;
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
		$query = $this->mobile_model->check_availability();
		if($query){
			$data['status'] = 1;
			$data['message'] = 'success';
			$data['availability'] = $query;
			echo json_encode($data);
		}
		else{
			$data['status'] = 0;
			$data['message'] = 'failed';
			$data['availability'] = $query;
			echo json_encode($data);
 		}
	}
}