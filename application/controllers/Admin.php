<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // Data Tabel Pendaftar
        $data['pendaftar'] = $this->User_model->getPendaftar();

        // Data Jumlah Pendaftar masuk
        $data['all_pendaftar'] = $this->User_model->getAllPendaftar();

        // Data Jumlah Pendaftar lolos
        $data['pendaftar_lolos'] = $this->User_model->getPendaftarLolos();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_admin', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }


    public function data_pendaftaran()
    {
        $data['title'] = 'Data Pendaftaran';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // Data Tabel Pendaftar
        $data['pendaftar'] = $this->User_model->dataPendaftar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_admin', $data);
        $this->load->view('admin/data_pendaftaran', $data);
        $this->load->view('templates/footer');
    }


    public function detail_pendaftar($id)
    {
        $data['title'] = 'Detail Pendaftaran';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $id_pendaftar = $id;

        // Detail Pendaftar
        $this->db->select('pendaftar.*, kampus.name as kampus');
        $this->db->from('pendaftar');
        $this->db->join('kampus', 'kampus.id = pendaftar.kampus_id');
        $this->db->where('pendaftar.id =', $id_pendaftar);
        $data['pendaftar'] = $this->db->get()->row_array();

        // Detail Pendaftaran
        $this->db->select('pendaftaran.*, project.project');
        $this->db->from('pendaftaran');
        $this->db->join('project', 'project.id = pendaftaran.project_id');
        $this->db->where('pendaftar_id =', $id_pendaftar);
        $data['pendaftaran'] = $this->db->get()->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_admin', $data);
        $this->load->view('admin/detail_pendaftar', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {

        $status  = $this->input->post('status');
        $id  = $this->input->post('id');

        $this->db->set('status', $status);
        $this->db->where('id', $id);
        $this->db->update('pendaftaran');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Status Berhasil Diubah
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('admin/data_pendaftaran');
    }


    public function data_project()
    {
        $data['title'] = 'Data Project';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();

        $this->db->select('project.*, kategori.name as kategori');
        $this->db->from('project');
        $this->db->join('kategori', 'kategori.id = project.kategori_id');
        $data['project'] = $this->db->get()->result_array();

        $this->form_validation->set_rules('project', 'project', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar_admin', $data);
            $this->load->view('admin/data_project', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'project' => $this->input->post('project'),
                'kategori_id' => $this->input->post('kategori_id'),
            ];

            $this->db->insert('project', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Project baru  berhasil ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('admin/data_project');
        }
    }
}
