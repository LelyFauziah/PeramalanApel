<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
installation
Controller Login,ErrorPage
Helper userlogin_helper
autoload userlogin
router 

usage 

user_allow([]) : harus login dan dapat diakses semua level
user_allow([1]) : harus login dan hanya dapat di akses oleh level 1
user_allow([1,2]) : harus login dan hanya dapat di akses oleh level 1 dan 2

user_allow([],false) : false di maksud redirect = false, sehingga hanya mengembalikan nilai boolean (digunakan untuk mengatur view)
*/
class Login extends CI_Controller
{


    public function index()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_auth_username');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_auth_password');
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');


            $data_users = $this->db
                ->where('username', $username)
                ->where('password', md5($password))
                ->get('users')
                ->row(0);

            $session_data = [
                'is_loggedin' => true,
                'id' => $data_users->id,
                'nama' => $data_users->nama,
                'username' => $data_users->username,
                'level' => $data_users->level,
                'gambar' => $data_users->gambar
            ];

            $this->session->set_userdata('userlogin', $session_data);
            redirect("Home");
        }
    }

    function auth_username($username)
    {
        $query = $this->db
            ->where('username', $username)
            ->get('users');

        if ($query->num_rows() != 1) {
            $this->form_validation->set_message('auth_username', '{field} belum terdaftar');
            return false;
        }
        return true;
    }

    function auth_password($password)
    {
        $username = $this->input->post('username');
        $query_username = $this->db
            ->where('username', $username)
            ->get('users');

        $query_password = $this->db
            ->where('username', $username)
            ->where('password', md5($password))
            ->get('users');

        if ($query_username->num_rows() == 1) {
            if ($query_password->num_rows() != 1) {
                $this->form_validation->set_message('auth_password', '{field} salah');
                return false;
            }
        }
        return true;
    }

    public function register()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]|min_length[8]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'Re-Password', 'trim|required|min_length[6]');

        if ($this->form_validation->run() == false) {
            $this->load->view('register');
        } else {
            $set_users = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'level' => 1,
            ];
            $this->db->insert('users', $set_users);
            $insert_id = $this->db->insert_id();

            $data_users = $this->db
                ->where('id', $insert_id)
                ->get('users')
                ->row(0);

            $session_data = [
                'is_loggedin' => true,
                'id' => $data_users->id,
                'nama' => $data_users->nama,
                'username' => $data_users->username,
                'level' => $data_users->level,
                'gambar' => $data_users->gambar
            ];

            $this->session->set_userdata('userlogin', $session_data);
            redirect("Home");
        }
    }

    public function profile()
    {
        user_allow([]);

        $this->load->library('form_validation');

        $unique_username = "";
        if ($this->input->post('username') != $this->session->userdata('userlogin')['username']) {
            $unique_username = '|is_unique[users.username]';
        }


        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[8]' . $unique_username);

        $this->form_validation->set_rules('gambar', 'gambar', 'callback_upload_gambar');

        if ($this->input->post('password') != "") {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[repassword]');
            $this->form_validation->set_rules('repassword', 'Re-Password', 'trim|required|min_length[6]');
        }
        if ($this->form_validation->run() == false) {
            $data = [
                'userlogin' => $this->session->userdata('userlogin')
            ];
            $this->load->view('profile', $data);
        } else {

            $id_users = $this->session->userdata('userlogin')['id'];

            $set_users = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
            ];

            if ($this->input->post('password') != "") {
                $set_users['password'] = md5($this->input->post('password'));
            }

            $this->db
                ->where('id', $id_users)
                ->update('users', $set_users);

            $data_users = $this->db
                ->where('id', $id_users)
                ->get('users')
                ->row(0);

            $session_data = [
                'is_loggedin' => true,
                'id' => $data_users->id,
                'nama' => $data_users->nama,
                'username' => $data_users->username,
                'level' => $data_users->level,
                'gambar' => $data_users->gambar
            ];

            $this->session->set_userdata('userlogin', $session_data);
            redirect("Profile");
        }
    }
    function upload_gambar()
    {
        $id_users = $this->session->userdata('userlogin')['id'];

        if ($_FILES['gambar']['name'] != "") {
            $config['upload_path']          = './storage/users/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['file_ext_tolower']     = true;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $this->form_validation->set_message('upload_gambar', "{field} : " . $this->upload->display_errors('', ''));
                return false;
            } else {
                $users_data = $this->db
                    ->where('id', $id_users)
                    ->get('users')
                    ->row(0);
                if ($users_data->gambar != 'default.png') {
                    unlink('storage/users/' . $users_data->gambar);
                }

                $set_users = [
                    'gambar' => $this->upload->data('file_name')
                ];
                $this->db
                    ->where('id', $id_users)
                    ->update('users', $set_users);

                $session_data = $this->session->userdata('userlogin');
                $session_data['gambar'] = $this->upload->data('file_name');
                $this->session->set_userdata('userlogin', $session_data);
            }
        }
        return true;
    }

    public function logout()
    {
        $this->session->unset_userdata('userlogin');
        redirect("Login");
    }
}
