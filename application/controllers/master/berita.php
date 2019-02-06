<?php 

class Berita extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('master/modelberita');
		$this->load->helper("url");
		$this->load->helper("download");
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->library("simple_html_dom");
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
		$data["list_training"] = $this->modelberita->getCounttraining();
		$data["list_testing"] = $this->modelberita->getCounttesting();
		
		$config = array();
        $config["base_url"] = base_url() . "master/berita/home/".$id_topik_situs;
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
		
		//pagination data training
		$config["total_rows"] = $this->modelberita->countAlltrainingbyid($id_topik_situs);
		
		$this->pagination->initialize($config);

		$page_training = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$data["page_training"] = $page_training;
		$data["links_training"] = $this->pagination->create_links();

		$data["detailtraining"] = $this->modelberita->getAlltrainingbyid($config["per_page"], $page_training, $id_topik_situs);

		//pagination data testing
		$config["total_rows"] = $this->modelberita->countAlltestingbyid($id_topik_situs);
		
		$this->pagination->initialize($config);

		$page_testing = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$data["page_testing"] = $page_testing;
		$data["links_testing"] = $this->pagination->create_links();

		$data["detailtesting"] = $this->modelberita->getAlltestingbyid($config["per_page"], $page_testing, $id_topik_situs);
		
		if($data["detailtesting"] || $data["detailtraining"]){
			$row = $this->modelberita->gettopiksitusbyid($id_topik_situs);
			
			$data["nama_situs"] = $row->situs;
			$data["nama_topik"] = $row->topik;
		}

		$this->load->view('master/berita/home', $data);
	}
	
	public function tambah_training($id_situs=0, $id_topik=0){
		
		$data['id_situs'] = $id_situs;
		$data['id_topik'] = $id_topik;
	
		$data['situs']=$this->modelberita->getAllsitus();
		$data['topik']=$this->modelberita->getAlltopik();
	
		$this->load->view('master/berita/tambah_training', $data);
	}

	public function tambah_testing($id_situs=0, $id_topik=0){
		
		$data['id_situs'] = $id_situs;
		$data['id_topik'] = $id_topik;
	
		$data['situs']=$this->modelberita->getAllsitus();
		$data['topik']=$this->modelberita->getAlltopik();
	
		$this->load->view('master/berita/tambah_testing', $data);
	}
		
	public function submit(){
		$jenis = $this->input->post('jenis');
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
					$banyakberita = $this->insertberita($value, $row->id_topik_situs, $tanggal, $id_situs, $jenis);
					$count = $count + $banyakberita;
				}
		        break;
		    case 2:
		    	$begin = new DateTime($tanggal_awal);
				$end = new DateTime($tanggal_akhir);

				for($i = $begin; $i <= $end; $i->modify('+1 day')){
					$tanggal = $i->format("Y-m-d");
					$value = $this->okezone($id_situs, $id_topik, $tanggal);
					$banyakberita = $this->insertberita($value, $row->id_topik_situs, $tanggal, $id_situs, $jenis);
					$count = $count + $banyakberita;
				}
		        break;
		    case 3:
		    	$begin = new DateTime($tanggal_awal);
				$end = new DateTime($tanggal_akhir);

				for($i = $begin; $i <= $end; $i->modify('+1 day')){
					$tanggal = $i->format("Y-m-d");
					$value = $this->kompas($id_situs, $id_topik, $tanggal);
					$banyakberita = $this->insertberita($value, $row->id_topik_situs, $tanggal, $id_situs, $jenis);
					$count = $count + $banyakberita;
				}
		        break;
	        case 4:
	        	$value = $this->rmol($id_situs, $id_topik, $page);
				$banyakberita = $this->insertberita($value, $row->id_topik_situs, $page, $id_situs, $jenis);
				$count = $count + $banyakberita;
		        break;
		    case 5:
		    	if($id_topik==1 || $id_topik==3 || $id_topik==5 || $id_topik==6){
					$value = $this->metrotvnews($id_situs, $id_topik, $page);
		    		$tanggal="";
		    		$banyakberita = $this->insertberita($value, $row->id_topik_situs, $tanggal, $id_situs, $jenis);
					$count = $count + $banyakberita;
		    	}else{
		    		$begin = new DateTime($tanggal_awal);
					$end = new DateTime($tanggal_akhir);

					for($i = $begin; $i <= $end; $i->modify('+1 day')){
						$tanggal = $i->format("Y-m-d");
						$value = $this->metrotvnews($id_situs, $id_topik, $tanggal);
						
						$banyakberita = $this->insertberita($value, $row->id_topik_situs, $tanggal, $id_situs, $jenis);
						$count = $count + $banyakberita;
					}
		    	}
		        break;
		    default:
		        $this->session->set_flashdata('message', 'Pilih situs berita yang ingin ditambahkan!');
				$this->session->set_flashdata('statusmessage', '2');

				if($jenis==1){
					redirect('master/berita/tambah_training');
				}else{
					redirect('master/berita/tambah_testing');
				}
		}

		$this->session->set_flashdata('message', 'Data berhasil ditambah dengan jumlah '.$count.' judul berita!');
		$this->session->set_flashdata('statusmessage', '1');

		if($jenis==1){
			redirect('master/berita/tambah_training/'.$id_situs.'/'.$id_topik);	
		}else{
			redirect('master/berita/tambah_testing/'.$id_situs.'/'.$id_topik);	
		}
	}

	public function export_training($topik=0){
		$this->modelberita->export_training($topik);

		$this->session->set_flashdata('message', 'Data training berhasil di export!');
		$this->session->set_flashdata('statusmessage', '1');

		redirect('master/berita/');
	}

	public function export_testing(){
		$this->modelberita->export_testing();

		$this->session->set_flashdata('message', 'Data testing berhasil di export!');
		$this->session->set_flashdata('statusmessage', '1');

		redirect('master/berita/');
	}

	public function is_logged_in(){
		if(!$this->session->userdata('is_logged_in')){
			redirect('auth/login');
		}
	}

	function insertberita($value='', $id_topik_situs=0, $tanggal='', $id_situs=0, $jenis=0){
		$count=0;
		foreach ($value as $val) {
			$data["id_topik_situs"] = $id_topik_situs;
			if ($id_situs!=4) {
				$data['tanggal_terbit'] = $tanggal;
			}
			$data['berita'] = $val['judul'];
			$data['url'] = $val['url'];
			$count++;
			$id_berita = $this->modelberita->tambah($data);

			$data1['id_berita'] = $id_berita;
			$data1['id_kelas'] = 3;
			
			if($jenis==1){
				$this->modelberita->tambah_training($data1);
			}else{
				$this->modelberita->tambah_testing($data1);
			}
		}

		return $count;
	}

	function detik($situs=0, $topik=0, $tanggal=''){
		error_reporting(E_ERROR | E_PARSE);

		$row=$this->modelberita->gettopiksitus($situs, $topik);
		$newDate = date("m/d/Y", strtotime($tanggal));
		$tanggal = str_replace('/', '%2F', $newDate);
		
		$main_url = '';
		$main_url = ''.$row->link_url.''.$tanggal;
		
		$str = file_get_contents($main_url);

		// Gets Webpage Internal Links
		$doc = new DOMDocument; 
		@$doc->loadHTML($str); 
		
		
		$data = array();
		//get title
		if($topik==3){
			$items = $doc->getElementsByTagName('h3');
		}else{
			$items = $doc->getElementsByTagName('h2');
		}

		$i=0;
		foreach($items as $value){
			$attrs = $value->textContent;
			if(strlen(trim($attrs))>25){
				$data[$i] = array();
				$data[$i]['judul'] = trim($attrs);
				$i++;
			}
		}
		
		//get url
		$string = substr($main_url, 8);
		$arr = explode("/", $string, 2);
		$site = $arr[0];

		$items = $doc->getElementsByTagName('a'); 
		$count = $i;
		$i=0;
		foreach($items as $value){ 
			$attrs = $value->attributes;

			@$string = substr($attrs->getNamedItem('href')->nodeValue, 8);
			$arr = explode("/", $string, 2);
			$site2 = strtolower($arr[0]);

			if(strlen($attrs->getNamedItem('href')->nodeValue)>45 && $i<$count && strcmp($site, $site2)==0){
		    	$data[$i]['url'] = $attrs->getNamedItem('href')->nodeValue;
		    	$i++;
			}
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

		$data = array();

		//get title
		$items = $doc->getElementsByTagName('h4'); 
		
		$i=0;
		$idx=0;
		foreach($items as $value){ 
			if($idx!=0){
				$attrs = $value->textContent;
				$newData = trim($attrs);
				$data[$i]['judul'] = $newData;
				$i++;
			}
			$idx++;
		}

		//get link
		//get url
		$items = $doc->getElementsByTagName('a'); 

		$count = $i;
		$i=0;
		$temp = '';	
		foreach($items as $value){ 
			$attrs = $value->attributes;
			if(strlen($attrs->getNamedItem('href')->nodeValue)>50){
				if($temp != $attrs->getNamedItem('href')->nodeValue && $i<$count){
		    		$temp = $attrs->getNamedItem('href')->nodeValue;
		    		$data[$i]['url'] = $attrs->getNamedItem('href')->nodeValue;
		    		$i++;
		    	}

			}
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

		//get title
		$items = $doc->getElementsByTagName('h3'); 

		$data = array();
		$i=0;

		foreach($items as $value){ 
			$attrs = $value->textContent;
			$newData = trim($attrs);
			$data[$i]['judul'] = $newData;
			$i++;
		}

		//get url
		$item = $doc->getElementsByTagName('a'); 
		$count = $i;
		$i=0;
		foreach($item as $value){ 
			$attr = $value->attributes;
			if(@strcmp($attr->getNamedItem('class')->nodeValue, "article__link") == 0 && $i<$count){
		    	$data[$i]['url'] = $attr->getNamedItem('href')->nodeValue;
		    	$i++;
			}
		}

		return $data;
	}
	
	function rmol($situs=0, $topik=0, $page=0){
		error_reporting(E_ERROR | E_PARSE);

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
			//get url
			foreach ($value->childNodes as $val){
				$url = $val->attributes;
				foreach($url as $v){
					if($count<20){
						$data[$count]['url'] = $v->nodeValue;
					}
				}
			}

			//get title
			$attrs = $value->textContent;
			$newData = trim($attrs);
			if ($count<20) {
				$data[$count]['judul'] = $newData;
			}
			$count++;
		}
		
		return $data;
	}

	function metrotvnews($situs=5, $topik=1, $tanggal=''){
		error_reporting(E_ERROR | E_PARSE);

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

		//get title
		$items = $doc->getElementsByTagName('h2');

		$data = array();
		$i = 0;
		foreach($items as $value){ 
			//get url
			foreach ($value->childNodes as $val){
				$url = $val->attributes;
				foreach($url as $v){
					$data[$i]['url'] = $v->nodeValue;
				}
			}
			//get title
			$attrs = $value->textContent;
			$newData = trim($attrs);
			if(strlen($newData)>13){
				$data[$i]['judul'] = $newData; 
				$i++;
			}
		}

		return $data;
	}
}	