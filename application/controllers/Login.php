<?php

class Login extends CI_Controller{
    function __construct() {
        parent::__construct();

	       $this->load->model('m_login');
        //  error_reporting(0);
    }

    function index(){
  		if($this->session->userdata('id_admin')){
  			redirect('Admin');
  		}else {
  			$this->load->view('Login/login');
  		}
  	}

    public function proses_login(){
  		if($_POST) {
  					$data['username'] = $this->input->post('username');
  					$data['password'] = md5($this->input->post('password'));

  					$result = $this->m_login->login($data);
  					if($result) {
  								$this->_daftarkan_session($result);
  					} else {
  						redirect('login');
  					}
  		   }
      }

      public function _daftarkan_session($result) {
            // Daftarkan Session
            $sess = array(
                'logged' => TRUE,
                 'id_admin' => $result->id_admin,
                'username' => $result->username,
            );
            $this->session->set_userdata($sess);

            //Redirect ke home
            redirect('admin');
        }

        function logout(){
            $this->session->sess_destroy();
            redirect('login');
        }

}
