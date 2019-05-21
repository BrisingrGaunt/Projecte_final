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
        //var_dump($taula);
        $query=$this->db->get_where('client',array('password'=>$taula['password']));
        $this->db->or_where('username' ,$taula['username']);
        $this->db->or_where('email', $taula['username']);
        if($query->num_rows()==0){
            return 0;
        }
        return $query->result_array()[0];
	}
    
    public function registre($post){
        //Primer comprovarem que no existeixi el client que es vol inserir
        $data=$this->preparar($post);
        $query = $this->db->get_where('client', array('email' => $data['email'],'username'=>$data['username']));
        if($query->num_rows()!=0){
            return "No s'ha pogut realitzar l'alta d'usuari degut a que ja existeix a l'aplicació";
        }
        $this->db->insert('client',$data);
        return "Registre realitzat correctament";
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