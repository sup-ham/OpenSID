<?php
class Header_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	// Data penduduk yang digunakan untuk ditampilkan di Widget halaman dashbord (Home SID)
	public function penduduk_total()
	{
		$sql = "SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function keluarga_total()
	{
		$data = $this->db->select('COUNT(*) AS jumlah')
			->from('tweb_keluarga u')
			->join('tweb_penduduk t', 'u.nik_kepala = t.id', 'left')
			->where('t.status_dasar', '1')
			->where('t.kk_level', '1')
			->get()->result_array();
		return $data;
	}

	public function miskin_total()
	{
		$jml_program = $this->db->select('COUNT(id) as jml')
			->get('program')
			->row()->jml;
		if (empty($jml_program))
		{
			$data['jumlah'] = 0;
			$data['nama'] = 'PROGRAM BANTUAN';
			$data['link_detail'] = 'program_bantuan';
			return $data;
		}

		if (empty($this->setting->dashboard_program_bantuan))
			$this->setting->dashboard_program_bantuan = 1;
		$data = $this->db->select('COUNT(pp.id) AS jumlah')
			->select('nama')
			->from('program p')
			->join('program_peserta pp', 'p.id = pp.program_id', 'left')
			->where('p.id', $this->setting->dashboard_program_bantuan)
			->get()
			->row_array();
		$data['link_detail'] = 'statistik/index/50'.$this->setting->dashboard_program_bantuan;
		return $data;
	}

	public function kelompok_total()
	{
		$sql = "SELECT COUNT(id) AS jumlah FROM kelompok";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function rtm_total()
	{
		$sql = "SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE rtm_level = 1";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function dusun_total()
	{
		$sql = "SELECT COUNT(id) AS jumlah FROM tweb_wil_clusterdesa WHERE rt = '0' AND rw = '0' ";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	// ---
	public function get_data()
	{
	/*
	 * global variabel
	 * */
		$outp["sasaran"] = array("1"=>"Penduduk", "2"=>"Keluarga / KK", "3"=>"Rumah Tangga", "4"=>"Kelompok/Organisasi Kemasyarakatan");
		$outp['user'] = $this->auth->get_user_vars();

		$sql = "SELECT * FROM config WHERE 1";
		$query = $this->db->query($sql);
		$outp['desa'] = $query->row_array();

		$sql = "SELECT COUNT(id) AS jml FROM komentar WHERE id_artikel = 775 AND enabled = 2;";
		$query = $this->db->query($sql);
		$lap = $query->row_array();
		$outp['lapor'] = $lap['jml'];

		// Terpaksa menjalankan migrasi, karena apabila tabel setting_modul
		// belum ada, menu modul tidak tampil, dan pengguna tidak bisa menjalankan Migrasi DB
		if (!$this->db->table_exists('setting_modul') )
		{
			$this->load->model('database_model');
			$this->database_model->migrasi_db_cri();
		}
		$this->load->model('modul_model');
		$outp['modul'] = $this->modul_model->list_aktif();

		return $outp;
	}

	public function get_config()
	{
		$sql = "SELECT * FROM config WHERE 1";
		$query = $this->db->query($sql);
		$outp['desa'] = $query->row_array();
		return $outp;
	}
}
