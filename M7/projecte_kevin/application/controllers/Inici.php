<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inici extends CI_Controller {
    
	public function index()
	{
		
        $this->load->model('producte');
        $data['productes']=$this->producte->obtenirRanking();
        $curl=curl_init("http://127.0.0.1/projecte_kevin_webservice/index.php/api/Server/mostrarCatesAll");
        curl_setopt($curl,CURLOPT_TIMEOUT,20);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
		$resultat=json_decode(curl_exec($curl),true);
		curl_close($curl);
        $data['cates']=$resultat;
        $this->load->view('index',$data);
	}
    
    public function login(){
        $this->load->view('inici');
    }
    
        
    public function ubicar(){
        if(isset($_GET)){
            $id=$_GET['id'];
            $this->load->model('empresa');
            $direccio=$this->empresa->getDireccio($id);
            $data['direccio']=$direccio;
            $data['nom']=$this->empresa->getNom($id);
            $data['coordenades']=$this->getCoordinates($direccio);
            $this->load->view('mapa',$data);
        }
    }
    
    function getCoordinates($address){
        $address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern
        //echo $address;
        $url = "https://maps.google.com/maps/api/geocode/json?sensor=false&key=AIzaSyBhIshCfsCDpxZj2EmDQcyRUw3sczEiTJE&address=$address";
        $response = file_get_contents($url);
        $json = json_decode($response,TRUE); //generate array object from the response from the web
        return ($json['results'][0]['geometry']['location']['lat'].",".$json['results'][0]['geometry']['location']['lng']);
}
    
    public function accio(){
        $valors=explode('_',$_POST['accio']);
        $accio=$valors[0];
        $model=$valors[1];
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
                //var_dump($info);
                //exit;
                $this->session->set_flashdata('informacio', $info);
                if(sizeof($info)==3){
                    // Part client
                    $_SESSION['client']=$info['email'];
                    redirect('Cliente');
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
