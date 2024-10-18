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
                        
                        <h4 class="card-title">Orderan Aktiv Detail</h4> 
                        <a href="<?php echo site_url('persediaan/orderaktiv/'); ?>" class="btn btn-primary btn-sm" role="button">Back</a>      
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
                                        <th>Id Menu</th>
                                        <th>Nama Menu</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>TotalHarga</th>
                                        <?php
                                                $aksesUs = "hidden";
                                                $arrayAkses = ['1'];
                                                if (in_array($this->session->userdata('ses_akses'), $arrayAkses)) $aksesUs = "";
                                                ?>
                                        <th <?= $aksesUs ?>>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if ($datamenu) {
                                        foreach ($datamenu as $data) {
                                            $id_penjualan = $data->id_penjualan;
                                            $tanggal_produksi = $data->tanggal_produksi;
                                            $tanggal_jual = $data->tanggal_jual;
                                            $jumlah = $data->jumlah;
                                            $harga = $data->harga;
                                            $totalharga = $data->totalharga;
                                            $statusjual = $data->statusjual;
                                            $kodecabang = $data->kodecabang;
                                            $noid = $data->noid;
                                            $namamenu = $data->namamenu;
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
                                            <td><?= $noid ?></td>
                                            <td><b><?= $namamenu ?></b></td>
                                            <td><b><?= $jumlah ?></b></td>
                                            <td><?php echo number_format($harga); ?></td>
                                            <td><?php echo number_format($totalharga); ?></td>
                                            <td <?= $aksesUs ?>>
                                            <?php 
                                            if($statusjual == '1'){
                                                ?>
                                                <a href="" class="btn btn-danger btn-sm" role="button"
                                                data-toggle="modal" data-target="#deletecab<?= $noid ?>"
                                                <?= $aksesUs ?>>Delete</a>
                                                <div id="deletecab<?= $noid ?>" class="modal fade" tabindex="-1"
                                                    role="dialog" aria-labelledby="warning-header-modalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header modal-colored-header bg-warning">
                                                                <h4 class="modal-title text-white"
                                                                    id="warning-header-modalLabel">
                                                                    Yakin di hapus?
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="mt-0"></h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light"
                                                                    data-dismiss="modal">Close</button>
                                                                <a href="<?php echo site_url('persediaan/delete_order_detail_satuan/' . $noid. '/' .$tanggal_produksi. '/' .$id_penjualan. '/' .$jumlah. '/' .$kodecabang); ?>"
                                                                    class="btn btn-secondary btn-sm"
                                                                    role="button">Delete</a>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
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
                        <hr>
                        <div class="d-flex justify-content-end">
                        <a href="<?php echo site_url('persediaan/order_done/' . $id_penjualan); ?>" class="btn btn-success btn-sm" role="button">Check-Out</a>
                        &nbsp;
                        <a href="<?php echo site_url('persediaan/print_order/' . $id_penjualan); ?>" class="btn btn-primary btn-sm" role="button">Invoice</a>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                        <a href="<?php echo site_url('persediaan/delete_order_detail_all/' . $id_penjualan); ?>" class="btn btn-danger btn-sm" role="button" <?= $aksesUs ?>>Delete ALL</a>
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
        $('#myTable').DataTable({
            dom: 'Bflrtip',
            buttons: [
                'excelHtml5',
            ]
        });

    });
</script>
