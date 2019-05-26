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
        $this->db->select('p.nom, pa.valoracio, cl.username, c.estat,c.data, pa.cata, pa.client, e.nom as empresa');
        $this->db->from('participacio pa');
        $this->db->join('cata c', 'c.id = pa.cata');
        $this->db->join('client cl','cl.email=pa.client');
        $this->db->join('producte p','p.codi=c.producte');
        $this->db->join('empresa e','e.id=c.empresa');
        $this->db->where($filtre);
        $query=$this->db->get();
        if($query->num_rows()==0){
            return 0;
        }
        return $query->result_array()[0];
    }
    
    public function getAllEmpresa($empresa){
        $query = $this->db->query("select p.nom, pa.valoracio, cl.username, c.estat, c.data, pa.cata from participacio pa, cata c, client cl, producte p where c.id=pa.cata and cl.email=pa.client and p.codi=c.producte and pa.cata in (select id from cata where empresa='".$empresa."');");
        return $query->result_array();
    }
    
    public function apuntar($dades){
        //primer es comprova que no existeixi l'usuari en aquesta cata
        $resultat=$this->db->get_where('participacio',$dades);
        if($resultat->num_rows()!=0){
            return "Ja estàs apuntat a aquesta cata";
        }
        $this->db->insert('participacio',$dades);
        return "T'has apuntat a la cata correctament";
    }
    
    public function desapuntar($dades){
        //comprovem que l'usuari no existeixi en aquesta cata
        $resultat=$this->db->get_where('participacio',$dades);
        if($resultat->num_rows()==0){
            return "No et pots desapuntar d'una cata en la que no participes";
        }
        
        $this->db->delete('participacio',$dades);
        return "T'has desapuntat de forma correcta";  
    }
    
    public function valorar($dades){
        //primer es comprova que l'usuari estigui apuntat a la cata que vol valorar en cas que es vulgui fer el lio per URL
        $resultat=$this->db->get_where('participacio',array('cata'=>$dades['cata'],'client'=>$dades['client']));
        if($resultat->num_rows()==0){
            return "No pots valorar una cata en la que no estàs apuntat!!";
        }
        //si tot correcte, llavors es puntua
        $this->db->where(array('cata'=>$dades['cata'],'client'=>$dades['client']));
        $this->db->update('participacio', array('valoracio'=>$dades['valoracio']));
        return "Valoració realitzada, gràcies.";
    }
    
    public function getAllUsuari($user){
        $this->db->select('pa.cata, pa.valoracio');
        $this->db->from('participacio pa');
        $this->db->where($user);
        $query=$this->db->get();
        $cates="";
        $valoracions="";
        foreach($query->result_array() as $aux){
            $cates.=$aux['cata'].":";
            $valoracions.=$aux['valoracio'].":";
        }
        $resultat['cates']=$cates;
        $resultat['valoracions']=$valoracions;
        //exit;
        return $resultat;
    }

}

?>
