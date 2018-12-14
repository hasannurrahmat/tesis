<?php 

class Model_auth extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function getuser($username){
		$this->db->where('pe.username', $username);
        $query = $this->db->get("user pe");
		if($query->num_rows() == 1){
			return $query->row();
		}
	}

	public function validasi_login($username, $password){
		$this->db->where('pe.username', $username);
		$this->db->where('pe.password', $password);
		$this->db->join('group_user ug', 'ug.id_group_user=pe.id_group_user');
        $query = $this->db->get("user pe");
		
		if($query->num_rows() == 1){
			return $query->row();
		}
	}

	public function getAllsitus(){
		$this->db->select("s.id_situs, s.situs, count(b.berita) as jumlah");
		$this->db->group_by("ts.id_situs");
		$this->db->join("topik_situs ts", "ts.id_topik_situs=b.id_topik_situs", "right outer");
		$this->db->join("topik t", "ts.id_topik=t.id_topik");
		$this->db->join("situs s", "ts.id_situs=s.id_situs");
		$query = $this->db->get("berita b");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	public function getAlltopik(){
		$this->db->select("t.id_topik, t.topik, count(b.berita) as jumlah");
		$this->db->group_by("ts.id_topik");
		$this->db->join("topik_situs ts", "ts.id_topik_situs=b.id_topik_situs", "right outer");
		$this->db->join("topik t", "ts.id_topik=t.id_topik");
		$this->db->join("situs s", "ts.id_situs=s.id_situs");
		$query = $this->db->get("berita b");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
}