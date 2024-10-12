<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biaya_mod extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getdata_biaya()
    {
        $hasil = [];
        $query = $this->db->query("SELECT * FROM biaya_op");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function selectmaxnoid()
    {

        $query = $this->db->query("SELECT max(noid) as noid FROM biaya_op");
        
            
        if ($query->num_rows() > 0) {
            $data = $query->row();
            $newid = $data->noid;
        }
        
        return $newid;
    }

    function insertdata_biaya($data)
    {
        $berhasil = $this->db->insert('biaya_op', $data);
        return $berhasil;
    }

    function delete_biaya($noid)
    {
        $this->db->where('noid', $noid);
        $this->db->delete('biaya_op');
    }
 

    public function getdata_dashboard()
    {
        $timezone = "Asia/Jakarta";
        if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
        $tanggalnow = date('Y-m-d');

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
                tanggal_jual = '".$tanggalnow."' 
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


    public function getdata_dashboard_bul()
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
                YEAR(tanggal_jual) = '".$tahun."' 
                AND MONTH(tanggal_jual) = '".$bulan."' 
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



    function persediaan_dash(){
        $akses = $this->session->userdata('ses_akses');
        if ($akses == 1){
            $query = $this->db->query(" SELECT sum(jumlah) as jml FROM persediaan ");
        }
        else {
            $cab = $this->session->userdata('ses_cab');
            $query = $this->db->query("SELECT sum(jumlah) as jml FROM persediaan WHERE kodecabang = '".$cab."' ");
        }
        
        $hasil = $query->row()->jml;
        return $hasil;
    }

    function penjualan_dash(){

        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggalnow = date('Y-m-d');

        $akses = $this->session->userdata('ses_akses');
        if ($akses == 1){
            $query = $this->db->query(" SELECT sum(jumlah) as jml FROM penjualan WHERE tanggal_jual = '".$tanggalnow."' ");
        }
        else {
            $cab = $this->session->userdata('ses_cab');
            $query = $this->db->query("SELECT sum(jumlah) as jml FROM penjualan WHERE kodecabang = '".$cab."' AND tanggal_jual = '".$tanggalnow."' ");
        }
        
        $hasil = $query->row()->jml;
        return $hasil;
    }

    function penjualan_dash_bul(){

        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggalnow = date('Y-m-d');
		$tahun = date('Y');
		$mon = date('m');

        $akses = $this->session->userdata('ses_akses');
        if ($akses == 1){
            $query = $this->db->query(" SELECT sum(jumlah) as jml FROM penjualan WHERE YEAR(tanggal_jual) = '".$tahun."' AND MONTH(tanggal_jual) = '".$mon."' ");
        }
        else {
            $cab = $this->session->userdata('ses_cab');
            $query = $this->db->query("SELECT sum(jumlah) as jml FROM penjualan WHERE kodecabang = '".$cab."' AND YEAR(tanggal_jual) = '".$tahun."' AND MONTH(tanggal_jual) = '".$mon."' ");
        }
        
        $hasil = $query->row()->jml;
        return $hasil;
    }

    function penjualan_dash_nom(){

        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggalnow = date('Y-m-d');

        $akses = $this->session->userdata('ses_akses');
        if ($akses == 1){
            $query = $this->db->query(" SELECT sum(totalharga) as jml FROM penjualan WHERE tanggal_jual = '".$tanggalnow."' ");
        }
        else {
            $cab = $this->session->userdata('ses_cab');
            $query = $this->db->query("SELECT sum(totalharga) as jml FROM penjualan WHERE kodecabang = '".$cab."' AND tanggal_jual = '".$tanggalnow."' ");
        }
        
        $hasil = $query->row()->jml;
        return $hasil;
    }

    function penjualan_dash_nom_bul(){

        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggalnow = date('Y-m-d');
		$tahun = date('Y');
		$mon = date('m');

        $akses = $this->session->userdata('ses_akses');
        if ($akses == 1){
            $query = $this->db->query(" SELECT sum(totalharga) as jml FROM penjualan WHERE YEAR(tanggal_jual) = '".$tahun."' AND MONTH(tanggal_jual) = '".$mon."' ");
        }
        else {
            $cab = $this->session->userdata('ses_cab');
            $query = $this->db->query("SELECT sum(totalharga) as jml FROM penjualan WHERE kodecabang = '".$cab."' AND YEAR(tanggal_jual) = '".$tahun."' AND MONTH(tanggal_jual) = '".$mon."' ");
        }
        
        $hasil = $query->row()->jml;
        return $hasil;
    }

    
    function penjualan_dash_tunai(){

        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggalnow = date('Y-m-d');

        $akses = $this->session->userdata('ses_akses');
        if ($akses == 1){
            $query = $this->db->query(" SELECT sum(totalharga) as jml FROM penjualan WHERE tanggal_jual = '".$tanggalnow."' AND carabayar='tunai' ");
        }
        else {
            $cab = $this->session->userdata('ses_cab');
            $query = $this->db->query("SELECT sum(totalharga) as jml FROM penjualan WHERE kodecabang = '".$cab."' AND tanggal_jual = '".$tanggalnow."' AND carabayar='tunai' ");
        }
        
        $hasil = $query->row()->jml;
        return $hasil;
    }

    
    function penjualan_dash_nontunai(){

        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggalnow = date('Y-m-d');

        $akses = $this->session->userdata('ses_akses');
        if ($akses == 1){
            $query = $this->db->query(" SELECT sum(totalharga) as jml FROM penjualan WHERE tanggal_jual = '".$tanggalnow."' AND carabayar='nonTunai' ");
        }
        else {
            $cab = $this->session->userdata('ses_cab');
            $query = $this->db->query("SELECT sum(totalharga) as jml FROM penjualan WHERE kodecabang = '".$cab."' AND tanggal_jual = '".$tanggalnow."' AND carabayar='nonTunai' ");
        }
        
        $hasil = $query->row()->jml;
        return $hasil;
    }

    function get_total_biaya()
    {
        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$tanggalnow = date('Y-m-d');
		$tahun = date('Y');
		$mon = date('m');

        
            $query = $this->db->query("SELECT sum(nominal) as jml FROM biaya_op WHERE YEAR(updatemod) = '".$tahun."' AND MONTH(updatemod) = '".$mon."' ");
        
        
        $hasil = $query->row()->jml;
        return $hasil;
    }




    

}