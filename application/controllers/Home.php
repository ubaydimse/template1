<?php

class Home extends CI_Controller{
			
	function __construct() {
		 parent::__construct();
         $this->load->helper(array('url','form'));
	}		
			
	function index()
	{
		$data = array(
			'title' => 'yoo',
			'isi' => 'pages/home',
			'dt' => 'halo ini data dari controller'
		);
		$this->load->view('layouts/plain/wrapper', $data);
	}
			
	function login()
	{
		
		echo 'aaaaaa';
	}	
			
}