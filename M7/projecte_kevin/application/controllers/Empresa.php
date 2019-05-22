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
    
    public function veure_valoracions(){
        $this->load->model('participacio');
        if(isset($_GET['id'])){
            $filtre=array('pa.cata'=>$_GET['id']);
            $dades=$this->participacio->getValoracionsUna($filtre);
        }
        else{
            $dades=$this->participacio->getAllEmpresa($_SESSION['info_empresa']['id']);
            $data['esGeneral']=true;
        }
        $data['info_cata_individual']=$dades;
        $data['info_empresa']=$_SESSION['info_empresa'];
        $this->load->view('visualitzar_valoracions',$data);
    }
    
    public function modificar_cata(){
        $this->load->model('cata');
        $this->load->model('producte');
        if(isset($_GET['id'])){
            $filtre=array('id'=>$_GET['id']);
            $dades=$this->cata->getAllFiltre($filtre);
            $data['editar_cata']=$dades[0];
        }
        $data['productes']=$this->producte->getAllByEmpresa($_SESSION['info_empresa']['id']);
        $data['info_empresa']=$_SESSION['info_empresa'];
        $this->load->view('programar_cata',$data);
    }
    
    public function programar_cata(){
        $data['info']="";
        if($this->input->post()){
            $this->load->model('cata');
            $resultat=$this->cata->programar_cata($_POST);
            $data['info']=$resultat;
        }
        $this->load->model('producte');
        
        $data['productes']=$this->producte->getAllByEmpresa($_SESSION['info_empresa']['id']);
        $data['info_empresa']=$_SESSION['info_empresa'];
        $this->load->view('programar_cata',$data);
    }
    
}
