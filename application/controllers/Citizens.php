<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Citizens extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('citizen_model');
		$this->load->model('address_model');
		$this->load->model('property_model');
	}


	public function index(){
		$data['title'] = "Citizens";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['citizens'] = $this->citizen_model->get_citizens_with_barangay();
		$this->render('citizens/main', $data);
	}


	public function add($redirectURL = NULL, $redirectFunction = NULL, $redirectValue = NULL){
		if(isset($redirectURL)){
			$this->session->set_userdata('redirectURL', $redirectURL);
			if(isset($redirectFunction)){
				$this->session->set_userdata('redirectFunction', $redirectFunction);
				if(isset($redirectValue)){
					$this->session->set_userdata('redirectValue', $redirectValue);
				}
			}
		}
		$data['title'] = "Citizens";
		$data['barangay'] = $this->get_data->get_all_value('tbl_barangay');
		$data['nationality'] = $this->get_data->get_all_value('tbl_nationality');
		$data['address'] = $this->address_model->get_address_with_barangay();
		$this->render('citizens/add', $data);
	}

	public function add_now(){
		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Citizen_Title', 'Title', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Citizen_NickName', 'Nick Name', 'trim|alpha|strip_tags');
		$this->form_validation->set_rules('Citizen_Suffix', 'Name Suffix', 'trim|strip_tags');
		$this->form_validation->set_rules('Citizen_LastName', 'Last name', 'trim|required|strip_tags|alpha');
		$this->form_validation->set_rules('Citizen_FirstName', 'First name', 'trim|required|strip_tags|alpha');
		$this->form_validation->set_rules('Citizen_MiddleName', 'Middle name', 'trim|strip_tags');
		$this->form_validation->set_rules('Citizen_Gender', 'Gender', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Citizen_CivilStatus', 'Civil Status', 'trim|required|strip_tags');
		
		$this->form_validation->set_rules('Barangay_ID', 'Barangay1', 'trim|required|numeric|strip_tags');
		$this->form_validation->set_rules('address1', 'Current Address', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Citizen_CurrentAddress', 'Current Address', 'trim|numeric|strip_tags');
		$this->form_validation->set_rules('currentAddressFrom', 'Current Address From', 'trim|required|strip_tags');
		$this->form_validation->set_rules('currentAddressTo', 'Current Address To', 'trim|required|strip_tags');
		if($this->input->post('Citizen_CurrentAddress', TRUE) == NULL){	
			$data['address1'] = $this->address_model->add_address($this->input->post('address1', TRUE), $this->input->post('Barangay_ID', TRUE));
		}
		else{
			$this->form_validation->set_rules('Citizen_CurrentAddress', 'Current Address', 'trim|required|strip_tags');
		}

		// $this->form_validation->set_rules('Barangay_ID_Permanent', 'Barangay2', 'trim|required|strip_tags');
		// $this->form_validation->set_rules('address2', 'Permanent Address', 'trim|required|strip_tags');
		// $this->form_validation->set_rules('Citizen_PermanentAddress', 'Permanent Address', 'trim|numeric|strip_tags');
		// $this->form_validation->set_rules('permanentAddressFrom', 'Permanent Address From', 'trim|required|strip_tags');
		// $this->form_validation->set_rules('permanentAddressTo', 'Permanent Address To', 'trim|required|strip_tags');
		// if($this->input->post('Citizen_PermanentAddress', TRUE) == NULL){	
		// 	$data['address2'] = $this->address_model->add_address($this->input->post('address2', TRUE), $this->input->post('Barangay_ID_Permanent', TRUE));
		// }	
		// else{
		// 	$this->form_validation->set_rules('Citizen_PermanentAddress', 'Permanent Address', 'trim|required|strip_tags');
		// }
		
		$this->form_validation->set_rules('Nationality_ID', 'Nationality', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Citizen_BirthDate', 'Birthdate', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Citizen_BirthPlace', 'Birth Place', 'trim|strip_tags');
		$this->form_validation->set_rules('Citizen_Mobile', 'Mobile Number', 'trim|strip_tags|numeric');
		$this->form_validation->set_rules('Citizen_Telephone', 'Telephone Number', 'trim|strip_tags|numeric');
		$this->form_validation->set_rules('Citizen_HighestEducationAttainment', 'Highest Educational Attainment', 'trim|strip_tags');
		$this->form_validation->set_rules('Citizen_Email', 'Email address', 'trim|strip_tags|valid_email|is_unique[tbl_citizens.Citizen_Email]');
		$this->form_validation->set_rules('Citizen_NameOfFather', 'Name of Father', 'trim|strip_tags');
		$this->form_validation->set_rules('Citizen_NameOfMother', 'Name of Mother', 'trim|strip_tags');
		$this->form_validation->set_rules('Citizen_NameOfSpouse', 'Name of Spouse', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE)	{
			$this->add();
		}
		else{	
			$query = $this->citizen_model->add($data);
			if($query){
				$this->session->set_flashdata('success', 'Citizen Registration Successful!');
				if($this->session->has_userdata('redirectURL') && $this->session->has_userdata('redirectFunction') && $this->session->has_userdata('redirectValue')) {
					$url = $this->session->userdata('redirectURL');
					$function = $this->session->userdata('redirectFunction');
					$value = $this->session->userdata('redirectValue');
					$array_items = array('redirectURL', 'redirectFunction','redirectValue');
					$this->session->unset_userdata($array_items);
					redirect($url.'/'.$function.'/'.$value);
				}
				else if($this->session->has_userdata('redirectURL') && $this->session->has_userdata('redirectFunction')) {
					$url = $this->session->userdata('redirectURL');
					$function = $this->session->userdata('redirectFunction');
					$array_items = array('redirectURL', 'redirectFunction');
					$this->session->unset_userdata($array_items);
					redirect($url.'/'.$function.'/'.$query);
				}
				else if($this->session->has_userdata('redirectURL')){
					$this->session->unset_userdata('redirectURL');
					$url = $this->session->userdata('redirectURL');
					redirect($url);
				}
				else{
					redirect('citizens/view/'.$query);
				}
			}
			else{
				$this->session->set_flashdata('failed', 'Citizen Registration Failed!');
				$this->add();
			}
		}
	}

	public function customAlpha($str){
		if ( !preg_match('/^[a-z .,\-]+$/i',$str) ){
			$this->form_validation->set_message('customAlpha', 'Invalid Name Format');
			return false;
		}
	}

	public function view(){
		$data['title'] = "Citizens";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$conditions = array('Citizen_ID' => $this->uri->segment(3));
		$data['citizen_data'] = $this->get_data->get_value_where('tbl_citizens', $conditions);
		$data['barangay'] = $this->get_data->get_value_where('tbl_barangay', array('Barangay_ID' => $data['citizen_data'][0]->Barangay_ID));
		$data['nationality'] = $this->get_data->get_value_where('tbl_nationality', array('Nationality_ID' => $data['citizen_data'][0]->Nationality_ID));
		$data['currentAddress'] = $this->address_model->get_address($data['citizen_data'][0]->Citizen_CurrentAddress);
		$data['permanentAddress'] = $this->address_model->get_address($data['citizen_data'][0]->Citizen_PermanentAddress);
		$data['history_address'] = $this->address_model->get_address_history($data['citizen_data'][0]->Citizen_ID);
		$data['properties'] = $this->property_model->get_citizen_property($this->uri->segment(3));
		$data['trm_data'] = $this->get_data->get_value_where('tbl_trm', $conditions);
		$this->render('citizens/view', $data);
	}

	public function edit(){
		$data['title'] = "Citizens";
		$conditions = array('Citizen_ID' => $this->uri->segment(3));
		$data['citizen_data'] = $this->get_data->get_value_where('tbl_citizens', $conditions);
		$data['barangay'] = $this->get_data->get_all_value('tbl_barangay');
		$data['nationality'] = $this->get_data->get_all_value('tbl_nationality');
		$this->render('citizens/edit', $data);
	}


	public function edit_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Citizen_Title', 'Title', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Citizen_NickName', 'Nick Name', 'trim|strip_tags');
		$this->form_validation->set_rules('Citizen_Suffix', 'Name Suffix', 'trim|strip_tags');
		$this->form_validation->set_rules('Citizen_LastName', 'Last name', 'trim|required|strip_tags|alpha');
		$this->form_validation->set_rules('Citizen_FirstName', 'First name', 'trim|required|strip_tags|alpha');
		$this->form_validation->set_rules('Citizen_MiddleName', 'Middle name', 'trim|strip_tags|alpha');
		$this->form_validation->set_rules('Citizen_Gender', 'Gender', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Citizen_CivilStatus', 'Civil Status', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Barangay_ID', 'Barangay', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Nationality_ID', 'Nationality', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Citizen_BirthDate', 'Birthdate', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Citizen_BirthPlace', 'Birth Place', 'trim|strip_tags');
		$this->form_validation->set_rules('Citizen_Mobile', 'Mobile Number', 'trim|strip_tags|numeric');
		$this->form_validation->set_rules('Citizen_Telephone', 'Telephone Number', 'trim|strip_tags|numeric');
		$this->form_validation->set_rules('Citizen_Email', 'Email address', 'trim|strip_tags|valid_email');
		$this->form_validation->set_rules('Citizen_NameOfFather', 'Name of Father', 'trim|strip_tags');
		$this->form_validation->set_rules('Citizen_NameOfMother', 'Name of Mother', 'trim|strip_tags');
		$this->form_validation->set_rules('Citizen_NameOfSpouse', 'Name of Spouse', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			redirect('citizens/edit/'.$this->input->post('Citizen_ID', TRUE));
		}
		else{	
			$query = $this->citizen_model->edit($this->input->post('Citizen_ID', TRUE));
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('citizens/view/'.$this->input->post('Citizen_ID', TRUE));
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('citizens/view/'.$this->input->post('Citizen_ID', TRUE));
			}
		}
	}

	public function photo(){
		$data['title'] = "Citizens";
		$conditions = array('Citizen_ID' => $this->uri->segment(3));
		$data['citizen_data'] = $this->get_data->get_value_where('tbl_citizens', $conditions);
		$this->render('citizens/photo', $data);
	}

	public function photo_add_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('imageURL', 'Image URL', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Citizen_ID', 'Citizen ID', 'trim|required|strip_tags');
		if($this->form_validation->run() == FALSE){
			redirect('citizens/photo/'.$this->input->post('Citizen_ID', TRUE));
		}
		else{	
			$query = $this->citizen_model->add_photo($this->input->post('Citizen_ID', TRUE));
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('citizens/view/'.$this->input->post('Citizen_ID', TRUE));
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('citizens/view/'.$this->input->post('Citizen_ID', TRUE));
			}
		}

	}

	public function address(){
		$data['title'] = "Citizens";
		$conditions = array('Citizen_ID' => $this->uri->segment(3));
		$data['citizen_data'] = $this->get_data->get_value_where('tbl_citizens', $conditions);
		$data['barangay'] = $this->get_data->get_all_value('tbl_barangay');
		$data['address'] = $this->address_model->get_address_with_barangay();
		$data['address1'] = $this->address_model->get_address($data['citizen_data'][0]->Citizen_CurrentAddress);
		$data['address2'] = $this->address_model->get_address($data['citizen_data'][0]->Citizen_PermanentAddress);
		$this->render('citizens/address', $data);
	}

	public function address_change(){

		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('address1', 'Current Address', 'trim|required|strip_tags');
		if($this->input->post('Citizen_CurrentAddress', TRUE) == NULL){	
			$data['address1'] = $this->address_model->add_address($this->input->post('address1', TRUE), $this->input->post('Barangay_ID', TRUE));
		}
		else{
			$this->form_validation->set_rules('Citizen_CurrentAddress', 'Current Address', 'trim|required|strip_tags');
		}

		$this->form_validation->set_rules('address2', 'Permanent Address', 'trim|required|strip_tags');
		if($this->input->post('Citizen_PermanentAddress', TRUE) == NULL){	
			$data['address2'] = $this->address_model->add_address($this->input->post('address2', TRUE), $this->input->post('Barangay_ID_Permanent', TRUE));
		}	
		else{
			$this->form_validation->set_rules('Citizen_PermanentAddress', 'Permanent Address', 'trim|required|strip_tags');
		}
		if($this->form_validation->run() == FALSE){
			redirect('citizens/address/'.$this->input->post('Citizen_ID', TRUE));
		}
		else{
			$query = $this->address_model->edit_address($this->input->post('Citizen_ID', TRUE), $data);
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('citizens/view/'.$this->input->post('Citizen_ID', TRUE));
			}
			else{
				$this->session->set_flashdata('failed', 'No Change has been made!');
				redirect('citizens/view/'.$this->input->post('Citizen_ID', TRUE));
			}
		}
	}

}
