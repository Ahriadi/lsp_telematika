<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    function __construct() {
        parent::__construct();
        // error_reporting(0);
        $this->load->model('M_user');

		// if(!$this->session->userdata('id_admin')){
		// 	redirect('login');
		//   }
    }


	public function index(){
        $config=array();
        $config['site_url'] = site_url('user');
        $data['user'] = $this->M_user->tampil($config);
    		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/user/user', $data);
        $this->load->view('admin/footer');
    }

	public function tambah()
	{

		$data['teman'] = $this->m_chat->get_user();
		$this->load->view('admin/header');
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/user/form');
        $this->load->view('admin/footer');
	}

    public function proses_tambah(){
      $data['id_user'] = $this->input->post('id_user');
      $data['nama_lengkap'] = $this->input->post('nama_lengkap');
      $data['alamat'] = $this->input->post('alamat');
      $data['email'] = $this->input->post('email');
      $data['no_telepon'] = $this->input->post('no_telepon');
      $data['username'] = $this->input->post('username');
      $data['password'] = md5($this->input->post('password'));


        $this->M_user->tambah($data);
        redirect(base_url('/user')."");
    }

    public function proses_hapus(){
        $data['id_user'] = $this->input->get('id_user');
        if($data['id_user'] != "") {
            $this->M_user->hapus($data);
        }
        redirect(base_url('/user')."");
    }

    public function edit(){
        $id_user = $this->input->get('id_user');
        $data['entry'] = $this->M_user->get($id_user);
        if(!isset($data['entry'][0]) || $data['entry'][0] == ""){
            redirect(base_url('/user')."");
        }else{
            $data['entry'] = $data['entry'][0];
			      $this->load->view('admin/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/user/form_edit', $data);
            $this->load->view('admin/footer');
        }
    }

    public function proses_edit(){
        $data['id_user'] = $this->input->post('id_user');
        $data['nama_lengkap'] = $this->input->post('nama_lengkap');
        $data['alamat'] = $this->input->post('alamat');
        $data['email'] = $this->input->post('email');
        $data['no_telepon'] = $this->input->post('no_telepon');
        $data['username'] = $this->input->post('username');
        $data['password'] = md5($this->input->post('password'));

        $this->M_user->update($data);
        redirect(base_url('/user')."");
    }
}
