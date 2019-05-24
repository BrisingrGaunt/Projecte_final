<?php class Client extends CI_Model {
    
    public function preparar($post){
        $taula=[];
        foreach($post as $clau => $valor){
            if($clau!="accio"){
                $taula[$clau]=$valor;
            }
        }
        return $taula;
    }
    
    public function login($post) {
        $taula=$this->preparar($post);
        //var_dump($taula);
        $query=$this->db->query("select * from client where password like '".$taula['password']."' and (email like '".$taula['username']."' or username like '".$taula['username']."')");
       /* $query = $this->db->query("SELECT * FROM users;");

        $query=$this->db->get_where('client',array('password'=>$taula['password']));
        $this->db->or_where('username' ,$taula['username']);
        $this->db->or_where('email', $taula['username']);*/
        if($query->num_rows()==0){
            return 0;
        }
        return $query->result_array()[0];
	}
    
    public function registre($post){
        //Primer comprovarem que no existeixi el client que es vol inserir
        $data=$this->preparar($post);
        $query = $this->db->get_where('client', array('email' => $data['email'],'username'=>$data['username']));
        if($query->num_rows()!=0){
            return "No s'ha pogut realitzar l'alta d'usuari degut a que ja existeix a l'aplicació";
        }
        $this->db->insert('client',$data);
        return "Registre realitzat correctament";
    }
    
    public function getProperEvent($filtre){
        $this->db->select('e.nom as empresa, p.nom as producte, c.id, c.data, e.tipusVia, e.direccio, e.numDireccio, e.comarca');
        $this->db->from('empresa e');
        $this->db->join('cata c','c.empresa = e.id');
        $this->db->join('producte p','p.empresa = e.id');
        $this->db->where($filtre);
        $this->db->order_by("c.data", "asc");
        $this->db->limit(1);
        $query=$this->db->get();

        return $query->result_array()[0];
    }
    
    public function getQtParticipacions($filtre){
        $this->db->select('pa.cata');
        $this->db->from('participacio pa');
        $this->db->join('cata c', 'pa.cata = c.id'); 
        $this->db->where($filtre);
        $query=$this->db->get();
        return $query->num_rows();
    }
}

?>