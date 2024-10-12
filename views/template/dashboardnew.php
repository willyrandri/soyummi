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

        .blue-text {
            color: blue;
        }
        .green-text {
            color: green;
        }
    </style>
</head>

<div id="home" class="container-flex">
                <!-- <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                             
                            </div>
                        </div>
                    </div>
                </div>
                <hr> -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-1 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div
                                        class="round round-lg text-white d-inline-block text-center rounded-circle bg-info">
                                        <i class="ti-wallet"></i>
                                    </div>
                                    <div class="ml-2 align-self-center">
                                        <?php echo date('d M'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div
                                        class="round round-lg text-white d-inline-block text-center rounded-circle bg-info">
                                        <i class="ti-wallet"></i>
                                    </div>
                                    <div class="ml-2 align-self-center">
                                        <h4 class="mb-0 font-weight-light">
                                        <?php 
                                        if ($count_persediaan < 1){
                                            ?>
                                            <h5 class="text-muted mb-0">Persediaan <span class="blue-text"><b>0</b></span></h5>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <h5 class="text-muted mb-0">Persediaan <span class="blue-text"><b><?= $count_persediaan ?></b></span></h5>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div
                                        class="round round-lg text-white d-inline-block text-center rounded-circle bg-warning">
                                        <i class="mdi mdi-cellphone-link"></i></div>
                                    <div class="ml-2 align-self-center">
                                        <h4 class="mb-0 font-weight-light">
                                        <?php 
                                        if ($count_penjualan < 1){
                                            ?>
                                            <h5 class="text-muted mb-0">Penjualan <span class="green-text"><b>0</b></span></h5>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <h5 class="text-muted mb-0">Penjualan <span class="green-text"><b><?= $count_penjualan ?></b></span></h5>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div
                                        class="round round-lg text-white d-inline-block text-center rounded-circle bg-primary">
                                        <i class="mdi mdi-cart-outline"></i></div>
                                    <div class="ml-2 align-self-center">
                                        <h4 class="mb-0 font-weight-light">
                                        <?php 
                                        if ($nom_penjualan < 1){
                                            ?>
                                            <h5 class="text-muted mb-0">Total <span class="green-text"><b>0</b></span></h5>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <h5 class="text-muted mb-0">Total <span class="green-text"><b><?php echo number_format($nom_penjualan); ?></b></span></h5>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div
                                        class="round round-lg text-white d-inline-block text-center rounded-circle bg-primary">
                                        <i class="mdi mdi-cart-outline"></i></div>
                                    <div class="ml-2 align-self-center">
                                        <h4 class="mb-0 font-weight-light">
                                        <?php 
                                        if ($tunai < 1){
                                            ?>
                                            <h5 class="text-muted mb-0">Tunai <span class="green-text"><b>0</b></span></h5>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <h5 class="text-muted mb-0">Tunai <span class="green-text"><b><?php echo number_format($tunai); ?></b></span></h5>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div
                                        class="round round-lg text-white d-inline-block text-center rounded-circle bg-primary">
                                        <i class="mdi mdi-cart-outline"></i></div>
                                    <div class="ml-2 align-self-center">
                                        <h4 class="mb-0 font-weight-light">
                                        <?php 
                                        if ($nontunai < 1){
                                            ?>
                                            <h5 class="text-muted mb-0">NonTunai <span class="green-text"><b>0</b></span></h5>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <h5 class="text-muted mb-0">NonTunai <span class="green-text"><b><?php echo number_format($nontunai); ?></b></span></h5>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    
                </div>
                <hr>
                

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Dasboard</h4>
                        
                        <hr>
                        <div class="table-responsive">
                            <table id="myTable2" class="table table-striped table-bordered display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>ID Menu</th> -->
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <!-- <th>Jumlah Awal</th> -->
                                    <?php
                                    // Add dynamic column headers based on $datacab
                                    if ($datacab) {
                                        foreach ($datacab as $data2) {
                                            $kodecabang = $data2->kodecabang;
                                            echo "<th>$kodecabang</th>";
                                        }
                                        foreach ($datacab as $data2) {
                                            $kodecabang = $data2->kodecabang;
                                            echo "<th>Penjualan $kodecabang</th>";
                                        }
                                    }
                                    ?>

                                    <th>Stock</th>
                                    <th>TerJual</th>
                                    <th>Penjualan</th>
                                    <!-- <th>Tgl Produksi</th>
                                    <th>Kadarluasa</th> -->
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
                                        $tanggal = $data->tanggal;
                                        $jumlah = $data->jumlah;
                                        $kadarluasa = $data->kadarluasa;
                                        $sisa = (float) $data->sisa;
                                        $jual = (float) $data->jual;
                                        $omset = $jual * $harga;
                                        ?>
                                        <tr>
                                            <td><?= $norut ?></td>
                                            <td><b><?= $namamenu ?></b></td>
                                            <td><?php echo number_format($harga); ?></td>
                                            <!-- <td><?= $jumlah ?></td> -->
                                            
                                            <?php
                                            // Output branch values
                                            if ($datacab) {
                                                foreach ($datacab as $data2) {
                                                    $kodecabang = $data2->kodecabang;
                                                    $dynamicValue = isset($data->$kodecabang) ? $data->$kodecabang : '0';
                                                    echo "<td>" . number_format($dynamicValue) . "</td>";
                                                }
                                            }

                                            // Output penjualan values
                                            if ($datacab) {
                                                foreach ($datacab as $data2) {
                                                    $kodecabang = $data2->kodecabang;
                                                    $penjualanValue = isset($data->{"penjualan_$kodecabang"}) ? $data->{"penjualan_$kodecabang"} : '0';
                                                    echo "<td>" . number_format($penjualanValue) . "</td>";
                                                }
                                            }
                                            ?>

                                            <td><?= $sisa ?></td>
                                            <td><?= $jual ?></td>
                                            <td><?= $omset ?></td>
                                            <!-- <td><?= $tanggal ?></td>
                                            <td><?= $kadarluasa ?></td> -->
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                                </tbody>


                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

<!-- sampai kebawah kali ini untuk modals -->


</div>
<!--  -->
<script>
$(document).ready(function() {
    var table = $('#myTable2').DataTable({
        dom: 'Bflrtip',
        buttons: ['excelHtml5'],
        pageLength: 25, // Set default number of rows to display
        drawCallback: function() {
            var api = this.api();
            
            // Debugging: Log the column indexes
            // console.log('Column indexes:', api.columns().indexes().toArray());

            // Calculate totals for each column
            $(api.column(3).footer()).html(
                api.column(3, { page: 'current' }).data().reduce(function(a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0).toFixed(2)
            );
            
            $(api.column(4).footer()).html(
                api.column(4, { page: 'current' }).data().reduce(function(a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0).toFixed(2)
            );
            
            // Loop through all dynamic columns
            var totalColumns = <?php echo json_encode(count($datacab) * 2); ?>;
            for (var i = 0; i < totalColumns; i++) {
                $(api.column(i + 5).footer()).html(
                    api.column(i + 5, { page: 'current' }).data().reduce(function(a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0).toFixed(2)
                );
            }
            
            // Total for Sisa column
            var sisaIndex = totalColumns + 5; // Adjust index for Sisa column
            // console.log('Sisa column index:', sisaIndex); // Debugging: Log the index
            $(api.column(sisaIndex).footer()).html(
                api.column(sisaIndex, { page: 'current' }).data().reduce(function(a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0).toFixed(2)
            );
        }
    });
});
</script>
