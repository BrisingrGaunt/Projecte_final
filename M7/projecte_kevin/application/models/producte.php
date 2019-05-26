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
    
    public function obtenirRanking(){
        //per obtenir el ranking de productes
        $resultat=$this->db->query("SELECT DISTINCT `p`.`nom`, `p`.`descripcio`, avg(`pa`.`valoracio`) as valoracio, `e`.`nom` as `empresa`, `e`.`id`, `c`.`data` FROM `producte` `p` JOIN `cata` `c` ON `c`.`producte`=`p`.`codi` JOIN `participacio` `pa` ON `pa`.`cata`=`c`.`id` JOIN `empresa` `e` ON `e`.`id`=`c`.`empresa` group by p.nom, p.descripcio, e.nom, e.id, c.data ORDER BY `pa`.`valoracio` DESC, `p`.`nom` ASC");
        //$resultat=$this->db->get();
        //var_dump($resultat->result_array());
        return $resultat;
       /* exit;
        $this->db->distinct();
        $this->db->select("p.nom, p.descripcio, pa.valoracio, e.nom as empresa, e.id, c.data");
        $this->db->from("producte p");
        $this->db->join('cata c','c.producte=p.codi');
        $this->db->join('participacio pa','pa.cata=c.id');
        $this->db->join('empresa e','e.id=c.empresa');
        $this->db->order_by('pa.valoracio','desc');
        $this->db->order_by('p.nom','asc');
        $resultat=$this->db->get()->result();
        $this->output->enable_profiler(TRUE);
        var_dump($this->db->last_query());
        var_dump($resultat[0]->nom);
        exit;
        return $resultat;
        //return $resultat->result_array();
        //exit;
       /* foreach($resultat->result_array() as $p){
           $productes[$p['nom']]=$p['valoracio'];
        }
        $productes=array_reverse($productes);
        return $productes;*/
       // return $resultat->result_array();
    }
}
?>