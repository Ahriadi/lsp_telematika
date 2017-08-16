<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller{
    function __construct() {
        parent::__construct();
        // error_reporting(0);
        $this->load->model('M_pesanan');
        $this->load->model('M_produk');

    }

	function index(){
        $this->load->library('pagination');

        $config=array();
        $config['base_url'] = base_url().'belanja/index';
        $config['total_rows'] = $this->M_pesanan->record_count();
        $config['per_page'] = 4;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        if($this->uri->segment(3)==""){
            $data['number']=0;
        } else {
            $data['number'] = $this->uri->segment(3);
        }
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3));

        $data['belanja'] = $this->M_pesanan->tampil($config['per_page'], $page);
        $data['link'] = $this->pagination->create_links();

		    $data['produk'] = $this->M_produk->get_produk('id_produk');

		$this->load->view('home/header');
		$this->load->view('home/navbar2', $data);
		$this->load->view('home/belanja', $data);
		$this->load->view('home/footer');
    }

    public function tambah_keranjang_belanja(){

		$data['id_user'] = $this->session->userdata('id_user');
		$data['id_produk'] = $this->input->get('id_produk');
		$data['nama_pesanan'] = $this->input->get('nama_produk');
		$data['alamat'] = $this->session->userdata('alamat');
		$data['jumlah'] = 1;
		$data['tgl_pesan'] = date('Y-m-d');

		$this->M_pesanan->tambah($data);

		$this->session->set_flashdata('notif','Data Pesanan Disimpan, Silahkan Cek di keranjang Belanja Anda!');
		redirect('home/menu');

    }

	public function tampil_edit_keranjang_belanja(){

        $data['entry'] = $this->M_pesanan->get($this->input->get('id'));
        if(!isset($data['entry'][0]) || $data['entry'][0] == ""){
            redirect(base_url('produk')."");
        }else{
            $data['entry'] = $data['entry'][0];
			$data['menu'] = $this->M_kategori->tampil();
			$data['teman'] = $this->M_chat->get_admin();
			$this->load->view('home/header');
			$this->load->view('home/navbar2', $data);
			$this->load->view('home/belanja_edit', $data);
			$this->load->view('home/footer');
        }

    }

	public function update_keranjang_belanja(){

		$data['id_pesanan'] = $this->input->post('id_pesanan');
		$data['jumlah'] = $this->input->post('jumlah');
		$data['alamat'] = $this->input->post('alamat');

		$this->M_pesanan->update($data);

		$this->session->set_flashdata('notif','Data Pesanan Disimpan !');
		redirect('belanja');

    }


	public function hapus_keranjang_belanja(){

		$data['id_pesanan'] = $this->input->get('id');

		$this->M_pesanan->hapus($data);

		$this->session->set_flashdata('notif','Data Pesanan Dihapus !');
		redirect('belanja');

    }


    public function simpan_pesanan() {

  		$id_user = $this->session->userdata('id_user');
  		$jumlah = count($this->input->post('id_pesanan'));
  		$id_pesanan = $this->input->post('id_pesanan');
  		$date2 = date('YmdHis');
  		$status = '1';

  		for($i=0;$i<$jumlah;$i++) {
  			$data['id_user'] = $id_user;
  			$data['id_pesanan'] = $id_pesanan[$i];
  			$data['id_transaksi'] = 'KD-'.$id_user.$date2;
  			$data['status'] = $status;

  			$this->M_pembelian->update_pesanan($data);

  		}

  		redirect('pembelian');
      }


  	public function terima_pesanan() {

  		$id_user = $this->session->userdata('id_user');
  		$jumlah = count($this->input->post('id_pesanan'));
  		$id_pesanan = $this->input->post('id_pesanan');
  		$status = '2';

  		for($i=0;$i<$jumlah;$i++) {
  			$data['id_user'] = $id_user;
  			$data['id_pesanan'] = $id_pesanan[$i];
  			$data['status'] = $status;

  			$this->M_pembelian->update_pesanan($data);

  		}

  		redirect('pesanan_di_proses');
      }


  	public function transaksi_selesai() {

  		$id_user = $this->session->userdata('id_user');
  		$jumlah = count($this->input->post('id_pesanan'));
  		$id_pesanan = $this->input->post('id_pesanan');
  		$status = '3';

  		for($i=0;$i<$jumlah;$i++) {
  			$data['id_user'] = $id_user;
  			$data['id_pesanan'] = $id_pesanan[$i];
  			$data['status'] = $status;

  			$this->M_pembelian->update_pesanan($data);

  		}

  		redirect('pesanan_masuk');
      }




}
