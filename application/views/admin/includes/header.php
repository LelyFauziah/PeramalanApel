<!--
=========================================================
 Light Bootstrap Dashboard - v2.0.1
=========================================================

 Product Page: https://www.creative-tim.com/product/light-bootstrap-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/light-bootstrap-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url("assets/") ?>img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo base_url("assets/") ?>img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>UD.DUA PUTRA</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="<?php echo base_url("assets/") ?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url("assets/") ?>css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo base_url("assets/") ?>css/demo.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="<?php echo base_url("assets/") ?>img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a class="simple-text">
                        UD DUA PUTRA
                    </a>
                </div>
                <ul class="nav">
                    <li>
                        <a class="nav-link" href="<?php echo base_url("Home") ?>">
                            <i class="nc-icon nc-chart-bar-32"></i>
                            <p>Home</p>
                        </a>
                    </li>

                    <?php if (user_allow([1], false)) : ?>
                        <li>
                            <a class="nav-link" href="<?php echo base_url("Users") ?>">
                                <i class="nc-icon nc-single-02"></i>
                                <p>Users</p>
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="<?php echo base_url("Pasar") ?>">
                                <i class="nc-icon nc-bank"></i>
                                <p>Pasar</p>
                            </a>
                        </li>
                    <?php endif ?>

                    <li>
                        <a class="nav-link" href="<?php echo base_url("Pembelian") ?>">
                            <i class="nc-icon nc-cart-simple"></i>
                            <p>Pembelian</p>
                        </a>
                    </li>

                    <?php if (user_allow([1], false)) : ?>
                    <li>
                        <a class="nav-link" href="<?php echo base_url("Produk") ?>">
                            <i class="nc-icon nc-apple"></i>
                            <p>Produk</p>
                        </a>
                    </li>
                    <?php endif ?>

                    <li>
                        <a class="nav-link" href="<?php echo base_url("Penjualan") ?>">
                            <i class="nc-icon nc-cart-simple"></i>
                            <p>Penjualan</p>
                        </a>
                    </li>

                    <?php if (user_allow([1], false)) : ?>
                    <li>
                        <a class="nav-link" href="<?php echo base_url("Peramalan") ?>">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Peramalan</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?php echo base_url("Mutasi") ?>">
                            <i class="nc-icon nc-chart-bar-32"></i>
                            <p>Mutasi</p>
                        </a>
                    </li>
                    <?php endif ?>

                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"><?php echo $this->uri->segment(1) ?></a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">

                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url("Logout") ?>">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">