<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_pendidikan_terakhir($id){
	$pendidikan = '';
	if($id==1){
		$pendidikan = 'SD / Sederajat';
	}elseif($id==2){
		$pendidikan = 'SMP / Sederajat';
	}elseif($id==3){
		$pendidikan = 'SMA / Sederajat';
	}elseif($id==4){
		$pendidikan = 'D1 / Sederajat';
	}elseif($id==5){
		$pendidikan = 'D2 / Sederajat';
	}elseif($id==6){
		$pendidikan = 'D3 / Sederajat';
	}elseif($id==7){
		$pendidikan = 'S1 / D4 / Sederajat';
	}elseif($id==8){
		$pendidikan = 'S2 / Sederajat';
	}elseif($id==9){
		$pendidikan = 'S3 / Sederajat';
	}
	return $pendidikan;
}

function get_kategori($id){
	$kategori = '-';
	if($id>=0 && $id<=20){
		$kategori = 'E / Buruk';
	}elseif($id>=21 && $id<=40){
		$kategori = 'D / Kurang';
	}elseif($id>=41 && $id<=60){
		$kategori = 'C / Cukup';
	}elseif($id>=61 && $id<=80){
		$kategori = 'B / Baik';
	}elseif($id>=81 && $id<=100){
		$kategori = 'A / Istimewa';
	}
	
	return $kategori;
}

function tanggal_indonesia($tgl='0000-00-00') {
    $tgl = ($tgl=='0000-00-00')?"1990-01-01":$tgl;
	
    $tanggal = explode("-", $tgl);
    $nama_bulan = get_list_bulan();
    $bulan = $tanggal[1]*1;
	$time = "";
	if(strlen($tanggal[2])>3){
		$time = substr($tanggal[2],3);
		$tanggal[2] = substr($tanggal[2],0,3);
		
	}
	
	if($tgl!='1990-01-01'){
		return $tanggal[2]." ".$nama_bulan[$bulan]." ".$tanggal[0]. " ".$time;
	}else{
		return '-';
	}
}

function get_list_bulan() {
    $data = array(
            1=>"Januari",
            2=>"Februari",
            3=>"Maret",
            4=>"April",
            5=>"Mei",
            6=>"Juni",
            7=>"Juli",
            8=>"Agustus",
            9=>"September",
            10=>"Oktober",
            11=>"November",
            12=>"Desember",
    );
    return $data;
}