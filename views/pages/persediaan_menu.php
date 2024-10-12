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

                            <h4 class="card-title">Stock Produk - <?= $kodecab;?></h4>
                            <br>
                            <?php
                        $ses_akses = $this->session->userdata('ses_akses');
                        if ($ses_akses =='1'){
                             if ($datacab) {
                                foreach ($datacab as $data2) {
                                      $kdcab = $data2->kodecabang;
                                      $namacabang = $data2->namacabang;
                                    $isChecked = ($kdcab == $kodecab) ? 'checked' : '';
                                      ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kodecabang" id="cabang-<?= $kdcab ?>"
                                    value="<?= $kdcab ?>" <?= htmlspecialchars($isChecked) ?> required>
                                <label class="form-check-label" for="cabang-<?= $kdcab ?>">
                                    <?= $namacabang ?>
                                </label>

                            </div>

                            <?php 
                                     }
                                     ?>
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" role="button"
                                onclick="refreshData();">Refresh</a>
                            <?php
                                }
                             }
                         else {};
                        ?>
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
                                            $tanggal = $data->tanggal;
                                            $jumlah = $data->jumlah;
                                            $kadarluasa = $data->kadarluasa;
                                            $kodecabang = $data->kodecabang;
                                    ?>
                                        <tr>
                                            <td><?= $norut ?></td>
                                            <!-- <td><?= $noid ?></td> -->
                                            <td><b><?= $namamenu ?></b></td>
                                            <td><?php echo number_format($harga); ?></td>
                                            <td><?= $jumlah ?></td>
                                            <td><b><?= $tanggal ?></b></td>
                                            <td><?= $kadarluasa ?></td>
                                            <td>
                                                <!-- tombol jual -->

                                                <span id="jumlah-<?= $noid ?>-<?= $tanggal ?>">0</span>
                                                <input type="hidden" name="jumlahawal[<?= $noid ?>][<?= $tanggal ?>]" value="<?= $jumlah ?>">

                                                <input type="hidden" name="jumlah[<?= $noid ?>][<?= $tanggal ?>]"
                                                    value="0" id="input-jumlah-<?= $noid ?>-<?= $tanggal ?>">
                                                <input type="hidden" name="harga[<?= $noid ?>][<?= $tanggal ?>]"
                                                    value="<?= $harga ?>" id="input-harga-<?= $noid ?>-<?= $tanggal ?>">

                                                <input type="hidden" name="kdcab[<?= $noid ?>][<?= $tanggal ?>]"
                                                    value="<?= $harga ?>" id="input-kdcab-<?= $noid ?>-<?= $tanggal ?>">

                                                <br>
                                                <br>
                                                <a href="javascript:void(0);" class="btn btn-warning btn-sm kurang-btn"
                                                    data-noid="<?= $noid ?>" data-tanggal="<?= $tanggal ?>"
                                                    data-jumlah="<?= $jumlah ?>" role="button"><i
                                                        class="fas fa-minus"></i></a>

                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm tambah-btn"
                                                    data-noid="<?= $noid ?>" data-tanggal="<?= $tanggal ?>"
                                                    data-jumlah="<?= $jumlah ?>" role="button"><i
                                                        class="fas fa-plus"></i></a>
                                                <!-- tombol jual -->
                                                <?php
                                                $aksesUs = "hidden";
                                                $arrayAkses = ['1'];
                                                if (in_array($this->session->userdata('ses_akses'), $arrayAkses)) $aksesUs = "";
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
                                                                <h5 class="mt-0">Data jika salah input ulang di produksi
                                                                    !!</h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light"
                                                                    data-dismiss="modal">Close</button>
                                                                <a href="<?php echo site_url('persediaan/persediaan_delete/' . $noid. '/' .$tanggal. '/' .$kodecabang); ?>"
                                                                    class="btn btn-secondary btn-sm"
                                                                    role="button">Delete</a>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
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
                                <!-- <button type="submit" class="btn btn-success">SELL</button> -->
                                <input type="radio" id="tun" name="carabayar" value="Tunai">
                                 <label for="tun">Tunai</label>
                                 <br>&nbsp;&nbsp;
                                 <input type="radio" id="nontun" name="carabayar" value="nonTunai" checked>
                                 <label for="nontun">Non-Tunai</label>
                                 <br>
                            </div>
                            <div class="d-flex justify-content-end">
                                
                                <a href="" class="btn btn-success btn-sm" role="button" data-toggle="modal"
                                    data-target="#butonsell<?= $noid ?>">SELL</a>
                                <div id="butonsell<?= $noid ?>" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="success-header-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header modal-colored-header bg-success">
                                                <h4 class="modal-title text-white" id="success-header-modalLabel">
                                                    Tambahkan Catatan / Diskon, *jika ada
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="fname"
                                                        class="col-sm-3 text-right control-label col-form-label">Note</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name='catatan'
                                                            id="jenis" placeholder="Catatan">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="fname"
                                                        class="col-sm-3 text-right control-label col-form-label">Discount</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" name='diskon'
                                                            id="jenis" placeholder="Discount dalam rupiah">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">SELL</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

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
        buttons: ['excelHtml5'],
    });

    $('.tambah-btn').click(function() {
        var noid = $(this).data('noid');
        var tanggal = $(this).data('tanggal'); // Get tanggal from data attribute
        var maxJumlah = $(this).data('jumlah'); // Get max jumlah from data attribute
        var jumlahElement = $('#jumlah-' + noid + '-' + tanggal);
        var inputJumlahElement = $('#input-jumlah-' + noid + '-' + tanggal);
        var jumlah = parseInt(jumlahElement.text());
        if (jumlah < maxJumlah) { // Check if jumlah is less than maxJumlah
            jumlah++;
            jumlahElement.text(jumlah);
            inputJumlahElement.val(jumlah); // Update hidden input value
            console.log('Updated Value for ' + noid + ' on ' + tanggal + ': ' + jumlah);
        }
    });


    $('.kurang-btn').click(function() {
        var noid = $(this).data('noid');
        var tanggal = $(this).data('tanggal'); // Get tanggal from data attribute
        var jumlahElement = $('#jumlah-' + noid + '-' + tanggal);
        var inputJumlahElement = $('#input-jumlah-' + noid + '-' + tanggal);
        var jumlah = parseInt(jumlahElement.text());
        if (jumlah > 0) {
            jumlah--;
            jumlahElement.text(jumlah);
            inputJumlahElement.val(jumlah); // Update hidden input value
            console.log('Updated Value for ' + noid + ' on ' + tanggal + ': ' + jumlah);
        }
    });



    // Remove the form submit handler or ensure it correctly submits the form
    $('form').off('submit').on('submit', function(event) {
        // You may log the form data for debugging if needed
        console.log('Form Data:', $(this).serialize());
        // Uncomment the line below to actually submit the form if needed
        // this.submit();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Function to show alert
    function showAlert(type, message) {
        var alertClass = type === 'success' ? 'alert-success' : 'alert-error';
        var alertElement = document.createElement('div');
        alertElement.className = 'alert ' + alertClass;
        alertElement.innerText = message;

        document.body.appendChild(alertElement);

        // Remove alert after 2 seconds
        setTimeout(function() {
            alertElement.classList.add('fade-out');
            setTimeout(function() {
                document.body.removeChild(alertElement);
            }, 500); // Match with CSS transition time
        }, 1500);
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

<script>
function refreshData() {
    // Get the selected kodecabang value
    var selectedKodecabang = document.querySelector('input[name="kodecabang"]:checked').value;
    // Set the value in the hidden refresh form
    document.getElementById('refreshKodecabang').value = selectedKodecabang;
    // Submit the refresh form
    document.getElementById('refreshForm').submit();
}

// Submit the form via AJAX

$('form').on('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    var formData = $(this).serialize(); // Serialize form data

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>persediaan/buat_orderan', // URL to handle form submission
        data: formData,
        success: function(response) {
            // Redirect to the review page
            window.location.href =
                '<?php echo base_url(); ?>persediaan/review_orderan'; // URL to review the order
        },
        error: function(xhr, status, error) {
            console.error('Form submission failed:', error);
            // Optionally show an error message to the user
        }
    });
});
</script>