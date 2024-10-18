<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_mod extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
        
    public function save_produksi_batch($data) {
        // Start transaction
        $this->db->trans_begin();
    
        foreach ($data as $item) {
            // Check if record already exists
            $this->db->where('noid', $item['noid']);
            $this->db->where('tanggal', $item['tanggal']);
            $query = $this->db->get('produksi');
    
            if ($query->num_rows() > 0) {
                $this->db->trans_rollback();
                return false; // Indicate failure
            }
            else{
                $this->db->insert('produksi', $item);
            }
        }
        // Commit transaction if no errors
        $this->db->trans_commit();
        return true;
    }



    function getcabang()
    {
        $hasil = [];
        $query = $this->db->query("SELECT 
            *
            FROM kantor_cabang
        ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function getcabang_not($cabang)
    {
        $hasil = [];
        $query = $this->db->query("SELECT 
            *
            FROM kantor_cabang where kodecabang <> '".$cabang."'
        ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function delete_produksi($noid, $tanggal) {
        $this->db->where('noid', $noid);
        $this->db->where('tanggal', $tanggal);
        return $this->db->delete('produksi'); // Replace 'your_table_name' with the actual table name
    }

    public function save_persediaan($data) {
        return $this->db->insert_batch('persediaan', $data);
    }

    public function save_dist($data) {
        return $this->db->insert_batch('distribusi', $data);
    }

    public function getdata_akan_didist()
    {
    // Step 1: Get distinct kodecabang values from Table C
    $this->db->select('kodecabang');
    $query = $this->db->get('kantor_cabang');
    $kodecabangList = $query->result_array();
    // var_dump ($kodecabangList);die();

    // Step 2: Build dynamic CASE statements for pivot columns
    $pivotColumns = [];
    $sisaCalculation = [];
    $jualCalculation = [];
    $distCalculation = [];
    $perCalculation = [];

    foreach ($kodecabangList as $row) {
        $kodecabang = $row['kodecabang'];
        $kodecabang2 = "stock".$row['kodecabang'];
        $pivotColumns[] = "MAX(CASE WHEN c.kodecabang = '$kodecabang' THEN c.jumlah ELSE 0 END) AS `$kodecabang`";
        $sisaCalculation[] = "COALESCE(MAX(CASE WHEN c.kodecabang = '$kodecabang' THEN c.jumlah ELSE 0 END), 0)";
        $jualCalculation[] = "COALESCE(SUM(CASE WHEN d.kodecabang = '$kodecabang' THEN d.jumlah ELSE 0 END), 0)";
        $distCalculation[] = "COALESCE(MAX(CASE WHEN e.kodecabang = '$kodecabang' THEN e.jumlah ELSE 0 END), 0)";
        $perCalculation[] = "SUM(CASE WHEN f.kodecabang = '$kodecabang' THEN f.jumlah ELSE 0 END) AS `$kodecabang2`";
    }
    
    $pivotSQL = implode(", ", $pivotColumns);
    $sisaSQL = implode(" + ", $sisaCalculation);
    $jualSQL = implode(" + ", $jualCalculation);
    $distSQL = implode(" + ", $distCalculation);
    $perSQL = implode(" , ", $perCalculation);

    // Construct the SQL query
    $sql = "SELECT * FROM 
    (
        SELECT 
                b.noid,
                b.norut,
                b.namamenu,
                b.harga,
                a.tanggal,
                a.kadarluasa,
                a.jumlah,
                $perSQL,
                $pivotSQL,
                (a.jumlah - (ABS($sisaSQL) + ABS($jualSQL) + ABS($distSQL))) AS sisa
            FROM menu_utama b 
            LEFT JOIN produksi a ON a.noid = b.noid 
            LEFT JOIN persediaan c ON a.noid = c.noid AND a.tanggal = c.tanggal
            LEFT JOIN persediaan f ON a.noid = f.noid
            LEFT JOIN penjualan d ON a.noid = d.noid AND a.tanggal = d.tanggal_produksi
            LEFT JOIN distribusi e ON a.noid = e.noid AND a.tanggal = e.tanggal AND e.stat_dist = '1'
            GROUP BY 
                b.noid, 
                b.norut, 
                b.namamenu, 
                b.harga, 
                a.tanggal, 
                a.kadarluasa, 
                a.jumlah
    ) ss 
    WHERE ss.sisa > 0 
    ORDER BY 
    ss.norut, 
    ss.tanggal ASC";

    // Execute the query
    // echo $sql;
    // die();
    $query2 = $this->db->query($sql);

    if ($query2->num_rows() > 0) {
        $hasil = [];
        foreach ($query2->result() as $data) {
            $hasil[] = $data;
        }
        return $hasil;
    }
}



    public function getDynamicPivotData()
    {
        // Step 1: Get distinct kodecabang values from Table C
        $this->db->select('kodecabang');
        $query = $this->db->get('kantor_cabang');
        $kodecabangList = $query->result_array();

        // Step 2: Build dynamic CASE statements for pivot columns
        $pivotColumns = [];
        $sisaCalculation = [];

        foreach ($kodecabangList as $row) {
            $kodecabang = $row['kodecabang'];
            $pivotColumns[] = "MAX(CASE WHEN c.kodecabang = '$kodecabang' THEN c.jumlah ELSE 0 END) AS `$kodecabang`";
            $sisaCalculation[] = "COALESCE(MAX(CASE WHEN c.kodecabang = '$kodecabang' THEN c.jumlah ELSE 0 END), 0)";
        }
        
        $pivotSQL = implode(", ", $pivotColumns);
        $sisaSQL = implode(" - ", $sisaCalculation);

        // Construct the SQL query
        $sql = "SELECT 
                    b.noid,
                    b.norut,
                    b.namamenu,
                    b.harga,
                    a.tanggal AS tanggal_produksi,
                    a.kadarluasa,
                    a.jumlah,
                    $pivotSQL,
                    (a.jumlah - ($sisaSQL)) AS sisa
                FROM menu_utama b 
                LEFT JOIN produksi a ON a.noid = b.noid 
                LEFT JOIN persediaan c ON a.noid = c.noid AND a.tanggal = c.tanggal
                GROUP BY 
                    b.noid, 
                    b.norut, 
                    b.namamenu, 
                    b.harga, 
                    a.tanggal, 
                    a.kadarluasa, 
                    a.jumlah
                ORDER BY 
                    b.norut, 
                    a.tanggal ASC";

        // Execute the query
        $query = $this->db->query($sql);

        // Fetch and return the results
        $results = $query->result_array();
        return $results;
    }

    public function get_max_id_dist() {
        $this->db->select_max('iddist');
        $query = $this->db->get('distribusi');
        return $query->row()->iddist;
    }

    function get_dist($cabang)
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
            INNER JOIN distribusi b ON a.noid = b.noid AND b.jumlah > 0
            AND b.kodecabang = '".$cabang."' AND b.tglditerima IS NULL
            ORDER BY norut ASC
        ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }


    function insertall_persediaan($kdcabang)
    {
        $this->db->query("INSERT INTO persediaan SELECT * FROM distribusi WHERE stat_dist = '1' AND kodecabang = '".$kdcabang."' ");
    }

    function update_distribusi($kdcabang)
    {
        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tgljam =  date("ymdHis");

        $userid = $this->session->userdata('ses_id');

        $this->db->set('tglditerima', $tgljam);
        $this->db->set('userterima', $userid);
        $this->db->set('stat_dist', '2');
        $this->db->where('kodecabang', $kdcabang);
        $this->db->update('distribusi');
    }

    function update_persediaan_stat($kdcabang)
    {
        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tgljam =  date("ymdHis");

        $userid = $this->session->userdata('ses_id');

        $this->db->set('tglditerima', $tgljam);
        $this->db->set('userterima', $userid);
        $this->db->set('stat_dist', '2');
        $this->db->where('kodecabang', $kdcabang);
        $this->db->update('persediaan');
    }

    
    
}