<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_mod extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getdata_penjualan($startDate, $endDate)
    {
        $hasil = [];
        $query = $this->db->query("SELECT a.*,b.namamenu FROM penjualan a
        LEFT JOIN menu_utama b ON a.noid = b.noid
        WHERE a.tanggal_jual BETWEEN '".$startDate."' AND '".$endDate."' 
        ORDER BY a.tanggal_jual DESC
        ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function getdata_produksi($startDate, $endDate)
    {
        $hasil = [];
        $query = $this->db->query("SELECT a.*,b.namamenu FROM produksi a
        LEFT JOIN menu_utama b ON a.noid = b.noid
        WHERE a.tanggal BETWEEN '".$startDate."' AND '".$endDate."' 
        ORDER BY a.tanggal DESC
        ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function getdata_distribusi($startDate, $endDate)
    {
        $hasil = [];
        $query = $this->db->query("SELECT a.*,b.namamenu FROM distribusi a
        LEFT JOIN menu_utama b ON a.noid = b.noid
        WHERE a.tanggal BETWEEN '".$startDate."' AND '".$endDate."' 
        ORDER BY a.tanggal DESC
        ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function getdata_persediaan_history($startDate, $endDate)
    {
        $hasil = [];
        $query = $this->db->query("SELECT a.*,b.namamenu FROM persediaan_history a
        LEFT JOIN menu_utama b ON a.noid = b.noid
        WHERE a.tanggal BETWEEN '".$startDate."' AND '".$endDate."' 
        ORDER BY a.tanggal DESC
        ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function get_lap_keu()
    {
        
        $hasil = [];

        $query = $this->db->query("SELECT * FROM view_lap_keuangan");
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function getdata_totaljual($startDate, $endDate)
    {
        $timezone = "Asia/Jakarta";
        if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
        $tanggalnow = date('Y-m-d');
        $tahun = date('Y');
        $bulan = date('m');

        // Step 1: Get distinct kodecabang values from Table C
        $this->db->select('kodecabang');
        $query = $this->db->get('kantor_cabang');
        $kodecabangList = $query->result_array();

        // Step 2: Build dynamic CASE statements for pivot columns
        
        $penjualanPivot = [];

        foreach ($kodecabangList as $row) {
            $kodecabang = $row['kodecabang'];
            
            $penjualanPivot[] = "COALESCE(j.penjualan_$kodecabang, 0) AS penjualan_$kodecabang";
        }

        $penjualanSQL = implode(", ", $penjualanPivot);

        // Construct the SQL query
        $sql = "SELECT 
            b.noid, 
            b.norut, 
            b.namamenu, 
            b.harga, 
            a.tanggal, 
            a.kadarluasa,
            SUM(a.jumlah) AS jumlah,
            COALESCE(p.Arifin, 0) AS Arifin,
            COALESCE(p.IntanPayung, 0) AS IntanPayung,
            ABS(COALESCE(p.Arifin, 0) + COALESCE(p.IntanPayung, 0)) AS sisa,
            $penjualanSQL
            ,ABS(COALESCE(j.penjualan_Arifin, 0) + COALESCE(j.penjualan_IntanPayung, 0)) AS jual
        FROM 
            menu_utama b 
        LEFT JOIN 
            produksi a ON a.noid = b.noid 
        LEFT JOIN (
            SELECT 
                noid, 
                tanggal, 
                SUM(CASE WHEN kodecabang = 'Arifin' THEN jumlah ELSE 0 END) AS Arifin, 
                SUM(CASE WHEN kodecabang = 'IntanPayung' THEN jumlah ELSE 0 END) AS IntanPayung 
            FROM 
                persediaan 
            GROUP BY 
                noid, tanggal
        ) p ON a.noid = p.noid AND a.tanggal = p.tanggal
        LEFT JOIN (
            SELECT 
                noid, 
                tanggal_produksi, 
                SUM(CASE WHEN kodecabang = 'Arifin' THEN jumlah ELSE 0 END) AS penjualan_Arifin, 
                SUM(CASE WHEN kodecabang = 'IntanPayung' THEN jumlah ELSE 0 END) AS penjualan_IntanPayung 
            FROM 
                penjualan 
            WHERE 
                tanggal_jual BETWEEN '".$startDate."' 
                AND '".$endDate."' 
            GROUP BY 
                noid, tanggal_produksi
        ) j ON a.noid = j.noid AND a.tanggal = j.tanggal_produksi
        GROUP BY 
            b.noid, b.norut, b.namamenu, b.harga, a.tanggal, a.kadarluasa
        ORDER BY 
            b.norut, a.tanggal ASC;
        ";

        // Execute the query
        $query2 = $this->db->query($sql);

        if ($query2->num_rows() > 0) {
            foreach ($query2->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }

        return []; // Return an empty array if no results
    }

    function getdata_biaya_date($startDate, $endDate)
    {
        $hasil = [];
        $query = $this->db->query("SELECT * FROM biaya_op WHERE updatemod BETWEEN '".$startDate."' AND '".$endDate."' ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

   

}