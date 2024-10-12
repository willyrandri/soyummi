<!-- datatable css -->
<link href="<?php echo base_url(); ?>assets/dataTable/DataTables-1.10.21/css/jquery.dataTables.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/dataTable/Buttons-1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <!-- dataTable -->

    <!-- js script here-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-341.js"></script>
    <!--<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/dataTable/DataTables-1.10.21/js/jquery.dataTables.min.js"></script>

    <!--<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/dataTable/Buttons-1.6.2/js/dataTables.buttons.min.js"></script>
    <!-- button datatables -->
    <!-- <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/buttons.html5.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/jszip.min.js"></script>

<!-- tambahan -->
<!-- <link href="<?php echo base_url(); ?>/dist/tambahan/will.css" rel="stylesheet"> -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Menu</h4>
                                <label><h4 class="card-title"></h4></label><a href="<?php echo base_url(); ?>parameter/tambah_menu" class="btn btn-danger" role="button">Tambah Menu Baru</a>
                                <hr>
                                <div class="table-responsive">
                                    <!-- <table id="mytable" class="table table-striped table-bordered"> -->
                                    <table id="myTable" class="table table-striped table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Menu</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Kadarluasa</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           
                                            if ($datamenu) {
                                                foreach ($datamenu as $data) {
                                                    $noid = $data->noid;
                                                    $norut = $data->norut;
                                                    $namamenu = $data->namamenu;
                                                    $harga = $data->harga;
                                                    $stat = $data->stat;
                                                    $usermod = $data->usermod;
                                                    $updatemod = $data->updatemod;
                                                    $kadarluasa = $data->kadarluasa;
                                            ?>
                                                <tr>
                                               
                                                <td><?= $norut ?></td>
                                                <td><?= $noid ?></td>
                                                <td><?= $namamenu ?></td>
                                                <td><?php echo number_format($harga); ?></td>
                                                <td><?= $kadarluasa ?></td>
                                                <td>
                                                <a href="<?php echo site_url('parameter/menu_edit/' . $noid); ?>" class="btn btn-warning btn-sm" role="button">Edit</a>
                                                &nbsp;
                                                    <?php 
                                                    if ($stat == '2'){
                                                        ?>
                                                        <a href="<?php echo site_url('parameter/aktivkan/' . $noid); ?>" class="btn btn-danger btn-sm" role="button"><i class="fas fa-check"></i></a>
                                                        <?php
                                                    }
                                                    else {
                                                        ?>
                                                        <a href="<?php echo site_url('parameter/non_aktivkan/' . $noid); ?>" class="btn btn-success btn-sm" role="button"><i class="fas fa-check"></i></a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

            <!-- sampai kebawah kali ini untuk modals -->
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            dom: 'Bflrtip',
            buttons: [
                'excelHtml5',
            ]
        });

    });
</script>