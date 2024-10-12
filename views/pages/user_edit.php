
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body"> 
                            <form class="form-horizontal" method='POST' action='<?php echo base_url(); ?>parameter/posteditpejabat' enctype='multipart/form-data'>
                                 <?php foreach($editusers as $u){ ?>
                                    <h4 class="card-title">Edit</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nik</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" class="form-control" id="ktr" name="nik" value="<?php echo $u->nik ?>" >
                                            <input type="text" class="form-control" id="idktr" name="idnik" value="<?php echo $u->nik ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="idpsv" name="nama" value="<?php echo $u->nama ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Reset Password?</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name='pass' id="jenis" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="hiddenInput form-group row">
                                            <label for="inputField" class="col-sm-3 text-right control-label col-form-label">Pilih Level User</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='leveluser' data-toggle="tooltip" data-placement="top" title="" data-original-title="pilih cabang" required>
                                                        <option selected ></option>
                                                        <?php
                                                        if ($data_akses) {
                                                            foreach ($data_akses as $data2) {
                                                                $cab = $data2->level;
                                                                $nama = $data2->level_desc;
                                                        ?>
                                                        <option value =<?= $cab ?> ><?= $cab ?> - <?= $nama ?></option>
                                                        <?php 
                                                                } 
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                        </div>

                                    <div class="hiddenInput form-group row">
                                            <label for="inputField" class="col-sm-3 text-right control-label col-form-label">Pilih Cabang</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='cabang' data-toggle="tooltip" data-placement="top" title="" data-original-title="pilih jenis" required>
                                                        <option selected ></option>
                                                        <?php
                                                        if ($data_cabang) {
                                                            foreach ($data_cabang as $data3) {
                                                                $kdcab = $data3->kodecabang;
                                                                $namacab = $data3->namacabang;
                                                        ?>
                                                        <option value =<?= $kdcab ?> ><?= $kdcab ?> - <?= $namacab ?></option>
                                                        <?php 
                                                                } 
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                        </div>
                                    <!--  -->
                                </div>
                                <hr>
                                
                        <?php } ?>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                        <a type="button" href="<?php echo base_url(); ?>parameter/user" class="btn btn-dark waves-effect waves-light">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

            <!-- script untuk terbilang -->
   <script>
        Math.fmod = function (a,b) { return Number((a - (Math.floor(a / b) * b)).toPrecision(8)); };
        function terbilang(nilai) {
            const huruf = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
            let temp = "";
            if (nilai < 12) {
                temp = " "+ huruf[nilai];
            } else if (nilai <20) {
                temp = terbilang(nilai - 10)+ " Belas";
            } else if (nilai < 100) {
                temp = terbilang(Math.floor(nilai/10))+" Puluh"+ terbilang(nilai % 10);
            } else if (nilai < 200) {
                temp = " Seratus" + terbilang(nilai - 100);
            } else if (nilai < 1000) {
                temp = terbilang(Math.floor(nilai/100)) + " Ratus" + terbilang(nilai % 100);
            } else if (nilai < 2000) {
                temp = " Seribu" + terbilang(nilai - 1000);
            } else if (nilai < 1000000) {
                temp = terbilang(Math.floor(nilai/1000)) + " Ribu" + terbilang(nilai % 1000);
            } else if (nilai < 1000000000) {
                temp = terbilang(Math.floor(nilai/1000000)) + " Juta" + terbilang(nilai % 1000000);
            } else if (nilai < 1000000000000) {
                temp = terbilang(Math.floor(nilai/1000000000)) + " Milyar" + terbilang(Math.fmod(nilai,1000000000));
            } else if (nilai < 1000000000000000) {
                temp = terbilang(Math.floor(nilai/1000000000000)) + " Trilyun" + terbilang(Math.fmod(nilai,1000000000000));
            }     
            return temp;
        }

        var input = document.getElementById("nominal");
        input.addEventListener("keyup", function(event) {
            // console.log(event.key);
        // if (event.key === "Enter") {

            event.preventDefault();
            const nilai = document.getElementById("nominal").value;
            let hasil = terbilang(nilai);
            document.getElementById("hasil").value = hasil;
        // }
        });
    </script>
   <!-- script untuk terbilang -->