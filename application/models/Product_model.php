<?php

class Product_model extends CI_Model{


	public function get_products(){
		$this->db->select('product.*, auxillary.aux_value');
		$this->db->from('product');
		$this->db->join('auxillary', 'auxillary.aux_id = product.product_category_id');
		$this->db->order_by('date_created', 'desc');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_product($id){
		$this->db->select('product.*, auxillary.aux_value');
		$this->db->from('product');
		$this->db->join('auxillary', 'auxillary.aux_id = product.product_category_id');
		$this->db->where('product_id', $id);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_product_inventory($inventory_id){
		$this->db->select('inventory.*');
		$this->db->from('inventory');
		$this->db->where_in('inventory_id', explode(",", $inventory_id));
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function do_upload($type){
		
		$config['upload_path'] = './resources/images/product_photo/temp/';
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
				'new_image' => './resources/images/product_photo/',
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
				if($type == 'add'){
					$query = $this->add($image_data['raw_name'], $image_data['full_path']);	
				}
				else if($type == 'edit'){
					$query = $this->edit($image_data['raw_name'], $image_data['full_path']);
					$file = './resources/images/product_photo/'.$this->input->post('image_name').'.jpeg';
					unlink($file);
				}
				
				if($query){
					$file = './resources/images/product_photo/temp/'.$image_data['raw_name'].'.jpeg';
					unlink($file);
					return $query;
				}
			}
		}	
	}

	public function add($image_name, $full_path){

		$path = $full_path;
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$image_data = file_get_contents($path);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($image_data);

		$this->db->trans_start();

		$data = array(
			'inventory_id' => $this->input->post('inventory_id', TRUE),
			'product_category_id' => $this->input->post('Product_Category', TRUE),
			'product_code' => $this->input->post('Product_Code', TRUE),
			'name' => $this->input->post('Product_Name', TRUE),
			'description' => $this->input->post('Product_Description', TRUE),
			'price' => $this->input->post('Product_Price', TRUE),
			'image_name' => $image_name,
			'image_base64' => $base64,
			'created_by' => $this->session->userdata('user_id'),
			'date_created' => date('Y-m-d h:i:s'),
			'updated_by' => $this->session->userdata('user_id'),
			'date_updated' => date('Y-m-d h:i:s')
		);

		$query = $this->db->insert('product', $data);
		$this->db->trans_complete();
		
		if($query){
			return TRUE;
		}
	}

	public function edit($image_name, $full_path){
		if($full_path !== NULL){
			$path = $full_path;
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$image_data = file_get_contents($path);
			$base64 = 'data:image/' . $type . ';base64,' . base64_encode($image_data);
		}
		$this->db->trans_start();

		$data = array(
			'inventory_id' => $this->input->post('inventory_id', TRUE),
			'status' => $this->input->post('Product_Status', TRUE),
			'product_category_id' => $this->input->post('Product_Category', TRUE),
			'product_code' => $this->input->post('Product_Code', TRUE),
			'name' => $this->input->post('Product_Name', TRUE),
			'description' => $this->input->post('Product_Description', TRUE),
			'price' => $this->input->post('Product_Price', TRUE),	
			'updated_by' => $this->session->userdata('user_id'),
			'date_updated' => date('Y-m-d h:i:s')
		);
		if($image_name !== NULL || $full_path !== NULL){
		$data['image_name'] = $image_name;
		$data['image_base64'] = $base64;
		}

		$query = $this->db->update('product', $data, array('product_id'=>$this->input->post('product_id', TRUE)));
		$this->db->trans_complete();
		
		if($query){
			return $this->input->post('product_id');
		}
	}

}