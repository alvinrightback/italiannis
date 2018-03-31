<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('accounts_model');
	}


	public function change_password(){
		$data['title'] = "Account";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$this->render('accounts/password/main', $data);
	}

	public function password_update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('oldPassword', 'Old Password', 'trim|required|callback_checkOldPassword');
		$this->form_validation->set_rules('newPassword', 'New Password', 'trim|required|matches[newPasswordConfirm]');
		$this->form_validation->set_rules('newPasswordConfirm', 'Confirm Password', 'trim|required');
		if($this->form_validation->run() == FALSE){
			$this->change_password();
		}
		else{	
			$query = $this->accounts_model->update_password($this->session->userdata('user_id'));
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('user/change_password');
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('user/change_password');
			}
		}
	}

	public function checkOldPassword(){
		$PassFromDB = $this->get_data->get_value('password','users', array('user_id'=> $this->session->userdata('user_id')));
		$PassFromForm = $this->input->post('oldPassword', TRUE);
		if(sha1($PassFromForm) == $PassFromDB){
			$PassFromForm = $this->input->post('newPassword', TRUE);
			if(sha1($PassFromForm) != $PassFromDB){
				return TRUE;
			}
			else{
				$this->form_validation->set_message('checkOldPassword', 'Same password is not allowed');
				return FALSE;	
			}
		}
		else{
			$this->form_validation->set_message('checkOldPassword', 'Incorrect password');
			return FALSE;
		}
	}
}
