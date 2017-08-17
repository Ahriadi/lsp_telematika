<?php
defined('BASEPATH') OR exit('No direct script access allowed');


	class Admin extends CI_Controller{
    function __construct() {
        parent::__construct();
        // error_reporting(0);
        //  $this->load->model('m_chat');

		if(!$this->session->userdata('id_admin')){
			redirect('login');
		}
    }


	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/home');
		$this->load->view('admin/footer');
	}



}
