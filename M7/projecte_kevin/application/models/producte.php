<?php

class Producte extends CI_Model {
    
    public function afegir($data){
        //primer es selecciona que no existeixi ja
        $resultat=$this->db->get_where('producte',array('empresa'=>$data['empresa'],'nom'=>$data['nom']));
        if($resultat->num_rows()!=0){
            return "Error: Aquest producte ja existeix dintre del teu catàleg";
        }
        else{
            $this->db->insert('producte',$data);
            return "Producte donat d'alta correctament";
        } 
    }
    
    public function getAllByEmpresa($empresa){
        $sql=$this->db->get_where('producte',array('empresa'=>$empresa));
        return $sql->result_array();
    }
    
    public function getNom($id){
        $sql=$this->db->get_where('producte',array('codi'=>$id));
       // var_dump($sql->result_array())
        return $sql->result_array()[0]['nom'];
    }
}
?>