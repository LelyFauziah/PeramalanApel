<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        user_allow([1,2]);
    }


    public function index()
    {
        $data['penjualan_data'] = $this->db
            ->select('*,(select nama from users where id=penjualan.fk_karyawan) as nama_karyawan,(select nama from pasar where id=penjualan.fk_pasar) as nama_pasar,')
            ->get('penjualan')
            ->result();
        $this->load->view('admin/penjualan/index', $data);
    }
    public function detail($id_penjualan)
    {
        $data['penjualan_data'] = $this->db
            ->select('*,(select nama from users where id=penjualan.fk_karyawan) as nama_karyawan,(select nama from pasar where id=penjualan.fk_pasar) as nama_pasar,')
            ->where('id', $id_penjualan)
            ->get('penjualan')
            ->row(0);

        $data['detail_data'] = $this->db
            ->select('detail_penjualan.*,concat(produk.jenis," ",produk.ukuran) produk')
            ->join('produk', 'detail_penjualan.fk_produk=produk.id')
            ->where('fk_penjualan', $id_penjualan)
            ->get('detail_penjualan')
            ->result();

        $this->load->view('admin/penjualan/detail', $data);
    }
    public function insert()
    {
        $this->load->view('admin/penjualan/insert');
    }

    public function add_penjualan()
    {
        $fk_karyawan = $this->session->userdata("userlogin")['id'];
        $fk_pasar = $this->input->post('fk_pasar');
        $produk = $this->input->post('produk');

        $set_penjualan = [
            'tanggal' => date('Y-m-d H:i:s'),
            'fk_karyawan' => $fk_karyawan,
            'fk_pasar' => $fk_pasar,
        ];
        $this->db->insert('penjualan', $set_penjualan);
        $id_penjualan = $this->db->insert_id();

        foreach ($produk as $key => $value) {
            $set_detail = [
                'fk_penjualan' => $id_penjualan,
                'fk_produk' => $value['fk_produk'],
                'jumlah' => $value['jumlah']
            ];
            $this->db->insert('detail_penjualan', $set_detail);


            $data_produk = $this->db->where('id', $set_detail['fk_produk'])->get('produk')->row(0);
            $stok = $data_produk->stok - $set_detail['jumlah'];
            $this->db->where('id', $set_detail['fk_produk'])->update('produk', ['stok' => $stok]);

            $set_mutasi = [
                'tanggal' => date('Y-m-d H:i:s'),
                'fk_produk' => $value['fk_produk'],
                'jenis' => "Penjualan",
                'jumlah' => $value['jumlah'],
                'stok' => $stok
            ];
            $this->db->insert('mutasi', $set_mutasi);
        }

        echo json_encode([
            'id' => $id_penjualan,
            'detail_url' =>  base_url("Penjualan/detail/" . $id_penjualan),
            'type' => 'success',
            'title' => 'Berhasil',
            'text' => "Penjualan Berhasil"
        ]);
    }

    public function set_delete($id_penjualan)
    {
        $data_penjualan = $this->db->where('id', $id_penjualan)->get('penjualan')->row(0);
        if ($data_penjualan->status == 1) {
            $this->db->where('id', $id_penjualan)->delete('penjualan');
            echo "<script>alert('Berhasil melakukan delete')</script>";
            redirect("Penjualan", 'refresh');
        } else {
            echo "<script>alert('Wrong Function')</script>";
            redirect("Penjualan/detail/" . $id_penjualan, 'refresh');
        }
    }

    public function set_confirm($id_penjualan)
    {
        $data_penjualan = $this->db->where('id', $id_penjualan)->get('penjualan')->row(0);
        if ($data_penjualan->status == 1) {
            $data_detail = $this->db->where('fk_penjualan', $id_penjualan)->get('detail_penjualan')->result();
            foreach ($data_detail as $k => $v) {
                $data_produk = $this->db->where('id', $v->fk_produk)->get('produk')->row(0);
                $stok = $data_produk->stok + $v->jumlah;
                $this->db->where('id', $v->fk_produk)->update('produk', ['stok' => $stok]);

                $set_mutasi = [
                    'tanggal' => date('Y-m-d H:i:s'),
                    'fk_produk' => $v->fk_produk,
                    'jenis' => "Penjualan",
                    'jumlah' => $v->jumlah,
                    'stok' => $stok
                ];
                $this->db->insert('mutasi', $set_mutasi);
            }
            $this->db->where('id', $id_penjualan)->update('penjualan', ['status' => 2]);
            echo "<script>alert('Berhasil melakukan confirm')</script>";
            redirect("Penjualan/detail/" . $id_penjualan, 'refresh');
        } else {
            echo "<script>alert('Wrong Function')</script>";
            redirect("Penjualan/detail/" . $id_penjualan, 'refresh');
        }
    }

    public function peramalan()
    {

        $this->load->view('admin/penjualan/peramalan');
    }

    public function import()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('excel', 'excel', 'trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/penjualan/import');
        } else {
            $config['upload_path'] = './storage/excel_tmp/';
            $config['allowed_types'] = 'xls|xlsx';
            $config['max_size'] = 2000;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('excel')) {
                echo json_encode([
                    'type' => "error",
                    'text' => $this->upload->display_errors('', ''),
                    'title' => "Import"
                ]);
            } else {
                $file_name = $this->upload->data('file_name');

                $this->load->library('excelreader');

                //choose format
                $inputFileName = './storage/excel_tmp/' . $file_name;
                $inputFileType = 'xls';
                $is_error = false;
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();
                    $fetch_excel = $sheet->rangeToArray('A4:' . 'E' . $highestRow, null, true, false);

                    $data_penjualan = [];
                    $exceldata_produk = [];
                    $id_penjualan = 0;
                    foreach ($fetch_excel as $key => $value) {

                        if ($value['0'] != "") {

                            $id_penjualan++;
                            $data_penjualan[$id_penjualan] = [
                                'tanggal' => $this->excelreader->excelDateConvert('Y-m-d', $value['0']),
                                'karyawan' => $value['1'],
                                'pasar' => $value['2'],
                            ];
                        }

                        $exceldata_produk[$id_penjualan][$key] = [
                            'nama_produk' => $value['3'],
                            'jumlah_produk' => $value['4']
                        ];
                    }
                    $data['data_penjualan'] = $data_penjualan;

                    $count_entered = 0;
                    foreach ($data_penjualan as $key => $value) {
                        $data_karyawan = $this->db
                            ->where('nama', $value['karyawan'])
                            ->where('level', '1')
                            ->get('users')
                            ->row(0);

                        if ($data_karyawan == null) {
                            $set_karyawan = [
                                'nama' => $value['karyawan'],
                                'level' => '1',
                            ];
                            $this->db->insert('users', $set_karyawan);
                            $id_karyawan = $this->db->insert_id();
                        } else {
                            $id_karyawan = $data_karyawan->id;
                        }

                        $data_pasar = $this->db
                            ->where('nama', $value['pasar'])
                            ->get('pasar')
                            ->row(0);

                        if ($data_pasar == null) {
                            $set_pasar = [
                                'nama' => $value['pasar'],
                            ];
                            $this->db->insert('pasar', $set_pasar);
                            $id_pasar = $this->db->insert_id();
                        } else {
                            $id_pasar = $data_pasar->id;
                        }

                        $set_penjualan = [
                            'tanggal' => $value['tanggal'],
                            'fk_karyawan' => $id_karyawan,
                            'fk_pasar' => $id_pasar
                        ];

                        $this->db->insert('penjualan', $set_penjualan);
                        $penjualan_id = $this->db->insert_id();
                        foreach ($exceldata_produk[$key] as $k => $v) {
                            $explode_nama = explode(" ", $v['nama_produk']);
                            $jenis = $explode_nama[0];
                            $ukuran = $explode_nama[1];

                            $data_produk = $this->db
                                ->where('jenis', $jenis)
                                ->where('ukuran', $ukuran)
                                ->get('produk')
                                ->row(0);

                            if ($data_produk == null) {
                                $set_produk = [
                                    'jenis' => $jenis,
                                    'ukuran' => $ukuran,
                                ];
                                $this->db->insert('produk', $set_produk);
                                $id_produk = $this->db->insert_id();
                            } else {
                                $id_produk = $data_produk->id;
                            }

                            $set_detail = [
                                'fk_penjualan' => $penjualan_id,
                                'fk_produk' => $id_produk,
                                'jumlah' => $v['jumlah_produk'],
                            ];
                            $this->db->insert('detail_penjualan', $set_detail);
                        }
                        $count_entered++;
                    }

                    unlink($inputFileName);

                    echo json_encode([
                        'type' => "success",
                        'text' => "Data count : " . $count_entered,
                        'title' => "Import Berhasil",
                        'data' => $data_penjualan
                    ]);
                } catch (Exception $e) {
                    $is_error = true;
                    $data['error_info'] = 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage();

                    echo json_encode([
                        'type' => "error",
                        'text' => $data['error_info'],
                        'title' => "Import"
                    ]);
                }
            }
        }
    }

    public function triple()
    {

        $raw_penjualan = $this->db
            ->select("*,week(penjualan.tanggal) minggu,year(penjualan.tanggal) tahun,(select sum(jumlah) from detail_penjualan where fk_penjualan=penjualan.id) jumlah")
            ->group_by("week(penjualan.tanggal)")
            ->group_by("year(penjualan.tanggal)")
            ->get('penjualan')->result();

        $alfa = 0.3;

        $data_penjualan = [];
        foreach ($raw_penjualan as $key => $value) {
            $data_penjualan[$key] = [
                'tahun' => $value->tahun,
                'minggu' => $value->minggu,
                'jumlah' => $value->jumlah,
            ];
        }

        $data_triple = [];

        $alfa = 0.3;
        $s1 = 0;
        $s2 = 0;
        $s3 = 0;
        foreach ($data_penjualan as $key => $value) {
            if ($key == 0) {
                $s1 = $value['jumlah'];
                $s2 = $value['jumlah'];
                $s3 = $value['jumlah'];
                continue;
            }
            $s1 = ($alfa * $data_penjualan[$key - 1]['jumlah']) + ((1 - $alfa) * $s1);
            $s2 = ($alfa * $s1) + ((1 - $alfa) * $s2);
            $s3 = ($alfa * $s2) + ((1 - $alfa) * $s3);


            $at = (3 * $s1) - (3 * $s2) + $s3;
            $bt = ($alfa / 2 * pow((1 - $alfa), 2)) * (((6 - 5 * $alfa) * $s1) - ((10 - 8 * $alfa) * $s2) + ((4 - 3 * $alfa) * $s3));
            $ct = pow($alfa, 2) / (1 - pow($alfa, 2)) * ($s1 - (2 * $s2) + $s3);
            $ft = $at + $bt + (1 / 2 * $ct);

            $error = abs($ft - $value['jumlah']);
            if ($error != 0) {
                $pe = $value['jumlah'] / $error;
            } else {
                $pe = 0;
            }
            $data_triple[$key] = [
                's1' => $s1,
                's2' => $s2,
                's3' => $s3,
                'at' => $at,
                'bt' => $bt,
                'ct' => $ct,
                'ft' => $ft,
                'error' => $error,
                'pe' => $pe,
            ];
        }
        dd($data_triple);
    }

    public function arima()
    {
        $raw_penjualan = $this->db
            ->select("*,week(penjualan.tanggal) minggu,year(penjualan.tanggal) tahun,(select sum(jumlah) from detail_penjualan where fk_penjualan=penjualan.id) jumlah")
            ->group_by("week(penjualan.tanggal)")
            ->group_by("year(penjualan.tanggal)")
            ->get('penjualan')->result();

        $beta1 = 0.774715710184695;
        $beta2 = 0.520990065207925;

        $data_penjualan = [];
        foreach ($raw_penjualan as $key => $value) {
            $data_penjualan[$key] = [
                'tahun' => $value->tahun,
                'minggu' => $value->minggu,
                'jumlah' => ($value->jumlah == null ? 0 : $value->jumlah),
            ];
        }

        $data_arima = [];
        $MA1 = 0;
        foreach ($data_penjualan as $key => $value) {
            if ($key == 0) {
                continue;
            }

            $_AR1 = ($data_penjualan[$key - 1]['jumlah'] * $beta1) + ($MA1 * $beta2);
            $_ERROR = $value['jumlah'] - $_AR1;
            $MA1 = abs($_ERROR);
            $_PE = $MA1 / $value['jumlah'];
            $data_arima[$key] = [
                'jumlah' => $value['jumlah'],
                "AR1" => $_AR1,
                "ERROR" => $_ERROR,
                'MA1' => $MA1,
                'PE' => $_PE
            ];
        }
        dd($data_arima);
    }
}
