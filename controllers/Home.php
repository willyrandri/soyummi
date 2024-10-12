<?php
class Home extends CI_Controller
// class Home extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			redirect('logincon/index');
		}
		
		$this->load->model('parameter_mod', "pomod");
		$this->load->model('produk_mod', "prod");
		$this->load->model('Biaya_mod', "bm");

	}

	public function index($page = 'dashboardnew')
	{
		if (!file_exists(APPPATH . 'views/template/' . $page . '.php')) {
			show_404();
		}

		$data['datamenu'] = $this->bm->getdata_dashboard();
		$data['datacab'] = $this->prod->getcabang();

		$data['count_persediaan'] = $this->bm->persediaan_dash();
		$data['count_penjualan'] = $this->bm->penjualan_dash();
		$data['nom_penjualan'] = $this->bm->penjualan_dash_nom();
		$data['tunai'] = $this->bm->penjualan_dash_tunai();
		$data['nontunai'] = $this->bm->penjualan_dash_nontunai();


		$this->load->view('template/sidemenu');
		$this->load->view('template/' . $page, $data);
		// $this->load->view('template/' . $page);
		$this->load->view('template/footers');
	}

	public function bulanan($page = 'dashboard_bulanan')
	{
		if (!file_exists(APPPATH . 'views/template/' . $page . '.php')) {
			show_404();
		}

		$data['datacab'] = $this->prod->getcabang();

		$data['count_persediaan'] = $this->bm->persediaan_dash();
		
		$data['nontunai'] = $this->bm->penjualan_dash_nontunai();
		// new here
		$data['datamenu'] = $this->bm->getdata_dashboard_bul();
		$data['count_penjualan'] = $this->bm->penjualan_dash_bul();
		$data['nom_penjualan'] = $this->bm->penjualan_dash_nom_bul();
		$data['biaya'] = $this->bm->get_total_biaya();



		$this->load->view('template/sidemenu');
		$this->load->view('template/' . $page, $data);
		// $this->load->view('template/' . $page);
		$this->load->view('template/footers');
	}



}