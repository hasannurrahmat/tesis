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
}	