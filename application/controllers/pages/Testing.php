<?php

class Testing extends CI_Controller{
			
	function __construct() {
		parent::__construct();
	}		
			
	function index()
	{
		$data = array(
			'title' => 'Testing batch insert',
			'isi' => 'pages/home'
		);
		$this->load->view('layouts/loggedin/wrapper', $data);
	}
	
	function insert_all()
	{
		$p = $this->input->post(); $dataBatch = array();
		for($i=0; $i<count($p['nama']); $i++)
		{
			array_push($dataBatch,
				array(
					'nama' => $p['nama'][$i],
					'kelas' => $p['kelas'][$i],
					'npm' => $p['npm'][$i],
					'jam_daftar' => $p['jam_daftar'][$i]
				)
			);
		}
		$this->db->insert_batch('test_mahasiswa_m', $dataBatch);
		redirect();
	}
	

// --------------- eof -----------------
}
?>