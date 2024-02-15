<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('harga_model');
	}

	public function index()
	{
		$data['title'] = 'Harga';
		$data['harga'] = $this->harga_model->get_data('tb_harga')->result();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('harga', $data);
		$this->load->view('templates/footer');
	}

	public function plus()
	{
		$data['title'] = 'Tambah Harga';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tambah_harga', $data); // Corrected view name
		$this->load->view('templates/footer');
	}
	
	public function buat()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->plus();
		} else {
			$data = array(
				'harga' => $this->input->post('harga'),
				'jenis_bahan' => $this->input->post('jenis_bahan'),
			);
			
			$this->harga_model->insert_data($data, 'tb_harga');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data Berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button></div>');
			redirect('harga');			
		}
	}
	
	public function edit($id_harga)
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data = array(
				'harga' => $this->input->post('harga'),
				'jenis_bahan' => $this->input->post('jenis_bahan'), // Corrected input name
			);
			$this->harga_model->update_data($id_harga, $data, 'tb_harga'); // Corrected model and table name
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data Berhasil Diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button></div>');
			redirect('harga');
		}
	}
	
	public function _rules()
	{
		$this->form_validation->set_rules('harga', 'Harga', 'required', array('required' => '%s harus diisi !!!'));
	}
	
	public function delete($id)
	{
		$where = array('id_harga' => $id); // Corrected column name
		$this->harga_model->delete($where, 'tb_harga');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Data Berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button></div>');
		redirect('harga');
	}
}
