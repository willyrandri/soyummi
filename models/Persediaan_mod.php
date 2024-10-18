<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persediaan_mod extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
        

    function get_persediaan($cabang)
    {
        $hasil = [];
        $query = $this->db->query("SELECT 
            a.namamenu,
            b.noid,
            a.norut,
            b.harga,
            b.tanggal,
            b.jumlah,
            b.kadarluasa,
            b.stat_dist,
            b.kodecabang
            FROM 
            menu_utama a
            LEFT JOIN persediaan b ON a.noid = b.noid AND b.jumlah > 0
            AND b.kodecabang = '".$cabang."' AND b.tglditerima IS NOT NULL
            ORDER BY norut ASC
        ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function get_pindah($cabang)
    {
        $hasil = [];
        $query = $this->db->query("SELECT 
            a.namamenu,
            b.noid,
            a.norut,
            b.harga,
            b.tanggal,
            b.jumlah,
            b.kadarluasa,
            b.stat_dist,
            b.kodecabang,
            b.iddist
            FROM 
            menu_utama a
            INNER JOIN persediaan b ON a.noid = b.noid AND b.jumlah > 0
            AND b.kodecabang = '".$cabang."' AND b.tglditerima IS NOT NULL
            ORDER BY norut ASC
        ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function get_orderan($cabang)
    {
        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tgl =  date("ymd");

        $hasil = [];
        $ses_akses = $this->session->userdata('ses_akses');
        if ($ses_akses =='1'){
            $query = $this->db->query("SELECT * FROM view_orderanaktiv WHERE statusjual ='1' OR tanggal_jual = '".$tgl."' ORDER BY statusjual, id_penjualan ASC");
		}
		else{
			$query = $this->db->query("SELECT * FROM view_orderanaktiv  WHERE (statusjual ='1' OR tanggal_jual = '".$tgl."') AND kodecabang = '".$cabang."' ORDER BY statusjual, id_penjualan ASC ");
		}
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function get_orderan_cal($cabang)
    {
        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tgl =  date("ymd");

        $hasil = [];
        $ses_akses = $this->session->userdata('ses_akses');
        if ($ses_akses =='1'){
            $query = $this->db->query("SELECT (SUM(totalharga) - SUM(diskon)) as tharga, SUM(diskon) as tdiskon, carabayar 
            FROM view_orderanaktiv WHERE statusjual ='1' OR tanggal_jual = '".$tgl."' GROUP BY carabayar");
		}
		else{
			$query = $this->db->query("SELECT (SUM(totalharga) - SUM(diskon)) as tharga, SUM(diskon) as tdiskon, carabayar 
            FROM view_orderanaktiv  WHERE (statusjual ='1' OR tanggal_jual = '".$tgl."') AND kodecabang = '".$cabang."' GROUP BY carabayar ");
		}
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function get_orderan_print($id_penjualan)
    {
        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tgl =  date("ymd");

        $hasil = [];
        
        $query = $this->db->query("SELECT * FROM view_orderanaktiv WHERE id_penjualan = '".$id_penjualan."' ");
		
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function get_orderan_detail($id_penjualan)
    {
        
        $hasil = [];

        $query = $this->db->query("SELECT a.noid, a.tanggal_produksi, a.id_penjualan, a.statusjual, a.tanggal_jual, a.jumlah, a.harga, a.totalharga, a.kodecabang
        ,b.namamenu
        FROM penjualan a 
        LEFT JOIN menu_utama b ON a.noid = b.noid
        WHERE a.id_penjualan = '".$id_penjualan."' ORDER BY b.norut ASC");
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function delete_persediaan($noid, $tanggal, $kodecabang) {
        $this->db->where('noid', $noid);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('kodecabang', $kodecabang);
        return $this->db->delete('persediaan'); // Replace 'your_table_name' with the actual table name
    }

    public function delete_distribusi($noid, $tanggal, $kodecabang, $iddist) {
        $this->db->where('noid', $noid);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('kodecabang', $kodecabang);
        $this->db->where('iddist', $iddist);
        return $this->db->delete('distribusi'); // Replace 'your_table_name' with the actual table name
    }

    public function kurangi_stok($data, $jumlahAwal) {
        // var_dump($jumlahAwal); die();
            // Ensure necessary keys exist in $data
            if (isset($data['tanggal_produksi'], $data['noid'], $data['kodecabang'], $data['jumlah'])) {
                $tanggal_produksi = $data['tanggal_produksi'];
                $noid = $data['noid'];
                $kodecabang = $data['kodecabang'];
                $jumlah = $data['jumlah'];
                $jumlahbaru = $jumlahAwal - $jumlah; // Use the passed jumlahawal
                // var_dump ($jumlahbaru); die();
    
                // Update the stock in the database
                $this->db->set('jumlah', $jumlahbaru);
                $this->db->where('noid', $noid);
                $this->db->where('tanggal', $tanggal_produksi);
                $this->db->where('kodecabang', $kodecabang);
                
                if ($this->db->update('persediaan')) {
                    // Optional: You can log success or return a success message
                    return true;
                } else {
                    // Handle update error
                    return 'Failed to update stock';
                }
            } else {
                return 'Missing required data';
            }
        
    }
    

    // public function insert_order($data) {
    //     return $this->db->insert('penjualan', $data);
    // }

    public function insert_order($data) {
        $this->db->trans_start();
        $this->db->insert('penjualan', $data);
        $this->db->trans_complete();
        
        // Check for errors after the insert attempt
        if ($this->db->trans_status() === FALSE) {
            $error = $this->db->error(); // Get the error details
            // Check for duplicate entry error code
            if ($error['code'] == 1062) {
                return 'Data duplikat';
            }
            return 'Terjadi kesalahan saat menyimpan data';
        }
        
        return true; // Successfully inserted
    }
    

    public function select_tahun_jual() {
        $hasil = [];
        $query = $this->db->query("SELECT max(id_penjualan) as id_penjualan FROM penjualan");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function order_done_status($id_penjualan)
    {

        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tgljam =  date("ymdHis");

        $ses_id = $this->session->userdata('ses_id');
        
        $this->db->set('konfirmby', $ses_id);
        $this->db->set('konfirmdate', $tgljam);
        $this->db->set('statusjual', '2');
        $this->db->where('id_penjualan', $id_penjualan);
        $this->db->update('penjualan');
    }

    function del_order_detail_satuan($noid, $tanggal_produksi, $id_penjualan, $jumlah,$kodecabang) {
        // Query to get the maximum quantity for the specified conditions
        $query = $this->db->query("SELECT MAX(jumlah) as jumlah FROM persediaan
            WHERE noid = ? AND tanggal = ? AND kodecabang = ?", [$noid, $tanggal_produksi,$kodecabang]);
        
        // Initialize $jumlahawal with a default value of 0
        $jumlahawal = 0;
    
        if ($query->num_rows() > 0) {
            $data = $query->row();
            $jumlahawal = $data->jumlah;
        }
    
        // Calculate the new quantity
        $jumlahAkhir = $jumlahawal + $jumlah;
    
        // Update the quantity in the persediaan table
        $this->db->set('jumlah', $jumlahAkhir);
        $this->db->where('noid', $noid);
        $this->db->where('tanggal', $tanggal_produksi);
        $this->db->where('kodecabang', $kodecabang);
        $this->db->update('persediaan');
    
        // Delete the order detail from the penjualan table
        $this->db->where('id_penjualan', $id_penjualan);
        $this->db->where('noid', $noid);
        $this->db->where('tanggal_produksi', $tanggal_produksi);
        $this->db->delete('penjualan');
    }


    public function del_order_detail_all($id_penjualan) {
        // Query to get penjualan details for the specified id_penjualan
        $penjualan = $this->db->query("SELECT noid, tanggal_produksi, jumlah, kodecabang FROM penjualan WHERE id_penjualan = ?", [$id_penjualan]);
    
        // Check if there are results for penjualan
        if ($penjualan->num_rows() > 0) {
            $penjualan_data = $penjualan->result();
    
            // Iterate over the penjualan data
            foreach ($penjualan_data as $data) {
                $noid = $data->noid;
                $tanggal_produksi = $data->tanggal_produksi;
                $jumlah_penjualan = $data->jumlah;
                $kodecabang = $data->kodecabang;
    
                // Fetch persediaan data for the same noid and tanggal_produksi
                $persediaan = $this->db->query("SELECT jumlah FROM persediaan WHERE noid = ? AND tanggal = ? AND kodecabang = ?", [$noid, $tanggal_produksi,$kodecabang]);
    
                if ($persediaan->num_rows() > 0) {
                    $persediaan_data = $persediaan->row(); // Use row() for a single result
                    $jumlah_persediaan = $persediaan_data->jumlah;
    
                    // Calculate the new quantity
                    $jumlahAkhir = $jumlah_persediaan + $jumlah_penjualan;
    
                    // Update the quantity in the persediaan table
                    $this->db->set('jumlah', $jumlahAkhir);
                    $this->db->where('noid', $noid);
                    $this->db->where('tanggal', $tanggal_produksi);
                    $this->db->where('kodecabang', $kodecabang);
                    $this->db->update('persediaan');
                }
            }
    
            // Delete the order details from the penjualan table
            $this->db->where('id_penjualan', $id_penjualan);
            $this->db->delete('penjualan');
        } else {
            // Handle the case where no records are found for the given id_penjualan
            return false;
        }
    }


    function get_jualdata($id_penjualan)
    {
        $hasil = [];
        $query = $this->db->query("SELECT id_penjualan, catatan, diskon 
            FROM penjualan 
            WHERE id_penjualan = '".$id_penjualan."'
            GROUP BY id_penjualan, catatan, diskon ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }


    function insert_order_edit($data, $id_jual)
    {
        $this->db->where('id_penjualan', $id_jual);
        $this->db->update('penjualan', $data);
    }
    
    

    
    
}