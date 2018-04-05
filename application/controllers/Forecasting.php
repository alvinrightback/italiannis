
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forecasting extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('forecasting_model');
		$this->load->model('product_model');
   }
    
   public function index(){
		$data['title'] = "Forecasting";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		//$data['orders'] = $this->display_model->get_orders();
		$data['products'] = $this->product_model->get_products();
		$this->render('forecasting/main', $data);
	}

	public function product_forecast(){
		$data['title'] = "Forecasting";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		//$data['orders'] = $this->display_model->get_orders();
		$data['products'] = $this->product_model->get_products();
		$this->render('forecasting/product', $data);		
	}

	public function get_yearly_sales(){
		echo json_encode($this->forecasting_model->get_yearly_sales());
	}

	public function get_yearly_sales_forecast(){
		echo json_encode($this->forecasting_model->get_yearly_sales_forecast());
	}

	public function get_product_yearly_sales(){
		echo json_encode($this->forecasting_model->get_product_yearly_sales());
	}

	public function get_product_yearly_sales_forecast(){
		echo json_encode($this->forecasting_model->get_product_yearly_sales_forecast());
	}
}