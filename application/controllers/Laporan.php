<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan extends CI_Controller{
    function __construct() {
        parent::__construct();
        // error_reporting(0);
        $this->load->model('m_laporan');
      //
  		if(!$this->session->userdata('id_admin')){
  			redirect('login');
  		}
    }


	public function index(){
        $this->load->library('pagination');

        $config=array();
        $config['base_url'] = base_url().'laporan/index';
        $config['total_rows'] = count($this->m_laporan->record_count());
        $config['per_page'] = 30;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;

		//config css for pagination
		    $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'Pertama';
        $config['last_link'] = 'Akhir';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Sebelumnya';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Selanjutnya';
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

        $data['pesanan_di_proses'] = $this->m_laporan->tampil($config['per_page'], $page);
		    $data['link'] = $this->pagination->create_links();
		    $this->load->view('admin/header');
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/laporan/laporan', $data);
        $this->load->view('admin/footer');

    }

	public function find(){

			if($this->input->post('submit')){
				$month = $this->input->post('month');
				$year = $this->input->post('year');

				$option = array(
					'user_month'=>$month,
					'user_data'=>$year
				);
				$this->session->set_userdata($option);
			}else{
			   $year = $this->uri->segment ( 4 );
			   $month = $this->uri->segment ( 5 );
			}

			$config = array ();
			$config ["base_url"] = base_url () . "laporan/find/".$year."/".$month;
			$config ["total_rows"] = count($this->m_laporan->search_count($month,$year));
			$config ["per_page"] = 25;
			$config ["uri_segment"] = 6;
			$choice = $config ["total_rows"] / $config ["per_page"];
			$config ["num_links"] = 5;

			// config css for pagination
			$config ['full_tag_open'] = '<ul class="pagination">';
			$config ['full_tag_close'] = '</ul>';
			$config ['first_link'] = 'First';
			$config ['last_link'] = 'Last';
			$config ['first_tag_open'] = '<li>';
			$config ['first_tag_close'] = '</li>';
			$config ['prev_link'] = 'Previous';
			$config ['prev_tag_open'] = '<li class="prev">';
			$config ['prev_tag_close'] = '</li>';
			$config ['next_link'] = 'Next';
			$config ['next_tag_open'] = '<li>';
			$config ['next_tag_close'] = '</li>';
			$config ['last_tag_open'] = '<li>';
			$config ['last_tag_close'] = '</li>';
			$config ['cur_tag_open'] = '<li class="active"><a href="#">';
			$config ['cur_tag_close'] = '</a></li>';
			$config ['num_tag_open'] = '<li>';
			$config ['num_tag_close'] = '</li>';

			if ($this->uri->segment ( 6 ) == "") {
				$data ['number'] = 0;
			} else {
				$data ['number'] = $this->uri->segment ( 6 );
			}

			$this->pagination->initialize ( $config );
			$page = ($this->uri->segment ( 6 )) ? $this->uri->segment ( 6 ) : 0;

			$data ['month'] = $this->input->post('month');
			$data ['year'] = $this->input->post('year');
			$data ['pesanan_di_proses'] = $this->m_laporan->search($month,$year,$config ["per_page"], $page);
			$data['link'] = $this->pagination->create_links();
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/laporan/result', $data);
			$this->load->view('admin/footer');

	}

	public function add(){

			$month = $this->input->get('month');
			$year = $this->input->get('year');

			switch($month){
				case 1 : $nama_bulan = "JANUARI";break;
				case 2 : $nama_bulan = "FEBRUARI";break;
				case 3 : $nama_bulan = "MARET";break;
				case 4 : $nama_bulan = "APRIL";break;
				case 5 : $nama_bulan = "MEI";break;
				case 6 : $nama_bulan = "JUNI";break;
				case 7 : $nama_bulan = "JULI";break;
				case 8 : $nama_bulan = "AGUSTUS";break;
				case 9 : $nama_bulan = "SEPTEMBER";break;
				case 10 : $nama_bulan = "OKTOBER";break;
				case 11 : $nama_bulan = "NOVEMBER";break;
				case 12 : $nama_bulan = "DESEMBER";break;
			}
			$this->load->library('Excel');

			//load PHPExcel library
			$this->excel->setActiveSheetIndex(0);
                  //name the worksheet
                  $this->excel->getActiveSheet()->setTitle('Laporan Rekapitulasi Pegawai');

  				//STYLING
  				$styleArray = array(
  					'borders' => array('vertical' =>
  						array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' =>
  							array('argb' => '0000'),
  							),
  						),
  					);

					//STYLING
  				$styleArray2 = array(
  					'borders' => array('allborders' =>
  						array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' =>
  							array('argb' => '0000'),
  							),
  						),
  					);

				//STYLING
  				$styleArray3 = array(
  					'borders' => array('bottom' =>
  						array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' =>
  							array('argb' => '0000'),
  							),
  						),
  					);

				$styleArray4 = array(
  					'borders' => array('right' =>
  						array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' =>
  							array('argb' => '0000'),
  							),
  						),
  					);

				$styleArray5 = array(
  					'borders' => array('left' =>
  						array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' =>
  							array('argb' => '0000'),
  							),
  						),
  					);


			$no = 7;

			//SET DIMENSI TABEL
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(64);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(11);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);


			//set KOP
			$this->excel->getActiveSheet()->mergeCells('A1:H1');
			$this->excel->getActiveSheet()->setCellValue('A1', 'LAPORAN TRANSAKSI PENJUALAN BULAN '.$nama_bulan.' TAHUN '.$year.'');
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

			//SET NO
			$this->excel->getActiveSheet()->setCellValue('A5', 'NO');
			$this->excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(11);
			$this->excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A5')->getFont()->setName('Calibri');

			//SET KODE TRANSAKSI
			$this->excel->getActiveSheet()->setCellValue('B5', 'KODE TRANSAKSI');
			$this->excel->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('B5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('B5')->getFont()->setSize(11);
			$this->excel->getActiveSheet()->getStyle('B5')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('B5')->getFont()->setName('Calibri');

			$this->excel->getActiveSheet()->setCellValue('C5', 'TANGGAL');
			$this->excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('C5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('C5')->getFont()->setSize(11);
			$this->excel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('C5')->getFont()->setName('Calibri');

			$this->excel->getActiveSheet()->setCellValue('D5', 'NAMA PRODUK');
			$this->excel->getActiveSheet()->getStyle('D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('D5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('D5')->getFont()->setSize(11);
			$this->excel->getActiveSheet()->getStyle('D5')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('D5')->getFont()->setName('Calibri');

			$this->excel->getActiveSheet()->setCellValue('E5', 'HARGA');
			$this->excel->getActiveSheet()->getStyle('E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('E5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('E5')->getFont()->setSize(11);
			$this->excel->getActiveSheet()->getStyle('E5')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('E5')->getFont()->setName('Calibri');

			$this->excel->getActiveSheet()->setCellValue('F5', 'JUMLAH');
			$this->excel->getActiveSheet()->getStyle('F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('F5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('F5')->getFont()->setSize(11);
			$this->excel->getActiveSheet()->getStyle('F5')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('F5')->getFont()->setName('Calibri');

			$this->excel->getActiveSheet()->setCellValue('G5', 'TOTAL');
			$this->excel->getActiveSheet()->getStyle('G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('G5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('G5')->getFont()->setSize(11);
			$this->excel->getActiveSheet()->getStyle('G5')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('G5')->getFont()->setName('Calibri');

			$no =7;
			$hit =1;

			$data = $this->m_laporan->print_report($month,$year);

			foreach ($data as $datax) {
				$this->excel->getActiveSheet()->setCellValue('A'.$no, $hit );
				$this->excel->getActiveSheet()->setCellValue('B'.$no, $datax->id_transaksi );
				$this->excel->getActiveSheet()->setCellValue('C'.$no, date("d-m-Y",strtotime($datax->tgl_pesan)) );
				$this->excel->getActiveSheet()->setCellValue('D'.$no, $datax->nama_pesanan );
				$this->excel->getActiveSheet()->setCellValue('E'.$no, $datax->harga );
				$this->excel->getActiveSheet()->setCellValue('F'.$no, $datax->jumlah );
				$this->excel->getActiveSheet()->setCellValue('G'.$no, ($datax->harga*$datax->jumlah) );

				$no++;
				$hit++;

			}

			$harga = 0;
			$jumlah = 0;
			$total = 0;
			foreach ($data as $datax) {
				$harga =  $harga+$datax->harga;
				$jumlah =  $jumlah+$datax->jumlah;
				$total =  ($total+($datax->harga*$datax->jumlah));
			}
			$this->excel->getActiveSheet()->mergeCells('A'.$no.':D'.$no.'');
			$this->excel->getActiveSheet()->setCellValue('A'.$no, "TOTAL KESELURUHAN");
			$this->excel->getActiveSheet()->getStyle('A'.$no.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A'.$no.'')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A'.$no.'')->getFont()->setSize(11);
			$this->excel->getActiveSheet()->getStyle('E'.$no.'')->getFont()->setSize(11);
			$this->excel->getActiveSheet()->getStyle('F'.$no.'')->getFont()->setSize(11);
			$this->excel->getActiveSheet()->getStyle('G'.$no.'')->getFont()->setSize(11);
			$this->excel->getActiveSheet()->getStyle('A'.$no.'')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('E'.$no.'')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('F'.$no.'')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('G'.$no.'')->getFont()->setBold(true);

			$this->excel->getActiveSheet()->setCellValue('E'.$no, $harga);
			$this->excel->getActiveSheet()->setCellValue('F'.$no, $jumlah );
			$this->excel->getActiveSheet()->setCellValue('G'.$no, $total );

			$this->excel->getActiveSheet()->getStyle('A5:G'.($no))->applyFromArray($styleArray);
			$this->excel->getActiveSheet()->getStyle('A5:G'.($no))->applyFromArray($styleArray2);
			$this->excel->getActiveSheet()->getStyle('A5:G'.($no))->applyFromArray($styleArray3);


			ob_end_clean();
                  $filename='Laporan Transaksi Bulan.xls'; //save our workbook as this file name
                  header('Content-Type: application/vnd.ms-excel'); //mime type
                  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                  header('Cache-Control: max-age=0'); //no cache

                  //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                  //if you want to save it as .XLSX Excel 2007 format
                  $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

			$objWriter->save('php://output');

           //redirect('report/report_all','refresh');



	}

}
