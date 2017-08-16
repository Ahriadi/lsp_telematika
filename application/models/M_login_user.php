<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login_user extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function login($data) {
        $this->db->select('*');
        $this->db->from('table_user');
        $this->db->where('username', $data['username']);
        $this->db->where('password', $data['password']);
        return $this->db->get()->row();
    }

    public function update($data, $user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('user_tbl', $data);
    }

	public function last_login($data) {

		$this->db->update('user_tbl', $data, array('user_id'=>$this->session->userdata('user_id')));
    }

}
?>
