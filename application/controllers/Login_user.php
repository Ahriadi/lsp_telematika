<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_user extends CI_Controller {

    function __construct() {
        parent::__construct();
        // error_reporting(0);
        $this->load->model("m_login_user");
        $this->load->helper(array('Form', 'Cookie', 'String'));

    }

    public function proses_login(){
		if($_POST) {
					$data['username'] = $this->input->post('username');
					$data['password'] = md5($this->input->post('password'));

					$result = $this->m_login_user->login($data);
					if($result) {
								$this->_daftarkan_session($result);
					} else {
						redirect('home/login');
					}


		}
    }

	public function _daftarkan_session($result) {
        // Daftarkan Session
        $sess = array(
            'logged' => TRUE,
            'id_user' => $result->id_user,
            'username' => $result->username,
            'email' => $result->email,
            'no_telepon' => $result->no_telepon,
            'alamat' => $result->alamat
        );
        $this->session->set_userdata($sess);

        //Redirect ke home
        redirect();
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect();
    }

}
