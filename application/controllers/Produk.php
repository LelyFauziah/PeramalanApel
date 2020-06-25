<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        user_allow([1]);
    }


    public function index()
    {
        $data['produk_data'] = $this->db
            ->get('produk')
            ->result();
        $this->load->view('admin/produk/index', $data);
    }

    public function insert()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
       
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/produk/insert');
        } else {
            $set_users = [
                'jenis' => $this->input->post('jenis'),
                'ukuran' => $this->input->post('ukuran'),
                'stok' => $this->input->post('stok'),
            ];
            $this->db->insert('produk', $set_users);

            redirect("Produk");
        }
    }

    public function update($id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
    

        if ($this->form_validation->run() == false) {
            $users_data = $this->db
                ->where('id', $id)
                ->get('produk')
                ->row(0);
            $data['produk_data'] = $users_data;
            $this->load->view('admin/produk/update', $data);
        } else {
            $set_produk = [
                'jenis' => $this->input->post('jenis'),
                'ukuran' => $this->input->post('ukuran'),
                'stok' => $this->input->post('stok'),
            ];

            $this->db
                ->where('id', $id)
                ->update('produk', $set_produk);

            redirect('Produk');
        }
    }

    public function delete($id)
    {

        $this->db
            ->where('id', $id)
            ->delete('produk');

        redirect("Produk");
    }
}