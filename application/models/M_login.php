<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function login($data) {
        $this->db->select('*');
        $this->db->from('table_admin');
        $this->db->where('username', $data['username']);
        $this->db->where('password', $data['password']);
        return $this->db->get()->row();
    }

}
?>
