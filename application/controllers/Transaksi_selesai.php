<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_selesai extends CI_Controller{
    function __construct() {
        parent::__construct();
        // error_reporting(0);
        $this->load->model('m_transaksi_selesai');

  		// if(!$this->session->userdata('id_admin')){
  		// 	redirect('login');
  		// }
    }

   function index(){
        $this->load->library('pagination');

        $config=array();
        $config['base_url'] = base_url().'Transaksi_selesai/index';
        $config['total_rows'] = count($this->m_transaksi_selesai->record_count());
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

        $data['transaksi_selesai'] = $this->m_transaksi_selesai->tampil($config['per_page'], $page);
		    $data['link'] = $this->pagination->create_links();
		    $this->load->view('admin/header');
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/pesanan/transaksi_selesai', $data);
        $this->load->view('admin/footer');

    }


   function detail(){

        $data['pesanan_masuk'] = $this->m_transaksi_selesai->tampil_detail($this->input->get('id_user'));
		    $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/pesanan/detail_transaksi_selesai', $data);
        $this->load->view('admin/footer');

    }





}
