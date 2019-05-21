<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inici extends CI_Controller {
    
	public function index()
	{
		$this->load->view('inici');
	}
    
    public function accio(){
        $valors=explode('_',$_POST['accio']);
        $accio=$valors[0];
        $model=$valors[1];
        //var_dump($accio);
        //var_dump($model);
        $this->load->model($model);
        $data=array();
        if(sizeof($_POST)==3){
            $info=$this->$model->login($_POST);
            if($info==0){
                //Si no hi ha cap usuari amb aquests credencials
                $data['info']="Credencials errònies, comprova les dades";
                //$this->load->view
            }
            else{
                var_dump($info);
                $this->session->set_flashdata('informacio', $info);
                if(sizeof($info)==3){
                    // Part client
                    $_SESSION['client']=$info['email'];
                    redirect('Client');
                }
                else{
                    // Part empresa
                    $_SESSION['empresa']=$info['id'];
                    redirect('Empresa');
                }
            }
        }
        else{
            $missatge=$this->$model->registre($_POST);
            $data['info']=$missatge;
        }
        $this->load->view('inici',$data);
        /*var_dump($missatge);
        foreach($_POST as $clau => $valor){
            echo $clau." ".$valor."<br>";
        }*/
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('Inici');
    }
}
