<?php

class Trm_model extends CI_Model {

	public function add(){
		$data1 = array();
		$data2 = array();
		$data3 = array();
		$data4 = array();
		$data5 = array();

		$header = array('Citizen_ID'					=> $this->input->post('Citizen_ID', TRUE),
						'TRM_DateSurrendered' 	    	=> $this->input->post('TRM_DateSurrendered', TRUE),
						'TRM_AgeOfFirstDrugUse' 		=> $this->input->post('TRM_AgeOfFirstDrugUse', TRUE),
						'TRM_DrugFirstTried'	    	=> $this->input->post('TRM_DrugFirstTried', TRUE),
						'DateCreated'					=> date('Y-m-d h:i:s'),	
						'CreatedBy' 					=> $this->session->userdata('user_id')
						);

		if($this->input->post('checkTRM', TRUE) == 1){
			$data1 = array(
				'TRM_ScreeningResult_ID' 		=> $this->input->post('TRM_ScreeningResult_ID', TRUE),
				'TRM_Intervention_Avail_ID' 	=> $this->input->post('TRM_Intervention_Avail_ID', TRUE),
				'TRM_Treatment_Avail_ID'     	=> $this->input->post('TRM_Treatment_Avail_ID', TRUE),
				'TRM_Status_ID' 				=> $this->input->post('TRM_Status_ID', TRUE)
				);
			if($this->input->post('TRM_ScreeningResult_ID', TRUE) == 2){
				$data2 = array(
					'TRM_ScreeningResultReferredTo' 			=> $this->input->post('TRM_ScreeningResultReferredTo', TRUE));	
			}
			else{
				$data2 = array(
					'TRM_ScreeningResultReferredTo'			    => NULL);	
			}
			if($this->input->post('TRM_Intervention_Avail_ID', TRUE) == 6){
				$data3 = array(	
					'TRM_Intervention_Avail_Others' 			=> $this->input->post('TRM_Intervention_Avail_Others', TRUE),	
					'TRM_Intervention_Avail_DateOfentry' 		=> $this->input->post('TRM_Intervention_Avail_DateOfentry', TRUE),	
					'TRM_Intervention_Avail_DateFinished' 		=> $this->input->post('TRM_Intervention_Avail_DateFinished', TRUE));
			}
			else{
				$data3 = array(	
					'TRM_Intervention_Avail_Others' 			=> NULL,	
					'TRM_Intervention_Avail_DateOfentry' 		=> NULL,	
					'TRM_Intervention_Avail_DateFinished' 		=> NULL);
			}
			if($this->input->post('TRM_Treatment_Avail_ID', TRUE) == 2){
				$data4 = array(
					'TRM_Treatment_Avail_CommunityBased_EntryDate' 			
					=> $this->input->post('TRM_Treatment_Avail_CommunityBased_EntryDate', TRUE),	
					'TRM_Treatment_Avail_CommunityBased_ServicesProvided' 			
					=> $this->input->post('TRM_Treatment_Avail_CommunityBased_ServicesProvided', TRUE),	
					'TRM_Treatment_Avail_CommunityBased_DateFinished' 			
					=> $this->input->post('TRM_Treatment_Avail_CommunityBased_DateFinished', TRUE));
			}
			else{
				$data4 = array(	
					'TRM_Treatment_Avail_CommunityBased_EntryDate' 			
					=> NULL,
					'TRM_Treatment_Avail_CommunityBased_ServicesProvided' 			
					=> NULL,
					'TRM_Treatment_Avail_CommunityBased_DateFinished' 			
					=> NULL);
			}
			if($this->input->post('TRM_Status_ID', TRUE) == 2){
				$data5 = array(	
					'TRM_SpecifyReason' 		=> $this->input->post('TRM_SpecifyReason', TRUE));
			}
			else{
				$data5 = array(	
					'TRM_SpecifyReason' 		=> NULL);
			}
			$data = array_merge($data1, $data2, $data3, $data4, $data5, $header);
		}
		if($this->input->post('checkTRM', TRUE) == 1){
			$id = $this->input->post('TRM_ID', TRUE);
			$query = $this->db->update('tbl_trm', $data, "TRM_ID = '$id'");	
			if($query){
				return $id;
			}
		}
		else{
			$query = $this->db->insert('tbl_trm', $header);	
			if($query){
			return $this->db->insert_id();
			}
		}

		
	}

	public function add_trm_drug_used(){
		$data = array(
			'TRM_ID' 						=> $this->input->post('TRM_ID', TRUE),
			'TRM_DrugsCurrentlyUsed' 	   	=> $this->input->post('TRM_DrugsCurrentlyUsed', TRUE),
			'TRM_SourceOfDrugs' 			=> $this->input->post('TRM_SourceOfDrugs', TRUE),
			'TRM_FrequencyOfUse' 			=> $this->input->post('TRM_FrequencyOfUse', TRUE),
			'TRM_ModeOfDrugUse' 			=> $this->input->post('TRM_ModeOfDrugUse', TRUE),	
			'TRM_AmountSpentPerDrugIntake' 	=> $this->input->post('TRM_AmountSpentPerDrugIntake', TRUE),
			'DateCreated'					=> date('Y-m-d h:i:s'),	
			'CreatedBy' 					=> $this->session->userdata('user_id')
			);
		$insert = $this->db->insert('tbl_trm_drug_used', $data);		
		
		if($insert){
			return $this->db->insert_id();
		}
	}

	public function delete_trm_drug_used($ID){
		$query = $this->db->delete('tbl_trm_drug_used', array('TRM_DU_ID'=>$ID));
		if($this->db->affected_rows()){
			return TRUE;
		}
	}

	public function get_drug_used($id){
		$this->db->select('tbl_trm_drug_used.*, ref_source_of_drugs.*, ref_frequency_of_use.*, ref_mode_of_drug_use.*, tbl_drug.Drug_Name');
		$this->db->from('tbl_trm_drug_used');
		$this->db->join('ref_source_of_drugs', 'ref_source_of_drugs.SOD_ID = tbl_trm_drug_used.TRM_SourceOfDrugs');
		$this->db->join('ref_frequency_of_use', 'ref_frequency_of_use.FOU_ID = tbl_trm_drug_used.TRM_FrequencyOfUse');
		$this->db->join('ref_mode_of_drug_use', 'ref_mode_of_drug_use.MODU_ID = tbl_trm_drug_used.TRM_ModeOfDrugUse');
		$this->db->join('tbl_drug', 'tbl_drug.Drug_ID = tbl_trm_drug_used.TRM_DrugsCurrentlyUsed');
		$this->db->where('tbl_trm_drug_used.TRM_ID', $id);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_trm($citizen_ID, $trm_ID){
		$this->db->select('tbl_trm.*, tbl_drug.*, ref_age_of_first_drug_use.*');
		$this->db->from('tbl_trm');
		$this->db->join('tbl_drug', 'tbl_drug.Drug_ID = tbl_trm.TRM_DrugFirstTried');
		$this->db->join('ref_age_of_first_drug_use', 'ref_age_of_first_drug_use.AOFDU_ID = tbl_trm.TRM_AgeOfFirstDrugUse');
		$this->db->where('tbl_trm.TRM_ID', $trm_ID);
		$this->db->where('tbl_trm.Citizen_ID', $citizen_ID);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}


	public function edit($id){
		$data1 = array();
		$data2 = array();
		$data3 = array();
		$data4 = array();
		$data5 = array();

		$data1 = array(
			'TRM_DateSurrendered' 	    	=> $this->input->post('TRM_DateSurrendered', TRUE),
			'TRM_AgeOfFirstDrugUse' 		=> $this->input->post('TRM_AgeOfFirstDrugUse', TRUE),
			'TRM_DrugFirstTried'	    	=> $this->input->post('TRM_DrugFirstTried', TRUE),
			'TRM_ScreeningResult_ID' 		=> $this->input->post('TRM_ScreeningResult_ID', TRUE),
			'TRM_Intervention_Avail_ID' 	=> $this->input->post('TRM_Intervention_Avail_ID', TRUE),
			'TRM_Treatment_Avail_ID'     	=> $this->input->post('TRM_Treatment_Avail_ID', TRUE),
			'TRM_Status_ID' 				=> $this->input->post('TRM_Status_ID', TRUE),
			'UpdatedBy' 					=> $this->session->userdata('user_id')
			);
		if($this->input->post('TRM_ScreeningResult_ID', TRUE) == 2){
			$data2 = array(
				'TRM_ScreeningResultReferredTo' 			=> $this->input->post('TRM_ScreeningResultReferredTo', TRUE));	
		}
		else{
			$data2 = array(
				'TRM_ScreeningResultReferredTo'			    => NULL);	
		}
		if($this->input->post('TRM_Intervention_Avail_ID', TRUE) == 6){
			$data3 = array(	
				'TRM_Intervention_Avail_Others' 			=> $this->input->post('TRM_Intervention_Avail_Others', TRUE),	
				'TRM_Intervention_Avail_DateOfentry' 		=> $this->input->post('TRM_Intervention_Avail_DateOfentry', TRUE),	
				'TRM_Intervention_Avail_DateFinished' 		=> $this->input->post('TRM_Intervention_Avail_DateFinished', TRUE));
		}
		else{
			$data3 = array(	
				'TRM_Intervention_Avail_Others' 			=> NULL,	
				'TRM_Intervention_Avail_DateOfentry' 		=> NULL,	
				'TRM_Intervention_Avail_DateFinished' 		=> NULL);
		}
		if($this->input->post('TRM_Treatment_Avail_ID', TRUE) == 2){
			$data4 = array(
				'TRM_Treatment_Avail_CommunityBased_EntryDate' 			
				=> $this->input->post('TRM_Treatment_Avail_CommunityBased_EntryDate', TRUE),	
				'TRM_Treatment_Avail_CommunityBased_ServicesProvided' 			
				=> $this->input->post('TRM_Treatment_Avail_CommunityBased_ServicesProvided', TRUE),	
				'TRM_Treatment_Avail_CommunityBased_DateFinished' 			
				=> $this->input->post('TRM_Treatment_Avail_CommunityBased_DateFinished', TRUE));
		}
		else{
			$data4 = array(	
				'TRM_Treatment_Avail_CommunityBased_EntryDate' 			
				=> NULL,
				'TRM_Treatment_Avail_CommunityBased_ServicesProvided' 			
				=> NULL,
				'TRM_Treatment_Avail_CommunityBased_DateFinished' 			
				=> NULL);
		}
		if($this->input->post('TRM_Status_ID', TRUE) == 2){
			$data5 = array(	
				'TRM_SpecifyReason' 		=> $this->input->post('TRM_SpecifyReason', TRUE));
		}
		else{
			$data5 = array(	
				'TRM_SpecifyReason' 		=> NULL);
		}

		$data = array_merge($data1, $data2, $data3, $data4, $data5);

		$update = $this->db->update('tbl_trm', $data, "TRM_ID = '$id'");		

		if($update){
			return TRUE;
		}
	}


	public function get_surrenderers(){
		$this->db->select('tbl_citizens.*, tbl_barangay.*, tbl_trm.TRM_DateSurrendered, tbl_trm.TRM_ID');
		$this->db->from('tbl_barangay');
		$this->db->join('tbl_citizens', 'tbl_citizens.Barangay_ID = tbl_barangay.Barangay_ID');
		$this->db->join('tbl_trm', 'tbl_citizens.Citizen_ID = tbl_trm.Citizen_ID');
		$this->db->order_by('tbl_trm.TRM_DateSurrendered', 'DESC');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}


}