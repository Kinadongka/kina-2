<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_user extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('stock_model');
	}

	public function index()
	{
		$data['title'] = 'Stock';
		$data['stock'] = $this->stock_model->get_data('tb_stock')->result(); // Changed 'Stock' to 'stock'
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('stock_user', $data);
		$this->load->view('templates/footer');
	}

	public function add()
	{
		$data['title'] = 'Tambah Stock';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tambah_stock', $data);
		$this->load->view('templates/footer');
	}
	
	public function create()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->add();
		} else {
			$data = array(
				'nama_stock' => $this->input->post('nama_stock'),
				'jumlah_stock' => $this->input->post('jumlah_stock'),
				'tanggal_masuk' => $this->input->post('tanggal_masuk'),
			);
			
			$this->stock_model->insert_data($data, 'tb_stock'); // Changed 'dokter_model' to 'stock_model'
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data Berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button></div>');
			redirect('stock');			
		}
	}
	
	public function edit($id_stock)
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data = array(
				'nama_stock' => $this->input->post('nama_stock'),
				'jumlah_stock' => $this->input->post('jumlah_stock'),
				'tanggal_masuk' => $this->input->post('tanggal_masuk'),
			);
			$this->stock_model->update_data($id_stock, $data, 'tb_stock'); // Changed 'dokter_model' to 'stock_model'
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data Berhasil Diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button></div>');
			redirect('stock');
		}
	}
	
	public function _rules()
	{
		$this->form_validation->set_rules('nama_stock', 'Nama Stock', 'required', array('required' => '%s harus diisi !!!'));
		$this->form_validation->set_rules('jumlah_stock', 'Jumlah Stock', 'required|numeric', array('required' => '%s harus diisi !!!', 'numeric' => '%s harus berupa angka !!!'));
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|numeric', array('required' => '%s harus diisi !!!', 'numeric' => '%s harus berupa angka !!!'));
	}
	
	public function delete($id)
	{
		$where = array('id_stock' => $id); // Changed 'id_dokter' to 'id_stock'
		$this->stock_model->delete($where, 'tb_stock'); // Changed 'dokter_model' to 'stock_model'
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Data Berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button></div>');
		redirect('stock');
	}
}
