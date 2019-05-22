<?php

class Cata extends CI_Model {
    
    public function getAllFiltre($filtre){
        $this->db->select('p.nom,p.descripcio, c.data, c.estat, c.id, p.codi');
        $this->db->from('cata c');
        $this->db->join('producte p', 'p.codi = c.producte'); 
        $this->db->where($filtre);
        $query=$this->db->get();
        if($query->num_rows()==0){
            return 0;
        }
        return $query->result_array();
    }
    
    public function programar_cata($dades){
        // comprovem que la cata sigui programada en el futur
        if($dades['data']<date('Y-m-d H:i')){
            return "No es pot programar una cata en un dia anterior a l'actual";
        }
        // comprovem que no existeixi una cata igual
        $query=$this->db->get_where('cata',$dades);
        if($query->num_rows()!=0){
            return "Aquesta cata ja està programada.";
        }
        $this->db->insert('cata',$dades);
        return "Nova cata afegida";
    }

}

?>
