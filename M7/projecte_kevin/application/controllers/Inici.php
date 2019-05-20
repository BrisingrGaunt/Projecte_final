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
        if(sizeof($_POST)==3){
            $this->$model->login($_POST);
        }
        else{
            $this->$model->registre($_POST);
        }
        var_dump(sizeof($_POST));
        foreach($_POST as $clau => $valor){
            echo $clau." ".$valor."<br>";
        }
    }
}
