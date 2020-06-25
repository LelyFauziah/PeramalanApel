<?php $this->load->view("admin/includes/header") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Peramalan Arima dan Triple Exponential Smoothing</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <?php echo form_open("", ['id' => "form-arima"]) ?>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3">Pasar</label>
                            <div class="col-md-9">
                                <select name="pasar" id="" class="form-control">
                                <option value="" >Semua Pasar</option>
                                    <?php foreach ($this->db->get('pasar')->result() as $key => $value) : ?>
                                        <option value="<?php echo $value->id ?>" <?php echo (set_value('pasar') == $value->id ? "selected" : "") ?>><?php echo $value->nama ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <h6>Arima</h6>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3">Beta 1</label>
                            <div class="col-md-9">
                                <input type="text" name="beta1" class="form-control" value="<?php echo (set_value('beta1') == "" ? $config['beta1'] : set_value("beta1")) ?>">
                                <?php echo form_error("beta1") ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3">Beta 2</label>
                            <div class="col-md-9">
                                <input type="text" name="beta2" class="form-control" value="<?php echo (set_value('beta2') == "" ? $config['beta2'] : set_value("beta2")) ?>">
                                <?php echo form_error("beta2") ?>
                            </div>
                        </div>
                        <h6>TRIPLE</h6>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3">Alfa</label>
                            <div class="col-md-9">
                                <input type="number" min="0.1" max="0.9" step="0.1" name="alfa" class="form-control" value="<?php echo (set_value('alfa') == "" ? $config['alfa'] : set_value("alfa")) ?>">
                                <?php echo form_error("alfa") ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3">Minggu ke</label>
                            <div class="col-md-9">
                                <input type="number" name="period" class="form-control" value="<?php echo (set_value('period') == "" ? date("W") : set_value("period")) ?>">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class=" col-md-9">
                                <input type="checkbox" name="cfg_update"> Update Config<br>
                                <button type="submit" class="btn btn-primary">Hitung</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="col-md-4 bg-success text-white pt-3" style="border-radius: 10px;">
                        <h5>Rumus Arima</h5>
                        <div class="form-group">
                            <p>MA = jumlah awal produk</p>
                            <p>AR1 = jumlah * beta1 + MA * beta2</p>
                            <p>Error = jumlah - AR1</p>
                            <p>PE = MA / jumlah</p>
                            <p>HASIL = adalah hasil peramalan yang digunakan</p>

                            <p>RUMUS TRIPLE EXPONENTIAL SMOOTHING </p>
                            <p>S't = αXt-1+(1-α)St-1</p>
                            <p>S'' = αS't+(1-α)S''t-1</p>
                            <p>S''' = αS"t+(1-α)S'''t-1</p>
                            <p>αt = (3St)-(3S''t)+S'''t-1</p>
                            <p>bt = α/2(1-α)^2 [(6-5α)S't-(10-8α)S''t+(4-3α)S''']</p>
                            <p>ct = α^2/(1-α^2)[S't-2S''t+S'''t]</p>
                            <p>ft+m = αt+bt+m+1/2ctm^2</p>
                           
                        </div>
                    </div>
                </div>

                <?php if(isset($data_avg_error)): ?>
                    <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Arima</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">TRIPLE</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="accordion" id="accordionExample">

                            <?php foreach ($data_peramalan as $id_produk => $peramalan) : ?>
                                <div class="card mb-0">
                                    <div class="card-body" id="headingOne">
                                        <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#produk-<?php echo $id_produk ?>" aria-expanded="true" aria-controls="collapseOne">
                                            <?php echo $peramalan[0]->nama_produk ?>
                                        </button>
                                    </div>

                                    <div id="produk-<?php echo $id_produk ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">

                                            <legend><?php echo $peramalan[0]->nama_produk ?></legend>
                                            <table class="table table-hover table-stripped aso-datatable-clean" cellpadding="20px">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Periode</th>
                                                        <th>Jumlah</th>
                                                        <th>Ar</th>
                                                        <th>Error</th>
                                                        <th>Ma</th>
                                                        <th>Pe</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($peramalan as $key => $value) : ?>
                                                        <tr>
                                                            <td><?php echo $key + 1 ?></td>
                                                            <td><?php echo $value->minggu . "-" . $value->tahun ?></td>
                                                            <td><?php echo number_format($value->jumlah, 3) ?></td>
                                                            <td><?php echo number_format($value->ar, 3) ?></td>
                                                            <td><?php echo number_format($value->error, 3) ?></td>
                                                            <td><?php echo number_format($value->ma, 3) ?></td>
                                                            <td><?php echo number_format($value->pe, 3) ?></td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="accordion" id="accordionExample2">

                            <?php foreach ($data_peramalan as $id_produk => $peramalan) : ?>
                                <div class="card mb-0">
                                    <div class="card-body" id="headingOne">
                                        <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#produk-triple-<?php echo $id_produk ?>" aria-expanded="true" aria-controls="collapseOne">
                                            <?php echo $peramalan[0]->nama_produk ?>
                                        </button>
                                    </div>

                                    <div id="produk-triple-<?php echo $id_produk ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample2">
                                        <div class="card-body">

                                            <legend><?php echo $peramalan[0]->nama_produk ?></legend>
                                            <table class="table table-hover table-stripped aso-datatable-clean table-responsive" cellpadding="20px">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Periode</th>
                                                        <th>Jumlah</th>
                                                        <th>S1</th>
                                                        <th>S2</th>
                                                        <th>S3</th>
                                                        <th>AT</th>
                                                        <th>BT</th>
                                                        <th>CT</th>
                                                        <th>FT</th>
                                                        <th>Error</th>
                                                        <th>PE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($peramalan as $key => $value) : ?>
                                                        <tr>
                                                            <td><?php echo $key + 1 ?></td>
                                                            <td><?php echo $value->minggu . "-" . $value->tahun ?></td>
                                                            <td><?php echo $value->jumlah_triple ?></td>
                                                            <td><?php echo number_format($value->s1, 3) ?></td>
                                                            <td><?php echo number_format($value->s2, 3) ?></td>
                                                            <td><?php echo number_format($value->s3, 3) ?></td>
                                                            <td><?php echo number_format($value->at, 3) ?></td>
                                                            <td><?php echo number_format($value->bt, 3) ?></td>
                                                            <td><?php echo number_format($value->ct, 3) ?></td>
                                                            <td><?php echo number_format($value->ft, 3) ?></td>
                                                            <td><?php echo number_format($value->error, 3) ?></td>
                                                            <td><?php echo number_format($value->pe_triple, 3) ?></td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>



                <p>Average PE Error arima : <?php echo $data_avg_error['arima'] ?></p>
                <p>Average PE Error triple : <?php echo $data_avg_error['triple'] ?></p>

                <legend>Hasil</legend>
                <table class="table table-hover table-stripped aso-datatable-clean" cellpadding="20px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>ARIMA</th>
                            <th>TRIPLE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_hasil as $key => $value) : ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $value->nama_produk  ?></td>
                                <td><?php echo number_format($value->ar, 3) ?></td>
                                <td><?php echo number_format($value->ft, 3) ?></td>
                            <?php endforeach ?>
                    </tbody>
                </table>

                <div class="accordion" id="accordionExample3">

                    <?php foreach ($data_peramalan as $id_produk => $peramalan) : ?>
                        <div class="card mb-0">
                            <div class="card-body" id="headingOne">
                                <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#produk-chart-<?php echo $id_produk ?>" aria-expanded="true" aria-controls="collapseOne">
                                    <?php echo $peramalan[0]->nama_produk ?>
                                </button>
                            </div>

                            <div id="produk-chart-<?php echo $id_produk ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample3">
                                <div class="card-body">
                                    <legend><?php echo $peramalan[0]->nama_produk ?></legend>
                                    <div class="chart-area">
                                        <canvas id="chart-per-produk-<?php echo $id_produk ?>" width="354" height="190" style="display: block; width: 354px; height: 190px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <?php endif ?>



            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>
<script>
    var gradientChartOptionsConfigurationWithNumbersAndGrid = {
        bezierCurve: false,
        // maintainAspectRatio: false,
        legend: {
            display: true,
        },
        tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10
        },
        responsive: true,
        scales: {
            yAxes: [{
                gridLines: 0,
                gridLines: {
                    zeroLineColor: "transparent",
                    drawBorder: false
                }
            }],
            xAxes: []
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 15,
                bottom: 15
            }
        }
    };
</script>

<?php foreach ($chart_data as $key => $chart) : ?>
    <script>
        ctx = document.getElementById('chart-per-produk-<?php echo $key ?>').getContext("2d");
        ctx.height = 100;


        myChart = new Chart(ctx, {
            type: 'line',
            responsive: true,
            data: {
                labels: <?php echo json_encode($chart['label']); ?>,
                datasets: [{
                        label: "Aktual",
                        borderColor: "#ed4a4a",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#ed4a4a",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        fill: true,
                        backgroundColor: "rgba(255,0,0,0.1)",
                        borderWidth: 2,
                        lineTension: 0,
                        data: <?php echo json_encode($chart['jumlah']); ?>
                    },
                    {
                        label: "Arima",
                        borderColor: "#4a4aed",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#4a4aed",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        fill: true,
                        borderWidth: 2,
                        backgroundColor: "rgba(0,0,255,0.1)",
                        lineTension: 0,
                        data: <?php echo json_encode($chart['arima']); ?>
                    },
                    {
                        label: "Triple",
                        borderColor: "#18ce0f",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#18ce0f",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        fill: true,
                        backgroundColor: "rgba(0,255,0,0.1)",
                        borderWidth: 2,
                        lineTension: 0,
                        data: <?php echo json_encode($chart['triple']); ?>
                    },

                ]
            },
            options: gradientChartOptionsConfigurationWithNumbersAndGrid
        });
    </script>
<?php endforeach ?>