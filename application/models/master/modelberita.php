<?php

class Modelberita extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getAllberita(){
		$query = $this->db->get("berita k");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function getAllsitus(){
		$query = $this->db->get("situs k");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

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

	public function gettopiksitus($id_situs, $id_topik){
		$this->db->where("k.id_situs", $id_situs);
		$this->db->where("k.id_topik", $id_topik);
		$query = $this->db->get("topik_situs k");
		
		return $query->row();
	}

	public function gettopiksitusbyid($id_topik_situs){
		$this->db->where("ts.id_topik_situs", $id_topik_situs);
		$this->db->join("topik t", "ts.id_topik=t.id_topik");
		$this->db->join("situs s", "ts.id_situs=s.id_situs");
		$query = $this->db->get("topik_situs ts");
		
		return $query->row();
	}

	//get data training
	public function countAlltrainingbyid($id_topik_situs){
		$this->db->where("b.id_topik_situs", $id_topik_situs);
		$this->db->join("berita b", "b.id_berita=td.id_berita");
		$query = $this->db->get("training_data td");
		return $query->num_rows();
	}

	public function getAlltrainingbyid($limit, $start, $id_topik_situs){
		$this->db->limit($limit, $start);
		$this->db->where("b.id_topik_situs", $id_topik_situs);
		$this->db->join("berita b", "b.id_berita=td.id_berita");
		$query = $this->db->get("training_data td");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	public function getCounttraining(){
		$this->db->select("ts.id_topik_situs, s.id_situs, t.id_topik, count(b.berita) as jumlah");
		$this->db->group_by("ts.id_situs");
		$this->db->group_by("ts.id_topik");
		$this->db->join("berita b", "b.id_berita=td.id_berita");
		$this->db->join("topik_situs ts", "ts.id_topik_situs=b.id_topik_situs", 'right outer');
		$this->db->join("topik t", "ts.id_topik=t.id_topik");
		$this->db->join("situs s", "ts.id_situs=s.id_situs");
		$query = $this->db->get("training_data td");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	// =========================================================================================== //

	//get data testing
	public function countAlltestingbyid($id_topik_situs){
		$this->db->where("b.id_topik_situs", $id_topik_situs);
		$this->db->join("berita b", "b.id_berita=td.id_berita");
		$query = $this->db->get("testing_data td");
		return $query->num_rows();
	}

	public function getAlltestingbyid($limit, $start, $id_topik_situs){
		$this->db->limit($limit, $start);
		$this->db->where("b.id_topik_situs", $id_topik_situs);
		$this->db->join("berita b", "b.id_berita=td.id_berita");
		$query = $this->db->get("testing_data td");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	public function getCounttesting(){
		$this->db->select("ts.id_topik_situs, s.id_situs, t.id_topik, count(b.berita) as jumlah");
		$this->db->group_by("ts.id_situs");
		$this->db->group_by("ts.id_topik");
		$this->db->join("berita b", "b.id_berita=td.id_berita");
		$this->db->join("topik_situs ts", "ts.id_topik_situs=b.id_topik_situs", 'right outer');
		$this->db->join("topik t", "ts.id_topik=t.id_topik");
		$this->db->join("situs s", "ts.id_situs=s.id_situs");
		$query = $this->db->get("testing_data td");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	
	// =========================================================================================== //
	
	public function tambah($data){
		$this->db->insert('berita', $data);
		$insertId = $this->db->insert_id();
		return $insertId;
	}

	public function tambah_training($data){
		$this->db->insert('training_data', $data);
	}
	
	public function tambah_testing($data){
		$this->db->insert('testing_data', $data);
	}

	public function export_training(){
		$this->load->helper('download');

		//delete file exist
		$path_file = './python/training/training.csv';
		if(@unlink($path_file)){}

		$location = "c:/xampp/htdocs/efasonline/python/training/training.csv";
		$enclosed = '"';
		$line_terminated = '\n';

		$SQL = "SELECT 'id_training_data', 'id_berita', 'id_topik','berita', 'training_class' UNION ALL SELECT t.id_training_data, t.id_berita, ts.id_topik, b.berita, k.kelas INTO OUTFILE '".$location."' FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '".$enclosed."' LINES TERMINATED BY '".$line_terminated."' FROM training_data t JOIN berita b ON t.id_berita = b.id_berita JOIN topik_situs ts ON b.id_topik_situs = ts.id_topik_situs JOIN kelas k ON t.id_kelas = k.id_kelas;";

		$query = $this->db->query($SQL);

		//download file
		$file = base_url().'python/training/training.csv';
		$data = file_get_contents($file);
		$filename = basename($file);
		
		force_download($filename, $data);
	}

	public function export_testing(){
		$this->load->helper('download');

		//delete file exist
		$path_file = './python/testing/testing.csv';
		if(@unlink($path_file)){}

		$location = "c:/xampp/htdocs/efasonline/python/testing/testing.csv";
		$enclosed = '"';
		$line_terminated = '\n';

		$SQL = "SELECT 'id_testing_data', 'id_berita', 'id_topik','berita', 'testing_class' UNION ALL SELECT t.id_testing_data, t.id_berita, ts.id_topik, b.berita, k.kelas INTO OUTFILE '".$location."' FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '".$enclosed."' LINES TERMINATED BY '".$line_terminated."' FROM testing_data t JOIN berita b ON t.id_berita = b.id_berita JOIN topik_situs ts ON b.id_topik_situs = ts.id_topik_situs JOIN kelas k ON t.id_kelas = k.id_kelas;";

		$query = $this->db->query($SQL);

		//download file
		$file = base_url().'python/testing/testing.csv';
		$data = file_get_contents($file);
		$filename = basename($file);
		
		force_download($filename, $data);
	}
=======
<?php

class Modelberita extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getAllberita(){
		$query = $this->db->get("berita k");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function getAllsitus(){
		$query = $this->db->get("situs k");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

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

	public function gettopiksitus($id_situs, $id_topik){
		$this->db->where("k.id_situs", $id_situs);
		$this->db->where("k.id_topik", $id_topik);
		$query = $this->db->get("topik_situs k");
		
		return $query->row();
	}

	public function gettopiksitusbyid($id_topik_situs){
		$this->db->where("ts.id_topik_situs", $id_topik_situs);
		$this->db->join("topik t", "ts.id_topik=t.id_topik");
		$this->db->join("situs s", "ts.id_situs=s.id_situs");
		$query = $this->db->get("topik_situs ts");
		
		return $query->row();
	}

	//get data training
	public function countAlltrainingbyid($id_topik_situs){
		$this->db->where("b.id_topik_situs", $id_topik_situs);
		$this->db->join("berita b", "b.id_berita=td.id_berita");
		$query = $this->db->get("training_data td");
		return $query->num_rows();
	}

	public function getAlltrainingbyid($limit, $start, $id_topik_situs){
		$this->db->limit($limit, $start);
		$this->db->where("b.id_topik_situs", $id_topik_situs);
		$this->db->join("berita b", "b.id_berita=td.id_berita");
		$query = $this->db->get("training_data td");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	public function getCounttraining(){
		$this->db->select("ts.id_topik_situs, s.id_situs, t.id_topik, count(b.berita) as jumlah");
		$this->db->group_by("ts.id_situs");
		$this->db->group_by("ts.id_topik");
		$this->db->join("berita b", "b.id_berita=td.id_berita");
		$this->db->join("topik_situs ts", "ts.id_topik_situs=b.id_topik_situs", 'right outer');
		$this->db->join("topik t", "ts.id_topik=t.id_topik");
		$this->db->join("situs s", "ts.id_situs=s.id_situs");
		$query = $this->db->get("training_data td");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	// =========================================================================================== //

	//get data testing
	public function countAlltestingbyid($id_topik_situs){
		$this->db->where("b.id_topik_situs", $id_topik_situs);
		$this->db->join("berita b", "b.id_berita=td.id_berita");
		$query = $this->db->get("testing_data td");
		return $query->num_rows();
	}

	public function getAlltestingbyid($limit, $start, $id_topik_situs){
		$this->db->limit($limit, $start);
		$this->db->where("b.id_topik_situs", $id_topik_situs);
		$this->db->join("berita b", "b.id_berita=td.id_berita");
		$query = $this->db->get("testing_data td");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	public function getCounttesting(){
		$this->db->select("ts.id_topik_situs, s.id_situs, t.id_topik, count(b.berita) as jumlah");
		$this->db->group_by("ts.id_situs");
		$this->db->group_by("ts.id_topik");
		$this->db->join("berita b", "b.id_berita=td.id_berita");
		$this->db->join("topik_situs ts", "ts.id_topik_situs=b.id_topik_situs", 'right outer');
		$this->db->join("topik t", "ts.id_topik=t.id_topik");
		$this->db->join("situs s", "ts.id_situs=s.id_situs");
		$query = $this->db->get("testing_data td");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	
	// =========================================================================================== //
	
	public function tambah($data){
		$this->db->insert('berita', $data);
		$insertId = $this->db->insert_id();
		return $insertId;
	}

	public function tambah_training($data){
		$this->db->insert('training_data', $data);
	}
	
	public function tambah_testing($data){
		$this->db->insert('testing_data', $data);
	}

	public function export_training(){
		$this->load->helper('download');

		//delete file exist
		$path_file = './python/training/training.csv';
		if(@unlink($path_file)){}

		$location = "c:/xampp/htdocs/efasonline/python/training/training.csv";
		$enclosed = '"';
		$line_terminated = '\n';

		$SQL = "SELECT 'id_training_data', 'id_berita', 'id_topik','berita', 'training_class' UNION ALL SELECT t.id_training_data, t.id_berita, ts.id_topik, b.berita, k.kelas INTO OUTFILE '".$location."' FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '".$enclosed."' LINES TERMINATED BY '".$line_terminated."' FROM training_data t JOIN berita b ON t.id_berita = b.id_berita JOIN topik_situs ts ON b.id_topik_situs = ts.id_topik_situs JOIN kelas k ON t.id_kelas = k.id_kelas;";

		$query = $this->db->query($SQL);

		//download file
		$file = base_url().'python/training/training.csv';
		$data = file_get_contents($file);
		$filename = basename($file);
		
		force_download($filename, $data);
	}

	public function export_testing(){
		$this->load->helper('download');

		//delete file exist
		$path_file = './python/testing/testing.csv';
		if(@unlink($path_file)){}

		$location = "c:/xampp/htdocs/efasonline/python/testing/testing.csv";
		$enclosed = '"';
		$line_terminated = '\n';

		$SQL = "SELECT 'id_testing_data', 'id_berita', 'id_topik','berita', 'testing_class' UNION ALL SELECT t.id_testing_data, t.id_berita, ts.id_topik, b.berita, k.kelas INTO OUTFILE '".$location."' FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '".$enclosed."' LINES TERMINATED BY '".$line_terminated."' FROM testing_data t JOIN berita b ON t.id_berita = b.id_berita JOIN topik_situs ts ON b.id_topik_situs = ts.id_topik_situs JOIN kelas k ON t.id_kelas = k.id_kelas;";

		$query = $this->db->query($SQL);

		//download file
		$file = base_url().'python/testing/testing.csv';
		$data = file_get_contents($file);
		$filename = basename($file);
		
		force_download($filename, $data);
	}
}