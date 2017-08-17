<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_masuk extends CI_Controller{
    function __construct() {
        parent::__construct();
        // error_reporting(0);
        $this->load->model('M_pesanan_masuk');

  		if(!$this->session->userdata('id_admin')){
  			redirect('login');
  		}
    }

   function index(){
        $this->load->library('pagination');

        $config=array();
        $config['base_url'] = base_url().'Pesanan_masuk/index';
        $config['total_rows'] = count($this->M_pesanan_masuk->record_count());
        $config['per_page'] = 30;
        $config["uri_segment"] = 2;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        if($this->uri->segment(2)==""){
            $data['number']=0;
        } else {
            $data['number'] = $this->uri->segment(2);
        }
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2));

        $data['pesanan_masuk'] = $this->M_pesanan_masuk->tampil($config['per_page'], $page);
    		$data['link'] = $this->pagination->create_links();
    		$this->load->view('admin/header');
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/pesanan/pesanan_masuk', $data);
        $this->load->view('admin/footer');

    }


   function detail(){

        $data['pesanan_masuk'] = $this->M_pesanan_masuk->tampil_detail($this->input->get('id_user'));
		    $this->load->view('admin/header');
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/pesanan/detail', $data);
        $this->load->view('admin/footer');

    }





}
