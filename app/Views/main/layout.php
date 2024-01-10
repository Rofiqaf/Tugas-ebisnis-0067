<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi SIPP UD. Sawung White</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/plugins/chart.js/Chart.js"></script>
    <style>
        .sembunyi{display:none};
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->


                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" >
            <!-- Brand Logo -->
            <a href="<?= base_url() ?>main/dashboard" class="brand-link">
                <img src="<?= base_url() ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-bold">App SIPP </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image" style="display:flex;align-items:center;">
                        <img src="<?= base_url() ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <div style="color:#c2c7d0;line-height:16px">
                            <?php
                                // Memuat library session
                                $session = session();
                                $userData = $session->get('user');
                                echo "<strong>".$userData['nama']."</strong>";
                                echo "<br/>";
                                echo "<small><i>" . $userData['level'] . "</i></small>";
                            ?>
                        </div>
                    </div>
                </div>

                <!-- SidebarSearch Form -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                        <li class="nav-item sembunyi pemilik super-admin admin-penjualan admin-pembelian">
                            <a href="<?= site_url('/'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt text-white"></i>
                                <p class="text">
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">
                            Master
                        </li>
                        <li class="nav-item sembunyi pemilik super-admin">
                            <a href="<?= site_url('data_pt/index'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-tasks text-success"></i>
                                <p class="text">
                                    Data PT
                                </p>
                            </a>
                        </li>
                        <li class="nav-item sembunyi pemilik super-admin">
                            <a href="<?= site_url('user/index'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-tasks text-primary"></i>
                                <p class="text">
                                    Data User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item sembunyi super-admin admin-pembelian">
                            <a href="<?= site_url('supplier/index'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-tasks text-danger"></i>
                                <p class="text">
                                    Supplier
                                </p>
                            </a>
                        </li>
                        <li class="nav-item sembunyi super-admin admin-penjualan">
                            <a href="<?= site_url('produk/index'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-tasks text-warning"></i>
                                <p class="text">
                                    Produk
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">
                            Transaksi
                        </li>
                        <li class="nav-item sembunyi super-admin admin-pembelian">
                            <a href="<?= site_url('pembelian/index'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-indent text-success"></i>
                                <p class="text">
                                    Transaksi Pembelian
                                </p>
                            </a>
                        </li>
                        <li class="nav-item sembunyi pemilik super-admin admin-pembelian">
                            <a href="<?= site_url('pembelian/laporan'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-newspaper text-info"></i>
                                <p class="text">
                                    Laporan Pembelian
                                </p>
                            </a>
                        </li>
                        <li class="nav-item sembunyi super-admin admin-penjualan">
                            <a href="<?= site_url('penjualan/index'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-outdent text-primary"></i>
                                <p class="text">
                                    Transaksi Penjualan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item sembunyi pemilik super-admin admin-penjualan">
                            <a href="<?= site_url('penjualan/laporan'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-newspaper text-info"></i>
                                <p class="text">
                                    Laporan Penjualan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item sembunyi pemilik super-admin admin-penjualan admin-pembelian">
                            <a class="nav-link" href="/logout">
                            <i class="nav-icon fas fa-sign-out-alt text-white"></i>
                                <p class="text">
                                Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                <?= $this->renderSection('judul') ?>
                            </h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?= $this->renderSection('subjudul') ?>
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?= $this->renderSection('isi') ?>
                    </div>
                    <!-- /.card-body -->

                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>CodeIgniter</b> v4.4.3
            </div>
            <strong>Copyright &copy; Rofiq
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            levelnya = sessionStorage.getItem("level");
            $("."+levelnya).show();

            var colSm6Elements = $('.content-header').find('.col-sm-6');
            colSm6Elements.css('max-width', '100%');
            colSm6Elements.css('flex', 'auto');
            $('.card-tools').css('display','none');
        });
    </script>
</body>

</html>