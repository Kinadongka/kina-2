<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model_user extends CI_Model {

    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data, $table)
    {
        try {
            $this->db->insert($table, $data);
            return true; // Return true on successful insertion
        } catch (Exception $e) {
            log_message('error', 'Error inserting data: ' . $e->getMessage());
            return false; // Return false on failure
        }
    }

    public function update_data($id_stock, $data, $table)
    {
        try {
            $this->db->where('id_stock', $id_stock);
            $this->db->update($table, $data);
            return true; // Return true on successful update
        } catch (Exception $e) {
            log_message('error', 'Error updating data: ' . $e->getMessage());
            return false; // Return false on failure
        }
    }

    public function delete($where, $table)
    {
        try {
            $this->db->where($where);
            $this->db->delete($table);
            return true; // Return true on successful deletion
        } catch (Exception $e) {
            log_message('error', 'Error deleting data: ' . $e->getMessage());
            return false; // Return false on failure
        }
    }

}
