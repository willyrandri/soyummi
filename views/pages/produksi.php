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
    <form method="post" action="<?php echo base_url(); ?>produk/save_produksi">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Produksi</h4>
                        <hr>
                        <div class="table-responsive">
                            <!-- <table id="mytable" class="table table-striped table-bordered"> -->
                            <table id="myTable2" class="table table-striped table-bordered display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Menu</th>
                                        <th>Nama Menu</th>
                                        <th>Harga</th>
                                        <th>Action Produk</th>
                                        <th>Jumlah</th>
                                        <th>Hari Kadarluasa</th>
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
                                            <td>
                                                <!-- Adding data-noid attribute to identify rows -->
                                                <a href="<?php echo site_url('parameter/menu_edit/' . $noid); ?>" class="btn btn-secondary btn-sm" role="button">Edit</a>
                                            </td>
                                            <td>
                                            <input type="text" class="jumlah-input" id="jumlah-<?= $noid ?>" value="0">  
                                            <input type="hidden" name="jumlah[<?= $noid ?>]" value="0" id="input-jumlah-<?= $noid ?>"> 

                                                <input type="hidden" name="harga[<?= $noid ?>]" value="<?= $harga ?>" id="input-harga-<?= $noid ?>"> <!-- Hidden input for harga value -->
                                                <br>
                                                <a href="javascript:void(0);" class="btn btn-warning btn-sm kurang-btn" data-noid="<?= $noid ?>" role="button"><i class="fas fa-minus"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm tambah-btn" data-noid="<?= $noid ?>" role="button"><i class="fas fa-plus"></i></a>
                                            </td>
                                            <td>
                                                <span id="kadarluasa-<?= $noid ?>"><?= $kadarluasa ?></span> <!-- Display kadarluasa from DB -->
                                                <input type="hidden" name="kadarluasa[<?= $noid ?>]" value="<?= $kadarluasa ?>" id="kadarluasa-jumlah-<?= $noid ?>"> <!-- Hidden input to store kadarluasa value -->
                                                <br>
                                                <a href="javascript:void(0);" class="btn btn-warning btn-sm kadar-kurang-btn" data-noid="<?= $noid ?>" role="button"><i class="fas fa-minus"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm kadar-tambah-btn" data-noid="<?= $noid ?>" role="button"><i class="fas fa-plus"></i></a>
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
                            <div class="form-group">
                                <label for="tanggal">Pilih tanggal jika bukan hari ini:</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control">
                            </div>
                        <button type="submit" class="btn btn-danger">Input Produksi</button>
                            <?php
                            if ($datamenu) {
                                foreach ($datamenu as $data) {
                                    $noid = $data->noid;
                            ?>
                            <?php
                                }
                            }
                            ?>
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

    // Attach change event to inputs with class 'jumlah-input'
        $('.jumlah-input').on('change', function() {
            const noid = this.id.split('-')[1]; // Extract noid from the input's ID
            updateHiddenInput(noid);
        });

    function updateHiddenInput(noid) {
        var jumlahElement = $('#jumlah-' + noid);
        var inputJumlahElement = $('#input-jumlah-' + noid);
        var jumlah = parseInt(jumlahElement.val()) || 0; // Default to 0 if NaN
        inputJumlahElement.val(jumlah); // Update hidden input value
    }


    $('.tambah-btn').click(function() {
        var noid = $(this).data('noid');
        var jumlahElement = $('#jumlah-' + noid);
        var inputJumlahElement = $('#input-jumlah-' + noid);
        var jumlah = parseInt(jumlahElement.val());
        jumlah++;
        jumlahElement.val(jumlah); // Update text input value
        inputJumlahElement.val(jumlah); // Update hidden input value
        // console.log('Updated Value for ' + noid + ': ' + jumlah);
    });

    $('.kurang-btn').click(function() {
        var noid = $(this).data('noid');
        var jumlahElement = $('#jumlah-' + noid);
        var inputJumlahElement = $('#input-jumlah-' + noid);
        var jumlah = parseInt(jumlahElement.val());
        if (jumlah > 0) {
            jumlah--;
            jumlahElement.val(jumlah); // Update text input value
            inputJumlahElement.val(jumlah); // Update hidden input value
            // console.log('Updated Value for ' + noid + ': ' + jumlah);
        }
    });

    $('.kadar-tambah-btn').click(function() {
        var noid = $(this).data('noid');
        console.log('Kadarluasa Tambah Button Clicked for noid:', noid);
        
        var kadarluasaElement = $('#kadarluasa-' + noid); // Target the <span> element
        var jumlahElement = $('#kadarluasa-jumlah-' + noid); // Target the hidden input
        var currentKadarluasa = parseInt(kadarluasaElement.text()); // Get value from <span>
        // console.log('Current Kadarluasa Value:', currentKadarluasa);

        if (!isNaN(currentKadarluasa)) {
            currentKadarluasa++;
            kadarluasaElement.text(currentKadarluasa); // Update <span> with new value
            jumlahElement.val(currentKadarluasa); // Update hidden input with new value
            // console.log('Updated Kadarluasa Value for ' + noid + ': ' + currentKadarluasa);
        } else {
            // console.error('Failed to parse Kadarluasa value');
        }
    });

    $('.kadar-kurang-btn').click(function() {
        var noid = $(this).data('noid');
        // console.log('Kadarluasa Kurang Button Clicked for noid:', noid);
        
        var kadarluasaElement = $('#kadarluasa-' + noid); // Target the <span> element
        var jumlahElement = $('#kadarluasa-jumlah-' + noid); // Target the hidden input
        var currentKadarluasa = parseInt(kadarluasaElement.text()); // Get value from <span>
        // console.log('Current Kadarluasa Value:', currentKadarluasa);

        if (!isNaN(currentKadarluasa) && currentKadarluasa > 0) {
            currentKadarluasa--;
            kadarluasaElement.text(currentKadarluasa); // Update <span> with new value
            jumlahElement.val(currentKadarluasa); // Update hidden input with new value
            // console.log('Updated Kadarluasa Value for ' + noid + ': ' + currentKadarluasa);
        } else {
            // console.error('Failed to parse Kadarluasa value or value is already zero');
        }
    });


    // Remove the form submit handler or ensure it correctly submits the form
    $('form').off('submit').on('submit', function(event) {
        // You may log the form data for debugging if needed
        // console.log('Form Data:', $(this).serialize());
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

