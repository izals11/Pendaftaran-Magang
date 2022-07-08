<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getPendaftar()
    {
        $query = " SELECT pendaftar.*, pendaftaran.*, kampus.*, project.*
                   FROM pendaftar JOIN pendaftaran
                   ON pendaftar.id = pendaftaran.pendaftar_id
                   JOIN kampus ON pendaftar.kampus_id = kampus.id
                   JOIN project ON pendaftaran.project_id = project.id
                   AND pendaftaran.status = 0";
        return $this->db->query($query)->result_array();
    }

    public function getAllPendaftar()
    {
        $this->db->select('*');
        $this->db->from('pendaftar');
        $this->db->join('pendaftaran', 'pendaftaran.pendaftar_id = pendaftar.id');
        return $this->db->get()->num_rows();
    }

    public function getPendaftarLolos()
    {
        $this->db->select('*');
        $this->db->from('pendaftar');
        $this->db->join('pendaftaran', 'pendaftaran.pendaftar_id = pendaftar.id');
        $this->db->where('status =', 1);
        return $this->db->get()->num_rows();
    }

    public function dataPendaftar()
    {
        $query = " SELECT pendaftar.*, pendaftaran.pendaftar_id, pendaftaran.project_id, pendaftaran.tgl_mulai, 
        pendaftaran.tgl_selesai, pendaftaran.status, kampus.name, project.project
                   FROM pendaftar JOIN pendaftaran
                   ON pendaftar.id = pendaftaran.pendaftar_id
                   JOIN kampus ON pendaftar.kampus_id = kampus.id
                   JOIN project ON pendaftaran.project_id = project.id";
        return $this->db->query($query)->result_array();
    }
}
