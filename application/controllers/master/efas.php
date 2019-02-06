<?php 

class efas extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('master/modelefas');
		$this->load->helper("url");
		$this->load->helper("download");
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->library("pagination");
		$this->load->library('form_validation');
		$this->is_logged_in();
	}
	
	public function index(){
		$this->home();
	}
	
	public function home(){
		$data['tahap'] = 0;
		$data['cek'] = $this->modelefas->getAllterm_training();
		$data["topik"] = $this->modelefas->getAlltopik();
		$this->load->view('master/efas/home', $data);
	}
	
	public function is_logged_in(){
		if(!$this->session->userdata('is_logged_in')){
			redirect('auth/login');
		}
	}

	// ========================================== Preprocessing ========================================== //
	public function preprocessing(){
		$data['tahap'] = 1;
		$data['cek'] = $this->modelefas->getAllterm_training();
		$data["topik"] = $this->modelefas->getAlltopik();
		$this->load->view('master/efas/home', $data);
	}

	public function preprocessing_submit(){
		$id_topik = $this->input->post('id_topik');
		$jenis = $this->input->post('jenis');
		$jenis_data = ($jenis==1? 'training': 'testing');

		if($id_topik==1){
			$path_file = "./python/".$jenis_data."/".$jenis_data."_preprocess_politik.csv";
			$filename = "".$jenis_data."_preprocess_politik";
		}elseif ($id_topik==2){
			$path_file = "./python/".$jenis_data."/".$jenis_data."_preprocess_ekonomi.csv";
			$filename = "".$jenis_data."_preprocess_ekonomi";
		}elseif ($id_topik==3){
			$path_file = "./python/".$jenis_data."/".$jenis_data."_preprocess_sosial.csv";
			$filename = "".$jenis_data."_preprocess_sosial";
		}elseif ($id_topik==4){
			$path_file = "./python/".$jenis_data."/".$jenis_data."_preprocess_teknologi.csv";
			$filename = "".$jenis_data."_preprocess_teknologi";
		}
		//delete file exist
		if(@unlink($path_file)){}

		// $config['upload_path'] = './python/'.$jenis_data.'/';
	 //    $config['allowed_types'] = 'csv';
	 //    $config['max_size'] = '10000';
	 //    $config['overwrite'] = TRUE;
	 //    $config['encrypt_name'] = FALSE;
	 //    $config['remove_spaces'] = TRUE;
	 //    $config['file_name'] = $filename;
	 //    if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
	 //    $this->load->library('upload', $config);
	 //    if ( ! $this->upload->do_upload('userfile')) {
	 //        echo 'error';
	 //    } else {
	 //        $upload_data = $this->upload->data();
	 //    }

	    //update tabel training data
	    // $this->update_training_csv();

	    //run preprocessing python
	    $this->preprocessing_exec($id_topik, $jenis);

		$this->session->set_flashdata('message', 'Data berhasil diupload!');
		$this->session->set_flashdata('statusmessage', '1');
	    redirect('master/efas');
		// $row=$this->modelberita->gettopiksitus($id_situs, $id_topik);
	}

	public function preprocessing_exec($topik=0, $jenis=0){
		ini_set('max_execution_time', 0);
		set_time_limit(0);

		$jenis_data = ($jenis==1? 'training': 'testing');

		if($topik==1){
			$path_file = "python/preprocess_".$jenis_data."_politik.py";
		}elseif ($topik==2){
			$path_file = "python/preprocess_".$jenis_data."_ekonomi.py";
		}elseif ($topik==3){
			$path_file = "python/preprocess_".$jenis_data."_sosial.py";
		}elseif ($topik==4){
			$path_file = "python/preprocess_".$jenis_data."_teknologi.py";
		}
		$cmd="python c:/xampp/htdocs/efasonline/".$path_file;

		// $command = escapeshellcmd($cmd);

		$output = shell_exec($cmd);
	}

	public function download_preprocess($id_topik=0){
		$row=$this->modelefas->download_preprocess($id_topik);
		redirect('master/efas');
	}

	// ========================================== Build Model ========================================== //
	public function build_model(){
		$data['tahap'] = 2;
		$data["topik"] = $this->modelefas->getAlltopik();
		$this->load->view('master/efas/home', $data);
	}

	// ========================================== Classification ========================================== //
	public function classification(){
		$data['tahap'] = 3;
		$data["topik"] = $this->modelefas->getAlltopik();
		$this->load->view('master/efas/home', $data);
	}

	// ========================================== Prioritas ========================================== //
	public function prioritas($id_topik=0, $algoritma=0){
		$id_topik = $this->input->post('id_topik');
		$algoritma = $this->input->post('algoritma');
		$data['tahap'] = 4;
		$data['id_topik'] = $id_topik;
		$data['algoritma'] = $algoritma;
		$data["topik"] = $this->modelefas->getAlltopik();

		if($algoritma==1){
			$data["hasil_algoritma"] = $this->ahp($id_topik);
		}else{
			$data["hasil_algoritma"] = $this->topsis($id_topik);	
		}
		$this->load->view('master/efas/home', $data);
	}

	//sorting bobot
	function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
	    $sort_col = array();
	    foreach ($arr as $key=> $row) {
	        $sort_col[$key] = $row[$col];
	    }
	    array_multisort($sort_col, $dir, $arr);
	}

	function ahp($id_topik=0){
		error_reporting(0);
	    $data = array();
		
		$c1 = 0.320;
		$c2 = 0.122;
		$c3 = 0.558;

		$array = $fields = array(); $i = 0;
		$handle = "";
		if($id_topik==1){
			$handle = @fopen("./python/testing/test1_label.csv", "r");
		}elseif($id_topik==2){
			$handle = @fopen("./python/testing/test2_label.csv", "r");
		}elseif($id_topik==3){
			$handle = @fopen("./python/testing/test3_label.csv", "r");
		}elseif($id_topik==4){
			$handle = @fopen("./python/testing/test4_label.csv", "r");
		}elseif($id_topik==5){
			$handle = @fopen("./python/testing/test5_label.csv", "r");
		}elseif($id_topik==6){
			$handle = @fopen("./python/testing/test6_label.csv", "r");
		}

		if ($handle) {
		    while (($row = fgetcsv($handle, null, ',')) !== false) {
		        if (empty($fields)) {
		            $fields = $row;
		            continue;
		        }
		        foreach ($row as $k=>$value) {
		            @$array[$i][$fields[$k]] = $value;
		        }
		        $i++;
		    }
		    if (!feof($handle)) {
		        echo "Error: unexpected fgets() fail\n";
		    }
		    fclose($handle);


			$sum_c1 = 0;
			$sum_c2 = 0;
			$sum_c3 = 0;
			$count = 0;
			foreach ($array as $value) {
				$row=$this->modelefas->getberitabyid_testing($value['id_testing_data']);
				if($row && $value['category_id']!=3){
					$sum_c1 += strtotime($row->tanggal_terbit);
					$sum_c2 += $row->value_situs;
					$sum_c3 += $value['accuracy_test'];
				}
			}

		    foreach ($array as $value) {
				$row=$this->modelefas->getberitabyid_testing($value['id_testing_data']);
				if($row && $value['category_id']!=3){
					$data[$value['id_testing_data']]['id_testing_data'] = $value['id_testing_data'];
					$data[$value['id_testing_data']]['kelas'] = $value['category_id'];
					$data[$value['id_testing_data']]['berita'] = $row->berita;
					$data[$value['id_testing_data']]['tanggal'] = strtotime($row->tanggal_terbit)/$sum_c1;
					$data[$value['id_testing_data']]['value_situs'] = $row->value_situs/$sum_c2;
					$data[$value['id_testing_data']]['akurasi'] = $value['accuracy_test']/$sum_c3;
					$data[$value['id_testing_data']]['bobot'] = number_format(($data[$value['id_testing_data']]['tanggal']*$c1)+($data[$value['id_testing_data']]['value_situs']*$c2)+($data[$value['id_testing_data']]['akurasi']*$c3),5);
				}
			}

			$this->array_sort_by_column($data, 'bobot');

		}

		return $data;
	}

	function TOPSIS($id_topik=0){
		error_reporting(0);
	    $data = array();
		
		$c1 = 0.25;
		$c2 = 0.35;
		$c3 = 0.4;

		$array = $fields = array(); $i = 0;
		$handle = "";
		if($id_topik==1){
			$handle = @fopen("./python/testing/test1_label.csv", "r");
		}elseif($id_topik==2){
			$handle = @fopen("./python/testing/test2_label.csv", "r");
		}elseif($id_topik==3){
			$handle = @fopen("./python/testing/test3_label.csv", "r");
		}elseif($id_topik==4){
			$handle = @fopen("./python/testing/test4_label.csv", "r");
		}elseif($id_topik==5){
			$handle = @fopen("./python/testing/test5_label.csv", "r");
		}elseif($id_topik==6){
			$handle = @fopen("./python/testing/test6_label.csv", "r");
		}

		if ($handle) {
		    while (($row = fgetcsv($handle, null, ',')) !== false) {
		        if (empty($fields)) {
		            $fields = $row;
		            continue;
		        }
		        foreach ($row as $k=>$value) {
		            @$array[$i][$fields[$k]] = $value;
		        }
		        $i++;
		    }
		    if (!feof($handle)) {
		        echo "Error: unexpected fgets() fail\n";
		    }
		    fclose($handle);


			$sum_c1 = 0;
			$sum_c2 = 0;
			$sum_c3 = 0;
			$count = 0;
			foreach ($array as $value) {
				$row=$this->modelefas->getberitabyid_testing($value['id_testing_data']);
				if($row && $value['category_id']!=3){
					$sum_c1 += pow(strtotime($row->tanggal_terbit),2);
					$sum_c2 += pow($row->value_situs,2);
					$sum_c3 += pow($value['accuracy_test'],2);
				}
			}

		    foreach ($array as $value) {
				$row=$this->modelefas->getberitabyid_testing($value['id_testing_data']);
				if($row && $value['category_id']!=3){
					$data[$value['id_testing_data']]['id_testing_data'] = $value['id_testing_data'];
					$data[$value['id_testing_data']]['kelas'] = $value['category_id'];
					$data[$value['id_testing_data']]['berita'] = $row->berita;
					$data[$value['id_testing_data']]['tanggal'] = strtotime($row->tanggal_terbit)/sqrt($sum_c1)*$c1;
					$data[$value['id_testing_data']]['value_situs'] = $row->value_situs/sqrt($sum_c2)*$c2;
					$data[$value['id_testing_data']]['akurasi'] = $value['accuracy_test']/sqrt($sum_c3)*$c3;
					$data[$value['id_testing_data']]['dmax'] = 0;
					$data[$value['id_testing_data']]['dmin'] = 0;
					$data[$value['id_testing_data']]['bobot'] = 0;
				}
			}

			$ymax = array(0,0,0);
			$ymin = array(0,0,0);

			$ymax[0] = max(array_column($data, 'tanggal'));
			$ymax[1] = max(array_column($data, 'value_situs'));
			$ymax[2] = max(array_column($data, 'akurasi'));
			
			$ymin[0] = min(array_column($data, 'tanggal'));
			$ymin[1] = min(array_column($data, 'value_situs'));
			$ymin[2] = min(array_column($data, 'akurasi'));

			foreach ($array as $value) {
				$row=$this->modelefas->getberitabyid_testing($value['id_testing_data']);
				if($row && $value['category_id']!=3){
					$data[$value['id_testing_data']]['dmax'] = sqrt((pow($ymax[0] - $data[$value['id_testing_data']]['tanggal'], 2))+(pow($ymax[1] - $data[$value['id_testing_data']]['value_situs'], 2))+(pow($ymax[2] - $data[$value['id_testing_data']]['akurasi'], 2)));
					$data[$value['id_testing_data']]['dmin'] = sqrt((pow($ymin[0] - $data[$value['id_testing_data']]['tanggal'], 2))+(pow($ymin[1] - $data[$value['id_testing_data']]['value_situs'], 2))+(pow($ymin[2] - $data[$value['id_testing_data']]['akurasi'], 2)));
					$data[$value['id_testing_data']]['bobot'] = number_format($data[$value['id_testing_data']]['dmin']/($data[$value['id_testing_data']]['dmax']+$data[$value['id_testing_data']]['dmin']), 5);
				}
			}

			$this->array_sort_by_column($data, 'bobot');
		}

		return $data;
	}

	// ========================================== EFAS ========================================== //
	
	public function efas_view(){
		$data['tahap'] = 5;
		$data["topik"] = $this->modelefas->getAlltopik();
		$efas = $this->modelefas->getAllefas();

		$rating = array();
		$score = array();
		foreach($efas as $e){
			$rating[$e->id_testing_data] = $e->rating;
			$score[$e->id_testing_data] = $e->score;
		}

		$algoritma = array();
		foreach($data["topik"] as $t){
			$algoritma[$t->id_topik] = $this->topsis($t->id_topik);
		}

		$data['rating'] = $rating;
		$data['score'] = $score;
		$data['hasil'] = $algoritma;
		$this->load->view('master/efas/home', $data);
	}

	public function submit_efas(){
		$id_testing_data = $this->input->post('id_testing_data');
		$bobot = $this->input->post('bobot');
		$kelas = $this->input->post('kelas');
		$rating = $this->input->post('rating');
		
		$sum_bobot = array_sum($bobot);
		echo $sum_bobot;

		foreach($kelas as $k => $val){
			if($val == 1){
				$data['id_kelas'] = 1;
				$data['id_testing_data'] = $id_testing_data[$k];
				$data['rating'] = $rating[$k];
				$data['weight'] = $bobot[$k]/$sum_bobot;
				$data['score'] = $data['weight']*$data['rating'];
				$this->modelefas->tambah_efas($data);
			}elseif($val == 2){
				$data['id_kelas'] = 1;
				$data['id_testing_data'] = $id_testing_data[$k];
				$data['rating'] = $rating[$k];
				$data['weight'] = $bobot[$k]/$sum_bobot;
				$data['score'] = $data['weight']*$data['rating'];
				$this->modelefas->tambah_efas($data);
			}
		}

		$this->session->set_flashdata('message', 'Data berhasil diupload!');
		$this->session->set_flashdata('statusmessage', '1');
	    redirect('master/efas/summary');
	}
	// ========================================== Summary ========================================== //
	public function summary(){
		$data['tahap'] = 6;
		$data['efas'] = $this->modelefas->getAllefas();
		$data["topik"] = $this->modelefas->getAlltopik();
		$efas = $this->modelefas->getAllefas();

		$rating = array();
		$score = array();
		$weight = array();
		foreach($efas as $e){
			$rating[$e->id_testing_data] = $e->rating;
			$score[$e->id_testing_data] = $e->score;
			$weight[$e->id_testing_data] = $e->weight;
		}

		$algoritma = array();
		foreach($data["topik"] as $t){
			$algoritma[$t->id_topik] = $this->ahp($t->id_topik);
		}

		$data['rating'] = $rating;
		$data['score'] = $score;
		$data['weight'] = $weight;
		$data['hasil'] = $algoritma;

		$total_score = 0;
		foreach($data['efas'] as $val){
			$total_score += $val->score;
		}

		$data['total_score'] = number_format($total_score,3);
		$this->load->view('master/efas/home', $data);
	}

	public function update_training_csv(){
		$array = $fields = array(); $i = 0;
		$handle = @fopen("./python/training/training.csv", "r");
		if ($handle) {
		    while (($row = fgetcsv($handle, null, ',')) !== false) {
		        if (empty($fields)) {
		            $fields = $row;
		            continue;
		        }
		        foreach ($row as $k=>$value) {
		            @$array[$i][$fields[$k]] = $value;
		        }
		        $i++;
		    }
		    if (!feof($handle)) {
		        echo "Error: unexpected fgets() fail\n";
		    }
		    fclose($handle);

		    foreach ($array as $value) {
				$data['id_training_data'] = $value['id_training_data'];
		    	if($value['training_class']=="Opportunity"){
		    		$data['id_kelas'] = 1;
		    	}elseif($value['training_class']=="Threat"){
		    		$data['id_kelas'] = 2;
		    	}else{
		    		$data['id_kelas'] = 3;
		    	}
	    		$row=$this->modelefas->update_training($data);
		    }
		}
	}

	public function preprocess_csv($topik=0){
		$array = $fields = array(); $i = 0;
		$handle = @fopen("./python/training/training_preprocess.csv", "r");
		if ($handle) {
		    while (($row = fgetcsv($handle, null, ';')) !== false) {
		        if (empty($fields)) {
		            $fields = $row;
		            continue;
		        }
		        foreach ($row as $k=>$value) {
		            @$array[$i][$fields[$k]] = $value;
		        }
		        $i++;
		    }
		    if (!feof($handle)) {
		        echo "Error: unexpected fgets() fail\n";
		    }
		    fclose($handle);

		    foreach ($array as $value) {
				$data['id_training_data'] = $value['id_training_data'];
				$data['term'] = $value['berita'];
		    	
	    		$row=$this->modelefas->save_term_training($data);
		    }

		    print_r($array);
		}
	}
}	