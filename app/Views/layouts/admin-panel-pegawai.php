<?php

use Config\Services;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url()?>/node_modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/node_modules/weathericons/css/weather-icons.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/node_modules/weathericons/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/node_modules/summernote/dist/summernote-bs4.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/components.css">

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="<?= base_url()?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <?= $this->renderSection('script-head')?>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-light"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">

                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url()?>/assets/img/avatar/avatar-1.png"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block" style="color:blue">Hi, <?= session('nama')?></div>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Main Sidebar -->
            <div class="main-sidebar sidebar-style-2 bg-white border border-primary rounded">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="" style="color: blue;">Toko Baju Lemari Deyinn</a>
                    </div>
                    <ul class="sidebar-menu text">
                        <li class="menu-header" style="color: blue;">Dashboard</li>
                        <li class="nav-item <?= (service('uri')->getSegment(2) === 'home') ? 'active' : ''?>">
                            <a href="<?= base_url('pegawai/home')?>" class="nav-link"><i class="fas fa-home"
                                    style="color: blue;"></i><span style="color: blue;">Dashboard</span></a>
                        </li>
                        <?php if ($_SESSION['role'] == '2' || $_SESSION['role'] == '4'):?>
                        <li class="menu-header" style="color: blue;">Data Produk</li>
                        <li class="nav-item <?= (service('uri')->getSegment(2) === 'home') ? 'active' : ''?>">
                            <a href="<?= base_url('pegawai/barang')?>" class="nav-link"><i class="fas fa-folder"
                                    style="color: blue;"></i><span style="color: blue;">Produk</span></a>
                        </li>
                        <?php endif;?>
                        <?php if ($_SESSION['role'] == '2'):?>
                        <li class="menu-header" style="color: blue;">Laporan Penjualan</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-print"
                                    style="color: blue;"></i> <span style="color: blue;">Laporan Penjualan</span></a>
                            <ul class="dropdown-menu">
                                <?php if ($_SESSION['role'] == '2'):?>
                                <li><a class="nav-link" href="<?= base_url('pegawai/laporan-transaksi')?>">Laporan
                                        Transaksi</a></li>
                                <?php endif;?>
                            </ul>
                        </li>
                        <?php endif;?>
                        <?php if ($_SESSION['role'] == '4' || $_SESSION['role'] == '1' || $_SESSION['role'] == '2'):?>
                        <li class="menu-header" style="color: blue;">Transaksi</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-file"
                                    style="color: blue;"></i>
                                <span style="color: blue;">Data Transaksi</span></a>
                            <ul class="dropdown-menu">
                                <?php if ($_SESSION['role'] == '2'):?>
                                <li><a class="nav-link" href="<?= base_url('pegawai/pesanan')?>">Pesanan</a>
                                    <?php endif;?>
                                </li>
                            </ul>
                        </li>
                        <?php endif;?>
                        <?php if ($_SESSION['role'] == '2'):?>
                        <li class="menu-header" style="color: blue;">Pembeli</li>
                        <li class="nav-item <?= (service('uri')->getSegment(2) === 'users') ? 'active' : ''?>">
                            <a href="<?= base_url('pegawai/customer')?>" class="nav-link "> <i class="fas fa-users"></i>
                                <span style="color: blue;">Data Pembeli</span></a>
                        </li>
                        <?php endif;?>
                        <?php if ($_SESSION['role'] == '2'):?>
                        <li class="menu-header" style="color: blue;">Penjual</li>
                        <li class="nav-item <?= (service('uri')->getSegment(2) === 'users') ? 'active' : ''?>">
                            <a href="<?= base_url('pegawai/users')?>" class="nav-link "> <i class="fas fa-users"></i>
                                <span style="color: blue;">Data Penjual</span></a>
                        </li>
                        <?php endif;?>
                        <li class="menu-header" style="color: blue;">Menu Lainnya</li>
                        <li class="nav-item <?= (service('uri')->getSegment(2) === 'users') ? 'active' : ''?>">
                            <a href="<?=base_url('logout')?>" class="nav-link "> <i class="fas fa-sign-out-alt"
                                    style="color: blue;"></i>
                                <span style="color: blue;">Logout</span></a>
                        </li>
                        <br><br><br><br>
                        <div class="login-info border rounded d-flex justify-content-center align-items-center">
                            <p style="font-weight: bold;">Version : <small>1.1.0</small></p>
                        </div>
                </aside>
            </div>
            <!-- End Sidebar -->
            <!-- Main Content -->

            <?= $this->renderSection('content')?>

            <footer class="main-footer">
                <div class="footer-center">
                    <center>Copyright &copy;
                        <?=date('Y')?> <br><small>Markisa</small>
                    </center>
                </div>

            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url()?>/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="<?=base_url()?>/node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
    <script src="<?=base_url()?>/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="<?=base_url()?>/node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="<?=base_url()?>/node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?=base_url()?>/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="<?=base_url()?>/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <!-- Template JS File -->
    <script src="<?=base_url()?>/assets/js/scripts.js"></script>
    <script src="<?=base_url()?>/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?=base_url()?>/assets/js/page/index-0.js"></script>

    <!-- Datatable JS-->
    <script src="<?= base_url()?>/assets/js/page/modules-datatables.js"></script>
    <?= $this->renderSection('script')?>
</body>

</html>