<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
    }
    
    public function index()
    {
        $data['title'] = 'My Profile'; 
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer', $data);
    }
    
    public function edit()
    {
        $data['title'] = 'Edit Profile'; 
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $full_name = $this->input->post('full_name');
            $email = $this->session->userdata('email');
            
            // cek jika ada gambar yang diupload
            $upload_image = $_FILES['image']['name'];
            
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '4000';
                $config['upload_path'] = 'assets/Profile/';
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'admin.jpg' && $old_image != 'user.jpg') {
                        unlink(FCPATH . 'assets/Profile/' . $old_image);
                    }
                    
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
                    redirect('user/edit');
                }
            }
            
            $this->db->set('full_name', $full_name);
            $this->db->where('email', $email);
            $this->db->update('user');
            
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun Telah Berhasil Di Edit.</div>');
            redirect('user');
        }
    }
    
    public function changepassword()
    {
        $data['title'] = 'Change Password'; 
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[8]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[8]|matches[new_password1]');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if ($current_password == $new_password) {

            } else {
                $this->db->set('password', $new_password);
                $this->db->where('email', $this->session->userdata('email'));
                $this->db->update('user');
				
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Telah Berhasil Diganti!</div>');
                redirect('user/changepassword');
                
            }

        }
		
    }
	
}
