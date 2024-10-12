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
                        
                        <h4 class="card-title">Orderan Aktiv</h4>          
                        <hr>
                        <div class="table-responsive">
                            <!-- <table id="mytable" class="table table-striped table-bordered"> -->
                            <table id="myTable" class="table table-striped table-bordered display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id</th>
                                        <th>Status</th>
                                        <th>Date Order</th>
                                        <th>Jumlah</th>
                                        <th>TotalHarga</th>
                                        <th>Diskon</th>
                                        <th>CaraBayar</th>
                                        <th>Maker</th>
                                        <th>Operator</th>
                                        <th>Catatan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if ($datamenu) {
                                        foreach ($datamenu as $data) {
                                            $id_penjualan = $data->id_penjualan;
                                            $tanggal_jual = $data->tanggal_jual;
                                            $jumlah = $data->jumlah;
                                            $totalharga = $data->totalharga;
                                            $catatan = $data->catatan;
                                            $usermod = $data->usermod;
                                            $statusjual = $data->statusjual;
                                            $kodecabang = $data->kodecabang;
                                            $konfirmby = $data->konfirmby;
                                            $diskon = $data->diskon;
                                            $carabayar = $data->carabayar;
                                    ?>
                                        <tr>
                                        <td><?= $i++ ?></td>
                                            <td><?= $id_penjualan ?></td>
                                            <td><?php 
                                            if($statusjual == '1'){
                                                ?>
                                                <span class="bg-warning">Order</span>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <span class="bg-success">Selesai</span>
                                                <?php
                                            }
                                            ?></td>
                                            <td><?= $tanggal_jual ?></td>
                                            <!-- <td><b><?= $jumlah ?></b></td>
                                            <td><?php echo number_format($totalharga); ?></td>
                                            <td><?php echo number_format($diskon); ?></td> -->
                                            <td data-raw="<?php echo $jumlah; ?>">
                                                <?php echo number_format($jumlah); ?>
                                            </td>
                                            <td data-raw="<?php echo $totalharga; ?>">
                                                <?php echo number_format($totalharga); ?>
                                            </td>
                                            <td data-raw="<?php echo $diskon; ?>">
                                                <?php echo number_format($diskon); ?>
                                            </td>
                                            <td><?= $carabayar ?></td>
                                            <td><?= $usermod ?></td>
                                            <td><?= $konfirmby ?></td>
                                            <td><?= $catatan ?></td>
                                            <td>
                                            <?php
                                                $aksesUs = "hidden";
                                                $arrayAkses = ['1'];
                                                if (in_array($this->session->userdata('ses_akses'), $arrayAkses)) $aksesUs = "";
                                            ?>
                                               <a href="<?php echo site_url('persediaan/order_detail/' . $id_penjualan); ?>" class="btn btn-primary btn-sm" role="button">Detail</a>
                                               <!-- <a href="<?php echo site_url('persediaan/order_detail/' . $id_penjualan); ?>" class="btn btn-success btn-sm" role="button">Check-Out</a> -->
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Total</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
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
    var table = $('#myTable').DataTable({
        dom: 'Bflrtip',
        buttons: ['excelHtml5'],
        pageLength: 25, // Set default number of rows to display
        drawCallback: function() {
            var api = this.api();

            // Function to parse numbers from text content
            function parseNumber(value) {
                // Remove commas and other non-numeric characters
                var num = parseFloat(value.replace(/[^0-9.-]/g, ''));
                return isNaN(num) ? 0 : num;
            }

            // Function to format number with comma as thousand separator
            function formatNumber(value) {
                return value.toLocaleString(); // Format with commas
            }

            // Function to calculate and display total
            function calculateTotals(columnIndexes) {
                columnIndexes.forEach(function(index) {
                    // Calculate total for the specified column index
                    var total = api.column(index, { page: 'current' }).data().reduce(function(a, b) {
                        return a + parseNumber(b);
                    }, 0);

                    // Update footer with formatted total
                    $(api.column(index).footer()).html(formatNumber(total)); // Format number
                });
            }

            // Ensure the columns to sum are correctly specified (use zero-based index)
            var columnsToSum = [4, 5, 6]; // Update this array with the indexes of columns you want to sum
            calculateTotals(columnsToSum);
        }
    });
});
</script>

