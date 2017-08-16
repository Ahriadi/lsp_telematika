<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller{
    function __construct() {
        parent::__construct();
        // error_reporting(0);
        $this->load->model('M_pembelian');

    }

	function index(){
        $this->load->library('pagination');

        $config=array();
        $config['base_url'] = base_url().'pembelian/index';
        $config['total_rows'] = count($this->M_pembelian->record_count());
        $config['per_page'] = 100;
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

        $data['pembelian'] = $this->M_pembelian->tampil1($config['per_page'], $page);
       // $data['pembelian2'] = $this->M_pembelian->tampil2($config['per_page'], $page);
        $data['link'] = $this->pagination->create_links();


		$this->load->view('home/header');
		$this->load->view('home/navbar2');
		$this->load->view('home/pembelian', $data);
		$this->load->view('home/footer');
    }

    public function tambah_keranjang_belanja(){

		$data['id_user'] = $this->session->userdata('id_user');
		$data['id_produk'] = $this->input->post('id_produk');
		$data['nama_pesanan'] = $this->input->post('nama_produk');
		$data['alamat'] = $this->session->userdata('alamat');
		$data['jumlah'] = 1;
		$data['tgl_pesan'] = date('Y-m-d');

		$this->M_pembelian->tambah($data);

		$this->session->set_flashdata('notif','Data Pesanan Disimpan ! di keranjang belanja ');
		redirect('home/menu?id_kategori='. $this->input->post('id_kategori'));

    }

	public function tampil_edit_keranjang_belanja(){

        $data['entry'] = $this->M_pembelian->get($this->input->get('id'));
        if(!isset($data['entry'][0]) || $data['entry'][0] == ""){
            redirect(base_url('produk')."");
        }else{
            $data['entry'] = $data['entry'][0];
			$data['menu'] = $this->M_kategori->tampil();
			$data['teman'] = $this->M_chat->get_admin();
			$this->load->view('home/header');
			$this->load->view('home/sidebar', $data);
			$this->load->view('home/belanja_edit', $data);
			$this->load->view('home/footer');
        }

    }

	public function update_keranjang_belanja(){

		$data['id_pesanan'] = $this->input->post('id_pesanan');
		$data['jumlah'] = $this->input->post('jumlah');

		$this->M_pembelian->update($data);

		$this->session->set_flashdata('notif','Data Pesanan Disimpan ! ');
		redirect('belanja');

    }


	public function hapus_keranjang_belanja(){

		$data['id_pesanan'] = $this->input->get('id');

		$this->M_pembelian->hapus($data);

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

		$id_user = $this->input->post('id_user');
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

		$id_user = $this->input->post('id_user');
		$jumlah = count($this->input->post('id_pesanan'));
		$id_pesanan = $this->input->post('id_pesanan');
		$status = '3';

		for($i=0;$i<$jumlah;$i++) {
			$data['id_user'] = $id_user;
			$data['id_pesanan'] = $id_pesanan[$i];
			$data['status'] = $status;

			$this->M_pembelian->update_pesanan($data);

		}

		redirect('transaksi_selesai');
    }


}
