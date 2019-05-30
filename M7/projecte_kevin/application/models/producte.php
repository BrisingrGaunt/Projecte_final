<?php

class Producte extends CI_Model {
    
    public function afegir($data){
        //primer es busca que no existeixi ja
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
        return $sql->result_array()[0]['nom'];
    }
    
    public function obtenirRanking(){
        //per obtenir el ranking de productes
        $resultat=$this->db->query("SELECT DISTINCT `p`.`nom`, `p`.`descripcio`, avg(`pa`.`valoracio`) as valoracio, `e`.`nom` as `empresa`, `e`.`id`, `c`.`data` FROM `producte` `p` JOIN `cata` `c` ON `c`.`producte`=`p`.`codi` JOIN `participacio` `pa` ON `pa`.`cata`=`c`.`id` JOIN `empresa` `e` ON `e`.`id`=`c`.`empresa` group by p.nom, p.descripcio, e.nom, e.id, c.data ORDER BY `pa`.`valoracio` DESC, `p`.`nom` ASC");
        return $resultat;
    }
}
?>
