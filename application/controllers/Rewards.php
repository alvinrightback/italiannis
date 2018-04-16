
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rewards extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('rewards_model');
		$this->check_admin();
	}


	public function index(){
		$data['title'] = "Rewards";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['cards'] = $this->get_data->get_all_value_and_order_by('card', 'date_created', 'desc');
		$data['current_discount'] = $this->get_data->get_value('aux_value','auxillary', array('aux_group'=>'reward_discount'));
		$this->render('rewards/main', $data);
	}

	public function get_card_details(){
		$data['card_details'] = $this->get_data->get_value_where('card', array('card_id' => $this->input->post('id', TRUE)));
		$data['card_history'] = $this->get_data->get_value_where_and_order_by('card_history', array('card_id' => $this->input->post('id', TRUE)), 'date_created', 'desc');
		echo json_encode($data);
	}

	public function change_discount_percentage(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('inputDiscountPercentage', 'Discount Percentage', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('failed', 'Failed!');
			$this->index();
		}
		else{
			$query = $this->rewards_model->change_discount_percentage();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('rewards');
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('rewards');
				}
		}
	}

	public function add_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Card_String', 'Card String', 'trim|strip_tags');
		$this->form_validation->set_rules('Initial_Value', 'Initial Value', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('failed', 'Failed!');
			$this->index();
		}
		else{
			if(!$this->get_data->get_value_where('card', array('card_string'=> $this->input->post('Card_String')))){
				$query = $this->rewards_model->add();
				if($query){
					$this->session->set_flashdata('success', 'Successful!');
					redirect('rewards');
				}
				else{
					$this->session->set_flashdata('failed', 'Failed!');
					redirect('rewards');
				}
			}
			else{
				$this->session->set_flashdata('failed', 'Item name already exist!');
				redirect('rewards');
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
