<?php $this->load->view("admin/includes/header") ?>
<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Simple Table</h4>

                <a href="<?php echo base_url("Peramalan/") ?>" class="btn btn-primary">Arima</a>
                <a href="<?php echo base_url("Peramalan/triple") ?>" class="btn btn-primary">Triple</a>
            </div>
            <div class="card-body">
                <table class="table table-hover table-stripped" cellpadding="20px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Minggu</th>
                            <th>Jumlah</th>
                            <th>FT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peramalan_data as $key => $value) : ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $value['tahun'] ?></td>
                                <td><?php echo $value['minggu'] ?></td>
                                <td><?php echo $value['jumlah'] ?></td>
                                <td><?php echo $value['ft'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>