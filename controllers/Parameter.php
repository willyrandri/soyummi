<?php
class Parameter extends CI_Controller
// class Parameter extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			redirect('logincon/index');
		}
		$this->load->model('parameter_mod', "pomod");
	}

	public function user($page = 'user_menu')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		
		$data['datauser'] = $this->pomod->getdata_user();
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}

	public function menu($page = 'menu_menu')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		
		$data['datamenu'] = $this->pomod->getdata_menu();
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}

	public function cabang($page = 'cabang_menu')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		
		$data['datauser'] = $this->pomod->getdata_cabang();
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}

	public function user_delete($nik)
	{
		$this->pomod->delete_users($nik);
		redirect('parameter/user');
	}

	public function cabang_delete($kodecabang)
	{
		$this->pomod->delete_cabang($kodecabang);
		redirect('parameter/cabang');
	}

	public function tambah_user($page = 'user_input')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}

		$data['data_akses'] = $this->pomod->select_akses();
		$data['data_cabang'] = $this->pomod->select_cabang();
		// var_dump($data['data_cabang']);die();
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}

	public function tambah_cabang($page = 'cabang_input')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}

		$data['data_akses'] = $this->pomod->select_akses();
		$data['data_cabang'] = $this->pomod->select_cabang();
		// var_dump($data['data_cabang']);die();
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}

	public function tambah_menu($page = 'menu_input')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}

		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page);
		$this->load->view('template/footers');
	}

	public function post_user()
	{

		$timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggal = date('Y-m-d');
		$tahun = date('y');
		$jam =  date("H:i:s");
		$tgljam =  date("ymdHis");
		$saveuser = $this->session->userdata('ses_id');
		$kdcab = $this->session->userdata('ses_cab');


		$data['nik'] = $_POST['nik'];
		$data['nama'] = $_POST['nama'];
		$data['passwd'] = MD5($_POST['pass']);
		$data['kodecabang'] = $_POST['cabang'];
		$data['akses'] = $_POST['leveluser'];
		$data['usermod'] = $saveuser;
		$data['updatemod'] = $tgljam;
		$data['stat'] = '1';
		
		$this->pomod->insertdata_user($data);
		
		redirect('parameter/user');
	}

	public function post_cabang()
	{

		$timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggal = date('Y-m-d');
		$tahun = date('y');
		$jam =  date("H:i:s");
		$tgljam =  date("Y-m-d H:i:s");
		$saveuser = $this->session->userdata('ses_id');
		$kdcab = $this->session->userdata('ses_cab');

		$data['kodecabang'] = $_POST['kodecabang'];
		$data['namacabang'] = $_POST['namacabang'];
		$data['stat'] = '1';
		$data['usermod'] = $saveuser;
		$data['updatemod'] = $tgljam;

		$this->pomod->insertdata_cabang($data);
		
		redirect('parameter/cabang');
	}

	public function post_menu()
	{

		$timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggal = date('Y-m-d');
		$tahun = date('y');
		$jam =  date("H:i:s");
		$tgljam =  date("Y-m-d H:i:s");
		$saveuser = $this->session->userdata('ses_id');
		$kdcab = $this->session->userdata('ses_cab');

		$data['noid'] = $_POST['kodemenu'];
		$data['namamenu'] = $_POST['namamenu'];
		$data['norut'] = $_POST['norut'];
		$data['harga'] = $_POST['harga'];
		$data['kadarluasa'] = $_POST['kadarluasa'];
		$data['stat'] = '1';
		$data['usermod'] = $saveuser;
		$data['updatemod'] = $tgljam;

		$this->pomod->insertdata_menu($data);
		
		redirect('parameter/menu');
	}

	public function user_edit($nik)
	{
		$data['editusers'] = $this->pomod->edit_user_get($nik);
		$data['data_akses'] = $this->pomod->select_akses();
		$data['data_cabang'] = $this->pomod->select_cabang();
		// var_dump($data['paramcoaedit'] );
		// die();
		$this->load->view('template/sidemenu');
		$this->load->view('pages/user_edit', $data);
		$this->load->view('template/footers');
	}

	public function cabang_edit($kodecabang)
	{
		// $data['editusers'] = $this->pomod->edit_user_get($nik);
		// $data['data_akses'] = $this->pomod->select_akses();
		$data['data_cabang'] = $this->pomod->select_cabang_edit($kodecabang);
		// var_dump($data['data_cabang'] );
		// die();
		$this->load->view('template/sidemenu');
		$this->load->view('pages/cabang_edit', $data);
		$this->load->view('template/footers');
	}

	public function menu_edit($noid)
	{
		$data['menuedit'] = $this->pomod->select_menu_edit($noid);
		// var_dump($data['paramcoaedit'] );
		// die();
		$this->load->view('template/sidemenu');
		$this->load->view('pages/menu_edit', $data);
		$this->load->view('template/footers');
	}


	public function posteditpejabat()
	{
		$timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggal = date('Y-m-d');
		$tahun = date('y');
		$jam =  date("H:i:s");
		$tgljam =  date("ymdHis");
		$saveuser = $this->session->userdata('ses_id');
		$kdcab = $this->session->userdata('ses_cab');

		$nik = $_POST['nik'];
		$data['nama'] = $_POST['nama'];
		$data['passwd'] = MD5($_POST['pass']);
		$data['kodecabang'] = $_POST['cabang'];
		$data['akses'] = $_POST['leveluser'];
		$data['usermod'] = $saveuser;
		$data['updatemod'] = $tgljam;

		$this->pomod->udpate_user($data, $nik);
		redirect('parameter/user');
	}

	public function posteditcabang()
	{
		$timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggal = date('Y-m-d');
		$tahun = date('y');
		$jam =  date("H:i:s");
		$tgljam =  date("ymdHis");
		$saveuser = $this->session->userdata('ses_id');
		$kdcab = $this->session->userdata('ses_cab');

		$nik = $_POST['kodecabang'];
		$data['XNNAME'] = $_POST['namacabang'];
		$data['XNADD1'] = $_POST['alamat'];
		$data['XNCITY'] = $_POST['kota'];
		$data['XNBI#'] = $_POST['induk'];
		$data['usermod'] = $saveuser;
		$data['updatemod'] = $tgljam;

		$this->pomod->udpate_cabang($data, $nik);
		redirect('parameter/cabang');
	}

	public function posteditmenu()
	{
		$timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggal = date('Y-m-d');
		$tahun = date('y');
		$jam =  date("H:i:s");
		$tgljam =  date("ymdHis");
		$saveuser = $this->session->userdata('ses_id');
		$kdcab = $this->session->userdata('ses_cab');

		$nik = $_POST['noid'];
		$data['namamenu'] = $_POST['namamenu'];
		$data['harga'] = $_POST['harga'];
		$data['norut'] = $_POST['norut'];
		$data['kadarluasa'] = $_POST['kadarluasa'];
		$data['usermod'] = $saveuser;
		$data['updatemod'] = $tgljam;

		$this->pomod->udpate_menu($data, $nik);
		redirect('parameter/menu');
	}

	public function jamlogin($page = 'jam_login')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		
		$data['datajam'] = $this->pomod->getdata_jam();
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}

	public function postdatajam()
	{
		$timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggal = date('Y-m-d');
		$tahun = date('y');
		$jam =  date("H:i:s");
		$tgljam =  date("ymdHis");
		$saveuser = $this->session->userdata('ses_id');
		$kdcab = $this->session->userdata('ses_cab');

		$nik = 'jam';
		$data['masuk'] = $_POST['masuk'];
		$data['pulang'] = $_POST['pulang'];
		$data['usermod'] = $saveuser;
		$data['updatemod'] = $tgljam;

		$this->pomod->udpate_jam($data, $nik);
		redirect('parameter/jamlogin');
	}

	public function aktivkan($noid)
	{
		$this->pomod->update_stat_menu1($noid);
		redirect('parameter/menu');
	}

	public function non_aktivkan($noid)
	{
		$this->pomod->update_stat_menu2($noid);
		redirect('parameter/menu');
	}


}