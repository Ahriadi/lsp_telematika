<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );


class M_pembelian extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function record_count(){
		$this->db->select('*');
		$this->db->from('table_produk a, table_pesanan b');
		$this->db->where('b.id_user', $this->session->userdata('id_user'));
		$this->db->where('a.id_produk= b.id_produk');
		$this->db->where('b.status', 1);
		$this->db->group_by('id_transaksi');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach ($query->result () as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function tampil1($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('table_produk a, table_pesanan b');
		$this->db->where('b.id_user', $this->session->userdata('id_user'));
		$this->db->where('a.id_produk= b.id_produk');
		$this->db->where('b.status != 0 ');
		$this->db->group_by('b.status');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach ($query->result () as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function tampil_pembelian($status)
	{
		$this->db->select('*');
		$this->db->from('table_produk a, table_pesanan b');
		$this->db->where('b.id_user', $this->session->userdata('id_user'));
		$this->db->where('a.id_produk= b.id_produk');
		$this->db->where('b.status', $status);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach ($query->result () as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function menunggu_konfirmasi($id_transaksi)
	{
		$this->db->select('*');
		$this->db->from('table_produk a, table_pesanan b');
		$this->db->where('b.id_user', $this->session->userdata('id_user'));
		$this->db->where('a.id_produk= b.id_produk');
		$this->db->where('b.status', 1);
		$this->db->where('b.id_transaksi', $id_transaksi);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach ($query->result () as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function telah_di_konfirmasi($id_transaksi)
	{
		$this->db->select('*');
		$this->db->from('table_produk a, table_pesanan b');
		$this->db->where('b.id_user', $this->session->userdata('id_user'));
		$this->db->where('a.id_produk= b.id_produk');
		$this->db->where('b.status', 2);
		$this->db->where('b.id_transaksi', $id_transaksi);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach ($query->result () as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function transaksi_selesai($id_transaksi)
	{
		$this->db->select('*');
		$this->db->from('table_produk a, table_pesanan b');
		$this->db->where('b.id_user', $this->session->userdata('id_user'));
		$this->db->where('a.id_produk= b.id_produk');
		$this->db->where('b.status', 3);
		$this->db->where('b.id_transaksi', $id_transaksi);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach ($query->result () as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function get($id_pesanan){
		$this->db->where('a.id_produk=b.id_produk');
		$this->db->where('id_pesanan', $id_pesanan);
		$query = $this->db->get('table_produk a, table_pesanan b', 1);
		return $query->result();
	}


	public function tambah($data){
		$this->db->insert('table_pesanan', $data);
	}

	public function update($data){
		$this->db->update('table_pesanan', $data, array('id_pesanan'=>$data['id_pesanan']));
	}

	public function update_pesanan($data){
		$this->db->update('table_pesanan', $data, array('id_pesanan'=>$data['id_pesanan']));
	}

	public function hapus($data){
		$this->db->delete('table_pesanan', array('id_pesanan' =>$data['id_pesanan']));
	}

}
