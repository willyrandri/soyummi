<?php
class Loginmod extends CI_Model{

    function auth_user($username, $hashed_password){
        $query=$this->db->query("SELECT * FROM users WHERE nik='$username' and passwd = '$hashed_password' ");
        // var_dump($this->db->last_query());
        // die();
        return $query;
    }
    
    function jamlogin(){
        $query=$this->db->query("SELECT * FROM jam_login WHERE noid='jam' ");
        // var_dump($this->db->last_query());
        // die();
        $hasil = $query->row();
        return $hasil;
    }

    function get_profile($nik){
        $query=$this->db->query("SELECT * FROM users WHERE NIK='$nik'");
        return $query;
    }
    function ganti_pass($nik, $password){
    	$query=$this->db->query("UPDATE users SET passwd = MD5('$password') WHERE NIK = $nik");
    	return $query;
    }
    function reset_pass($nik){
        $password = '123456';
        $query=$this->db->query("UPDATE users SET passwd = MD5('$password') WHERE NIK = $nik");
        return $query;
    }
    function update_lastlogin($nik){
        $tz_object = new DateTimeZone('Asia/Jakarta');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        $this->db->set('lastlogin', $datetime->format('Y\-m\-d\ h:i:s'));
        $this->db->where('NIK', $nik);
        $this->db->update('users');
    }

}
