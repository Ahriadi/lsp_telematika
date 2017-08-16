<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk extends CI_Controller{
    function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->load->model('M_produk');
        // $this->load->model('m_chat');
		// if(!$this->session->userdata('id_admin')){
		// 	redirect('login');
		// }
    }


	function index(){
        $this->load->library('pagination');

        $config=array();
        $config['base_url'] = base_url().'produk/index';
        $config['total_rows'] = $this->M_produk->record_count();
        $config['per_page'] = 3;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;
        // $config["num_links"] = floor($choice);

		    //config css for pagination
		    $config['full_tag_open'] = '<ul class="pagination" style="padding-left:103px;">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'Pertama';
        $config['last_link'] = 'Akhir';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Sebelumnya';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Selanjutnya';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        if($this->uri->segment(3)==""){
            $data['number']=0;
        } else {
            $data['number'] = $this->uri->segment(3);
        }
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3));
		    // $page = ($this->uri->segment(3))?$this->uri->segment(3) : 0;

        $data['produk'] = $this->M_produk->tampil($config['per_page'], $page);
		    // $data['teman'] = $this->m_chat->get_user();
        $data['links'] = $this->pagination->create_links();
		    $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/produk/produk', $data);
        $this->load->view('admin/footer');
    }

    function search(){
      $key = $this->input->post('search');
      // $this->load->library('pagination');
      $config = array();
      $config['base_url'] = base_url().'index.php/produk/search';
      $config['total_rows'] = $this->M_produk->record_count_search($key);
      $config['per_page'] = 10;
      $config["uri_segment"] = 3;
      $choice = $config["total_rows"] / $config["per_page"];
      $config["num_links"] = floor($choice);
      if($this->uri->segment(3)=="") {
         $data['number']=0;
      } else {
               $data['number'] = $this->uri->segment(3);
      }
      $this->pagination->initialize($config);
      $page = ($this->uri->segment(3));
      $data['produk']=$this->M_produk->tampil_hasil_search($config['per_page'],$page,$key);
	  $data['teman'] = $this->m_chat->get_user();
      $data['link'] = $this->pagination->create_links();
      if($data['produk'] ==null){
          echo "<script languange='javascript'>;
              window.alert('Maaf data yang anda cari tidak ada');
              javascript=document.location='../produk';
              </script>";
      }else {
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/produk/produk', $data);
        $this->load->view('admin/footer');
      }

    }

	public function tambah(){
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/produk/form');
        $this->load->view('admin/footer');
	}

    public function proses_tambah(){
        $this->load->library('upload');
        $filename = $this->input->post('userfile');
        $config['upload_path'] = "./assets/produk/";
        $config['allowed_types'] = "gif|jpg|jpeg|png|pdf";
        $config['overwrite'] = "true";
        $config['max_size'] = "90000000";
    		$config['max_width']="100000";
    		$config['max_height']="100000";
            // $config['file_name'] = $this->input->post('id_rumah_makan');
    		$config['file_name'] = ''.date('YmdHis');
        $this->upload->initialize($config);

        if(!$this->upload->do_upload()){
            echo  $this->upload->display_errors();
        }else{
            $dat = $this->upload->data();
            $data['nama_produk'] = $this->input->post('nama_produk');
            $data['harga'] = $this->input->post('harga');
            $data['gambar'] = $dat['file_name'];

		        $this->M_produk->tambah($data);

		        redirect(base_url('/produk')."");

        }
    }

    public function proses_hapus(){
        $data = $this->input->get('id_produk');
        if($data != ""){
          $gambar = $this->M_produk->link_gambar($data);
          if ($gambar->num_rows() > 0)
          {
            $row = $gambar->row();
            $file_gambar = $row->gambar;
            $path_file = './assets/produk/';
            unlink($path_file.$file_gambar);
          }
            $this->M_produk->hapus($data);
        }
        redirect('produk');
    }

    public function edit(){
        $id_produk = $this->input->get('id_produk');
        $data['entry'] = $this->M_produk->get($id_produk);
        if(!isset($data['entry'][0]) || $data['entry'][0] == ""){
            redirect(base_url('produk')."");
        }else{
            $data['entry'] = $data['entry'][0];
			      $this->load->view('admin/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/produk/form_edit',$data);
            $this->load->view('admin/footer');
        }
    }

    public function proses_edit(){

        if($_FILES['userfile']['name']==""){
          $data['id_produk'] = $this->input->post('id_produk');
          $data['nama_produk'] = $this->input->post('nama_produk');
          $data['harga'] = $this->input->post('harga');

          $this->M_produk->update($data);
          redirect(base_url('/produk')."");

        }else{
          $this->load->library('upload');
          // $filename = $this->input->post('userfile');
          $config['upload_path'] = "./assets/produk/";
          $config['allowed_types'] = "gif|jpg|jpeg|png|pdf";
          $config['overwrite'] = "true";
          $config['max_size'] = "90000000";
          $config['max_width']="100000";
          $config['max_height']="100000";
              // $config['file_name'] = $this->input->post('id_rumah_makan');
          $config['file_name'] = ''.date('YmdHis');
          $this->upload->initialize($config);

          if(!$this->upload->do_upload()){
              echo  $this->upload->display_errors();
          }else{
            $dat = $this->upload->data();
            $data['id_produk'] = $this->input->post('id_produk');
            $data['nama_produk'] = $this->input->post('nama_produk');
            $data['harga'] = $this->input->post('harga');
            $data['gambar'] = $dat['file_name'];

            $this->M_produk->update($data);
            redirect(base_url('/produk')."");

          }
        }
      }

}
