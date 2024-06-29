<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_user extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login' ) {
			redirect('/');
		}
		$this->load->model('report_model');
	}

	public function index()
	{
		$this->load->view('report_user');
	}

	public function read()
	{
		header('Content-type: application/json');
		if ($this->report_model->read()->num_rows() > 0) {
			foreach ($this->report_model->read()->result() as $report) {
				$data[] = array(
					'tanggal' => $report->tanggal,
					'actual' => $report->actual,
					'target' => $report->target,
					'acv' => $report->acv,
					'keterangan' => $report->keterangan,
				);
			}
		} else {
			$data = array();
		}
		$report = array(
			'data' => $data
		);
		echo json_encode($report);
	}

	public function add()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'tanggal' => $this->input->post('tanggal'),
			'actual' => $this->input->post('actual'),
			'target' => $this->input->post('target'),
			'acv' => $this->input->post('acv'),
			'keterangan' => $this->input->post('keterangan')
		);
		if ($this->report_model->create($data)) {
			echo json_encode('sukses');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if ($this->report_model->delete($id)) {
			echo json_encode('sukses');
		}
	}

	public function edit()
	{
		$id = $this->input->post('id');
		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'actual' => $this->input->post('actual'),
			'target' => $this->input->post('target'),
			'acv' => $this->input->post('acv'),
			'keterangan' => $this->input->post('keterangan')
		);
		if ($this->report_model->update($id,$data)) {
			echo json_encode('sukses');
		}
	}

	public function get_report()
	{
		$id = $this->input->post('id');
		$report = $this->report_model->getReport($id);
		if ($report->row()) {
			echo json_encode($report->row());
		}
	}

	public function search()
	{
		header('Content-type: application/json');
		$report = $this->input->post('report');
		$search = $this->report_model->search($report);
		foreach ($search as $report) {
			$data[] = array(
				'id' => $report->id,
				'date' => $report->tanggal
			);
		}
		echo json_encode($data);
	}

}

/* End of file Kategori_produk.php */
/* Location: ./application/controllers/Kategori_produk.php */