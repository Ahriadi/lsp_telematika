
<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );


class M_produk extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function tambah($data){
		$this->db->insert('table_produk', $data);
	}

	public function kategori()
	{
		$query = $this->db->get('table_kategori');
		if($query->num_rows() > 0) {
			foreach($query->result () as $row){
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}



	public function record_count(){
		return $this->db->count_all('table_produk');
	}

	// public function tampil($limit, $start)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('table_produk r');
	// 	$this->db->join('table_kategori k', 'r.id_kategori=k.id_kategori');
  //
	// 	$this->db->limit($limit, $start);
	// 	$query = $this->db->get();
	// 	if($query->num_rows() > 0){
	// 		foreach ($query->result () as $row) {
	// 			$data[] = $row;
	// 		}
	// 		return $data;
	// 	}
	// 	return false;
	// }

  public function tampil($limit,$start){
		$query = $this->db->get('table_produk');
		if($query->num_rows() > 0){
			foreach ($query->result () as $row){
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function data($limit,$start)
	{
		// $this->db->select('*');
		// $this->db->from('table_produk r');
		// $this->db->join('table_kategori k', 'r.id_kategori=k.id_kategori');
    //
		// $this->db->limit($limit,$start);
		// $query = $this->db->get();
		// if($query->num_rows() > 0){
		// 	foreach ($query->result () as $row) {
		// 		$data[] = $row;
		// 	}
		// 	return $data;
		// }
		// return false;
	}




	public function hapus($data){
		$this->db->delete('table_produk', array('id_produk' =>$data['id_produk']));
	}

	public function link_gambar($id){
		$this->db->where('id_produk',$id);
		$query = $getData = $this->db->get('table_produk');

		if($getData->num_rows() > 0)
		return $query;
		else
		return null;
	}

	public function get($id_produk){
		$this->db->where('id_produk', $id_produk);
		$query = $this->db->get('table_produk', 1);
		return $query->result();
	}

	public function update($data){
		$this->db->update('table_produk', $data, array('id_produk'=>$data['id_produk']));
	}



	public function record_count_search($key){
		$this->db->like("nama_produk", $key);
		$this->db->or_like("id_kategori",$key);
		$this->db->or_like("harga",$key);

		return $this->db->count_all_results('table_produk');
	}

	public function tampil_hasil_search($limit, $start, $key){
		$this->db->like("nama_produk", $key);
		$this->db->or_like("id_kategori", $key);
		$this->db->or_like("harga", $key);
		$this->db->limit($limit, $start);
		$query = $this->db->get("table_produk");
		if($query->num_rows() > 0){
				foreach($query->result() as $row){
						$data[] = $row;
				}
				return $data;
		}return null;
	}



}
