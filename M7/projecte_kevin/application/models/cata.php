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
    
    public function getAllDetallat(){
        $this->db->select('p.nom,p.descripcio, c.data, c.estat, c.id, p.codi, e.nom as empresa, e.direccio, e.numDireccio, e.comarca, e.tipusVia');
        $this->db->from('cata c');
        $this->db->join('producte p', 'p.codi = c.producte'); 
        $this->db->join('empresa e','e.id=c.empresa');
        $this->db->order_by('c.data','desc');
        $query=$this->db->get();
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
    
    public function eliminar($filtre){
        $this->load->model('participacio');
        // Ens quedem amb l'id de la cata
        $id=$filtre[1];
        $filtre_participacio=array('pa.cata'=>$id);
        //busquem les participacions que té aquesta cata
        $registres=$this->participacio->getValoracionsUna($filtre_participacio);
        if($registres==0){
            return 0;
        }
        
        // eliminem les participacions
        $this->db->delete('participacio', array('cata' => $id));
        // eliminem les cates
        $this->db->delete('cata', array('id' => $id));
        return $registres;
    }
    
    public function modificar($dades){
        //Primer es comprova que la data sigui major al temps actual:
        if($dades['data']<date('Y-m-d H:i')){
            return 1;
        }
        
        //Si tot correcte, s'actualitza la cata amb les noves dades recollides del post
        $data = array(
            'producte' => $dades['producte'],
            'data' => $dades['data']
        );
        $this->db->where('id', $dades['id']);
        $this->db->update('cata', $data);
        
        //S'obtenen les dades dels usuaris apuntats a la cata
        $this->db->select('p.nom, cl.username, c.data, pa.client');
        $this->db->from('cata c');
        $this->db->join('producte p','p.codi=c.producte');
        $this->db->join('participacio pa','pa.cata=c.id');
        $this->db->join('client cl','pa.client=cl.email');
        $this->db->where('pa.cata',$dades['id']);
        $resultat=$this->db->get();
        if($resultat->num_rows()==0){
            return 0;
        }
        return $resultat->result_array();
    }

}

?>
