
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

	public function bill_out(){
		$query = $this->mobile_model->bill_out();
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

	public function get_current_quantity(){
		$query = $this->mobile_model->get_current_quantity();
		if($query){
			$data['status'] = 1;
			$data['message'] = 'success';
			$data['current_quantity'] = $query;
			echo json_encode($data);
		}
		else{
			$data['status'] = 0;
			$data['message'] = 'failed';
			$data['current_quantity'] = $query;
			echo json_encode($data);
 		}
	}

	public function changeInvoice(){
		$query = $this->db->get('transaction');
		foreach($query->result() as $row){
			$this->db->select('CONCAT( "I-", LPAD(trans_id,7,"0") ) as invoice_id');
			$query1 = $this->db->get_where('transaction', array('trans_id'=>$row->trans_id));

			$this->db->update('transaction', array('invoice_id' => $query1->result()[0]->invoice_id), array('trans_id'=>$row->trans_id));
		}
	}

	public function register_card(){
		$query = $this->mobile_model->register_card();
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

	public function check_card(){
		$query = $this->mobile_model->check_card();
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