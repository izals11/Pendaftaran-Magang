<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auto_model extends CI_Model
{
    public function getDataAutoComplete($autocomplete)
    {
        $this->db->select('*');
        $this->db->from('kampus');
        $this->db->like('name', $autocomplete);
        $this->db->limit(10);
        return $this->db->get()->result_array();
    }
}
