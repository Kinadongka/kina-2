<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }
	
     public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        
        $this->form_validation->set_rules('role', 'Role', 'required');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/role', $data); // Ubah view ke 'role/index'
            $this->load->view('templates/footer', $data);
        } else {
            $role = $this->input->post('role');

            // Tambah role
            $this->db->insert('user_role', ['role' => $role]);
            $this->session->set_flashdata('success', 'Role Baru Telah Berhasil Ditambah!');
            redirect('admin/role'); // Ubah redirect URL ke 'admin/role'
        }
    }

    public function edit_role($id)
    {
        $data['title'] = 'Edit Role';
        $data['role'] = $this->db->get_where('user_role', ['id' => $id])->row_array();

        $this->form_validation->set_rules('edited_role', 'Edited Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('role/edit', $data); // Ubah view ke 'role/edit'
            $this->load->view('templates/footer', $data);
        } else {
            $edited_role = $this->input->post('edited_role');

            // Update role
            $this->db->where('id', $id);
            $this->db->update('user_role', ['role' => $edited_role]);
            
            $this->session->set_flashdata('success', 'Role Berhasil Diupdate!');
            redirect('admin/role'); // Ubah redirect URL ke 'admin/role'
        }
    }

    public function delete_role($id)
    {
        // Hapus role
        $this->db->where('id', $id);
        $this->db->delete('user_role');
        
        $this->session->set_flashdata('success', 'Role Berhasil Dihapus!');
        redirect('admin/role'); // Ubah redirect URL ke 'admin/role'
    }
	
	public function roleAccess($role_id)
{
    $data['title'] = 'Role Access';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
	
    $this->db->where('id !=', 1);
    $data['menu'] = $this->db->get('user_menu')->result_array(); // Tambah tanda titik koma (;) di sini

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('admin/role-access', $data);
    $this->load->view('templates/footer', $data);
}

	public function changeaccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');
		
		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];
		
		$result = $this->db->get_where('user_access_menu', $data);
		
		if($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
			
		} else {
			$this->db->delete('user_access_menu', $data);
		}
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Telah Di Ubah!</div>');
	}
	
}
?>
