<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasar extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        user_allow([1]);
    }


    public function index()
    {
        $data['pasar_data'] = $this->db
            ->get('pasar')
            ->result();
        $this->load->view('admin/pasar/index', $data);
    }

    public function insert()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
       
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/pasar/insert');
        } else {
            $set_users = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
            ];
            $this->db->insert('pasar', $set_users);

            redirect("Pasar");
        }
    }

    public function update($id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
    

        if ($this->form_validation->run() == false) {
            $users_data = $this->db
                ->where('id', $id)
                ->get('pasar')
                ->row(0);
            $data['pasar_data'] = $users_data;
            $this->load->view('admin/pasar/update', $data);
        } else {
            $set_pasar = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
            ];

            $this->db
                ->where('id', $id)
                ->update('pasar', $set_pasar);

            redirect('Pasar');
        }
    }

    public function delete($id)
    {

        $this->db
            ->where('id', $id)
            ->delete('pasar');

        redirect("Pasar");
    }
}