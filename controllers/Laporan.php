<?php
class Laporan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			redirect('logincon/index');
		}
		
		$this->load->model('Laporan_mod', "lm");
		$this->load->model('produk_mod', "prod");

	}


	public function tgl_produksi($page = 'tgl_produksi')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page);
		$this->load->view('template/footers');
	}

	public function tgl_distribusi($page = 'tgl_distribusi')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page);
		$this->load->view('template/footers');
	}

	public function tgl_penjualan($page = 'tgl_penjualan')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page);
		$this->load->view('template/footers');
	}

	

	public function tgl_persediaan($page = 'tgl_persediaan')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page);
		$this->load->view('template/footers');
	}

	public function penjualan_tampil() 
	{
		$startDate = $this->input->get('startDate');
		if (!$startDate) {
			$startDate = $this->input->post('startDate');
		}
	
		$endDate = $this->input->get('endDate');
		if (!$endDate) {
			$endDate = $this->input->post('endDate');
		}

		$startDate = date('Y-m-d', strtotime($startDate));
		$endDate = date('Y-m-d', strtotime($endDate));
		
		$filteredData = $this->lm->getdata_penjualan($startDate, $endDate);
	
		$data['laporan'] = $filteredData;
		
	
		$this->load->view('template/sidemenu');
		$this->load->view('pages/laporan_penjualan', $data);
		$this->load->view('template/footers');
	}

	public function produksi_tampil() 
	{
		$startDate = $this->input->get('startDate');
		if (!$startDate) {
			$startDate = $this->input->post('startDate');
		}
	
		$endDate = $this->input->get('endDate');
		if (!$endDate) {
			$endDate = $this->input->post('endDate');
		}

		$startDate = date('Y-m-d', strtotime($startDate));
		$endDate = date('Y-m-d', strtotime($endDate));
		
		$filteredData = $this->lm->getdata_produksi($startDate, $endDate);
	
		$data['laporan'] = $filteredData;
		
	
		$this->load->view('template/sidemenu');
		$this->load->view('pages/laporan_produksi', $data);
		$this->load->view('template/footers');
	}

	public function distribusi_tampil() 
	{
		$startDate = $this->input->get('startDate');
		if (!$startDate) {
			$startDate = $this->input->post('startDate');
		}
	
		$endDate = $this->input->get('endDate');
		if (!$endDate) {
			$endDate = $this->input->post('endDate');
		}

		$startDate = date('Y-m-d', strtotime($startDate));
		$endDate = date('Y-m-d', strtotime($endDate));
		
		$filteredData = $this->lm->getdata_distribusi($startDate, $endDate);
	
		$data['laporan'] = $filteredData;
		
	
		$this->load->view('template/sidemenu');
		$this->load->view('pages/laporan_distribusi', $data);
		$this->load->view('template/footers');
	}

	public function persediaan_tampil() 
	{
		$startDate = $this->input->get('startDate');
		if (!$startDate) {
			$startDate = $this->input->post('startDate');
		}
	
		$endDate = $this->input->get('endDate');
		if (!$endDate) {
			$endDate = $this->input->post('endDate');
		}

		$startDate = date('Y-m-d', strtotime($startDate));
		$endDate = date('Y-m-d', strtotime($endDate));
		
		$filteredData = $this->lm->getdata_persediaan_history($startDate, $endDate);
	
		$data['laporan'] = $filteredData;
		
	
		$this->load->view('template/sidemenu');
		$this->load->view('pages/laporan_persediaan', $data);
		$this->load->view('template/footers');
	}


	public function laporan_keuangan() 
	{
		
		$filteredData = $this->lm->get_lap_keu();
	
		$data['laporan'] = $filteredData;
	
		$this->load->view('template/sidemenu');
		$this->load->view('pages/laporan_keuangan', $data);
		$this->load->view('template/footers');
	}

	public function total_jual_tgl($page = 'tgl_total_jual')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		
		// $data['datacab'] = $this->prod->getcabang();

		$this->load->view('template/sidemenu');
		$this->load->view('pages/'. $page);
		$this->load->view('template/footers');
	}

	public function totaljual_tampil() 
	{
		$startDate = $this->input->get('startDate');
		if (!$startDate) {
			$startDate = $this->input->post('startDate');
		}
	
		$endDate = $this->input->get('endDate');
		if (!$endDate) {
			$endDate = $this->input->post('endDate');
		}

		// $kdcabang = $this->input->post('kodecabang');

		$startDate = date('Y-m-d', strtotime($startDate));
		$endDate = date('Y-m-d', strtotime($endDate));
		
		$filteredData = $this->lm->getdata_totaljual($startDate, $endDate);

		$data['datacab'] = $this->prod->getcabang();
		$data['datamenu'] = $filteredData;
		
	
		$this->load->view('template/sidemenu');
		$this->load->view('pages/total_jual', $data);
		$this->load->view('template/footers');
	}

	public function pengeluaran_tgl($page = 'tgl_pengeluaran')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}

		$this->load->view('template/sidemenu');
		$this->load->view('pages/'. $page);
		$this->load->view('template/footers');
	}

	public function biaya_tgl($page = 'biaya_menu')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}

		$startDate = $this->input->get('startDate');
		if (!$startDate) {
			$startDate = $this->input->post('startDate');
		}
	
		$endDate = $this->input->get('endDate');
		if (!$endDate) {
			$endDate = $this->input->post('endDate');
		}

		$startDate = date('Y-m-d', strtotime($startDate));
		$endDate = date('Y-m-d', strtotime($endDate));
		
		$filteredData = $this->lm->getdata_biaya_date($startDate, $endDate);
	
		$data['databiaya'] = $filteredData;		
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}


}