
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Display extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('display_model');
	}


	public function index(){
		$data['title'] = "Kitchen Display";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['orders'] = $this->display_model->get_orders();
		$this->load->view('display/main', $data);
	}

	public function manage(){
		$data['title'] = "Kitchen Display";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['orders'] = $this->display_model->get_orders();
		$this->render('display/manage', $data);
	}

	public function get_order(){
		echo json_encode($this->display_model->get_order());
	}

	public function finish_order(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('trans_details_id', 'Item Name', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('failed', 'Failed!');
			$this->index();
		}
		else{
			$query = $this->display_model->finish_orders();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('display/manage');
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('display/manage');
			}
		}
	}
}