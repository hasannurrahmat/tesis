<?php

class Modelefas extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getAllterm_training(){
		$query = $this->db->get("term_training_data k");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
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

	public function getAllefas(){
		$query = $this->db->get("efas k");
 
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

	public function getberitabyid_testing($id_testing_data){
		$this->db->where("ts.id_testing_data", $id_testing_data);
		$this->db->join("berita t", "ts.id_berita=t.id_berita");
		$this->db->join("topik_situs s", "t.id_topik_situs=s.id_topik_situs");
		$query = $this->db->get("testing_data ts");
		
		return $query->row();
	}

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
	
	public function save_term_training($data){
		$this->db->insert('term_training_data', $data);
	}

	public function tambah_efas($data){
		$this->db->insert('efas', $data);
	}

	public function update_training($data){
		$this->db->where('id_training_data', $data['id_training_data']);
    	$this->db->update('training_data', $data);
	}

	public function download_preprocess($id_topik=0){
		$this->load->helper('download');

		$filename = '';
		if($id_topik==1){
			$filename = 'training_politik.csv';
		}elseif($id_topik==2){
			$filename = 'training_ekonomi.csv';
		}elseif($id_topik==3){
			$filename = 'training_sosial.csv';
		}elseif($id_topik==4){
			$filename = 'training_teknologi.csv';
		}elseif($id_topik==5){
			$filename = 'training_legal.csv';
		}elseif($id_topik==6){
			$filename = 'training_environment.csv';
		}
		//delete file exist
		$path_file = './python/training/'.$filename;
		if(@unlink($path_file)){}

		$location = "c:/xampp/htdocs/efasonline/python/training/".$filename;
		$enclosed = '"';
		$line_terminated = '\n';

		$SQL = "SELECT 'id_training_data','term', 'training_class' UNION ALL SELECT tt.id_training_data, tt.term, k.kelas INTO OUTFILE '".$location."' FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '".$enclosed."' LINES TERMINATED BY '".$line_terminated."' FROM term_training_data tt JOIN training_data t ON tt.id_training_data = t.id_training_data JOIN berita b ON t.id_berita = b.id_berita JOIN topik_situs ts ON b.id_topik_situs = ts.id_topik_situs JOIN kelas k ON t.id_kelas = k.id_kelas where ts.id_topik=".$id_topik.";";

		$query = $this->db->query($SQL);

		//download file
		$file = base_url().'python/training/'.$filename;
		$data = file_get_contents($file);
		$filename = basename($file);
		
		force_download($filename, $data);
	}
}