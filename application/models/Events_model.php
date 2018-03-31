<?php

class Events_model extends CI_Model{

	public function do_upload($barangay_ID){
		
		$config['upload_path'] = './resources/images/events_photo/temp/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['file_name'] = uniqid().'.jpeg';
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('userfile')){
			$this->session->set_flashdata('upload_error', $this->upload->display_errors());
		}
		else{
			$image_data = $this->upload->data();

			$config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => './resources/images/events_photo/',
				'maintain_ratio' => TRUE,
				'width' => 400,
				'height' => 600
				);

			$this->load->library('image_lib', $config); 

			if(!$this->image_lib->resize()){
				$error = array('error' => $this->image_lib->display_errors());
				$this->session->set_flashdata('upload_error', $error);	
			}	
			else{
				$query = $this->add_event($image_data['raw_name'], $barangay_ID);
				if($query){
					$file = './resources/images/events_photo/temp/'.$image_data['raw_name'].'.jpeg';
					unlink($file);
					return $query;
				}
			}
		}	
	}

	public function get_events(){
		$this->db->select('*');
		$this->db->from('tbl_events');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_events.Event_Barangay_ID');
		$this->db->order_by('tbl_events.DateCreated', 'desc');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row; 
			}
			return $data;	
		}
	}

	public function add_event($image, $barangay_ID){
		$data = array(
			'Event_Name' => $this->input->post('Event_Name', TRUE),
			'Event_Start' => $this->input->post('Event_Start', TRUE),
			'Event_End' => $this->input->post('Event_End', TRUE),
			'Event_Location' => $this->input->post('Event_Location', TRUE),
			'Event_Barangay_ID' => $this->input->post('Event_Barangay_ID', TRUE),
			'Event_Description' => $this->input->post('Event_Description', TRUE),
			'Barangay_ID' => $barangay_ID,
			'Event_Photo' => $image,
			'CreatedBy' => $this->session->userdata('user_id'),
			'DateCreated' => date('Y-m-d h:i:s')
			);

		$insert = $this->db->insert('tbl_events', $data);

		if($insert){
			return $this->db->insert_id();
		}
	}

	public function edit_event($id){
		$data = array(
			'Event_Name' => $this->input->post('Event_Name', TRUE),
			'Event_Start' => $this->input->post('Event_Start', TRUE),
			'Event_End' => $this->input->post('Event_End', TRUE),
			'Event_Location' => $this->input->post('Event_Location', TRUE),
			'Event_Barangay_ID' => $this->input->post('Event_Barangay_ID', TRUE),
			'Event_Description' => $this->input->post('Event_Description', TRUE),
			'Barangay_ID' => $barangay_ID,
			'UpdatedBy' => $this->session->userdata('user_id')
			);

		$update = $this->db->update('tbl_events', $data, "Event_ID = '$id'");

		if($update){
			return $this->input->post('Event_ID', TRUE);
		}
	}




}