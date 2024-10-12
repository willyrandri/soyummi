<?php
class Logincon extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Loginmod', "lg");
    }

    public function index()
    {
        $this->load->view('template/loginpages');
    }

    function auth_login()
    {
 
        
        $timezone = "Asia/Jakarta";
		if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

    
        $current_time = time();

        if (isset($_POST)) {
            $username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
            $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);
        
            // Check if username and password are not empty
            if (!empty($username) && !empty($password)) {
                // Hash the password using MD5
                $hashed_password = md5($password);
        
                $cek_login = $this->lg->auth_user($username, $hashed_password);
        
                if ($cek_login->num_rows() > 0) {
                    $data = $cek_login->row_array();
        
                    if (strtolower($data['stat']) == '1') {
                        // Set login timestamp in the session
                        $this->session->set_userdata('login_timestamp', time());
        
                        $this->session->set_userdata('masuk', TRUE);
                        $this->session->set_userdata('stat', strtolower($data['stat']));
                        $this->session->set_userdata('ses_id', $data['nik']);
                        $this->session->set_userdata('ses_nama', $data['nama']);
                        $this->session->set_userdata('ses_cab', $data['kodecabang']);
                        $this->session->set_userdata('ses_akses', $data['akses']);
                        $this->lg->update_lastlogin($username);
        
                        if ($data['akses'] == '1') {
                            redirect(base_url());
                        } else {
                            redirect('Persediaan/orderaktiv');
                        }
                    } else {
                        echo $this->session->set_flashdata('msg', 'Akun Anda Tidak Aktif');
                        redirect('logincon/index');
                    }
                } else {
                    echo $this->session->set_flashdata('msg', 'Username Atau Password Salah');
                    redirect('logincon/index');
                }
            } else {
                echo $this->session->set_flashdata('msg', 'Username dan Password harus diisi');
                redirect('logincon/index');
            }
        } else {
            redirect('logincon/index');
        }
        
        
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('logincon/index');
    }
}
