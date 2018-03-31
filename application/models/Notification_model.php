<?php

class Notification_model extends CI_Model{


	public function get_notifications(){
		$this->db->select('*');
		$this->db->from('tbl_document_request');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_document_request.Doc_Type_ID');
		$this->db->where('tbl_document_request.Notification_Status', 1);
		$this->db->order_by('tbl_document_request.Request_Date', 'desc');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

}