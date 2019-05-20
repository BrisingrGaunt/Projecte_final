<?php

class Empresa extends CI_Model {
    
    public function getComandes() {
		$query = $this->db->get('comanda');
		return $query->result_array();	
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