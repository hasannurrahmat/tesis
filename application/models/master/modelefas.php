<?php

class Modelefas extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	// public function getAllefas(){
	// 	$query = $this->db->get("efas k");
 
 //        if ($query->num_rows() > 0) {
 //            foreach ($query->result() as $row) {
 //                $data[] = $row;
 //            }
 //            return $data;
 //        }
 //        return false;
	// }
	
	// public function getAllsitus(){
	// 	$query = $this->db->get("situs k");
 
 //        if ($query->num_rows() > 0) {
 //            foreach ($query->result() as $row) {
 //                $data[] = $row;
 //            }
 //            return $data;
 //        }
 //        return false;
	// }

	public function getAlltopik(){
		$query = $this->db->get("topik k");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	// public function gettopiksitus($id_situs, $id_topik){
	// 	$this->db->where("k.id_situs", $id_situs);
	// 	$this->db->where("k.id_topik", $id_topik);
	// 	$query = $this->db->get("topik_situs k");
		
	// 	return $query->row();
	// }

	// public function gettopiksitusbyid($id_topik_situs){
	// 	$this->db->where("ts.id_topik_situs", $id_topik_situs);
	// 	$this->db->join("topik t", "ts.id_topik=t.id_topik");
	// 	$this->db->join("situs s", "ts.id_situs=s.id_situs");
	// 	$query = $this->db->get("topik_situs ts");
		
	// 	return $query->row();
	// }

	// public function countAllefasbyid($id_topik_situs){
	// 	$this->db->where("b.id_topik_situs", $id_topik_situs);
	// 	$query = $this->db->get("efas b");
	// 	return $query->num_rows();
	// }

	// public function getAllefasbyid($limit, $start, $id_topik_situs){
	// 	$this->db->limit($limit, $start);
	// 	$this->db->where("b.id_topik_situs", $id_topik_situs);
	// 	$query = $this->db->get("efas b");
 
 //        if ($query->num_rows() > 0) {
 //            foreach ($query->result() as $row) {
 //                $data[] = $row;
 //            }
 //            return $data;
 //        }
 //        return false;
	// }

	// public function getCounttopik(){
	// 	$this->db->select("ts.id_topik_situs, s.id_situs, t.id_topik, count(b.efas) as jumlah");
	// 	$this->db->group_by("ts.id_situs");
	// 	$this->db->group_by("ts.id_topik");
	// 	$this->db->join("topik_situs ts", "ts.id_topik_situs=b.id_topik_situs", 'right outer');
	// 	$this->db->join("topik t", "ts.id_topik=t.id_topik");
	// 	$this->db->join("situs s", "ts.id_situs=s.id_situs");
	// 	$query = $this->db->get("efas b");
 
 //        if ($query->num_rows() > 0) {
 //            foreach ($query->result() as $row) {
 //                $data[] = $row;
 //            }
 //            return $data;
 //        }
 //        return false;
	// }
	
	// public function tambah($data){
	// 	$this->db->insert('efas', $data);
	// }
	
}