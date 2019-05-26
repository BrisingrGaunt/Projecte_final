<?php
class Cata extends CI_Model {	
	function __construct(){   
	}
	
	public function getAllDetallat(){
        $this->db->select('p.nom,p.descripcio, c.data, c.estat, c.id, p.codi, e.nom as empresa, e.direccio, e.numDireccio, e.comarca, e.tipusVia');
        $this->db->from('cata c');
        $this->db->join('producte p', 'p.codi = c.producte'); 
        $this->db->join('empresa e','e.id=c.empresa');
        $this->db->order_by('c.data','desc');
        $query=$this->db->get();
        return $query->result_array();
    }
	
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
}
?>