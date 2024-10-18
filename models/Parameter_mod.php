<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parameter_mod extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getdata_user()
    {
        $ses_id = $this->session->userdata('ses_id');

        $query = $this->db->query("SELECT 
        a.nik
        ,a.nama
        ,b.level_desc as akses
        ,a.lastlogin
        ,c.namacabang as cab
        FROM users a
        LEFT JOIN users_role b ON a.akses = b.`level`
        LEFT JOIN kantor_cabang c ON a.kodecabang = c.`kodecabang`
        WHERE a.nik <> '".$ses_id."'
        ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function getdata_menu()
    {
        $ses_id = $this->session->userdata('ses_id');
        $hasil = [];
        $query = $this->db->query("SELECT 
        *
        FROM menu_utama
        ORDER BY norut ASC
        ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    
    function getdata_menu_aktiv()
    {
        $ses_id = $this->session->userdata('ses_id');
        $hasil = [];
        $query = $this->db->query("SELECT 
        *
        FROM menu_utama WHERE stat = '1'
        ORDER BY norut ASC
        ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function getdata_cabang()
    {
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
    
    function delete_users($nik)
    {
        $this->db->where('nik', $nik);
        $this->db->delete('users');
    }

    function delete_cabang($kodecabang)
    {
        $this->db->where('kodecabang', $kodecabang);
        $this->db->delete('kantor_cabang');
    }

    function select_akses()
    {
        $hasil =[];
        $query = $this->db->query("SELECT * FROM users_role");
        foreach ($query->result() as $row) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function select_cabang()
    {
        $hasil =[];
        $query = $this->db->query("SELECT * FROM kantor_cabang ORDER BY kodecabang ASC");
        foreach ($query->result() as $row) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function select_cabang_edit($kodecabang)
    {
        $query = $this->db->query("SELECT 
        *
        FROM kantor_cabang
        WHERE kodecabang = '".$kodecabang."'
        ");
        foreach ($query->result() as $row) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function select_menu_edit($noid)
    {
        $hasil=[];
        $query = $this->db->query("SELECT 
        *
        FROM menu_utama
        WHERE noid = '".$noid."'
        ");
        foreach ($query->result() as $row) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function insertdata_user($data)
    {
        $berhasil = $this->db->insert('users', $data);
        return $berhasil;
    }

    function insertdata_cabang($data)
    {
        // var_dump($data);DIE();
        $berhasil = $this->db->insert('kantor_cabang', $data);
        return $berhasil;
    }


    function insertdata_menu($data)
    {
        // var_dump($data);DIE();
        $berhasil = $this->db->insert('menu_utama', $data);
        return $berhasil;
    }

    function edit_user_get($nik)
    {
        $query = $this->db->query("SELECT * FROM users WHERE nik ='".$nik."' ");
        foreach ($query->result() as $row) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function udpate_user($data, $nik)
    {
        $this->db->where('nik', $nik);
        $this->db->update('users', $data);
    }
    
    function udpate_cabang($data, $nik)
    {
        $this->db->where('kodecabang', $nik);
        $this->db->update('kantor_cabang', $data);
    }

    function udpate_menu($data, $nik)
    {
        $this->db->where('noid', $nik);
        $this->db->update('menu_utama', $data);
    }

    function update_stat_menu1($noid)
    {
        $this->db->set('stat', '1');
        $this->db->where('noid', $noid);
        $this->db->update('menu_utama');
    }

    function update_stat_menu2($noid)
    {
        $this->db->set('stat', '2');
        $this->db->where('noid', $noid);
        $this->db->update('menu_utama');
    }

    function change_passwd_user($datapass, $nik)
    {
        $this->db->set('passwd', $datapass);
        $this->db->where('nik', $nik);
        $this->db->update('users');
    }

}