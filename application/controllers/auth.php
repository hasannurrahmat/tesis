<?php 

class Auth extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_auth');
	}
	
	public function index(){
		$this->login();
	}
	
	public function login(){
		if(!$this->session->userdata('is_logged_in')){
			$this->load->view('auth/form_login');
		}else{
			redirect('auth/home');
		}
	}
	
	public function home(){
		if(!$this->session->userdata('is_logged_in')){
			$this->load->view('auth/form_login');
		}else{
			
			$data['situs'] = $this->model_auth->getAllsitus();
			$data['topik'] = $this->model_auth->getAlltopik();
			// echo "<pre>";
			// print_r($data['situs']);
			// echo "</pre>";
			$data['user'] = $this->model_auth->getuser($this->session->userdata('username'));
			$this->load->view('auth/home', $data);
		}
	}
	
	public function validasi(){
	
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$query  = $this->model_auth->validasi_login($username, $password);
		
		//jika berhasil
		if($query){
		$data['username'] = $query->username;
			$data['id_group_user'] = $query->id_group_user;
			$data['group_user'] = $query->group_user;
			$data['id_user'] = $query->id_user;
			$data['nama'] = $query->nama;
		
			$data['is_logged_in'] = TRUE;
			//ses session utk login
			$this->session->set_userdata($data);
			
			redirect('auth/home');
			
		}else{ //gagal
			$this->session->set_flashdata('message', 'Username atau Password Salah!');
			$this->session->set_flashdata('statusmessage', '2');
			
			redirect('auth/login');
		}
	}
		
	function logout(){
		$this->session->sess_destroy();
		redirect('auth/login');
	}	

	function ganti(){
	    $config['upload_path'] = './uploads/profile_picture';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size'] = '10000';
	    $config['overwrite'] = TRUE;
	    $config['encrypt_name'] = FALSE;
	    $config['remove_spaces'] = TRUE;
	    $config['file_name'] = $this->session->userdata('username').''.time();
	    if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
	    $this->load->library('upload', $config);
	    if ( ! $this->upload->do_upload('userfile')) {
	        echo 'error';
	    } else {
	        $upload_data = $this->upload->data();


	        $data['file_photo'] = $upload_data['file_name'];
	        $this->db->where('username', $this->session->userdata('username'));
			$this->db->update('user', $data); 
	    }
	    redirect('auth/home');

	}
}