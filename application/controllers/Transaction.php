
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('transaction_model');
		$this->check_admin();
	}


	public function index(){
		$data['title'] = "Transaction";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['transaction'] = $this->get_data->get_all_value_and_order_by('transaction', 'date_created', 'desc');
		$this->render('transaction/main', $data);
	}

	public function get_all_transactions(){
		echo json_encode($this->get_data->get_all_value_and_order_by('transaction', 'date_created', 'desc'));
	}
	public function get_transaction_details(){
		echo json_encode($this->transaction_model->get_transaction_details());
	}

	public function add_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Item_Name', 'Item Name', 'trim|strip_tags');
		$this->form_validation->set_rules('Quantity', 'Quantity', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('failed', 'Failed!');
			$this->index();
		}
		else{
			if(!$this->get_data->get_value_where('inventory', array('name'=> $this->input->post('Item_Name')))){
				$query = $this->inventory_model->add();
				if($query){
					$this->session->set_flashdata('success', 'Successful!');
					redirect('inventory');
				}
				else{
					$this->session->set_flashdata('failed', 'Failed!');
					redirect('inventory');
				}
			}
			else{
				$this->session->set_flashdata('failed', 'Item name already exist!');
				redirect('inventory');
			}	
			
		}
	}

	public function edit_orders(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Edit_Trans_Id', 'Trans ID', 'trim|strip_tags');
		$this->form_validation->set_rules('trans_details_id', 'Trans Details ID', 'trim|strip_tags');
		$this->form_validation->set_rules('order_quantity', 'Order Quantity', 'trim|strip_tags');
		$this->form_validation->set_rules('order_status', 'Order Status', 'trim|strip_tags');
		$this->form_validation->set_rules('order_delete', 'Order Delete', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('failed', 'Failed!');
			$this->index();
		}
		else{
			$query = $this->transaction_model->edit_orders();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('transaction');
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('transaction');
			}
		}
	}

	public function payment_complete($id){
		$query = $this->transaction_model->payment_complete($id);
		if($query){
			$this->session->set_flashdata('success', 'Successful!');
			redirect('transaction');
		}
		else{
			$this->session->set_flashdata('failed', 'Failed!');
			redirect('transaction');
		}
	}
}
