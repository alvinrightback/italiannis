<?php

class Get_data extends CI_Model {


	public function get_value($field, $table, $conditions){
		$this->db->select($field);
		$query = $this->db->get_where($table, $conditions, 1);
		if($query){
			return  $query->row()->$field;
		}
	}

	public function get_all_value($table){
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_all_value_and_order_by($table, $field, $option){
		$this->db->order_by($field, $option);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_value_where($table, $conditions){
		$query = $this->db->get_where($table, $conditions);
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}


	public function get_value_where_and_order_by($table, $conditions, $field, $option){
		$this->db->order_by($field, $option);
		$query = $this->db->get_where($table, $conditions);
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_value_where_and_order_by_with_limit($table, $conditions, $field, $option, $limit){
		$this->db->order_by($field, $option);
		$query = $this->db->get_where($table, $conditions, $limit);
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function update_value_where($table, $data, $conditions){
		$query = $this->db->update($table, $data, $conditions);
		if($query){
			return TRUE;
		}
	}

	public function get_count_where($table, $conditions){
		$query = $this->db->get_where($table, $conditions);
		if($query){
			return $query->num_rows();
		}
	}

	public function get_max_id($field, $table){
		$this->db->select_max($field);
		$query = $this->db->get($table);
		if($query){
			return  $query->row()->$field;
		}
	}



}
