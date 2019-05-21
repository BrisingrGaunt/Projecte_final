<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {
    
	public function index()
	{
        $info=$this->session->flashdata('informacio');
        if($info!=""){
            $_SESSION['info_empresa']=$info;
        }
        else{
            $info=$_SESSION['info_empresa'];
        }
        $this->load->model('cata');
        
        $data['info_empresa']=$info;
        $filtre=array('c.empresa'=>$info['id']);
        $cates=$this->cata->getAllFiltre($filtre);
        if($cates!=0){
            $data['cates']=$cates;
        }
		$this->load->view('empresa',$data);
	}
    
    public function pujar_producte(){
        $data['info']="";
        if($this->input->post()){
             $this->load->model('producte');
            $resultat=$this->producte->afegir($_POST);
            $data['info']=$resultat;
        }
        $data['info_empresa']=$_SESSION['info_empresa'];
        $this->load->view('producte',$data); 
    }
    
    public function programar_cata(){
        $this->load->model('producte');
        $data['info']="";
        $data['productes']=$this->producte->getAllByEmpresa($_SESSION['info_empresa']['id']);
        $data['info_empresa']=$_SESSION['info_empresa'];
        $this->load->view('programar_cata',$data);
    }
    
}
