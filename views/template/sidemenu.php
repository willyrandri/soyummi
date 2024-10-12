<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>/dist/images/logo.jpg">
    <title>SO YUMMEH</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url(); ?>/aset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>/aset/css/sb-admin-2.min.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>/aset/vendor/jquery/jquery.min.js"></script>
    
</head>
<style>
    

    body {
        overflow: auto;
        display: flex;
        flex-direction: column;
    }

    #sidebar {
        width: 250px; /* Adjust as needed */
        background: #f8f9fa; /* Sidebar background color */
        /* Other sidebar styles */
    }

    footer {
        background-color: #fff;
        padding: 1rem;
        text-align: center;
        width: 100%;
        position: relative; /* Ensure footer doesn't overlap with content */
    }

    /* Custom gradient background */
    .bg-gradient-secondary-custom {
        background: linear-gradient(90deg, #B28DFF, #C5A3FF);
    }

    /* Custom solid color background */
    .bg-gradient-secondary-custom {
        background-color: #FBE4FF; /* Replace with your color */
    }

    /* Touch screen specific adjustments */
    @media (pointer: coarse) {
        #page-wrapper {
            overflow: auto; /* Ensure scrolling is enabled on touch screens */
        }
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-secondary-custom sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                </div>
                <div class="sidebar-brand-text mx-3">SO YUMMEH BABY FOOD
                    <!-- <sup>Control</sup> -->
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="<?php echo base_url(); ?>logincon/logout">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>


            <!-- Nav Item - Dashboard -->
            <?php
                $aksesUs = "hidden";
                $arrayAkses = ['1'];
                if (in_array($this->session->userdata('ses_akses'), $arrayAkses)) $aksesUs = "";
            ?>
            <li class="nav-item active" <?= $aksesUs ?>>
                <a class="nav-link" href="<?php echo base_url(); ?>Home/index">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item active" <?= $aksesUs ?>>
                <a class="nav-link" href="<?php echo base_url(); ?>Home/bulanan">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Monthly</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading" <?= $aksesUs ?>>
                Parameters Menu
            </div>
            <li class="nav-item" <?= $aksesUs ?>>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Parameters</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <a href="<?php echo base_url(); ?>parameter/menu" class="collapse-item" <?= $aksesUs ?>>Menu</a>
                    <a href="<?php echo base_url(); ?>parameter/user" class="collapse-item" <?= $aksesUs ?>>User</a>
                    <a href="<?php echo base_url(); ?>parameter/cabang" class="collapse-item" <?= $aksesUs ?>>Cabang</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Main Menu
            </div>

            <?php
                // $aksesUs = "hidden";
                // $arrayAkses = ['1','6'];
                // if (in_array($this->session->userdata('ses_akses'), $arrayAkses)) $aksesUs = "";
            ?>
            <li class="nav-item" <?= $aksesUs ?>>
                <a class="nav-link" href="<?php echo base_url(); ?>Produk/produksi"><i class="fas fa-fw fa-chart-area"></i>Produksi</a>
            </li>
            <li class="nav-item" <?= $aksesUs ?>>
                <a class="nav-link" href="<?php echo base_url(); ?>Persediaan/pindahtoko_pilcab"><i class="fas fa-fw fa-chart-area"></i>Pindah Toko</a>
            </li>
            <li class="nav-item" <?= $aksesUs ?>>
                <a class="nav-link" href="<?php echo base_url(); ?>Produk/distribusi"><i class="fas fa-fw fa-chart-area"></i>Distribusi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>Produk/terimabarang"><i class="fas fa-fw fa-chart-area"></i>Terima Barang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>Persediaan/index"><i class="fas fa-fw fa-chart-area"></i>Stock di Toko</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>Persediaan/orderaktiv"><i class="fas fa-fw fa-chart-area"></i>Order Aktiv</a>
            </li>
            
            
            <!-- Laporan -->
            <?php
                            $aksesUs = "hidden";
                            $arrayAkses = ['1'];
                            if (in_array($this->session->userdata('ses_akses'), $arrayAkses)) $aksesUs = "";
                        ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages12"
                    aria-expanded="true" aria-controls="collapsePages12">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapsePages12" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url(); ?>laporan/laporan_keuangan" <?= $aksesUs ?>>Keuangan</a>
                        <a class="collapse-item" href="<?php echo base_url(); ?>laporan/total_jual_tgl" <?= $aksesUs ?>>Rekap Penjualan</a>
                        <a class="collapse-item" href="<?php echo base_url(); ?>laporan/pengeluaran_tgl" <?= $aksesUs ?>>History Pengeleuaran</a>
                        <a class="collapse-item" href="<?php echo base_url(); ?>laporan/tgl_penjualan" <?= $aksesUs ?>>History Detail Penjualan</a>
                        <a class="collapse-item" href="<?php echo base_url(); ?>laporan/tgl_persediaan" <?= $aksesUs ?>>History Persediaan</a>
                        <a class="collapse-item" href="<?php echo base_url(); ?>laporan/tgl_Distribusi" <?= $aksesUs ?>>History Distribusi</a>
                        <a class="collapse-item" href="<?php echo base_url(); ?>laporan/tgl_produksi" <?= $aksesUs ?>>History Produksi</a> 
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <?php
                $aksesUs = "hidden";
                $arrayAkses = ['1'];
                if (in_array($this->session->userdata('ses_akses'), $arrayAkses)) $aksesUs = "";
            ?>
            <hr class="sidebar-divider d-none d-md-block" <?= $aksesUs ?>>
            <li class="nav-item" <?= $aksesUs ?>>
                <a class="nav-link" href="<?php echo base_url(); ?>Biaya/biaya_menu"><i class="fas fa-fw fa-chart-area"></i>Pengeluaran</a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
             <li class="nav-item" >
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                     
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                $userid = $this->session->userdata('ses_id');
                                $usernm = $this->session->userdata('ses_nama');
                                $kdcab = $this->session->userdata('ses_cab');
                                ?>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $userid; ?>-<?= $usernm; ?>-<?= $kdcab; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo base_url(); ?>/aset/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="<?php echo base_url(); ?>Home/pindah_cabang">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pindah Cabang
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

            