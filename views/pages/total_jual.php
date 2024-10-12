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
                
                

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <?php
                        $dates = array();
                        if ($datamenu) {
                            foreach ($datamenu as $datt) {
                                $dates[] = $datt->tanggal;
                            }
                        }

                        if (!empty($dates)) {
                            $minDate = min($dates);
                            $maxDate = max($dates);

                            // echo "Min Date: " . $minDate . "<br>";
                            // echo "Max Date: " . $maxDate;
                        }
                        ?>
                        <h4 class="card-title">Rekap Penjualan</h4>
                        
                        <hr>
                        <div class="table-responsive">
                            <table id="myTable2" class="table table-striped table-bordered display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>ID Menu</th> -->
                                    <th>Nama Menu</th>
                                    <!-- <th>Jumlah Awal</th> -->
                                    <?php
                                    // Add dynamic column headers based on $datacab
                                    if ($datacab) {
                                        foreach ($datacab as $data2) {
                                            $kodecabang = $data2->kodecabang;
                                            echo "<th>Penjualan $kodecabang</th>";
                                        }
                                    }
                                    ?>
                                    <th>TerJual</th>
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
                                            <?php
                                            // Output penjualan values
                                            if ($datacab) {
                                                foreach ($datacab as $data2) {
                                                    $kodecabang = $data2->kodecabang;
                                                    $penjualanValue = isset($data->{"penjualan_$kodecabang"}) ? $data->{"penjualan_$kodecabang"} : '0';
                                                    echo "<td>" . number_format($penjualanValue) . "</td>";
                                                }
                                            }
                                            ?>
                                            <td><?= $jual ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                                </tbody>


                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
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
<script>
$(document).ready(function() {
    var table = $('#myTable2').DataTable({
        dom: 'Bflrtip',
        buttons: ['excelHtml5'],
        pageLength: 25,
        drawCallback: function() {
            var api = this.api();
            var numCols = api.columns().header().length;

            // Calculate totals for each column
            for (var i = 2; i < numCols; i++) {
                var total = api.column(i, { page: 'current' }).data().reduce(function(a, b) {
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
                    return x + y;
                }, 0);
                $(api.column(i).footer()).html(total.toFixed(2));
            }
        }
    });
});
</script>
