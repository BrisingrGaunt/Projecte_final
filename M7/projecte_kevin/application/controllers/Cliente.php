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
            $this->comprovacions_client();
            $info=$_SESSION['info_client'];
        }
        $this->load->model("client");
        $data['qt_participacions']=$this->client->getQtParticipacions(array('pa.client'=>$info['email']));
        //Obtenim la propera cata per mostrar en la pàgina principal
        $data['propera_cata']=$this->client->getProperEvent(array('c.data >'=>date('Y-m-d H:i')));
        $data['info_client']=$info;
        //exit;
		$this->load->view('client',$data);
	}
    
    public function comprovacions_client(){
        if(!isset($_SESSION['info_client'])){
            redirect('Inici/logout');
        }
    }
    
    public function apuntar(){
        if(isset($_GET['filtre'])){
            $data['filtre']=true;
        }
        $this->comprovacions_client();
        $data['info_client']=$_SESSION['info_client'];
        $data['info']="";
        if($this->session->flashdata('info')){
            $data['info']=$this->session->flashdata('info');
        }
        $this->load->model("cata");
        $this->load->model("participacio");
        $data['cates']=$this->cata->getAllDetallat();
        $data['participacions']=$this->participacio->getAllUsuari(array('pa.client'=>$_SESSION['info_client']['email']));
        //var_dump($data['participacions']);
        //exit;
        $this->load->view('inscripcions',$data);
    }
    
    public function gestio_inscripcio(){
        $this->comprovacions_client();
        if(isset($_GET)){
            $this->load->model('participacio');
            $dades=array('cata'=>$_GET['id'],'client'=>$_SESSION['info_client']['email']);
            if($_GET['accio']=='apuntar'){
                $resultat=$this->participacio->apuntar($dades);
            }
            else{
                $resultat=$this->participacio->desapuntar($dades);
            }
            $this->session->set_flashdata('info',$resultat);
            redirect('Cliente/apuntar');
        }
        redirect('Cliente');
    }
    
    public function valora(){
        $this->comprovacions_client();
        $data['info_client']=$_SESSION['info_client'];
        $this->load->model('participacio');
        if($this->input->post()){
            $resultat=$this->participacio->valorar($_POST);
            $data['info']=$resultat;
            $filtre=array('pa.cata'=>$_POST['cata'],'pa.client'=>$_SESSION['info_client']['email']);
        }
        else{
            if(isset($_GET)){
                $filtre=array('pa.cata'=>$_GET['id'],'pa.client'=>$_SESSION['info_client']['email']);
            }            
        }
        $data['valoracio']=$this->participacio->getValoracionsUna($filtre)[0];
        $this->load->view('valoracio',$data);
    }
}

?>
