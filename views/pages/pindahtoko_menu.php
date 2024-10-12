<!-- datatable css -->
<link href="<?php echo base_url(); ?>assets/dataTable/DataTables-1.10.21/css/jquery.dataTables.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/dataTable/Buttons-1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">

<!-- JS script -->
<script src="<?php echo base_url(); ?>assets/js/jquery-341.js"></script>
<script src="<?php echo base_url(); ?>assets/dataTable/DataTables-1.10.21/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dataTable/Buttons-1.6.2/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/buttons.html5.min.js"></script>
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

<div class="page-wrapper">
    <div class="container-flex">
        <form method="post" action="<?php echo base_url(); ?>Persediaan/pindahtoko_saved">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pindah Stok Cabang</h4>
                            <hr>
                            <div class="table-responsive">
                                <table id="myTable2" class="table table-striped table-bordered display">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Menu</th>
                                            <th>Nama Menu</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Cabang</th>
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
                                                $jumlah = $data->jumlah;
                                                $kodecabang = $data->kodecabang;
                                                $tanggal = $data->tanggal;
                                                $iddist = $data->iddist;
                                        ?>
                                            <tr>
                                                <td><?= $norut ?></td>
                                                <td><?= $noid ?></td>
                                                <td><?= $namamenu ?></td>
                                                <td><?php echo number_format($harga); ?></td>
                                                <td><?= $jumlah ?></td>
                                                <td><?= $kodecabang ?></td>
                                                <td>
                                                <input type="hidden" name="noid[]" value="<?= $noid ?>">
                                                <input type="hidden" name="tanggal[]" value="<?= $tanggal ?>">
                                                <input type="hidden" name="kodecabang[]" value="<?= $kodecabang ?>">
                                                <input type="hidden" name="iddist[]" value="<?= $iddist ?>">
                                                    <span id="jumlah-<?= $noid ?>">0</span> <!-- Display jumlah -->
                                                    <input type="hidden" name="jumlah[<?= $noid ?>]" value="0" id="input-jumlah-<?= $noid ?>"> <!-- Hidden input to store jumlah value -->
                                                    <input type="hidden" name="harga[<?= $noid ?>]" value="<?= $harga ?>" id="input-harga-<?= $noid ?>"> <!-- Hidden input for harga value -->
                                                    <input type="hidden" name="max-jumlah[<?= $noid ?>]" value="<?= $jumlah ?>"> <!-- Hidden input for max jumlah value -->
                                                    <br>
                                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm tambah-btn" data-noid="<?= $noid ?>" role="button"><i class="fas fa-plus"></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <div class="form-group">
                                    <select class="form-control" name="namacabang" id="namacabang" required>
                                        <option value="" disabled selected>Pilih Cabang</option>
                                        <?php
                                        if ($datacab) {
                                            foreach ($datacab as $data2) {
                                                $kdcab = $data2->kodecabang;
                                                $namacabang = $data2->namacabang;
                                                echo "<option value='$kdcab'>$namacabang</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-danger">Pindahkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#myTable2').DataTable({
        dom: 'Bflrtip',
        buttons: ['excelHtml5'],
    });

    $('.tambah-btn').click(function() {
        var noid = $(this).data('noid');
        var jumlahElement = $('#jumlah-' + noid);
        var inputJumlahElement = $('#input-jumlah-' + noid);
        var maxJumlah = parseInt($('input[name="max-jumlah[' + noid + ']"]').val());
        var jumlah = parseInt(jumlahElement.text());
        if (jumlah < maxJumlah) {
            jumlah++;
            jumlahElement.text(jumlah);
            inputJumlahElement.val(jumlah);
            console.log('Updated Value for ' + noid + ': ' + jumlah);
        }
    });
});
</script>
