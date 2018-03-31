<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('accounts_model');
	}

	public function index(){
		$data['title'] = "Accounts";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['users'] = $this->accounts_model->get_users();
		$this->render('accounts/users/main', $data);
	}

	public function add(){
		$data['title'] = "Accounts";
		$data['barangay'] = $this->get_data->get_all_value('tbl_barangay');
		$data['roles'] = $this->get_data->get_value_where('ref_user_roles', array('User_Role_ID !=' => 1 ));
		$this->render('accounts/users/add', $data);

	}

	public function add_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('User_FirstName', 'User First Name', 'trim|required|alpha|strip_tags');
		$this->form_validation->set_rules('User_MiddleName', 'User Middle Name', 'trim|required|alpha|strip_tags');
		$this->form_validation->set_rules('User_LastName', 'User Last Name', 'trim|required|alpha|strip_tags');
		$this->form_validation->set_rules('User_Role_ID', 'User Role ID', 'trim|required|numeric|strip_tags');
		$this->form_validation->set_rules('User_Email', 'User Email Address', 'trim|required|valid_email|strip_tags');
		$this->form_validation->set_rules('Barangay_ID', 'Barangay ID', 'trim|required|numeric|strip_tags');

		if($this->form_validation->run() == FALSE){
			$this->add();
		}
		else{
			$password = $this->get_data->get_value('Default_Value', 'tbl_defaults', array('Default_Name'=>'Password'));
			$affix = $this->get_data->get_value('User_Role_Affix', 'ref_user_roles', array('User_Role_ID'=>$this->input->post('User_Role_ID', TRUE)));
			$zip = $this->get_data->get_value('Barangay_Zipcode', 'tbl_barangay', array('Barangay_ID'=>$this->input->post('Barangay_ID', TRUE)));
			$id = $this->get_data->get_max_id('User_ID', 'tbl_users');

			$username = 'bce'.$affix.$zip.($id+1);
			$query = $this->accounts_model->add($password, $username);
			if($query){
				$this->session->set_flashdata('success', 'User Registration Successful!');
				$this->index();
			}
			else{
				$this->session->set_flashdata('failed', 'User Registration Failed!');
				$this->index();
			}
		}
	}

	public function view(){
		$data['title'] = "Users";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['user_data'] = $this->accounts_model->get_user($this->uri->segment(3));
		$this->render('accounts/users/view', $data);
	}

	public function edit(){
		$data['title'] = "Users";
		$data['barangay'] = $this->get_data->get_all_value('tbl_barangay');
		$data['roles'] = $this->get_data->get_value_where('ref_user_roles', array('User_Role_ID !=' => 0 ));
		$data['user_data'] = $this->accounts_model->get_user($this->uri->segment(3));
		$this->render('accounts/users/edit', $data);
	}

	public function edit_now(){
		$this->load->library('form_validation');
		$existing_username = $this->get_data->get_value('User_Name', 'tbl_users', array('User_ID'=>$this->input->post('User_ID', TRUE)));

		if($this->input->post('User_Name', TRUE) != $existing_username){
		$this->form_validation->set_rules('User_Name', 'User Name', 'trim|required|strip_tags|is_unique[	tbl_users.User_Name]');
		}
		else{
		$this->form_validation->set_rules('User_Name', 'User Name', 'trim|required|strip_tags');
		}	
		$this->form_validation->set_rules('User_FirstName', 'User First Name', 'trim|required|alpha|strip_tags');
		$this->form_validation->set_rules('User_MiddleName', 'User Middle Name', 'trim|required|alpha|strip_tags');
		$this->form_validation->set_rules('User_LastName', 'User Last Name', 'trim|required|alpha|strip_tags');
		$this->form_validation->set_rules('User_Role_ID', 'User Role ID', 'trim|required|numeric|strip_tags');
		$this->form_validation->set_rules('User_Email', 'User Email Address', 'trim|required|valid_email|strip_tags');
		$this->form_validation->set_rules('Barangay_ID', 'Barangay ID', 'trim|required|numeric|strip_tags');

		if($this->form_validation->run() == FALSE){
			redirect('users/edit/'.$this->input->post('User_ID', TRUE));
		}
		else{
			$query = $this->accounts_model->edit($this->input->post('User_ID'));
			if($query){
				$this->session->set_flashdata('success', 'Update Successful!');
				$this->index();
			}
			else{
				$this->session->set_flashdata('failed', 'Update Failed!');
				$this->index();
			}
		}
	}

	public function reset_password($id){
		$default_pass = $this->get_data->get_value('Default_Value', 'tbl_defaults', array('Default_Name'=>'Password'));
		$query = $this->accounts_model->reset_password($default_pass, $id);
		if($query){
			$this->session->set_flashdata('success', 'Update Successful!');
			redirect('users/view/'.$query);
		}
		else{
			$this->session->set_flashdata('failed', 'Update Failed!');
			redirect('users/view/'.$query);
		}
	}

	public function change_status($id){
		$current_status = $this->get_data->get_value('User_Status', 'tbl_users', array('User_ID'=>$id));
		$query = $this->accounts_model->change_status($current_status, $id);
		if($query){
			$this->session->set_flashdata('success', 'Update Successful!');
			redirect('users/view/'.$query);
		}
		else{
			$this->session->set_flashdata('failed', 'Update Failed!');
			redirect('users/view/'.$query);
		}
	}
}
