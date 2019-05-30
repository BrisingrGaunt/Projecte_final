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
            $this->comprovacionsEmpresa();
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
    
    public function comprovacionsEmpresa(){
        if(!isset($_SESSION['info_empresa'])){
            redirect('Inici/logout');
        }
    }
    
    public function carregaXML(){
        $this->comprovacionsEmpresa();
        $data['info_empresa']=$_SESSION['info_empresa'];
        $data['info']="";
        
        if($this->input->post()){
            $config['upload_path']= './uploads/';
            $config['allowed_types']= 'xml';
            $this->load->library('upload',$config);
            if ($this->upload->do_upload('xml')) {
                    $nom_arxiu = $this->upload->data()['file_name'];
                    $xml = simplexml_load_file(base_url(). "/uploads/".$nom_arxiu);
                    $this->load->model('producte');
                    $errors=false;
                    foreach($xml->producte as $producte){
                        $valors=[];
                        $valors['empresa']=$producte->attributes()->empresa;
                        $valors['nom']=$producte->nom;
                        $valors['descripcio']=$producte->descripcio;
                        $resultat=$this->producte->afegir($valors);
                        if (strpos($resultat, 'Error') !== false) {
                            $errors=true;
                        }
                    }
                    if($errors){
                        $missatge="Hi ha hagut errors al realitzar la càrrega massiva. Contacta l'administrador.";
                    }
                    else{
                        $missatge="Els productes han sigut donats d'alta correctament";
                    }
                }
            else{
                $missatge="Error al llegir l'arxiu XML.";
            }
            $data['info']=$missatge;
        }
        $this->load->view('carrega_massiva',$data);
    }
    
    public function pujar_producte(){
        $this->comprovacionsEmpresa();
        $data['info']="";
        if($this->input->post()){
            //var_dump($_POST);
            //si entrem per la carrega xml
            if(isset($_POST['xml'])){
                redirect('Empresa/carregaXML');
            }
            $this->load->model('producte');
            $resultat=$this->producte->afegir($_POST);
            $data['info']=$resultat;
        }
        $data['info_empresa']=$_SESSION['info_empresa'];
        $this->load->view('producte',$data); 
    }
    
    public function veure_valoracions(){
        $this->comprovacionsEmpresa();
        $this->load->model('participacio');
        if(isset($_GET['id'])){
            $filtre=array('pa.cata'=>$_GET['id']);
            $dades=$this->participacio->getValoracionsUna($filtre);
        }
        else{
            $dades=$this->participacio->getAllEmpresa($_SESSION['info_empresa']['id']);
            $data['esGeneral']=true;
        }
        //var_dump($dades);
        //exit;
        $data['info_cata_individual']=$dades;
        $data['info_empresa']=$_SESSION['info_empresa'];
        $this->load->view('visualitzar_valoracions',$data);
    }
    
    public function modificar_cata(){
        $this->comprovacionsEmpresa();
        //$this->load->model('cata');
        $this->load->model('producte');
        if(isset($_GET['id'])){
            $filtre=array('id'=>$_GET['id']);
            $curl=curl_init("http://127.0.0.1/projecte_kevin_webservice/index.php/api/Server/mostrarCatesFiltre");
            curl_setopt($curl,CURLOPT_TIMEOUT,20);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('filtre'=>$filtre)));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
            $resultat=json_decode(curl_exec($curl),true);
            curl_close($curl);
            $data['editar_cata']=$resultat[0];
        }
        else{
            //entrem per post (modificar o eliminar)
            $this->load->model('cata');
            $missatge="";
            if(isset($_POST['eliminar'])){
                //Mètode eliminar
                $filtre=array('id',$_POST['id']);
                //resultat retornarà 0 si no hi ha cap usuari apuntat a la cata o el llistat d'usuaris
                $resultat=$this->cata->eliminar($filtre);
                if($resultat==0){
                    $missatge="Cata anul·lada, no hi havia ningú apuntat, so that's all folks!";
                }
                else{
                    foreach($resultat as $r){
                        $this->email->clear();
                        $this->email->from('brisingrgaunt@gmail.com', 'BrisingrGaunt Productions, SL');
                        $this->email->to($r['client']);
                        $this->email->subject('Cata anul·lada :(');
                        $this->email->message('Benvolgut/da, '.$r['username'].'<br>Ens fa mal al coraçao informar-te de que la cata que tenies prevista pel dia '.$r['data'].' del producte '.$r['nom'].' ha sigut: <b>CANCELADA!!!!!!!</b> consulta el web per més informació.');
                        $this->email->send();
                    }
                    $missatge="Cata anul·lada. Les persones apuntades ja han sigut avisades.";
                }
            }
            else{
                //MODIFIQUEM CATA
                $resultat=$this->cata->modificar($_POST);
                if($resultat==1){
                    $missatge="No es pot canviar la data a un temps passat";
                }
                else if($resultat==0){
                    $missatge="Cata modificada correctament, no hi ha cap participant al que avisar";
                }
                else{
                    //Obtenim el nom del producte antic
                    $producte_vell=$this->producte->getNom($_POST['producte_vell']);
                    $data_vella=$_POST['data_vella'];
                    foreach($resultat as $r){
                        $this->email->clear();
                        $this->email->from('brisingtgaunt@gmail.com','BrisingrGaunt Productions, SL');
                        $this->email->to($r['client']);
                        $this->email->subject('Cata modificada');
                        $this->email->message('Benvolgut/da, '.$r['username']."<br>T'informem que la cata a la que estaves apuntat: <ul><li>Data: ".$data_vella."</li><li>Producte: ".$producte_vell."</li></ul><br>Ha sigut modificada amb els següents valors:<ul><li>Data: ".$r['data']."</li><li>Producte: ".$r['nom']."</li></ul><br>Disculpa les molèsties.");
                        $this->email->send();
                    }
                    $missatge="Cata modificada correctament. Les persones apuntades han sigut notificades del canvi";
                } 
            }
            $data['info']=$missatge;
        }
        $data['productes']=$this->producte->getAllByEmpresa($_SESSION['info_empresa']['id']);
        $data['info_empresa']=$_SESSION['info_empresa'];
        $this->load->view('programar_cata',$data);
    }
    
    public function programar_cata(){
        $this->comprovacionsEmpresa();
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
