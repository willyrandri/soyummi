<?php
class Produk extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			redirect('logincon/index');
		}

		$this->load->model('parameter_mod', "pomod");
		$this->load->model('Produk_mod', "prod"); // Load the model
		
		// $this->load->model('Usermod', "um");

	}

	public function produksi($page = 'produksi')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}

		$data['datamenu'] = $this->pomod->getdata_menu_aktiv();
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}

	public function distribusi($page = 'distribusi_menu')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}

		$data['datamenu'] = $this->prod->getdata_akan_didist();
		// var_dump($data['datamenu']);die();
		$data['datacab'] = $this->prod->getcabang();

		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}

	public function save_produksi() {
		// Get the posted data
		$jumlah = $this->input->post('jumlah');
		$harga = $this->input->post('harga');
		$kadarluasa = $this->input->post('kadarluasa');
		
		// Debugging: Check if $jumlah is set and is an array
		if (!isset($jumlah) || !is_array($jumlah)) {
			show_error('Invalid input data');
			return;
		}
		
		$data = [];
		foreach ($jumlah as $noid => $value) {
			$harga_value = isset($harga[$noid]) ? $harga[$noid] : 0;
			$kadarluasa_value = isset($kadarluasa[$noid]) ? (int)$kadarluasa[$noid] : 0; // Ensure kadarluasa_value is an integer
			
			if ($value > 0) { // Only save items with jumlah greater than 0
				// Calculate the new kadarluasa date
				$timezone = "Asia/Jakarta";
				if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
				$tgljam =  date("ymdHis");

				$currentDate = new DateTime();
				$currentDate->modify("+$kadarluasa_value days");
				$kadarluasa_date = $currentDate->format('Y-m-d');
				$stat_dist = '1';
				$tanggal = $this->input->post('tanggal');
				$ses_id = $this->session->userdata('ses_id');
	
				$data[] = [
					'noid' => $noid,
					'jumlah' => $value,
					'harga' => $harga_value,
					'kadarluasa' => $kadarluasa_date,
					'stat_dist' => $stat_dist,
					'tanggal' => $tanggal ? $tanggal : date('Y-m-d'), // Assuming you want to save the current date
					'usermod' => $ses_id,
					'updatemod' => $tgljam,
				];
			}
		}
		
		// In the controller's save_produksi method
		if (!empty($data)) {
			if ($this->prod->save_produksi_batch($data)) {
				$this->session->set_flashdata('success_message', 'Data successfully saved!');
			} else {
				$this->session->set_flashdata('error_message', 'Failed. Data ini sudah pernah di input hari ini.');
			}
		} else {
			$this->session->set_flashdata('error_message', 'No data to save.');
		}
		
		// Redirect after setting the flash data
		redirect('produk/produksi'); // Adjust the redirect as needed
	}


	public function produksi_delete($noid, $tanggal) {
		// Your delete logic here using $noid and $kodecabang
		// Example:
		
		$result = $this->prod->delete_produksi($noid, $tanggal);
	
		if ($result) {
			$this->session->set_flashdata('success_message', 'Data deleted successfully.');
		} else {
			$this->session->set_flashdata('error_message', 'Failed to delete data.');
		}
	
		redirect('Produk/distribusi'); // Redirect to the appropriate view
	}

	public function save_distribusi()
	{
		$kodecabang = $this->input->post('kodecabang');
		$jumlah = $this->input->post('jumlah');
		$harga = $this->input->post('harga');
		$kadarluasa = $this->input->post('kadarluasa');
        $ses_id = $this->session->userdata('ses_id');

		// Get the current maximum id_dist and increment it by 1
		$current_max_id_dist = $this->prod->get_max_id_dist();
		$id_dist = $current_max_id_dist ? $current_max_id_dist + 1 : 1;
	
		$data = [];
		foreach ($jumlah as $noid => $tanggal_data) {
			foreach ($tanggal_data as $tanggal => $jumlah_value) {
				if ($jumlah_value > 0) {
					$data[] = [
						'noid' => $noid,
						'harga' => $harga[$noid][$tanggal],
						'tanggal' => $tanggal,
						'jumlah' => $jumlah_value,
						'kadarluasa' => $kadarluasa[$noid][$tanggal],
						'stat_dist' => '1', 
						'kodecabang' => $kodecabang,
						'tgldist' => date('Y-m-d H:i:s'),
						'userdist' => $ses_id,
						'iddist' => $id_dist,
					];
				}
			}
		}
	
		if ($this->prod->save_dist($data)) {
			$this->session->set_flashdata('success_message', 'Data saved successfully.');
		} else {
			$this->session->set_flashdata('error_message', 'Failed to save data.');
		}
	
		redirect('produk/distribusi'); 
	}
	


	public function terimabarang($page = 'terimabarang_menu')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$ses_akses = $this->session->userdata('ses_akses');
		$cabang = $this->input->post('kodecabang') ? $this->input->post('kodecabang') : 'IntanPayung'; // Set default value 'IP' if not picked
		
		if ($ses_akses =='1'){
			$data['datamenu'] = $this->prod->get_dist($cabang);
			$data['kodecab'] = $cabang;
		}
		else{
			$cabang = $this->session->userdata('ses_cab');
			$data['datamenu'] = $this->prod->get_dist($cabang);
			$data['kodecab'] = $cabang;
		}

		
		$data['datacab'] = $this->prod->getcabang();
		
		$this->load->view('template/sidemenu');
		$this->load->view('pages/' . $page,$data);
		$this->load->view('template/footers');
	}

	
	

}