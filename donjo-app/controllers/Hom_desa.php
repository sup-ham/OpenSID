<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hom_desa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('user_model');
		$grup	= $this->user_model->sesi_grup($_SESSION['sesi']);
		if ($grup != 1 AND $grup != 2)
		{
			if (empty($grup))
				$_SESSION['request_uri'] = $_SERVER['REQUEST_URI'];
			else
				unset($_SESSION['request_uri']);
			redirect('siteman');
		}
		$this->load->model('header_model');
		$this->load->model('config_model');
		$this->modul_ini = 200;
	}

	public function index()
	{
		redirect('hom_desa/konfigurasi');
	}

	public function konfigurasi()
	{
		$this->load->model('provinsi_model');
		// Menampilkan menu dan sub menu aktif
		$nav['act'] = 1;
		$nav['act_sub'] = 17;
		$header = $this->header_model->get_data();

		$data['main'] = $this->config_model->get_data();
		$this->load->view('header',$header);
		$this->load->view('nav',$nav);
		// Buat row data desa di konfigurasi_form apabila belum ada data desa
		if ($data['main']) $data['form_action'] = site_url("hom_desa/update/".$data['main']['id']);
			else $data['form_action'] = site_url("hom_desa/insert/");
		$data['list_provinsi'] = $this->provinsi_model->list_data();
		$this->load->view('home/konfigurasi_form',$data);
		$this->load->view('footer');
	}

	public function insert()
	{
		$this->config_model->insert();
		redirect('hom_desa/konfigurasi');
	}

	public function update($id='')
	{
		$this->config_model->update($id);
		redirect("hom_desa/konfigurasi");
	}

	public function ajax_kantor_maps()
	{
		$data['desa'] = $this->config_model->get_data();
		$data['form_action'] = site_url("hom_desa/update_kantor_maps/");
		$this->load->view("home/ajax_kantor_desa_maps", $data);
	}

	public function ajax_wilayah_maps()
	{
		$data['desa'] = $this->config_model->get_data();
		$data['form_action'] = site_url("hom_desa/update_wilayah_maps/");
		$this->load->view("home/ajax_wilayah_desa_maps", $data);
	}

	public function update_kantor_maps()
	{
		$this->config_model->update_kantor();
		redirect("hom_desa/konfigurasi");
	}

	public function update_wilayah_maps()
	{
		$this->config_model->update_wilayah();
			redirect("hom_desa/konfigurasi");
	}

}
