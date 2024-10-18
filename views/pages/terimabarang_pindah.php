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

    #loading-screen {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(255, 255, 255, 0.8);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
}

    </style>
</head>
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="container-flex">
        <!-- Hidden form for refreshing data -->
        <form id="refreshForm" method="post" action="<?php echo base_url(); ?>produk/terimabarang">
            <input type="hidden" name="kodecabang" id="refreshKodecabang" value="IntanPayung">
        </form>

        <form id="orderForm" method="post" action="<?php echo base_url(); ?>produk/terimabarang_admin">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- basic table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Terima Barang Pindah ke - <?= $kodecab;?></h4>
                            <hr>
                            <div class="table-responsive">
                                <!-- <table id="mytable" class="table table-striped table-bordered"> -->
                                <table id="myTable2" class="table table-striped table-bordered display">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Menu</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Tgl Produksi</th>
                                            <th>Kadarluasa</th>
                                            <th>Id Distribusi</th>
                                            <th>Cabang</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i = 1;
                                    if ($datamenu) {
                                        foreach ($datamenu as $data) {
                                            $noid = $data->noid;
                                            $norut = $data->norut;
                                            $namamenu = $data->namamenu;
                                            $harga = $data->harga;
                                            $tanggal = $data->tanggal;
                                            $jumlah = $data->jumlah;
                                            $kadarluasa = $data->kadarluasa;
                                            $kodecabang = $data->kodecabang;
                                            $iddist = $data->iddist;
                                    ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <!-- <td><?= $noid ?></td> -->
                                            <td><b><?= $namamenu ?></b></td>
                                            <td><?php echo number_format($harga); ?></td>
                                            <td><?= $jumlah ?></td>
                                            <td><b><?= $tanggal ?></b></td>
                                            <td><?= $kadarluasa ?></td>
                                            <td><?= $iddist ?></td>
                                            <td><?= $kodecabang ?></td>
                                            <td>
                                                <!-- tombol check -->
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm check-btn"
                                                    data-noid="<?= $noid ?>" data-tanggal="<?= $tanggal ?>"
                                                    data-kodecabang="<?= $kodecabang ?>" role="button">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                <!-- tombol check -->
                                                <?php
                                                $aksesUs = "hidden";
                                                $arrayAkses = ['1'];
                                                if (in_array($this->session->userdata('ses_akses'), $arrayAkses)) $aksesUs = "";
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
        </form>
    </div>
</div>


<div id="loading-screen" style="display: none;">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
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
        buttons: ['excelHtml5'],
    });

});

// $(document).on('click', '.check-btn', function() {
//     var noid = $(this).data('noid');
//     var tanggal = $(this).data('tanggal');
//     var kodecabang = $(this).data('kodecabang');
//     var iddist = $(this).data('iddist');

//     $.ajax({
//         url: '<?php echo base_url(); ?>Produk/update_pindahtoko',
//         type: 'POST',
//         data: {
//             noid: noid,
//             tanggal: tanggal,
//             kodecabang: kodecabang
//         },
//         success: function(response) {
//             var data = JSON.parse(response);
//             if (data.status == 'success') {
//                 alert(data.message);
//                 location.reload(); // Refresh the page
//             } else {
//                 alert(data.message);
//             }
//         },
//         error: function(xhr, status, error) {
//             console.log(error);
//         }
//     });
// });

$(document).on('click', '.check-btn', function() {
    var noid = $(this).data('noid');
    var tanggal = $(this).data('tanggal');
    var kodecabang = $(this).data('kodecabang');
    
    // Disable the button to prevent multiple clicks
    $(this).prop('disabled', true);
    
    // Show the loading screen
    $('#loading-screen').show();

    $.ajax({
        url: '<?php echo base_url(); ?>Produk/update_pindahtoko',
        type: 'POST',
        data: {
            noid: noid,
            tanggal: tanggal,
            kodecabang: kodecabang
        },
        success: function(response) {
            var data = JSON.parse(response);
            if (data.status == 'success') {
                alert(data.message);
                location.reload(); // Refresh the page
            } else {
                alert(data.message);
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        },
        complete: function() {
            // Hide the loading screen
            $('#loading-screen').hide();
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Function to show alert
    function showAlert(type, message) {
        alert(type + ": " + message);
    }

    // Show success or error message based on flashdata
    <?php if ($this->session->flashdata('success_message')): ?>
    showAlert('success', '<?php echo $this->session->flashdata('success_message'); ?>');
    <?php endif; ?>
    <?php if ($this->session->flashdata('error_message')): ?>
    showAlert('error', '<?php echo $this->session->flashdata('error_message'); ?>');
    <?php endif; ?>

});

</script>
