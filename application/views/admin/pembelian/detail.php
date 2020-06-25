<?php $this->load->view("admin/includes/header") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                <?php if ($pembelian_data->status == 1) : ?>
                    <div class="btn-group btn-group-sm float-right">
                        <a href="<?php echo base_url("Pembelian/set_delete/" . $pembelian_data->id) ?>" class="btn btn-danger">Delete</a>
                        <?php if (user_allow([1], false)) : ?>
                            <a href="<?php echo base_url("Pembelian/set_confirm/" . $pembelian_data->id) ?>" class="btn btn-success ml-3">Confirm</a>
                        <?php endif ?>
                    </div>
                <?php endif ?>
                <h4 class="card-title">Detail Pembelian</h4>
                <p class="card-category">Daftar produk yang telah dibeli dari petani</p>
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <td>Tanggal</td>
                        <td> : </td>
                        <td><?php echo $pembelian_data->tanggal ?></td>
                    </tr>
                    <tr>
                        <td>Petani</td>
                        <td> : </td>
                        <td><?php echo $pembelian_data->petani ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td> : </td>
                        <td><?php switch ($pembelian_data->status) {
                                case 1:
                                    echo "<span class='badge badge-secondary'>draft</span>";
                                    break;
                                case 2:
                                    echo "<span class='badge badge-success'>confirm</span>";
                                    break;
                            } ?></td>
                    </tr>
                </table>
            </div>
            <div class="card-body table-full-width table-responsive">
                <table class="table table-hover table-striped aso-datatable-scroll">
                    <thead>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Jumlah</th>

                    </thead>
                    <tbody>
                        <?php foreach ($detail_data as $key => $value) : ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $value->produk ?></td>
                                <td><?php echo $value->jumlah ?></td>

                            </tr>
                        <?php endforeach ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>