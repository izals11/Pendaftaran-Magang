<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }


    private function _login()
    {
        $email = $this->input->POST('email');
        $password = $this->input->POST('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // jika user ada
        if ($user) {
            // jika user aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Password Salah!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email ini belum diaktivasi!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Email ini tidak teregistrasi!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
            redirect('auth');
        }
    }


    public function registrasi()
    {
        $data['kampus'] = $this->db->get('kampus')->result_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();

        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('kampus_id', 'Kampus_id', 'required|trim', [
            'required' => 'The Kampus field is required.'
        ]);
        $this->form_validation->set_rules('nim', 'Nim', 'required|trim');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password to short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->POST('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->POST('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash(
                    $this->input->POST('password1'),
                    PASSWORD_DEFAULT
                ),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            // siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);

            $user_id = $this->db->insert_id();

            // $this->db->insert('user_token', $user_token);

            // $this->_sendEmail($token, 'verify');

            $pendaftar = [
                'user_id' => $user_id,
                'full_name' => htmlspecialchars($this->input->POST('name', true)),
                'email' => htmlspecialchars($email),
                'kampus_id' => $this->input->POST('kampus_id'),
                'nim' => $this->input->POST('nim'),
                'telepon' => $this->input->POST('telepon'),
                'kategori_id' => $this->input->POST('kategori_id')
            ];

            $this->db->insert('pendaftar', $pendaftar);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Selamat! Akun Anda berhasil dibuat. Mohon aktivasi akun Anda!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'ujicobapakai@gmail.com',
            'smtp_pass' => 'ujicobapakai2022',
            'smtp_port' => '465',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('ujicobapakai@gmail.com', 'Magang Diskominfosan');
        $this->email->to($this->input->post('email'));
        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Klik link ini untuk verifikasi akun Anda : <a href="' . base_url() . 'auth/verify?email=' .
                $this->input->post('email') . '&token=' . urlencode($token) . '">Aktivasi</a>');
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger;
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    ' . $email . ' telah diaktivasi! Mohon login!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Aktivasi akun gagal! Token kadaluarsa.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Aktivasi akun gagal! Token salah.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Aktivasi akun gagal! Email salah.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Anda telah logout!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function getDataAutoComplete()
    {
        $autocomplete = $this->input->get('term');
        if ($autocomplete) {
            $getDataAutoComplete = $this->Auto_model->getDataAutoComplete($autocomplete);
            foreach ($getDataAutoComplete as $row) {
                $result[] = array(
                    'label' => $row['name'],
                    'kampus_id' => $row['id']
                );
                $this->output->set_content_type('application/json')->set_output(json_encode($result));
            }
        }
    }
}
