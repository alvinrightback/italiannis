
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('product_model');
	}


	public function index(){
		$data['title'] = "Product";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['products'] = $this->product_model->get_products();
		$data['product_category'] = $this->get_data->get_value_where('auxillary', array('aux_group'=>'product_category'));
		$data['inventory'] = $this->get_data->get_value_where('inventory', array('quantity >' => 0));
		$this->render('product/main', $data);
	}

	public function add_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Product_Name', 'Product Name', 'trim|strip_tags');
		$this->form_validation->set_rules('Product_Code', 'Product Code', 'trim|strip_tags|is_unique[product.product_code]');
		$this->form_validation->set_rules('Product_Description', 'Description', 'trim|strip_tags');
		$this->form_validation->set_rules('Product_Price', 'Price', 'trim|strip_tags');
		$this->form_validation->set_rules('Product_Category', 'Category', 'trim|strip_tags');
		$this->form_validation->set_rules('inventory_id', 'Inventory ID', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('failed', 'Failed!');
			$this->index();
		}
		else{
			$query = $this->product_model->do_upload('add');
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('product');
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('product');
			}
			
		}
	}

	public function get_product_details(){
		$data['product_details'] = $this->product_model->get_product($this->input->post('id'));
		$data['product_details_inventory'] = $this->product_model->get_product_inventory($data['product_details'][0]->inventory_id);
		echo json_encode($data);
	}

	public function edit(){
		$data['title'] = "Product";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['product_details'] = $this->product_model->get_product($this->uri->segment(3));
		$data['product_details_inventory'] = $this->product_model->get_product_inventory($data['product_details'][0]->inventory_id);
		$data['product_category'] = $this->get_data->get_value_where('auxillary', array('aux_group'=>'product_category'));
		$data['inventory'] = $this->get_data->get_value_where('inventory', array('quantity >' => 0));
		$this->render('product/edit', $data);

	}


	public function edit_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Product_Status', 'Product Status', 'trim|strip_tags');
		$this->form_validation->set_rules('Product_Name', 'Product Name', 'trim|strip_tags');
		$this->form_validation->set_rules('Product_Description', 'Description', 'trim|strip_tags');
		$this->form_validation->set_rules('Product_Price', 'Price', 'trim|strip_tags');
		$this->form_validation->set_rules('Product_Category', 'Category', 'trim|strip_tags');
		$this->form_validation->set_rules('inventory_id', 'Inventory ID', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('failed', 'Failed!');
			$this->index();
		}
		else{
			if(!empty($_FILES['userfile']['name'])){
				$query = $this->product_model->do_upload('edit');
			}
			else{
				$query = $this->product_model->edit(NULL,NULL);
			}

			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('product/edit/'.$query);
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('product/edit/'.$query);
			}
			
		}

	}

}
