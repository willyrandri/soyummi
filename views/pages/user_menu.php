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
                                <h4 class="card-title">Data USERS</h4>
                                <label><h4 class="card-title"></h4></label><a href="<?php echo base_url(); ?>parameter/tambah_user" class="btn btn-danger" role="button">Tambah User Baru</a>
                                <hr>
                                <div class="table-responsive">
                                    <!-- <table id="mytable" class="table table-striped table-bordered"> -->
                                    <table id="myTable" class="table table-striped table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nik</th>
                                                <th>Nama</th>
                                                <th>Akses</th>
                                                <th>Cabang</th>
                                                <th>Last Login</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            if ($datauser) {
                                                foreach ($datauser as $data) {
                                                    $nik = $data->nik;
                                                    $nama = $data->nama;
                                                    $akses = $data->akses;
                                                    $lastlogin = $data->lastlogin;
                                                    $cab = $data->cab;
                                            ?>
                                                <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $nik ?></td>
                                                <td><?= $nama ?></td>
                                                <td><?= $akses ?></td>
                                                <td><?= $cab ?></td>
                                                <td><?= $lastlogin ?></td>
                                                <td>
                                                
                                                <a href="" class="btn btn-danger btn-sm" role="button" data-toggle="modal" data-target="#deletecab<?= $nik ?>">Delete</a>
                                                    <div id="deletecab<?= $nik ?>" class="modal fade" tabindex="-1" role="dialog"
                                                        aria-labelledby="warning-header-modalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header modal-colored-header bg-warning">
                                                                    <h4 class="modal-title text-white" id="warning-header-modalLabel">
                                                                    Yakin di hapus?
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="mt-0">Data akan terhapus dan tidak bisa di restore .. !!</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light"
                                                                        data-dismiss="modal">Close</button>
                                                                        <a href="<?php echo site_url('parameter/user_delete/' . $nik); ?>" class="btn btn-secondary btn-sm" role="button">Delete</a>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                <a href="<?php echo site_url('parameter/user_edit/' . $nik); ?>" class="btn btn-warning btn-sm" role="button">Edit</a></td>
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