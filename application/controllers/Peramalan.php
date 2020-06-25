<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peramalan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        user_allow([1]);
    }


    public function index()
    {

        $ma_month_before = 3;

        $_config = [];
        foreach ($this->db->get("_config")->result() as $value) {
            $_config[$value->_key] = $value->_value;
        }
        $data['config'] = $_config;
        if ($this->input->post('cfg_update') == 'on') {
            $this->db->where('_key', 'beta1')->update('_config', ['_value' => $this->input->post('beta1')]);
            $this->db->where('_key', 'beta2')->update('_config', ['_value' => $this->input->post('beta2')]);
            $this->db->where('_key', 'alfa')->update('_config', ['_value' => $this->input->post('alfa')]);
        }
        if ($this->input->post("pasar") != "") {
            $this->db->group_by('penjualan.fk_pasar');
            $this->db->where('penjualan.fk_pasar', $this->input->post("pasar"));
        }
        $penjualan_data = $this->db
            ->select('penjualan.fk_pasar id_pasar, detail_penjualan.fk_produk id_produk,year(penjualan.tanggal) tahun, week(penjualan.tanggal) minggu,pasar.nama nama_pasar,concat(produk.jenis," ",produk.ukuran) nama_produk,sum(detail_penjualan.jumlah) as jumlah')
            ->join('detail_penjualan', 'penjualan.id=detail_penjualan.fk_penjualan')
            ->join('produk', 'detail_penjualan.fk_produk=produk.id')
            ->join('pasar', 'penjualan.fk_pasar=pasar.id')
            ->group_by('week(tanggal)')
            ->group_by('detail_penjualan.fk_produk')
            ->order_by('penjualan.tanggal')
            ->get('penjualan')
            ->result();

        $beta1 = ($this->input->post('beta1') == "" ? $_config['beta1'] : $this->input->post('beta1'));
        $beta2 = ($this->input->post('beta2') == "" ? $_config['beta2'] : $this->input->post('beta2'));
        $period = ($this->input->post('period') == "" ? date("W") : $this->input->post('period'));

        ##triple
        $alfa = ($this->input->post('alfa') == "" ? $_config['alfa'] : $this->input->post('alfa'));
        $s1 = 0;
        $s2 = 0;
        $s3 = 0;

        $data_peramalan = [];

        $data_hasil = [];
        #dataperamalan[fk_pasar][fk_produk][bulantahun] = data_peramalan;
        foreach ($penjualan_data as $key => $value) {
            if ($value->minggu > $period) {
                break;
            }
            $data_peramalan[$value->id_produk][] = $value;
        }

        $error_arima = [];
        $error_triple = [];

        $chart_data = [];
        foreach ($data_peramalan as $id_produk => $dimens1) {
            foreach ($dimens1 as $key_period => $value) {

                #key_period 0 == minggu pertama jadi tidak ada proses perhitungan ar dll
                if ($key_period == 0) {

                    $s1 = $data_peramalan[$id_produk][0]->jumlah;
                    $s2 = $data_peramalan[$id_produk][0]->jumlah;
                    $s3 = $data_peramalan[$id_produk][0]->jumlah;
                    #arima
                    $data_peramalan[$id_produk][$key_period]->ar = 0;
                    $data_peramalan[$id_produk][$key_period]->error = 0;
                    $data_peramalan[$id_produk][$key_period]->ma = 0;
                    $data_peramalan[$id_produk][$key_period]->pe = 0;

                    $data_peramalan[$id_produk][$key_period]->rumus_ar = 0;
                    $data_peramalan[$id_produk][$key_period]->rumus_error = 0;
                    $data_peramalan[$id_produk][$key_period]->rumus_ma = 0;
                    $data_peramalan[$id_produk][$key_period]->rumus_pe = 0;

                    #triple
                    $data_peramalan[$id_produk][$key_period]->jumlah_triple = $value->jumlah;
                    $data_peramalan[$id_produk][$key_period]->s1 = $value->jumlah;
                    $data_peramalan[$id_produk][$key_period]->s2 = $value->jumlah;
                    $data_peramalan[$id_produk][$key_period]->s3 = $value->jumlah;
                    $data_peramalan[$id_produk][$key_period]->at = null;
                    $data_peramalan[$id_produk][$key_period]->bt = null;
                    $data_peramalan[$id_produk][$key_period]->ct = null;
                    $data_peramalan[$id_produk][$key_period]->ft = null;
                    $data_peramalan[$id_produk][$key_period]->error = null;
                    $data_peramalan[$id_produk][$key_period]->pe_triple = null;

                    $chart_data[$id_produk]['label'][] = $value->minggu . " " . $value->tahun;
                    $chart_data[$id_produk]['jumlah'][] = $value->jumlah;
                    $chart_data[$id_produk]['arima'][] = null;
                    $chart_data[$id_produk]['triple'][] = null;
                } else {

                    #get_data_sebelumnya 
                    $data_sebelum = $data_peramalan[$id_produk][$key_period - 1];

                    #arima
                    $_ar = ($data_sebelum->jumlah * $beta1) + ($data_sebelum->ma * $beta2);
                    $_error = $_ar - $value->jumlah;
                    // $_ma = abs($_error);
                    $_pe = abs($_error) / $value->jumlah;
                    $list_ma = [];
                    for ($i = 1; $i <= $ma_month_before; $i++) {
                        if (isset($data_peramalan[$id_produk][$key_period - $i])) {
                            $list_ma[] = $data_peramalan[$id_produk][$key_period - $i]->jumlah;
                        }
                    }
                    if (count($list_ma) == 0) {
                        $_ma = 0;
                    } else {
                        $_ma = array_sum($list_ma) / count($list_ma);
                    }

                    $error_arima[] = $_pe;

                    $data_peramalan[$id_produk][$key_period]->ar = $_ar;
                    $data_peramalan[$id_produk][$key_period]->error = $_error;
                    $data_peramalan[$id_produk][$key_period]->ma = $_ma;
                    $data_peramalan[$id_produk][$key_period]->pe = $_pe;


                    $data_peramalan[$id_produk][$key_period]->rumus_ar = "(" . $data_sebelum->jumlah . " * " . $beta1 . ") + (" . $data_sebelum->ma . "*" . $beta2 . ") =" . $_ar;
                    $data_peramalan[$id_produk][$key_period]->rumus_error = $_ar . " - " . $data_peramalan[$id_produk][$key_period]->jumlah . " = " . $_error;
                    $data_peramalan[$id_produk][$key_period]->rumus_ma = "abs(" . $_error . ") = " . $_ma;
                    $data_peramalan[$id_produk][$key_period]->rumus_pe = $_ma . " / " . $data_peramalan[$id_produk][$key_period]->jumlah . " = " . $_pe;

                    #triple
                    $s1 = ($alfa * $data_sebelum->jumlah) + ((1 - $alfa) * $s1); // $data_sebelumya = data asli pada priode itu // yang belakang st-1 (data sebelumnya data asli)
                    $s2 = ($alfa * $s1) + ((1 - $alfa) * $s2); // $s2 adalah data s2 sebelumnya s2-t
                    $s3 = ($alfa * $s2) + ((1 - $alfa) * $s3); // $s3 adalah data s3 sebelumnya s3-t
                    

                    $at = (3 * $s1) - (3 * $s2) + $s3;
                    $bt = ($alfa / 2 * pow((1 - $alfa), 2)) * (((6 - 5 * $alfa) * $s1) - ((10 - 8 * $alfa) * $s2) + ((4 - 3 * $alfa) * $s3));
                    $ct = pow($alfa, 2) / (1 - pow($alfa, 2)) * ($s1 - (2 * $s2) + $s3);
                    $ft = $at + ($bt * 1) + (1 / 2 * $ct * pow(1, 2));


                    $error = abs($ft - $value->jumlah);
                    if ($error != 0) {
                        $pe = $value->jumlah / $error;
                    } else {
                        $pe = 0;
                    }
                    $error_triple[] = $pe;

                    $data_peramalan[$id_produk][$key_period]->jumlah_triple = $value->jumlah;
                    
                    $data_peramalan[$id_produk][$key_period]->data_sebelum = $data_sebelum->jumlah;
                    $data_peramalan[$id_produk][$key_period]->s1 = $s1;
                    $data_peramalan[$id_produk][$key_period]->s2 = $s2;
                    $data_peramalan[$id_produk][$key_period]->s3 = $s3;
                    $data_peramalan[$id_produk][$key_period]->at = $at;
                    $data_peramalan[$id_produk][$key_period]->bt = $bt;
                    $data_peramalan[$id_produk][$key_period]->ct = $ct;
                    $data_peramalan[$id_produk][$key_period]->ft = $ft;
                    $data_peramalan[$id_produk][$key_period]->error = $error;
                    $data_peramalan[$id_produk][$key_period]->pe_triple = $pe;


                    $chart_data[$id_produk]['label'][] = $value->minggu . " " . $value->tahun;
                    $chart_data[$id_produk]['jumlah'][] = $value->jumlah;
                    $chart_data[$id_produk]['arima'][] = $_ar;
                    $chart_data[$id_produk]['triple'][] = $ft;
                }
            }

            do {
                $key_period++;
                $data_sebelum = $data_peramalan[$id_produk][$key_period - 1];
                $minggu = $data_sebelum->minggu;
                $minggu++;
                $tahun = $data_sebelum->tahun;
                if ($minggu >= date("W", strtotime('28th December ' . $data_sebelum->tahun))) {
                    $minggu = 1;
                    $tahun = $tahun + 1;
                }

                if ($minggu > $period) {
                    break;
                }

                $data_peramalan[$id_produk][$key_period] = new stdClass;

                $data_peramalan[$id_produk][$key_period]->id_pasar = $data_sebelum->id_pasar;
                $data_peramalan[$id_produk][$key_period]->id_produk = $data_sebelum->id_produk;
                $data_peramalan[$id_produk][$key_period]->minggu = $minggu;
                $data_peramalan[$id_produk][$key_period]->tahun = $tahun;
                $data_peramalan[$id_produk][$key_period]->nama_pasar = $data_sebelum->nama_pasar;
                $data_peramalan[$id_produk][$key_period]->nama_produk = $data_sebelum->nama_produk;
                $data_peramalan[$id_produk][$key_period]->jumlah = $data_sebelum->jumlah;

                ##menambahkan minggu
                $_ar = ($data_sebelum->jumlah * $beta1) + ($data_sebelum->ma * $beta2);
                $data_peramalan[$id_produk][$key_period]->jumlah = $_ar;
                $_error = $_ar - $data_peramalan[$id_produk][$key_period]->jumlah; //dianggap jumlah bulan setlahnya adalah sama seperti peramalannya
                // $_ma = abs($_error);

                $_pe = abs($_error) / $data_peramalan[$id_produk][$key_period]->jumlah;

                $list_ma = [];
                for ($i = 1; $i <= $ma_month_before; $i++) {
                    if (isset($data_peramalan[$id_produk][$key_period - $i])) {
                        $list_ma[] = $data_peramalan[$id_produk][$key_period - $i]->jumlah;
                    }
                }
                if (count($list_ma) == 0) {
                    $_ma = 0;
                } else {
                    $_ma = array_sum($list_ma) / count($list_ma);
                }

                $data_peramalan[$id_produk][$key_period]->ar = $_ar;
                $data_peramalan[$id_produk][$key_period]->error = $_error;
                $data_peramalan[$id_produk][$key_period]->ma = $_ma;
                $data_peramalan[$id_produk][$key_period]->pe = $_pe;


                $data_peramalan[$id_produk][$key_period]->rumus_ar = "(" . $data_sebelum->jumlah . " * " . $beta1 . ") + (" . $data_sebelum->ma . "*" . $beta2 . ") =" . $_ar;
                $data_peramalan[$id_produk][$key_period]->rumus_error = $_ar . " - " . $data_peramalan[$id_produk][$key_period]->jumlah . " = " . $_error;
                $data_peramalan[$id_produk][$key_period]->rumus_ma = "abs(" . $_error . ") = " . $_ma;
                $data_peramalan[$id_produk][$key_period]->rumus_pe = $_ma . " / " . $data_peramalan[$id_produk][$key_period]->jumlah . " = " . $_pe;

                ##triple
                $s1 = ($alfa * $data_sebelum->jumlah) + ((1 - $alfa) * $s1);
                $s2 = ($alfa * $s1) + ((1 - $alfa) * $s2);
                $s3 = ($alfa * $s2) + ((1 - $alfa) * $s3);


                $at = (3 * $s1) - (3 * $s2) + $s3;
                $bt = ($alfa / 2 * pow((1 - $alfa), 2)) * (((6 - 5 * $alfa) * $s1) - ((10 - 8 * $alfa) * $s2) + ((4 - 3 * $alfa) * $s3));
                $ct = pow($alfa, 2) / (1 - pow($alfa, 2)) * ($s1 - (2 * $s2) + $s3);
                $ft = $at + ($bt * 1) + (1 / 2 * $ct * pow(1, 2));

                $error = abs($ft - $ft); //dianggap jumlah bulan setlahnya adalah sama seperti peramalannya
                if ($error != 0) {
                    $pe = $ft / $error;
                } else {
                    $pe = 0;
                }

                $data_peramalan[$id_produk][$key_period]->jumlah_triple = $ft;
                $data_peramalan[$id_produk][$key_period]->s1 = $s1;
                $data_peramalan[$id_produk][$key_period]->s2 = $s2;
                $data_peramalan[$id_produk][$key_period]->s3 = $s3;
                $data_peramalan[$id_produk][$key_period]->at = $at;
                $data_peramalan[$id_produk][$key_period]->bt = $bt;
                $data_peramalan[$id_produk][$key_period]->ct = $ct;
                $data_peramalan[$id_produk][$key_period]->ft = $ft;
                $data_peramalan[$id_produk][$key_period]->error = $error;
                $data_peramalan[$id_produk][$key_period]->pe_triple = $pe;
                
                $chart_data[$id_produk]['label'][] = $minggu . " " . $tahun;
                $chart_data[$id_produk]['jumlah'][] = null;
                $chart_data[$id_produk]['arima'][] = $_ar;
                $chart_data[$id_produk]['triple'][] = $ft;
            } while ($minggu < $period);
        }

        foreach ($data_peramalan as $id_produk => $dimens1) {
            foreach ($dimens1 as $key_period => $value) {
                if ($value->minggu == $period) {
                    $data_hasil[] = $value;
                }
            }
        }


        if (count($error_arima) != 0) {
            $data['data_avg_error'] = [
                'arima' => array_sum($error_arima) / count($error_arima),
                'triple' => array_sum($error_triple) / count($error_triple),
            ];
        }

        $data['data_hasil'] = $data_hasil;
        $data['chart_data'] = $chart_data;
        $data['data_peramalan'] = $data_peramalan;
        $this->load->view('admin/peramalan/index', $data);
    }

    public function triple()
    {
        $penjualan_data = $this->db
            ->select('year(penjualan.tanggal) tahun, week(penjualan.tanggal) minggu,sum(detail_penjualan.jumlah) as jumlah')
            ->join('detail_penjualan', 'penjualan.id=detail_penjualan.fk_penjualan')
            ->group_by('week(tanggal)')
            ->group_by('month(tanggal)')
            ->get('penjualan')
            ->result();

        $data_penjualan = [];
        foreach ($penjualan_data as $key => $value) {
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
                'tahun' => $value['tahun'],
                'minggu' => $value['minggu'],
                'jumlah' => $value['jumlah'],
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


        $data['peramalan_data'] = $data_triple;
        $this->load->view('admin/peramalan/triple', $data);
    }
}
