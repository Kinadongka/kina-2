<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga_model_user extends CI_Model {

    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update_data($id_harga, $data, $table)
    {
        $this->db->where('id_harga', $id_harga);
        $this->db->update($table, $data);
    }
	
	public function delete($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

}
