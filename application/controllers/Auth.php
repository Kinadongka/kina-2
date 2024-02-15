<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('Captcha_lib');
    }

    public function index()
    {
        if($this->session->userdata('email')) {
            redirect('user');
        }

        // Validation rules for login form
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_check_captcha'); // Tambahkan validasi captcha

        if ($this->form_validation->run() == false) {
            // Validation failed, load the login view
            $data['title'] = 'Login Page';
            $data['captcha'] = $this->captcha_lib->generateCaptcha(); // Tambahkan captcha ke data
            $this->load->view('auth/login', $data);
        } else {
            // Validation successful, proceed with login
            $this->_login();
        }
    }

    public function check_captcha($str)
    {
        // Validate Captcha
        return $this->captcha_lib->validateCaptcha($str);
    }
    
    private function _login()
    {
        $email = trim($this->input->post('email'));
        $password = trim($this->input->post('password'));

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if ($user['is_active'] == 1 && $password == $user['password']) {
                // Password cocok
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if($user['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('user');
                }
            } else {
                // Password tidak cocok
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Belum Di Aktifasi atau Password Salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Belum Di Registrasi!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if($this->session->userdata('email')) {
            redirect('user');
        }

        // Validation rules for registration form
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|max_length[255]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|trim|min_length[8]');

        if ($this->form_validation->run() == false) {
            // Validation failed, load the registration view
            $this->load->view('auth/registration');
        } else {
            // Validation successful, insert user data into the database
            $data = [
                'full_name' => htmlspecialchars($this->input->post('full_name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => $this->input->post('password1'), // Store plaintext password
                'role_id' => 2,
                'is_active' => 1,  // Set akun menjadi tidak aktif sampai diaktivasi
                'date_created' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('user', $data);

            // Kirim email aktivasi ke pengguna (tambahkan fungsi ini sesuai kebutuhan)

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registrasi berhasil! Silahkan cek email untuk aktivasi akun.</div>');
            redirect('auth');
        }
    }

    public function lupa_password()
    {
        $this->load->view('auth/lupa_password');
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil logout.</div>');
        redirect('auth');
    }
    
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
?>
