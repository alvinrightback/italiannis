<?php

class Migrant_model extends CI_Model{

	public function get_migrants(){
		$this->db->select('*');
		$this->db->from('tbl_real_estate_property_renter');
		$this->db->join('tbl_citizens', 'tbl_citizens.Citizen_ID = tbl_real_estate_property_renter.Citizen_ID');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_real_estate_property_renter.Renter_Type_ID');
		$this->db->join('tbl_real_estate_property', 'tbl_real_estate_property.REP_ID = tbl_real_estate_property_renter.REP_ID');
		$this->db->where('Departure_Date', NULL);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

}