<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lapor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('user_model');
		$grup = $this->user_model->sesi_grup($_SESSION['sesi']);
		if ($grup != 1 AND $grup != 2 AND $grup != 3)
		{
			if (empty($grup))
				$_SESSION['request_uri'] = $_SERVER['REQUEST_URI'];
			else
				unset($_SESSION['request_uri']);
			redirect('siteman');
		}
		$this->load->model('header_model');
		$this->load->model('web_komentar_model');
		$this->modul_ini = 14;
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('lapor');
	}

	public function index($p = 1, $o = 0)
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_SESSION['filter']))
			$data['filter'] = $_SESSION['filter'];
		else $data['filter'] = '';

		if (isset($_POST['per_page']))
			$_SESSION['per_page'] = $_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data['paging'] = $this->web_komentar_model->paging($p, $o, 2);
		$data['main'] = $this->web_komentar_model->list_data($o, $data['paging']->offset, $data['paging']->per_page, 2);
		$data['keyword'] = $this->web_komentar_model->autocomplete();

		$header = $this->header_model->get_data();
		$nav['act'] = 14;
		$nav['act_sub'] = 55;

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('lapor/table', $data);
		$this->load->view('footer');
	}

	public function search()
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		redirect('lapor');
	}

	public function filter()
	{
		$filter = $this->input->post('filter');
		if ($filter != 0)
			$_SESSION['filter'] = $filter;
		else unset($_SESSION['filter']);
		redirect('lapor');
	}

	public function delete($p = 1, $o = 0, $id = '')
	{
		$this->web_komentar_model->delete($id);
		redirect("lapor/index/$p/$o");
	}

	public function delete_all($p = 1, $o = 0)
	{
		$this->web_komentar_model->delete_all();
		redirect("lapor/index/$p/$o");
	}

	public function komentar_lock($id = '')
	{
		$this->web_komentar_model->komentar_lock($id, 1);
		redirect("lapor/index/$p/$o");
	}

	public function komentar_unlock($id = '')
	{
		$this->web_komentar_model->komentar_lock($id, 2);
		redirect("lapor/index/$p/$o");
	}
}
