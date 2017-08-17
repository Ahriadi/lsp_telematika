<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_di_proses extends CI_Controller{
    function __construct() {
        parent::__construct();
        // error_reporting(0);
        $this->load->model('m_pesanan_di_proses');

  		if(!$this->session->userdata('id_admin')){
  			redirect('login');
  		}
    }

   function index(){
        $this->load->library('pagination');

        $config=array();
        $config['base_url'] = base_url().'pesanan_di_proses/index';
        $config['total_rows'] = count($this->m_pesanan_di_proses->record_count());
        $config['per_page'] = 30;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;

		//config css for pagination
		    $config['full_tag_open'] = '<ul class="pagination">';
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

        $data['pesanan_di_proses'] = $this->m_pesanan_di_proses->tampil($config['per_page'], $page);
		    $data['link'] = $this->pagination->create_links();
		    $this->load->view('admin/header');
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/pesanan/pesanan_di_proses', $data);
        $this->load->view('admin/footer');

    }

	public function find(){

			if($this->input->post('submit')){
				$column = $this->input->post('column');
				$query = $this->input->post('data');

				$option = array(
					'user_column'=>$column,
					'user_data'=>$query
				);
				$this->session->set_userdata($option);
			}else{
			   $query = $this->uri->segment ( 3 );
			   $column = $this->uri->segment ( 4 );
			}

			/* Get all users */

			$config = array ();
			$config ["base_url"] = base_url () . "pesanan_di_proses/find/".$query."/".$column;
			$config ["total_rows"] = count($this->m_pesanan_di_proses->search_count($column,$query));
			$config ["per_page"] = 30;
			$config ["uri_segment"] = 5;
			$choice = $config ["total_rows"] / $config ["per_page"];
			$config ["num_links"] = 5;

			// config css for pagination
			$config ['full_tag_open'] = '<ul class="pagination">';
			$config ['full_tag_close'] = '</ul>';
			$config ['first_link'] = 'First';
			$config ['last_link'] = 'Last';
			$config ['first_tag_open'] = '<li>';
			$config ['first_tag_close'] = '</li>';
			$config ['prev_link'] = 'Previous';
			$config ['prev_tag_open'] = '<li class="prev">';
			$config ['prev_tag_close'] = '</li>';
			$config ['next_link'] = 'Next';
			$config ['next_tag_open'] = '<li>';
			$config ['next_tag_close'] = '</li>';
			$config ['last_tag_open'] = '<li>';
			$config ['last_tag_close'] = '</li>';
			$config ['cur_tag_open'] = '<li class="active"><a href="#">';
			$config ['cur_tag_close'] = '</a></li>';
			$config ['num_tag_open'] = '<li>';
			$config ['num_tag_close'] = '</li>';

			if ($this->uri->segment ( 5 ) == "") {
				$data ['number'] = 0;
			} else {
				$data ['number'] = $this->uri->segment ( 5 );
			}

			$this->pagination->initialize ( $config );
			$page = ($this->uri->segment ( 5 )) ? $this->uri->segment ( 5 ) : 0;

			$data ['pesanan_di_proses'] = $this->m_pesanan_di_proses->search($column,$query,$config ["per_page"], $page);
			$data['teman'] = $this->m_chat->get_user();
			$data ['link'] = $this->pagination->create_links ();
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar', $data);
			$this->load->view('admin/pesanan/pesanan_di_proses', $data);
			$this->load->view('admin/footer');

	}


   function detail(){

        $data['pesanan_masuk'] = $this->m_pesanan_di_proses->tampil_detail($this->input->get('id_user'));
		    $this->load->view('admin/header');
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/pesanan/detail_proses', $data);
        $this->load->view('admin/footer');

    }





}
