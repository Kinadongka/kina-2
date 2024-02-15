<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_user extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('karyawan_model'); // Make sure the model name is correct
	}

	public function index()
	{
		$data['title'] = 'Karyawan';
		$data['karyawan'] = $this->karyawan_model->get_data('tb_karyawan')->result(); // Update 'pasien' to 'karyawan'
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('karyawan_user', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$data['title'] = 'Tambah Karyawan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tambah_karyawan', $data);
		$this->load->view('templates/footer');
	}
	
	public function tambah_aksi()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->tambah();
		} else {
			$data = array(
				'nama_karyawan' => $this->input->post('nama_karyawan'), // Update 'nama_pasien' to 'nama_karyawan'
				'nomor_telp' => $this->input->post('nomor_telp'), // Add this line for 'nomor_telp'
				'alamat' => $this->input->post('alamat'), // Add this line for 'alamat'
			);
			
			$this->karyawan_model->insert_data($data, 'tb_karyawan');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data Berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button></div>');
			redirect('karyawan'); // Update 'pasien' to 'karyawan'		
		}
	}
	
	public function edit($id_karyawan)
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data = array(
				'nama_karyawan' => $this->input->post('nama_karyawan'),
				'nomor_telp' => $this->input->post('nomor_telp'), // Add this line for 'nomor_telp'
				'alamat' => $this->input->post('alamat'), // Add this line for 'alamat'
			);
			$this->karyawan_model->update_data($id_karyawan, $data, 'tb_karyawan');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data Berhasil Diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button></div>');
			redirect('karyawan');
		}
	}
	
	public function _rules()
	{
		$this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required', array('required' => '%s harus diisi !!!'));
		$this->form_validation->set_rules('nomor_telp', 'Nomor Telp', 'required', array('required' => '%s harus diisi !!!'));
		$this->form_validation->set_rules('alamat', 'Alamat', 'required', array('required' => '%s harus diisi !!!'));
	}
	
	public function delete($id)
	{
		$where = array('id_karyawan' => $id);
		$this->karyawan_model->delete($where, 'tb_karyawan');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Data Berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button></div>');
		redirect('karyawan');
	}
}
