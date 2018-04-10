<?php 
class Session_model extends CI_Model{


	public function is_logged_in(){
		if($this->session->userdata()){
			if($this->session->userdata('is_logged_in')){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		else{
			return FALSE;
		}
	}
	public function checkAdmin(){

		if($this->session->userdata()){
			if($this->session->userdata('class') == 1){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		else{
			return FALSE;
		}

	}


	public function setSessionData($userID, $userRole){
		$sess_details = array('user_id' => $userID,
							  'role' => $userRole,
							  'is_logged_in' => TRUE);

		$this->session->set_userdata($sess_details);
	}

}