<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
    
	public function index()
	{
        $info=$this->session->flashdata('informacio');
        $data['info_client']=$info;
		$this->load->view('client',$data);
	}
}
