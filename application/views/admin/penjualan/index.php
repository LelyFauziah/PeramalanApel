<?php $this->load->view("admin/includes/header") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <a href="<?php echo base_url("Penjualan/import") ?>" class="btn btn-primary">Import</a>
                <a href="<?php echo base_url("Penjualan/insert") ?>" class="btn btn-primary">Tambah Penjualan</a>


            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                <h4 class="card-title">Penjualan</h4>
                <p class="card-category">Daftar penjualan produk</p>
            </div>
            <div class="card-body table-full-width table-responsive">
                <table class="table table-hover table-striped aso-datatable-scroll">
                    <thead>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Karyawan</th>
                        <th>Pasar</th>
                        <th>Status</th>
                        <!-- <th>Detail</th> -->
                        <th></th>
                    </thead>
                    <tbody>
                        <?php foreach ($penjualan_data as $key => $value) : ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $value->tanggal ?></td>
                                <td><?php echo $value->nama_karyawan ?></td>
                                <td><?php echo $value->nama_pasar ?></td>
                                <td><?php switch ($value->status) {
                                        case 1:
                                            echo "<span class='badge badge-secondary'>draft</span>";
                                            break;
                                        case 2:
                                            echo "<span class='badge badge-success'>confirm</span>";
                                            break;
                                    } ?></td>
                                <!-- <td>
                                    <ul>
                                        <?php foreach ($this->db->select('*,(select concat(jenis," ",ukuran) from produk where id=detail_penjualan.fk_produk) as nama_produk')->where('fk_penjualan', $value->id)->get('detail_penjualan')->result() as $k => $v) : ?>
                                            <li><?php echo $v->nama_produk . ":" . $v->jumlah ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </td> -->
                                <td>
                                    <a href="<?php echo base_url("Penjualan/detail/" . $value->id) ?>" class="btn btn-sm btn-primary">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>