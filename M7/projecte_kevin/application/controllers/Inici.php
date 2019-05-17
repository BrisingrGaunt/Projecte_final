<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inici extends CI_Controller {
    
	public function index()
	{

		$this->load->view('inici');
	}
}
