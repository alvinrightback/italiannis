<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {


	public function index()
	{
		$data['title'] = 'Login';
		$data['error'] = $this->session->flashdata('error');
		$this->load->view('login', $data);
	}
	public function validate_credentials(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_validateUser');

		if($this->form_validation->run() == FALSE){
			redirect('login');
		}
		else{
			redirect('dashboard');
		}
	}

	public function validateUser(){
		$username = $this->input->post('username', TRUE);
		$passFromForm = $this->input->post('password', TRUE);
		$passFromDB = $this->get_data->get_value('password', 'users', array('username'=> $username, 'user_role_id'=> 1));

		if($passFromDB){
			if(sha1($passFromForm) === $passFromDB){
				$userID = $this->get_data->get_value('user_id', 'users', array('username'=> $username, 'user_role_id'=> 1));
				$this->session_model->setSessionData($userID);
				return TRUE;
			}
			else{
				$this->session->set_flashdata('error','Password is incorrect');
				return FALSE;
			}

		}
		else{
			$this->session->set_flashdata('error','Username and Password is incorrect');
			return FALSE;
		}

	}

}
