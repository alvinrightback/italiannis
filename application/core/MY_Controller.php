<?php if (! defined('BASEPATH')) exit('No direct script access');

class MY_Controller extends CI_Controller {

	public $data;

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->check_auth();
		$this->get_userdata(); 
		//$this->get_notification();
	}

	private function check_auth(){
		if($this->router->class == 'login'){
			if($this->session->all_userdata()){
				if($this->session->userdata('is_logged_in') && $this->session->userdata('role') == 1 ){
					redirect('dashboard');
				}
				else if($this->session->userdata('is_logged_in') && $this->session->userdata('role') == 2 ){
					redirect('display/manage');
				}
				else if($this->session->userdata('is_logged_in') && $this->session->userdata('role') == 3 ){
					redirect('display');
				}
				else{
				}
			}
			else{
				$this->session->sess_destroy();
				redirect('login');
			}
		}
		else{
			if($this->session->all_userdata()){
				if(!$this->session->userdata('is_logged_in')){
					if($this->session->userdata('role') != 1 || $this->session->userdata('role') != 2 || $this->session->userdata('role') != 3 ){
						$this->session->sess_destroy();
						redirect('login');
					}
				}
			}
			else{
				$this->session->sess_destroy();
				redirect('login');
			}
		}
	}

	private function get_userdata(){
		if($this->session->userdata('is_logged_in') == TRUE){
			$this->data['user_role'] = $this->get_data->get_value('user_role_name','user_roles', array('user_role_id'=> $this->session->userdata('role')));
			$this->data['user_name'] = $this->get_data->get_value('username','users', array('user_id'=> $this->session->userdata('user_id')));
		}

	}
	
	public function check_admin(){
		if($this->session->userdata('role') != 1){
			redirect();
		}
	}

	private function get_notification(){
		$this->data['notifications'] = $this->notification_model->get_notifications();
	}

	public function render($view, $data) {
		$this->load->view('template/header', $data);
		$this->load->view('template/topnav', $this->data);
		$this->load->view('template/mainnav');
		$this->load->view($view, $data);
		$this->load->view('template/footer');
	}
}