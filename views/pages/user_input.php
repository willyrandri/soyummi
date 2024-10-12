<style>
    /* Optional styling for better presentation */
    #hiddenInput {
      display: none;
    }
</style>
      <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Tambah User</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Tambah User</li>
                    </ol>
                </div>
            </div> -->
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body"> 
                            <form id="dynamic-form" class="form-horizontal" role="form" method='POST' action='<?php echo base_url(); ?>parameter/post_user' enctype='multipart/form-data'>
                                    <h4 class="card-title">Tambahkan User</h4>
                                    <!-- <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nomor</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name='noid' id="fname" value=<?php echo $nourut_nota; ?> readonly>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">NIK</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" name='nik' id="jenis" placeholder="username login" required pattern="^\S+$" title="Spaces are not allowed">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name='nama' id="jenis" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name='pass' id="jenis" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputField" class="col-sm-3 text-right control-label col-form-label">Pilih Level User</label>
                                        <div class="col-sm-9">
                                            <div class="radio-group">
                                                <?php
                                                if ($data_akses) {
                                                    foreach ($data_akses as $data2) {
                                                        $cab = $data2->level;
                                                        $nama = $data2->level_desc;
                                                ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="leveluser" id="leveluser<?= $cab ?>" value="<?= $cab ?>" required>
                                                    <label class="form-check-label" for="leveluser<?= $cab ?>">
                                                        <?= $cab ?> - <?= $nama ?>
                                                    </label>
                                                </div>
                                                <?php 
                                                    } 
                                                } 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="inputField" class="col-sm-3 text-right control-label col-form-label">Pilih Cabang</label>
                                        <div class="col-sm-9">
                                            <div class="radio-group">
                                                <?php
                                                if ($data_cabang) {
                                                    foreach ($data_cabang as $data3) {
                                                        $kdcab = $data3->kodecabang;
                                                        $namacab = $data3->namacabang;
                                                ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cabang" id="cabang<?= $kdcab ?>" value="<?= $kdcab ?>" required>
                                                    <label class="form-check-label" for="cabang<?= $kdcab ?>">
                                                        <?= $kdcab ?> - <?= $namacab ?>
                                                    </label>
                                                </div>
                                                <?php 
                                                    } 
                                                } 
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <!-- perubahan 24 jan -->
                                    <!-- perubahan 24 jan -->
                                </div>      
                                <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">      
                                        <!-- Save Button -->
                                        <button type="submit" class="btn btn-info waves-effect waves-light text-right">Save</button>
                                        <!-- <button type="submit" class="btn btn-info waves-effect waves-light">Save</button> -->
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
   
</script>