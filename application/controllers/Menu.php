<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		
	}
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('success', 'Menu Baru Telah Berhasil Ditambah!');
            redirect('menu');
        }
    }

    public function edit($menu_id)
    {
        $data['title'] = 'Edit Menu';
        $data['menu'] = $this->db->get_where('user_menu', ['id' => $menu_id])->row_array();

        $this->form_validation->set_rules('edited_menu', 'Edited Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('menu/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $edited_menu = $this->input->post('edited_menu');
            $this->db->where('id', $menu_id);
            $this->db->update('user_menu', ['menu' => $edited_menu]);

            $this->session->set_flashdata('success', 'Menu Berhasil Diupdate!');
            redirect('menu');
        }
    }

    public function delete($menu)
    {
        $where = array('menu' => $menu);
        $this->db->where($where);
        $this->db->delete('user_menu');

        $this->session->set_flashdata('success', 'Menu Berhasil Dihapus!');
        redirect('menu');
    }
    
    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        
        $this->form_validation->set_rules('tittle', 'Tittle', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'tittle' => $this->input->post('tittle'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data SubMenu Baru Berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>');
            redirect('menu/submenu');
        }
		
		
    }
	public function edit_submenu($id)
{
    $this->load->model('Menu_model');

    $data['title'] = 'Edit Submenu';
    $data['submenu'] = $this->Menu_model->getSubMenuById($id);
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->form_validation->set_rules('tittle', 'Tittle', 'required');
    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('url', 'Url', 'required');
    $this->form_validation->set_rules('icon', 'Icon', 'required');

    if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('menu/edit_submenu', $data);
        $this->load->view('templates/footer', $data);
    } else {
        $update_data = [
            'tittle' => $this->input->post('tittle'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];

        $this->Menu_model->updateSubMenu($id, $update_data);

        $this->session->set_flashdata('success', 'SubMenu Berhasil Diubah!');
        redirect('menu/submenu');
    }
}

public function delete_submenu($id)
{
    $this->load->model('Menu_model');

    // Ensure that $id is not empty
    if (!empty($id)) {
        // Your deletion logic here using the model
        $this->Menu_model->deleteSubMenu($id);

        // Optionally, you can set a flash message to indicate successful deletion
        $this->session->set_flashdata('success', 'Submenu deleted successfully');
    }

    // Redirect to the submenu list page
    redirect('menu/submenu');
}



	
}
?>
