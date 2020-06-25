<?php $this->load->view("admin/includes/header") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                <h4 class="card-title">Mutasi Produk</h4>
                <p class="card-category">Daftar pembelian dan penjualan beserta stok produk</p>
            </div>
            <div class="card-body table-full-width table-responsive">
                <table class="table table-hover table-striped aso-datatable-scroll-2">
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>PRODUK</th>
                        <th>Jenis</th>
                        <th>IN</th>
                        <th>OUT</th>
                        <th>Stok</th>
                    </thead>
                    <tbody>
                        <?php foreach ($mutasi_data as $key => $value) : ?>
                            <tr>
                                <td><?php echo $key+1 ?></td>
                                <td><?php echo $value->tanggal ?></td>
                                <td><?php echo $value->jenis_produk." ".$value->ukuran_produk ?></td>
                                <td><?php echo $value->jenis ?></td>
                                <td><?php echo ($value->jenis == "Pembelian" ? $value->jumlah : "") ?></td>
                                <td><?php echo ($value->jenis == "Penjualan" ? $value->jumlah : "") ?></td>
                                <td><?php echo $value->stok ?></td>
                            </tr>
                        <?php endforeach ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>