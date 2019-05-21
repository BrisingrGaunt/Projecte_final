<?php

class Cata extends CI_Model {
    
    public function getAllFiltre($filtre){
        $this->db->select('p.nom,p.descripcio, c.data, c.estat');
        $this->db->from('cata c');
        $this->db->join('producte p', 'p.codi = c.producte'); 
        $this->db->where($filtre);
        $query=$this->db->get();
        if($query->num_rows()==0){
            return 0;
        }
        return $query->result_array();
    }

}

?>
