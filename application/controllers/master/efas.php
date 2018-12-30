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
	
	public function home($id_topik_situs=0){
		$data['judul'] = '';
		$data["topik"] = $this->modelefas->getAlltopik();
		$this->load->view('master/efas/home', $data);
	}
	
	public function is_logged_in(){
		if(!$this->session->userdata('is_logged_in')){
			redirect('auth/login');
		}
	}

	public function preprocessing(){

	}

	public function classification(){

	}

	function ahp($id_berita){

	}

	public function prioritas(){

	}

	public function efas(){

	}

	public function python_exec(){
		$cmd="python c:/xampp/htdocs/efasonline/python/tes.py";

		$command = escapeshellcmd($cmd);

		$output = shell_exec($command);
	}

	public function read_csv(){
		$array = $fields = array(); $i = 0;
		$handle = @fopen("d:/efas/berita.csv", "r");
		if ($handle) {
		    while (($row = fgetcsv($handle, null, ';')) !== false) {
		        if (empty($fields)) {
		            $fields = $row;
		            continue;
		        }
		        foreach ($row as $k=>$value) {
		            $array[$i][$fields[$k]] = $value;
		        }
		        $i++;
		    }
		    if (!feof($handle)) {
		        echo "Error: unexpected fgets() fail\n";
		    }
		    echo "<pre>";
		   	print_r($array);
		    echo "</pre>";
		    fclose($handle);
		}
	}
}	