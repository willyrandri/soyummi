<?php
class Persediaan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			redirect('logincon/index');
		}

		$this->load->model('Persediaan_mod', "pm");
		$this->load->model('Produk_mod', "prod");

	}


	public function index($page = 'persediaan_menu')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$ses_akses = $this->session->userdata('ses_akses');
		$cabang = $this->input->post('kodecabang') ? $this->input->post('kodecabang') : 'IntanPayung'; // Set default value 'IP' if not picked
		
		if ($ses_akses =='1'){
			$data['datamenu'] = $this->pm->get_persediaan($cabang);
			$data['kodecab'] = $cabang;
		}
		else{
			$cabang = $this->session->userdata('ses_cab');
			$data['datamenu'] = $this->pm->get_persediaan($cabang);
			$data['kodecab'] = $cabang;
		}

		
		$data['datacab'] = $this->prod->getcabang();
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}

	public function orderaktiv($page = 'sell_order')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$ses_akses = $this->session->userdata('ses_akses');
		$cabang = $this->input->post('kodecabang') ? $this->input->post('kodecabang') : 'IntanPayung'; // Set default value 'IP' if not picked
		
		if ($ses_akses =='1'){
			$data['datamenu'] = $this->pm->get_orderan($cabang);
			$data['datamenu_cal'] = $this->pm->get_orderan_cal($cabang);
			$data['kodecab'] = $cabang;
		}
		else{
			$cabang = $this->session->userdata('ses_cab');
			$data['datamenu'] = $this->pm->get_orderan($cabang);
			$data['datamenu_cal'] = $this->pm->get_orderan_cal($cabang);
			$data['kodecab'] = $cabang;
		}

		
		$data['datacab'] = $this->prod->getcabang();
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}

	public function order_detail($id_penjualan)
	{
		$data['datamenu'] = $this->pm->get_orderan_detail($id_penjualan);
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/sell_order_detail', $data);
		$this->load->view('template/footers');
	}

	public function print_order($id_penjualan)
	{

		$data['datamain'] = $this->pm->get_orderan_print($id_penjualan);
		$data['datamenu'] = $this->pm->get_orderan_detail($id_penjualan);
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/sell_order_detail_print', $data);
		$this->load->view('template/footers');
	}


	public function order_done($id_penjualan)
	{
		$this->pm->order_done_status($id_penjualan);
		redirect('persediaan/orderaktiv');
	}

	public function persediaan_delete($noid, $tanggal, $kodecabang) {
		$ses_akses = $this->session->userdata('ses_akses');

		
		$result = $this->pm->delete_persediaan($noid, $tanggal, $kodecabang);
	
		if ($result) {
			$this->session->set_flashdata('success_message', 'Data deleted successfully.');
		} else {
			$this->session->set_flashdata('error_message', 'Failed to delete data.');
		}
	
		redirect('persediaan/index'); // Redirect to the appropriate view
	}

	public function dist_delete($noid, $tanggal, $kodecabang, $iddist) {
		$ses_akses = $this->session->userdata('ses_akses');

		
		$result = $this->pm->delete_distribusi($noid, $tanggal, $kodecabang, $iddist);
	
		if ($result) {
			$this->session->set_flashdata('success_message', 'Data deleted successfully.');
		} else {
			$this->session->set_flashdata('error_message', 'Failed to delete data.');
		}
	
		redirect('persediaan/index'); // Redirect to the appropriate view
	}

	public function buat_orderan() {
		$timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tgljam =  date("ymdHis");

		$data = $this->input->post();
		
		$selectmaxid = $this->pm->select_tahun_jual();
		$id_penjualan = $selectmaxid[0]->id_penjualan;
		$year = substr($id_penjualan, 0, 2); 
		$number = intval(substr($id_penjualan, 2)); 
		$currentYear = date('y');
		
			if ($year == $currentYear) 
			{
				$number++;
			} else {
				$year = $currentYear;
				$number = 1;
			}

		$newNumber = $year . $number;
		
		$ses_akses = $this->session->userdata('ses_akses');
		if ($ses_akses =='1'){
			$cabang = $this->input->post('kodecabang') ? $this->input->post('kodecabang') : 'IntanPayung';
		}
		else{
			$cabang = $this->session->userdata('ses_cab');
		}

		$catatan = $this->input->post('catatan');
		$diskon = $this->input->post('diskon') ?? 0;
		$carabayar = $this->input->post('carabayar');

		$userid = $this->session->userdata('ses_id');

		foreach ($data['jumlah'] as $noid => $dates) {
			foreach ($dates as $tanggal => $jumlah) {
				if ($jumlah > 0) {
					$jumlahawal = isset($data['jumlahawal'][$noid][$tanggal]) ? $data['jumlahawal'][$noid][$tanggal] : 0;
					$insertData = [
						'noid' => $noid,
						'tanggal_produksi' => $tanggal,
						'jumlahawal' => $jumlahawal,
						'jumlah' => $jumlah,
						'harga' => $data['harga'][$noid][$tanggal],
						'totalharga' => ($jumlah * ($data['harga'][$noid][$tanggal])),
						'tanggal_jual' => date('Y-m-d'),
						'id_penjualan' => $newNumber,
						'kodecabang' => $cabang,
						'catatan' => $catatan,
						'diskon' => $diskon,
						'statusjual' => '1',
						'usermod' => $userid,
						'updatemod' => $tgljam,
						'carabayar' => $carabayar
					];

					$jumlahAwal = isset($insertData['jumlahawal']) ? $insertData['jumlahawal'] : 0;

					unset($insertData['jumlahawal']);

					$result = $this->pm->insert_order($insertData);
					if ($result === true) {
						// Redirect or show success message
						$this->pm->kurangi_stok($insertData, $jumlahAwal);
					} else {
						// Conditional error handling
						if (ENVIRONMENT !== 'production') {
							show_error($result, 500, 'An Error Was Encountered');
						} else {
							$this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan data');
						}
						break; // Exit the inner loop
					}

				}
			}
		}
		if ($result === true) {
			$this->session->set_flashdata('success_message', 'Order successfully created.');
		}

		redirect('persediaan/orderaktiv');
	}


	public function delete_order_detail_satuan($noid,$tanggal_produksi,$id_penjualan,$jumlah,$kodecabang)
	{
		$this->pm->del_order_detail_satuan($noid,$tanggal_produksi,$id_penjualan,$jumlah,$kodecabang);
		// redirect('persediaan/order_detail/'.$id_penjualan);
		redirect('persediaan/orderaktiv');
	}

	public function delete_order_detail_all($id_penjualan)
	{
		$this->pm->del_order_detail_all($id_penjualan);
		// redirect('persediaan/order_detail/'.$id_penjualan);
		redirect('persediaan/orderaktiv');
	}

	public function update_status() {
		$noid = $this->input->post('noid');
		$tanggal = $this->input->post('tanggal');
		$kodecabang = $this->input->post('kodecabang');
		$iddist = $this->input->post('iddist');
	
		// log_message('debug', 'update_status called with noid: ' . $noid . ', tanggal: ' . $tanggal . ', kodecabang: ' . $kodecabang . ', iddist: ' . $iddist);
	
		$timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tgljam = date("ymdHis");
		$userid = $this->session->userdata('ses_id');
	
		// Update stat_dist in distribusi table
		$update_data = [
			'stat_dist' => 2,
			'tglditerima' => $tgljam,
			'userterima' => $userid
		];
		$this->db->where('noid', $noid);
		$this->db->where('tanggal', $tanggal);
		$this->db->where('kodecabang', $kodecabang);
		$this->db->where('iddist', $iddist);
		$update_result = $this->db->update('distribusi', $update_data);
	
		log_message('debug', 'Update result: ' . $update_result);
	
		if ($update_result) {
			// Select data from distribusi table
			$this->db->where('noid', $noid);
			$this->db->where('tanggal', $tanggal);
			$this->db->where('kodecabang', $kodecabang);
			$this->db->where('iddist', $iddist);
			$query = $this->db->get('distribusi');
			$distribusi_data = $query->result_array();
	
			// log_message('debug', 'Distribusi data: ' . print_r($distribusi_data, true));
	
			// Insert data into persediaan table
			$insert_result = $this->db->insert_batch('persediaan', $distribusi_data);
	
			// log_message('debug', 'Insert result: ' . $insert_result);
	
			if ($insert_result) {
				$response = ['status' => 'success', 'message' => 'Data updated and inserted successfully.'];
			} else {
				$response = ['status' => 'error', 'message' => 'Failed to insert data into persediaan table.'];
			}
		} else {
			$response = ['status' => 'error', 'message' => 'Failed to update distribusi table.'];
		}
	
		echo json_encode($response);
	}

	public function pindahtoko_pilcab($page = 'pindahtoko_pilcab')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}

		$data['datacab'] = $this->prod->getcabang();
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}


	public function pindahtoko($page = 'pindahtoko_menu')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$cabang = $this->input->post('namacabang');
		$data['datamenu'] = $this->pm->get_pindah($cabang);
		$data['datacab'] = $this->prod->getcabang_not($cabang);
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}


	public function pindahtoko_saved() {
		$timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tgljam = date("ymdHis");
		$tgl = date("y-m-d");
		$userid = $this->session->userdata('ses_id');
		$namacabang = $this->input->post('namacabang');
	
		// Get the current maximum id_dist and increment it by 1
		$current_max_id_dist = $this->prod->get_max_id_dist();
		$id_dist = $current_max_id_dist ? $current_max_id_dist + 1 : 1;
	
		$noidArray = $this->input->post('noid');
		$tanggalArray = $this->input->post('tanggal');
		$kodecabangArray = $this->input->post('kodecabang');
		$iddistArray = $this->input->post('iddist');
		$jumlahArray = $this->input->post('jumlah');
		
		foreach ($noidArray as $key => $noid) {
			// Get the corresponding values
			$jumlah = $jumlahArray[$noid]; // Access jumlah using noid as key
			$tanggal = $tanggalArray[$key];
			$kodecabang = $kodecabangArray[$key];
			$iddist = $iddistArray[$key];
		
			// Only process if jumlah is greater than 0
			if ($jumlah > 0) {
				// Select data from persediaan table based on keys
				$this->db->select('noid, harga, tanggal, kadarluasa');
				$this->db->where('noid', $noid);
				$this->db->where('tanggal', $tanggal);
				$this->db->where('kodecabang', $kodecabang);
				$this->db->where('iddist', $iddist);
		
				// Execute the query
				$persediaanData = $this->db->get('persediaan')->row_array();
				// var_dump($persediaanData);(die);
				// Prepare data for insertion into distribusi
				$dataDistribusi = [
					'noid' => $persediaanData['noid'],
					'tanggal' => $persediaanData['tanggal'],
					'kadarluasa' => $persediaanData['kadarluasa'],
					'kodecabang' => $namacabang, // Using selected cabang
					'iddist' => 'P-' . $id_dist,
					'jumlah' => $jumlah,
					'stat_dist' => '1',
					'harga' => $persediaanData['harga'],
					'tgldist' => $tgljam,
					'userdist' => $userid,
					'tglpindah' => $tgl,
				];
				
				$this->db->insert('pindah_toko', $dataDistribusi);
				// var_dump($dataDistribusi);(die);
				// Now reduce the jumlah in persediaan table
				$this->db->set('jumlah', 'jumlah - ' . (int)$jumlah, FALSE); // Reduce the jumlah
				$this->db->where('noid', $noidArray[$key]);
				$this->db->where('tanggal', $tanggalArray[$key]);
				$this->db->where('kodecabang', $kodecabangArray[$key]);
				$this->db->where('iddist', $iddistArray[$key]);
				$this->db->update('persediaan');
			}
		}
	
		// Redirect or set a flash message
		$this->session->set_flashdata('success_message', 'Data successfully transferred.');
		redirect('Persediaan/pindahtoko_pilcab'); // Change this to your redirect route
	}

	public function order_edit($id_penjualan)
	{
		// $id_jual = $this->pomod->edit_user_get($id_penjualan);
		$data['id_jual'] = $this->pm->get_jualdata($id_penjualan);
		// var_dump($id_jual);
		// die();
		$this->load->view('template/sidemenu');
		$this->load->view('pages/sell_order_edit', $data);
		$this->load->view('template/footers');
	}

	public function order_edit_save()
	{
		$timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tgljam =  date("ymdHis");

		$userid = $this->session->userdata('ses_id');

		$id_jual = $_POST['noid'];
		$data['catatan'] = $_POST['catatan'];
		$data['diskon'] = $_POST['diskon'];
		$data['konfirmby'] = $userid;
		$data['konfirmdate'] = $tgljam;

		$this->pm->insert_order_edit($data, $id_jual);
		$this->session->set_flashdata('success_message', 'Order successfully created.');
		redirect('persediaan/orderaktiv');
	}


}