<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login' ) {
			redirect('/');
		}
		$this->load->model('report_model');
	}

	public function index(){
        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $report = $this->report_model->view_all();  // Panggil fungsi view_all yang ada di TransaksiModel
            $url_cetak = 'laporan_report/cetak';
            $label = 'Semua Data Report';
        }else{ // Jika terisi
            $report = $this->report_model->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $url_cetak = 'laporan_report/cetak?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
        }
        $data['report'] = $report;
        $data['url_cetak'] = site_url($url_cetak);
        $data['label'] = $label;
        $this->load->view('laporan_report', $data);
    }

    public function cetak(){
        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
            $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
            if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
                $report = $this->report_model->view_all();  // Panggil fungsi view_all yang ada di TransaksiModel
                $label = 'Semua Data Report';
            }else{ // Jika terisi
                $report = $this->report_model->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
                $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
                $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
                $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
            }
            $data['label'] = $label;
            $data['report'] = $report;
            // $this->load->view('print', $data);
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->filename = "laporan.pdf";
            $this->pdf->load_view('print', $data);
      }

	
}

/* End of file Kategori_produk.php */
/* Location: ./application/controllers/Kategori_produk.php */