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


<head>
    <style>
        #myTable2 td, #myTable2 th {
        padding: 1px 2px; /* Adjust top/bottom and left/right padding */
    }
    
    .alert {
        position: fixed;
        top: 10px;
        right: 10px;
        padding: 15px;
        border-radius: 4px;
        z-index: 9999;
        transition: opacity 0.5s ease-out;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .fade-out {
        opacity: 0;
    }
    </style>
</head>

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="container-flex">
        <!-- Hidden form for refreshing data -->
        <form id="refreshForm" method="post" action="<?php echo base_url(); ?>persediaan/index">
            <input type="hidden" name="kodecabang" id="refreshKodecabang" value="IntanPayung">
        </form>

        <form id="orderForm" method="post" action="<?php echo base_url(); ?>persediaan/buat_orderan">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- basic table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Laporan Distribusi</h4>
                            <hr>
                            <div class="table-responsive">
                                <!-- <table id="mytable" class="table table-striped table-bordered"> -->
                                <table id="myTable2" class="table table-striped table-bordered display">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID barang</th>
                                            <th>Nama Menu</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Tgl Jual</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i = 1;
                                    if ($laporan) {
                                        foreach ($laporan as $data) {
                                            $noid = $data->noid;
                                            $namamenu = $data->namamenu;
                                            $harga = $data->harga;
                                            $jumlah = $data->jumlah;
                                            $tanggal_jual = $data->tanggal;
                                            // $catatan = $data->catatan;
                                            // $carabayar = $data->carabayar;
                                            $usermod = $data->userterima;
                                    ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $noid ?></td>
                                            <td><b><?= $namamenu ?></b></td>
                                            <td><?php echo number_format($harga); ?></td>
                                            <td><?= $jumlah ?></td>
                                            <td><?= $tanggal_jual ?></td>
                                            <td><?= $usermod ?></td>
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
        </form>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

<!-- sampai kebawah kali ini untuk modals -->
<script>
$(document).ready(function() {
    $('#myTable2').DataTable({
        dom: 'Bflrtip',
        buttons: ['excelHtml5'],
    });
});
</script>
