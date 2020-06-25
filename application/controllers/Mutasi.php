<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mutasi extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        user_allow([1]);
    }


    public function index()
    {
        $data['mutasi_data'] = $this->db
        ->select('mutasi.*,produk.jenis jenis_produk,produk.ukuran ukuran_produk')
        ->join('produk','mutasi.fk_produk=produk.id')
        ->order_by('tanggal','asc')
        ->get('mutasi')
        ->result();
        $this->load->view('admin/mutasi/index',$data);
    }
}