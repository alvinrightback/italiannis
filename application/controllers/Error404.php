<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error404 extends MY_Controller {

	public function index($page = "Error 404")
	{	
		$data['title'] = $page;
		$this->render('errors/custom/error_404', $data);
	}

}