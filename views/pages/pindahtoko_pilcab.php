<form method="post" action="<?php echo site_url('Persediaan/pindahtoko'); ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pilih Cabang</h6>
                    </div>
                    <div class="card-body">
                        <div>
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
                        <br>
                        <button class="btn btn-success" type="submit">Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
