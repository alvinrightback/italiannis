
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('inventory_model');
	}


	public function index(){
		$data['title'] = "Transaction";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['inventory'] = $this->get_data->get_all_value_and_order_by('inventory', 'name', 'asc');
		$this->render('transaction/main', $data);
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

	public function edit_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Item_Details_Name', 'Item Name', 'trim|strip_tags');
		$this->form_validation->set_rules('Item_Details_Quantity', 'Quantity', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('failed', 'Failed!');
			$this->index();
		}
		else{
			$query = $this->inventory_model->edit();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('inventory');
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('inventory');
			}
		}

	}

	public function get_item_details(){
		$data['item_details'] = $this->get_data->get_value_where('inventory', array('inventory_id' => $this->input->post('id', TRUE)));
		$data['item_history'] = $this->get_data->get_value_where_and_order_by('inventory_history', array('inventory_id' => $this->input->post('id', TRUE)), 'date_created', 'desc');
		echo json_encode($data);
	}


	public function saleable(){
		$data['title'] = "Inventory";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['saleable'] = $this->inventory_model->get_saleable('product', 'date_created', 'desc');


		for ($i=0; $i < count($data['saleable']) ; $i++) { 
			$temp['inventory'] = $this->inventory_model->get_all_product_inventory($data['saleable'][$i]->inventory_id);
			$data['saleable'][$i]->inventory = $temp['inventory'];
			$insufficient = array();
			foreach($data['saleable'][$i]->inventory as $row){
				if($row->quantity <= 0){
					array_push($insufficient, $row->inventory_id);
				}
			}
			if(!empty($insufficient)){
				$data['saleable'][$i]->insufficient_inventory = $insufficient;
			}

			else{
			 	$data['saleable'][$i]->available_serving = $temp['inventory'][0]->quantity;	
			}
		}
		$this->render('inventory/saleable', $data);
	}


	public function edit_product_quantity(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Add_Quantity', 'Quantity', 'trim|strip_tags');
		$this->form_validation->set_rules('Product_ID', 'Product ID', 'trim|strip_tags');
		$this->form_validation->set_rules('Product_Inventory_ID', 'Inventory_ID', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('failed', 'Failed!');
			$this->index();
		}
		else{
			$query = $this->inventory_model->edit_product_quantity($this->input->post('inventory_id'));
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('inventory/saleable');
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('inventory/saleable');
			}
		}
	}
}
