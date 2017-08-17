<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );


class M_laporan extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	public function record_count(){
		$this->db->select('*');
		$this->db->from('table_produk a, table_pesanan b, table_user c');
		$this->db->where('a.id_produk= b.id_produk');
		$this->db->where('b.id_user= c.id_user');
		$this->db->where('b.status', 3);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach ($query->result () as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function search_count($month,$year){
		$this->db->select('*');
		$this->db->from('table_produk a, table_pesanan b, table_user c');
		$this->db->where('a.id_produk= b.id_produk');
		$this->db->where('b.id_user= c.id_user');
		$this->db->where('b.status', 3);
		$this->db->where('month(tgl_pesan)',$month);
		$this->db->where('year(tgl_pesan)',$year);
		$query = $this->db->get();
		return $query->result();
	}

	public function tampil($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('table_produk a, table_pesanan b, table_user c');
		$this->db->where('a.id_produk= b.id_produk');
		$this->db->where('b.id_user= c.id_user');
		$this->db->where('b.status', 3);
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

	public function search($month,$year,$limit, $start) {
		$this->db->select('*');
		$this->db->from('table_produk a, table_pesanan b, table_user c');
		$this->db->where('a.id_produk= b.id_produk');
		$this->db->where('b.id_user= c.id_user');
		$this->db->where('b.status', 3);
		$this->db->where('month(tgl_pesan)',$month);
		$this->db->where('year(tgl_pesan)',$year);
		$this->db->limit ($limit, $start);
		$query = $this->db->get ();
		if ($query->num_rows()> 0) {
			foreach ( $query->result () as $row ) {
				$data [] = $row;
			}
			return $data;
		}
		return false;
	}

	public function print_report($month,$year) {
		$this->db->select('*');
		$this->db->from('table_produk a, table_pesanan b, table_user c');
		$this->db->where('a.id_produk= b.id_produk');
		$this->db->where('b.id_user= c.id_user');
		$this->db->where('b.status', 3);
		$this->db->where('month(tgl_pesan)',$month);
		$this->db->where('year(tgl_pesan)',$year);
		$query = $this->db->get ();
		if ($query->num_rows()> 0) {
			foreach ( $query->result () as $row ) {
				$data [] = $row;
			}
			return $data;
		}
		return false;
	}

	public function tampil_detail($id_user)
	{
		$this->db->select('*');
		$this->db->from('table_produk a, table_pesanan b, table_user c');
		$this->db->where('a.id_produk= b.id_produk');
		$this->db->where('b.id_user= c.id_user');
		$this->db->where('b.status', 2);
		$this->db->where('b.id_user', $id_user);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach ($query->result () as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

}
