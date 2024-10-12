<?php
class Biaya extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			redirect('logincon/index');
		}
		
		$this->load->model('Biaya_mod', "bm");

	}

	public function biaya_menu($page = 'biaya_menu')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}

		$data['databiaya'] = $this->bm->getdata_biaya();
		
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}


	public function biaya_input($page = 'biaya_input')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}		
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page);
		$this->load->view('template/footers');
	}

	public function post_biaya()
	{

		$timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggal = date('Y-m-d');
		$tahun = date('y');
		$jam =  date("H:i:s");
		$tgljam =  date("Y-m-d H:i:s");
		$saveuser = $this->session->userdata('ses_id');


		$noid = $this->bm->selectmaxnoid();
		$noidnew = $noid+1;
		
		$data['noid'] = $noidnew;
		$data['keterangan'] = $_POST['keterangan'];
		$data['nominal'] = $_POST['nominal'];
		$data['usermod'] = $saveuser;
		$data['updatemod'] = $tanggal;

		$this->bm->insertdata_biaya($data);
		
		redirect('biaya/biaya_menu');
	}

	public function biaya_delete($noid)
	{
		$this->bm->delete_biaya($noid);
		redirect('biaya/biaya_menu');
	}



}