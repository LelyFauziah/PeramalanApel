<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        user_allow([1,2]);
    }


    public function index()
    {
        $data['pembelian_data'] = $this->db
            ->select('*,(select nama from users where id=pembelian.fk_karyawan) as nama_karyawan')
            ->get('pembelian')
            ->result();
        $this->load->view('admin/pembelian/index', $data);
    }

    public function detail($id_pembelian)
    {
        $data['pembelian_data'] = $this->db
            ->select('*,(select nama from users where id=pembelian.fk_karyawan) as nama_karyawan')
            ->where('id', $id_pembelian)
            ->get('pembelian')
            ->row(0);

        $data['detail_data'] = $this->db
            ->select('detail_pembelian.*,concat(produk.jenis," ",produk.ukuran) produk')
            ->join('produk', 'detail_pembelian.fk_produk=produk.id')
            ->where('fk_pembelian', $id_pembelian)
            ->get('detail_pembelian')
            ->result();

        $this->load->view('admin/pembelian/detail', $data);
    }

    public function insert()
    {
        $this->load->view('admin/pembelian/insert');
    }

    public function add_pembelian()
    {

        $fk_karyawan = $this->session->userdata("userlogin")['id'];
        $petani = $this->input->post('petani');
        $produk = $this->input->post('produk');

        $set_pembelian = [
            'tanggal' => date("Y-m-d H:i:s", strtotime($this->input->post('tanggal'))),
            'fk_karyawan' => $fk_karyawan,
            'petani' => $petani,
            'status' => 1,
        ];
        $this->db->insert('pembelian', $set_pembelian);
        $id_pembelian = $this->db->insert_id();

        foreach ($produk as $key => $value) {
            $set_detail = [
                'fk_pembelian' => $id_pembelian,
                'fk_produk' => $value['fk_produk'],
                'jumlah' => $value['jumlah']
            ];
            $this->db->insert('detail_pembelian', $set_detail);
        }

        echo json_encode([
            'id' => $id_pembelian,
            'detail_url' =>  base_url("Pembelian/detail/".$id_pembelian),
            'type' => 'success',
            'title' => 'Berhasil',
            'text' => "Pembelian Berhasil"
        ]);
    }

    public function set_delete($id_pembelian)
    {
        $data_pembelian = $this->db->where('id', $id_pembelian)->get('pembelian')->row(0);
        if ($data_pembelian->status == 1) {
            $this->db->where('id', $id_pembelian)->delete('pembelian');
            echo "<script>alert('Berhasil melakukan delete')</script>";
            redirect("Pembelian", 'refresh');
        } else {
            echo "<script>alert('Wrong Function')</script>";
            redirect("Pembelian/detail/" . $id_pembelian, 'refresh');
        }
    }

    public function set_confirm($id_pembelian)
    {
        $data_pembelian = $this->db->where('id', $id_pembelian)->get('pembelian')->row(0);
        if ($data_pembelian->status == 1) {
            $data_detail = $this->db->where('fk_pembelian', $id_pembelian)->get('detail_pembelian')->result();
            foreach ($data_detail as $k => $v) {
                $data_produk = $this->db->where('id', $v->fk_produk)->get('produk')->row(0);
                $stok = $data_produk->stok + $v->jumlah;
                $this->db->where('id', $v->fk_produk)->update('produk', ['stok' => $stok]);

                $set_mutasi = [
                    'tanggal' => date('Y-m-d H:i:s'),
                    'fk_produk' => $v->fk_produk,
                    'jenis' => "Pembelian",
                    'jumlah' => $v->jumlah,
                    'stok' => $stok
                ];
                $this->db->insert('mutasi', $set_mutasi);
            }
            $this->db->where('id',$id_pembelian)->update('pembelian',['status' => 2]);
            echo "<script>alert('Berhasil melakukan confirm')</script>";
            redirect("Pembelian/detail/" . $id_pembelian, 'refresh');
        } else {
            echo "<script>alert('Wrong Function')</script>";
            redirect("Pembelian/detail/" . $id_pembelian, 'refresh');
        }
    }

    public function peramalan()
    {

        $this->load->view('admin/pembelian/peramalan');
    }
}
