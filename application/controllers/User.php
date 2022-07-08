<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $user_id = $data['user']['id'];

        // Data Pendaftar
        $this->db->select('pendaftar.*, kampus.name as kampus');
        $this->db->from('pendaftar');
        $this->db->join('kampus', 'kampus.id = pendaftar.kampus_id');
        $this->db->where('pendaftar.user_id =', $user_id);
        $data['pendaftar'] = $this->db->get()->row_array();


        $pendaftar_id = $data['pendaftar']['id'];
        $data['pendaftaran'] = $this->db->get_where('pendaftaran', ['pendaftar_id' => $pendaftar_id])->row_array();

        $kategori_id = $data['pendaftar']['kategori_id'];
        $data['project'] = $this->db->get_where('project', ['kategori_id' => $kategori_id])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function postData()
    {
        $user = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $user_id = $user['id'];
        $data_pendaftar = $this->db->get_where('pendaftar', ['user_id' => $user_id])->row_array();

        $this->form_validation->set_rules('project_id', 'Project_id', 'required|trim');
        $this->form_validation->set_rules('document', 'Document', 'required|trim');
        $this->form_validation->set_rules('tgl_mulai', 'Tgl_mulai', 'required|trim');
        $this->form_validation->set_rules('tgl_selesai', 'Tgl_selesai', 'required|trim');

        $i = 0; // untuk looping
        $a = $this->input->post('full_name');
        $b = $this->input->post('nim');
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_selesai = $this->input->post('tgl_selesai');


        $upload_file = $_FILES['document'];

        if ($upload_file) {
            $config['allowed_types']        = 'doc|docx|pdf';
            $config['max_size']             = 5120;
            $config['upload_path']          = './assets/document/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('document')) {
                $file = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        }

        $data = [
            'pendaftar_id' => $data_pendaftar['id'],
            'project_id' => $this->input->post('project_id'),
            'document' => $file,
            'tgl_mulai' => date('Y-m-d', strtotime($tgl_mulai)),
            'tgl_selesai' => date('Y-m-d', strtotime($tgl_selesai)),
            'status' => 0,
        ];

        $this->db->insert('pendaftaran', $data);
        $pendafatran_id = $this->db->insert_id();


        if ($a[0] !== null) {
            foreach ($a as $row) {
                $data = [
                    'pendaftaran_id' => $pendafatran_id,
                    'full_name' => $row,
                    'nim' => $b[$i],
                ];

                $insert = $this->db->insert('kelompok', $data);
                if ($insert) {
                    $i++;
                }
            }
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil disimpan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('user');
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['kampus'] = $this->db->get('kampus')->result_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['upload_path']          = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . './assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Profil anda berhasil diupdate!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('user');
        }
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $user_id = $data['user']['id'];

        // Data Pendaftar
        $this->db->select('pendaftar.*, kampus.name as kampus');
        $this->db->from('pendaftar');
        $this->db->join('kampus', 'kampus.id = pendaftar.kampus_id');
        $this->db->where('pendaftar.user_id =', $user_id);
        $data['pendaftar'] = $this->db->get()->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/profile', $data);
        $this->load->view('templates/footer');
    }
}
