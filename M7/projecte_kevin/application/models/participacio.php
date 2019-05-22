<?php

class Participacio extends CI_Model {
    
    public function getValoracionsUna($filtre){
        //Consulta desitjada
        /*select p.nom, c.data, c.estat, e.tipusVia, e.direccio, e.numDireccio, e.comarca, pa.valoracio, cl.username 
        from participacio pa, cata c, client cl, producte p, empresa e 
        where p.codi=c.producte and pa.cata=c.id and e.id=c.empresa and cl.email=pa.client and pa.cata=3*/
        /*$this->db->select('p.nom,e.tipusVia, e.direccio, e.numDireccio, e.comarca,pa.valoracio,cl.username, c.data, c.estat');
        $this->db->from('participacio pa');
        $this->db->join('cata c', 'c.id = pa.cata');
        $this->db->join('client cl','cl.email=pa.client');
        $this->db->join('producte p','p.codi=c.producte');
        $this->db->join('empresa e','e.id=c.empresa');*/
        $this->db->select('p.nom, pa.valoracio, cl.username, c.estat,c.data, pa.cata');
        $this->db->from('participacio pa');
        $this->db->join('cata c', 'c.id = pa.cata');
        $this->db->join('client cl','cl.email=pa.client');
        $this->db->join('producte p','p.codi=c.producte');
        $this->db->where($filtre);
        $query=$this->db->get();
        if($query->num_rows()==0){
            return 0;
        }
        return $query->result_array();
    }
    
    public function getAllEmpresa($empresa){
        $query = $this->db->query("select p.nom, pa.valoracio, cl.username, c.estat, c.data, pa.cata from participacio pa, cata c, client cl, producte p where c.id=pa.cata and cl.email=pa.client and p.codi=c.producte and pa.cata in (select id from cata where empresa='".$empresa."');");
        return $query->result_array();
    }

}

?>
