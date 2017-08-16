<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );


class M_user extends CI_Model
{

	public function __construct(){
		parent::__construct();
	}

	public function tambah($data){
		$this->db->insert('table_user', $data);
	}

	public function tampil(){
		$query = $this->db->get('table_user');
		if($query->num_rows() > 0){
			foreach ($query->result () as $row){
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function hapus($data){
		$this->db->delete('table_user', array('id_user' =>$data['id_user']));
	}

	public function get($id_user){
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('table_user', 1);
		return $query->result();
	}

	public function update($data){
		$this->db->update('table_user', $data, array('id_user'=>$data['id_user']));
	}


}
