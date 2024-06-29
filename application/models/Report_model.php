<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

	private $table = 'report';

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function read()
	{
		return $this->db->get($this->table);
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	public function getReport($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table);
	}

	public function search($search="")
	{
		$this->db->like('tanggal', $search);
		return $this->db->get($this->table)->result();
	}

	public function view_by_date($tgl_awal, $tgl_akhir){
        $tgl_awal = $this->db->escape($tgl_awal);
        $tgl_akhir = $this->db->escape($tgl_akhir);
        $this->db->where('DATE(tanggal) BETWEEN '.$tgl_awal.' AND '.$tgl_akhir); // Tambahkan where tanggal nya
    	return $this->db->get($this->table)->result();// Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
 	}
	public function view_all(){
		return $this->db->get($this->table)->result(); // Tampilkan semua data transaksi
	}
	

}

/* End of file Kategori_produk_model.php */
/* Location: ./application/models/Kategori_produk_model.php */