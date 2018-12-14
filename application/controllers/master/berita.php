<?php 

class Berita extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('master/modelberita');
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
		$data["situs"] = $this->modelberita->getAllsitus();
		$data["topik"] = $this->modelberita->getAlltopik();
		$data["listberita"] = $this->modelberita->getCounttopik();
		
		$config = array();
        $config["base_url"] = base_url() . "master/berita/home/".$id_topik_situs;
        $config["total_rows"] = $this->modelberita->countAllberitabyid($id_topik_situs);
        $config["per_page"] = 10;
        $config["uri_segment"] = 5;
		
		//css pagination
		$config['full_tag_open'] = "<ul class='pagination pull-right'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		
		
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$data["page"] = $page;
		$data["links"] = $this->pagination->create_links();

		$data["detailberita"] = $this->modelberita->getAllberitabyid($config["per_page"], $page, $id_topik_situs);
		
		if($data["detailberita"]){
			$row = $this->modelberita->gettopiksitusbyid($id_topik_situs);
			$data["id_topik_situs"] = $id_topik_situs;
			$data["nama_situs"] = $row->situs;
			$data["nama_topik"] = $row->topik;
		}
		// echo "<pre>";
		// var_dump($data['detailberita']);
		// echo "</pre>";
		$this->load->view('master/berita/home', $data);
	}
	
	public function tambah($id_situs=0, $id_topik=0){
		
		$data['id_situs'] = $id_situs;
		$data['id_topik'] = $id_topik;
	
		$data['situs']=$this->modelberita->getAllsitus();
		$data['topik']=$this->modelberita->getAlltopik();
	
		$this->load->view('master/berita/tambah', $data);
	}
		
	public function submit(){
		$id_situs = $this->input->post('id_situs');
		$id_topik = $this->input->post('id_topik');
		$tanggal_awal = $this->input->post('tanggal_awal');
		$tanggal_akhir = $this->input->post('tanggal_akhir');
		$page = $this->input->post('page');

		$row=$this->modelberita->gettopiksitus($id_situs, $id_topik);

		$count=0;
		switch ($id_situs){
		    case 1:
		    	$begin = new DateTime($tanggal_awal);
				$end = new DateTime($tanggal_akhir);

				for($i = $begin; $i <= $end; $i->modify('+1 day')){
					$tanggal = $i->format("Y-m-d");
					$value = $this->detik($id_situs, $id_topik, $tanggal);
					$banyakberita = $this->insertberita($value, $row->id_topik_situs, $tanggal, $id_situs);
					$count = $count + $banyakberita;
				}
		        break;
		    case 2:
		    	$begin = new DateTime($tanggal_awal);
				$end = new DateTime($tanggal_akhir);

				for($i = $begin; $i <= $end; $i->modify('+1 day')){
					$tanggal = $i->format("Y-m-d");
					$value = $this->okezone($id_situs, $id_topik, $tanggal);
					$banyakberita = $this->insertberita($value, $row->id_topik_situs, $tanggal, $id_situs);
					$count = $count + $banyakberita;
				}
		        break;
		    case 3:
		    	$begin = new DateTime($tanggal_awal);
				$end = new DateTime($tanggal_akhir);

				for($i = $begin; $i <= $end; $i->modify('+1 day')){
					$tanggal = $i->format("Y-m-d");
					$value = $this->kompas($id_situs, $id_topik, $tanggal);
					$banyakberita = $this->insertberita($value, $row->id_topik_situs, $tanggal, $id_situs);
					$count = $count + $banyakberita;
				}
		        break;
	        case 4:
	        	$value = $this->rmol($id_situs, $id_topik, $page);
				$banyakberita = $this->insertberita($value, $row->id_topik_situs, $page, $id_situs);
				$count = $count + $banyakberita;
		        break;
		    case 5:
		    	if($id_topik==1 || $id_topik==3 || $id_topik==5 || $id_topik==6){
					$value = $this->metrotvnews($id_situs, $id_topik, $page);
		    		$tanggal="";
		    		$banyakberita = $this->insertberita($value, $row->id_topik_situs, $tanggal, $id_situs);
					$count = $count + $banyakberita;
		    	}else{
		    		$begin = new DateTime($tanggal_awal);
					$end = new DateTime($tanggal_akhir);

					for($i = $begin; $i <= $end; $i->modify('+1 day')){
						$tanggal = $i->format("Y-m-d");
						$value = $this->metrotvnews($id_situs, $id_topik, $tanggal);
						
						$banyakberita = $this->insertberita($value, $row->id_topik_situs, $tanggal, $id_situs);
						$count = $count + $banyakberita;
					}
		    	}
		        break;
		    default:
		        $this->session->set_flashdata('message', 'Pilih situs berita yang ingin ditambahkan!');
				$this->session->set_flashdata('statusmessage', '2');

				redirect('master/berita/tambah');
		}

		$this->session->set_flashdata('message', 'Data berhasil ditambah dengan jumlah '.$count.' judul berita!');
		$this->session->set_flashdata('statusmessage', '1');

		redirect('master/berita/tambah/'.$id_situs.'/'.$id_topik);	
	}

	public function is_logged_in(){
		if(!$this->session->userdata('is_logged_in')){
			redirect('auth/login');
		}
	}

	function insertberita($value='', $id_topik_situs=0, $tanggal='', $id_situs=0){
		$count=0;
		foreach ($value as $val) {
			$data["id_topik_situs"] = $id_topik_situs;
			if ($id_situs!=4) {
				$data['tanggal_terbit'] = $tanggal;
			}
			$data['berita'] = $val;
			$count++;
			$this->modelberita->tambah($data);
		}

		return $count;
	}

	function detik($situs=0, $topik=0, $tanggal=''){

		$row=$this->modelberita->gettopiksitus($situs, $topik);
		$newDate = date("m/d/Y", strtotime($tanggal));
		$tanggal = str_replace('/', '%2F', $newDate);
		
		$main_url = '';
		$main_url = ''.$row->link_url.''.$tanggal;
		
		$str = file_get_contents($main_url);

		// Gets Webpage Internal Links
		$doc = new DOMDocument; 
		@$doc->loadHTML($str); 
		$items = $doc->getElementsByTagName('h2'); 

		$data = array();
		foreach($items as $value){ 
			$attrs = $value->textContent;
			$data[] = $attrs; 
		}
		
		return $data;
	}

	function okezone($situs=0, $topik=0, $tanggal=''){
		$row=$this->modelberita->gettopiksitus($situs, $topik);
		$data = array (
		'tgl' => date("d", strtotime($tanggal)),
		'bln' => date("m", strtotime($tanggal)),
		'thn' => date("Y", strtotime($tanggal))
		);

		$query = http_build_query($data);
		$options = array(
		    'http' => array(
		        'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
		                    "Content-Length: ".strlen($query)."\r\n".
		                    "User-Agent:MyAgent/1.0\r\n",
		        'method'  => "POST",
		        'content' => $query,
		    ),
		);

		$main_url = $row->link_url;
		$context = stream_context_create($options);
		$str = file_get_contents($main_url, false, $context, -1, 40000);

		// Gets Webpage Internal Links
		$doc = new DOMDocument; 
		@$doc->loadHTML($str); 
		$items = $doc->getElementsByTagName('h4'); 

		$data = array();
		
		$idx=0;
		foreach($items as $value){ 
			if($idx!=0){
				$attrs = $value->textContent;
				$newData = trim($attrs);
				$data[] = $newData; 
			}
			$idx++;
		}

		return $data;
	}

	function kompas($situs=0, $topik=0, $tanggal=''){

		$row=$this->modelberita->gettopiksitus($situs, $topik);
		
		$main_url = $row->link_url.''.$tanggal;
		$str = file_get_contents($main_url);

		// Gets Webpage Internal Links
		$doc = new DOMDocument; 
		@$doc->loadHTML($str); 
		$items = $doc->getElementsByTagName('h3'); 

		$data = array();
		
		foreach($items as $value){ 
			$attrs = $value->textContent;
			$newData = trim($attrs);
			$data[] = $newData; 
		}
		return $data;
	}
	
	function rmol($situs=0, $topik=0, $page=0){

		$row=$this->modelberita->gettopiksitus($situs, $topik);
		
		$main_url = $row->link_url.''.$page;
		$str = file_get_contents($main_url);

		// Gets Webpage Internal Links
		$doc = new DOMDocument; 
		@$doc->loadHTML($str); 
		$items = $doc->getElementsByTagName('h2'); 

		$data = array();
		
		$count=0;
		foreach($items as $value){ 
			$attrs = $value->textContent;
			$newData = trim($attrs);
			if ($count<20) {
				$data[] = $newData;
			}
			$count++;
		}
		
		return $data;
	}

	function metrotvnews($situs=5, $topik=1, $tanggal=''){

		$row=$this->modelberita->gettopiksitus($situs, $topik);
		$newDate = date("Y/m/d", strtotime($tanggal));
		
		if($topik==1 || $topik==5){
			$page = ($tanggal-1)*20;
			$main_url = $row->link_url.''.$page;
		}else{
			$main_url = $row->link_url.''.$newDate;
		}
		$str = file_get_contents($main_url);

		// Gets Webpage Internal Links
		$doc = new DOMDocument; 
		@$doc->loadHTML($str); 
		$items = $doc->getElementsByTagName('h2'); 

		$data = array();
		
		foreach($items as $value){ 
			$attrs = $value->textContent;
			$newData = trim($attrs);
			if(strlen($newData)>13){
				$data[] = $newData; 
			}
		}
		return $data;
	}
}	