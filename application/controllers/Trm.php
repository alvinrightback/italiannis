<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trm extends MY_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('trm_model');
	}

	public function index($page = "TRM"){
		$data['title'] = $page;
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['surrenderers'] = $this->trm_model->get_surrenderers();
		$data['citizens'] = $this->get_data->get_all_value('tbl_citizens');
		$this->render('trm/main', $data);
	}

	public function add($page = "TRM"){
		$data['title'] = $page;
		$conditions = array('Citizen_ID' => $this->uri->segment(3));
		$data['citizen_data'] = $this->get_data->get_value_where('tbl_citizens', $conditions);
		$data['ageOfFirstDrugUse'] = $this->get_data->get_all_value('ref_age_of_first_drug_use');
		$data['drugs'] = $this->get_data->get_all_value('tbl_drug');
		$data['checkTRM'] = 0;
		if($this->checkTRM($this->uri->segment(3), $this->uri->segment(4))){
			$data['trm_data'] = $this->get_data->get_value_where('tbl_trm', array('Citizen_ID'=>$this->uri->segment(3), 'TRM_ID' => $this->uri->segment(4)));
			$data['drug_used'] = $this->trm_model->get_drug_used($this->uri->segment(4));
			$data['intervention'] = $this->get_data->get_all_value('ref_intervention_availment');
			$data['treatment'] = $this->get_data->get_all_value('ref_treatment_program_availment');
			$data['sourceOfDrugs'] = $this->get_data->get_all_value('ref_source_of_drugs');
			$data['frequencyOfUse'] = $this->get_data->get_all_value('ref_frequency_of_use');
			$data['modeOfDrugUse'] = $this->get_data->get_all_value('ref_mode_of_drug_use');
			$data['checkTRM'] = 1;
		}
		$this->render('trm/add', $data);
	}

	private function checkTRM($citizenID, $trmID){
		$query = $this->get_data->get_value_where('tbl_trm', array('Citizen_ID'=>$citizenID, 'TRM_ID'=>$trmID));
		if($query){
			return TRUE;
		}
	}

	public function add_trm_drug(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('TRM_DrugsCurrentlyUsed', 'Drugs Currently Used', 'trim|strip_tags');
		$this->form_validation->set_rules('TRM_SourceOfDrugs', 'Source of Drugs', 'trim|strip_tags');
		$this->form_validation->set_rules('TRM_FrequencyOfUse', 'Frequency of Use', 'trim|strip_tags');
		$this->form_validation->set_rules('TRM_ModeOfDrugUse', 'Mode of Drug Use', 'trim|strip_tags');
		$this->form_validation->set_rules('TRM_AmountSpentPerDrugIntake', 'Amount spent per drug intake', 'trim|strip_tags');

		if($this->form_validation->run() == FALSE){
			redirect('trm/add/'.$this->input->post('Citizen_ID', TRUE).'/'.$this->input->post('TRM_ID', TRUE));	
		}
		else{	
			$query = $this->trm_model->add_trm_drug_used();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('trm/add/'.$this->input->post('Citizen_ID', TRUE).'/'.$this->input->post('TRM_ID', TRUE));
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('trm/add/'.$this->input->post('Citizen_ID', TRUE).'/'.$this->input->post('TRM_ID', TRUE));
			}
		}
	}

	public function delete_trm_drug($ID, $citizen_ID, $trm_ID){
		$query = $this->trm_model->delete_trm_drug_used($ID);
		if($query){
			redirect('trm/add/'.$citizen_ID.'/'.$trm_ID);
		}
	}

	public function add_now(){
		$this->load->library('form_validation');
		//Part 1
		$this->form_validation->set_rules('TRM_DateSurrendered', 'Date Surrendered', 'trim|required|strip_tags');
		$this->form_validation->set_rules('TRM_AgeOfFirstDrugUse', 'Age of first drug use', 'trim|strip_tags');
		$this->form_validation->set_rules('TRM_DrugFirstTried', 'Drug first tried', 'trim|strip_tags');

		//Part 2
		if($this->input->post('checkTRM', TRUE) == 1){
	
			$this->form_validation->set_rules('TRM_ScreeningResult_ID', 'Screening Result', 'trim|strip_tags');
			if($this->input->post('TRM_ScreeningResult_ID', TRUE) == 2){
				$this->form_validation->set_rules('TRM_ScreeningResultReferredTo', 'Screening Result Referred To', 'trim|strip_tags');
			}
			$this->form_validation->set_rules('TRM_Intervention_Avail_ID', 'Intervention Availed', 'trim|strip_tags');
			if($this->input->post('TRM_Intervention_Avail_ID', TRUE) == 6){
				$this->form_validation->set_rules('TRM_Intervention_Avail_Others', 'Intervention Others', 'trim|strip_tags');
				$this->form_validation->set_rules('TRM_Intervention_Avail_DateOfentry', 'Intervention Date Of Entry', 'trim|strip_tags');
				$this->form_validation->set_rules('TRM_Intervention_Avail_DateFinished', 'Intervention Date Finished', 'trim|strip_tags');
			}
			$this->form_validation->set_rules('TRM_Treatment_Avail_ID', 'Treatment Availed', 'trim|strip_tags');
			if($this->input->post('TRM_Treatment_Avail_ID', TRUE) == 2){
				$this->form_validation->set_rules('TRM_Treatment_Avail_CommunityBased_EntryDate', 'Treatment Others', 'trim|strip_tags');
				$this->form_validation->set_rules('TRM_Treatment_Avail_CommunityBased_ServicesProvided', 'Treatment Date Of Entry', 'trim|strip_tags');
				$this->form_validation->set_rules('TRM_Treatment_Avail_CommunityBased_DateFinished', 'Treatment Date Finished', 'trim|strip_tags');
			}
			$this->form_validation->set_rules('TRM_Status_ID', 'Status', 'trim|strip_tags');
			if($this->input->post('TRM_Status_ID', TRUE) == 2){
				$this->form_validation->set_rules('TRM_SpecifyReason', 'Status Reason', 'trim|strip_tags');
			}
		}

		if($this->form_validation->run() == FALSE){
			if($this->input->post('checkTRM', TRUE) == 1){
				redirect('trm/add/'.$this->input->post('Citizen_ID', TRUE).'/'.$this->input->post('TRM_ID', TRUE));
			}
			else{
				redirect('trm/add/'.$this->input->post('Citizen_ID', TRUE));
			}
			
		}
		else{	
			$query = $this->trm_model->add();
			if($query){
				if($this->input->post('checkTRM', TRUE) == 1){
					$this->session->set_flashdata('success', 'Successful!');
					redirect('trm/view/'.$this->input->post('Citizen_ID', TRUE).'/'.$query);
				}
				else{
					redirect('trm/add/'.$this->input->post('Citizen_ID', TRUE).'/'.$query);
				}
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				if($this->input->post('checkTRM', TRUE) == 1){
					redirect('trm/add/'.$this->input->post('Citizen_ID', TRUE).'/'.$this->input->post('TRM_ID', TRUE));
				}
				else{
					redirect('trm/add/'.$this->input->post('Citizen_ID', TRUE));
				}
			}
		}
	}

	public function view($page = "TRM"){
		$data['title'] = $page;
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['citizen_data'] = $this->get_data->get_value_where('tbl_citizens', array('Citizen_ID' => $this->uri->segment(3)));
		$data['trm_data'] = $this->trm_model->get_trm($this->uri->segment(3), $this->uri->segment(4));
		$data['drug_used'] = $this->trm_model->get_drug_used($this->uri->segment(4));
		$this->render('trm/view', $data);
	}

	public function edit($page = "TRM"){
		$data['title'] = $page;
		$conditions = array('Citizen_ID' => $this->uri->segment(3));
		$data['citizen_data'] = $this->get_data->get_value_where('tbl_citizens', $conditions);
		$data['ageOfFirstDrugUse'] = $this->get_data->get_all_value('ref_age_of_first_drug_use');
		$data['drugs'] = $this->get_data->get_all_value('tbl_drug');
		$data['trm_data'] = $this->get_data->get_value_where('tbl_trm', array('Citizen_ID'=>$this->uri->segment(3), 'TRM_ID' => $this->uri->segment(4)));
		$data['drug_used'] = $this->trm_model->get_drug_used($this->uri->segment(4));
		$data['intervention'] = $this->get_data->get_all_value('ref_intervention_availment');
		$data['treatment'] = $this->get_data->get_all_value('ref_treatment_program_availment');
		$data['sourceOfDrugs'] = $this->get_data->get_all_value('ref_source_of_drugs');
		$data['frequencyOfUse'] = $this->get_data->get_all_value('ref_frequency_of_use');
		$data['modeOfDrugUse'] = $this->get_data->get_all_value('ref_mode_of_drug_use');
		$this->render('trm/edit', $data);
	}


	public function edit_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('TRM_DateSurrendered', 'Date Surrendered', 'trim|required|strip_tags');
		$this->form_validation->set_rules('TRM_AgeOfFirstDrugUse', 'Age of first drug use', 'trim|strip_tags');
		$this->form_validation->set_rules('TRM_DrugFirstTried', 'Drug first tried', 'trim|strip_tags');

		$this->form_validation->set_rules('TRM_ScreeningResult_ID', 'Screening Result', 'trim|strip_tags');
		if($this->input->post('TRM_ScreeningResult_ID', TRUE) == 2){
			$this->form_validation->set_rules('TRM_ScreeningResultReferredTo', 'Screening Result Referred To', 'trim|strip_tags');
		}
		$this->form_validation->set_rules('TRM_Intervention_Avail_ID', 'Intervention Availed', 'trim|strip_tags');
		if($this->input->post('TRM_Intervention_Avail_ID', TRUE) == 6){
			$this->form_validation->set_rules('TRM_Intervention_Avail_Others', 'Intervention Others', 'trim|strip_tags');
			$this->form_validation->set_rules('TRM_Intervention_Avail_DateOfentry', 'Intervention Date Of Entry', 'trim|strip_tags');
			$this->form_validation->set_rules('TRM_Intervention_Avail_DateFinished', 'Intervention Date Finished', 'trim|strip_tags');
		}
		$this->form_validation->set_rules('TRM_Treatment_Avail_ID', 'Treatment Availed', 'trim|strip_tags');
		if($this->input->post('TRM_Treatment_Avail_ID', TRUE) == 2){
			$this->form_validation->set_rules('TRM_Treatment_Avail_CommunityBased_EntryDate', 'Treatment Others', 'trim|strip_tags');
			$this->form_validation->set_rules('TRM_Treatment_Avail_CommunityBased_ServicesProvided', 'Treatment Date Of Entry', 'trim|strip_tags');
			$this->form_validation->set_rules('TRM_Treatment_Avail_CommunityBased_DateFinished', 'Treatment Date Finished', 'trim|strip_tags');
		}
		$this->form_validation->set_rules('TRM_Status_ID', 'Status', 'trim|strip_tags');
		if($this->input->post('TRM_Status_ID', TRUE) == 2){
			$this->form_validation->set_rules('TRM_SpecifyReason', 'Status Reason', 'trim|strip_tags');
		}

		if($this->form_validation->run() == FALSE){
			redirect('trm/edit/'.$this->input->post('Citizen_ID', TRUE).'/'.$this->input->post('TRM_ID', TRUE));
		}
		else{	
			$query = $this->trm_model->edit($this->input->post('TRM_ID', TRUE));
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('trm/view/'.$this->input->post('Citizen_ID', TRUE).'/'.$this->input->post('TRM_ID', TRUE));
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('trm/edit/'.$this->input->post('Citizen_ID', TRUE).'/'.$this->input->post('TRM_ID', TRUE));
			}
		}
	}

}
