<?php

class Client extends CI_Model {
    
    public function preparar($post){
        $taula=[];
        foreach($post as $clau => $valor){
            if($clau!="accio"){
                $taula[$clau]=$valor;
            }
        }
        return $taula;
    }
    
    public function login($post) {
        $taula=$this->preparar($post);
		//$query = $this->db->get('comanda');
        //var_dump($taula);
        //exit;
		return $query->result_array();	
	}
    
    public function registre($post){
        $data=$this->preparar($post);
        $this->db->insert('client',$data);
    }
    
    public function getComanda($com){
        $query=$this->db->get_where('comanda',array('id'=>$com));
		if(count($query->result_array())==0){
            return null;
        }
		return $query->result_array()[0];
    }
    
    public function getLinies($comanda){
        $query=$this->db->get_where('linia_comanda',array('comanda'=>$comanda));
        
		if(count($query->result_array())==0){
            return null;
        }
		return $query->result_array();
    }	
}

?>