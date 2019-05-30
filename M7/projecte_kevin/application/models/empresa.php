<?php

class Empresa extends CI_Model {
    
    public function preparar($post){
        $taula=[];
        foreach($post as $clau => $valor){
            if($clau!="accio"){
                if($clau=="password"){
                    $taula[$clau]=md5($valor);
                }
                else{
                    $taula[$clau]=$valor;
                }
            }
        }
        return $taula;
    }
    
    public function registre($post){
        //Primer comprovarem que no existeixi el client que es vol inserir
        $data=$this->preparar($post);
        $query = $this->db->get_where('empresa', array('email' => $data['email'],'username'=>$data['username']));
        if($query->num_rows()!=0){
            return "No s'ha pogut realitzar l'alta d'empresa degut a que ja existeix a l'aplicació";
        }
        $this->db->insert('empresa',$data);
        return "Registre realitzat correctament";
    }
    
    public function getDireccio($id){
        $this->db->select('tipusVia, direccio, numDireccio, comarca');
        $this->db->from('empresa');
        $this->db->where(array('id'=>$id));
        $resultat=$this->db->get();
        $info=$resultat->result_array()[0];
        $direccio=$info['tipusVia']." ".$info['direccio']." ".$info['numDireccio']." ".$info['comarca'];
        return $direccio;
    }
    
    public function getNom($id){
        $this->db->select('nom');
        $this->db->from('empresa');
        $this->db->where(array('id'=>$id));
        $resultat=$this->db->get();
        return $resultat->result_array()[0]['nom'];
    }
    
    public function login($post){
        $taula=$this->preparar($post);
        $query=$this->db->query("select * from empresa where password like '".$taula['password']."' and (email like '".$taula['username']."' or username like '".$taula['username']."')");
        if($query->num_rows()==0){
            return 0;
        }
        return $query->result_array()[0];
    }	
}

?>
