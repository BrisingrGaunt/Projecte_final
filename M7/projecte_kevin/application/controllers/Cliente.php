<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {
    
	public function index()
	{
        $info=$this->session->flashdata('informacio');
        if($info!=""){
            $_SESSION['info_client']=$info;
        }
        else{
            $info=$_SESSION['info_client'];
        }
        $this->load->model("client");
        $data['qt_participacions']=$this->client->getQtParticipacions(array('pa.client'=>$info['email']));
        //Obtenim la propera cata per mostrar en la pàgina principal
        $data['propera_cata']=$this->client->getProperEvent(array('c.data >'=>date('Y-m-d H:i')));
        $data['info_client']=$info;
		$this->load->view('client',$data);
	}
    
    public function apuntar(){
        $data['info_client']=$_SESSION['info_client'];
        $data['info']="";
        $this->load->model("cata");
        $this->load->model("participacio");
        $data['cates']=$this->cata->getAllDetallat();
        //var_dump($data['cates']);
        //exit;
        //var_dump($_SESSION['info_client']);
        //exit;
        $data['participacions']=$this->participacio->getAllUsuari(array('pa.client'=>$_SESSION['info_client']['email']));
        //var_dump(array_search(5,explode(":",$data['participacions']['cates'])));
        //exit;
        $this->load->view('inscripcions',$data);
    }
    
    public function gestio_inscripcio(){
        if(isset($_GET)){
            $this->load->model('participacio');
            $dades=array('cata'=>$_GET['id'],'client'=>$_SESSION['info_client']['email']);
            if($_GET['accio']=='apuntar'){
                $resultat=$this->participacio->apuntar($dades);
            }
            else{
                $resultat=$this->participacio->desapuntar($dades);
            }
        }
         redirect('Cliente');
    }
    
    public function valora(){
        if(isset($_GET)){
            //var_dump($_GET['id']);
            //exit;
            //$this->load->model('cata');
            //$this->cata->getOne($_GET['id']);
            $this->load->view('valoracio');
        }
        else{
            if($this->input->post()){
                $this->load->model('participacio');
                $this->participacio->valorar($dades);
            }            
        }
    }
}

?>
