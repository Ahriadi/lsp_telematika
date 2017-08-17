<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
		// error_reporting(0);
		$this->load->model('M_produk');
		$this->load->model('M_user');


    }

	public function index() {




		$this->load->library('pagination');
		$config=array();
		//$data['id_kategori']= $this->M_kategori->get('id_kategori');
		$config['base_url'] = base_url().'home/index';
		$config['total_rows'] = $this->M_produk->record_count();
		$config['per_page'] = 50;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = 3;

		//config css for pagination
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';


		if($this->uri->segment(3)==""){
				$data['number']=0;
		} else {
				$data['number'] = $this->uri->segment(3);
		}
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3));

		$data['produk'] = $this->M_produk->data($config['per_page'],$page);
		$data['links'] = $this->pagination->create_links();
		$this->load->view('home/header');
		$this->load->view('home/navbar');
		$this->load->view('home/content', $data);
		$this->load->view('home/footer');
    }

	public function menu(){
    $data['produk'] = $this->M_produk->get_produk($this->input->get('id_produk'));

		$this->load->view('home/header');
		$this->load->view('home/navbar2', $data);
		$this->load->view('home/menu');
		$this->load->view('home/footer');
	}

	public function login() {
		$this->load->view('home/header');
		$this->load->view('home/navbar2');
		$this->load->view('home/login');
		$this->load->view('home/footer');
    }

		public function daftar() {
		$this->load->view('home/header');
		$this->load->view('home/navbar2');
		$this->load->view('home/daftar');
		$this->load->view('home/footer');
    }

		public function proses_daftar(){
        $data['id_user'] = $this->input->post('id_user');
				$data['nama_lengkap'] = $this->input->post('nama_lengkap');
				$data['alamat'] = $this->input->post('alamat');
				$data['email'] = $this->input->post('email');
				$data['no_telepon'] = $this->input->post('no_telepon');
				$data['username'] = $this->input->post('username');
        $data['password'] = md5($this->input->post('password'));

        $this->M_user->tambah($data);
        redirect(base_url('home/login')."");
    }


		public function contacts() {

			$data['menu'] = $this->M_kategori->tampil();
			$data['teman'] = $this->M_chat->get_admin();
			$this->load->view('home/header');
			$this->load->view('home/navbar', $data);
			$this->load->view('home/contacts');
			$this->load->view('home/footer');
	    }

	 public function getChats()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {
            // Find friend
            $friend = $this->db->get_where('table_user', array('id_user' => $this->input->post('chatWith')), 1)->row();

            // Get Chats
            $chats = $this->db
                ->select('table_chat.*, table_user.nama_lengkap')
                ->from('table_chat')
                ->join('table_user', 'table_chat.send_by = table_user.id_user')
                ->where('(send_by = '. $this->session->userdata('id_user') .' AND send_to = '. $friend->id_user .')')
                ->or_where('(send_to = '. $this->session->userdata('id_user') .' AND send_by = '. $friend->id_user .')')
                ->order_by('table_chat.time', 'desc')
                ->limit(100)
                ->get()
                ->result();

            $result = array(
                'name' => $friend->nama_lengkap,
                'chats' => $chats
            );
            echo json_encode($result);
        }
    }

	public function sendMessage()
    {
        $this->db->insert('table_chat', array(
            'message' => htmlentities($this->input->post('message', true)),
            'send_to' => $this->input->post('chatWith'),
            'send_by' => $this->session->userdata('id_user')
        ));
    }

	public function check_chat(){

		$data['check_chat']=$this->M_chat->check_chat($this->session->userdata('id_user'));
		$data['check_chat'] = count($data['check_chat']);
		if($data['check_chat']>0){
			echo $data['check_chat'];
			//echo '<script type="text/javascript">play_sound();</script>';
		}


	}

}
