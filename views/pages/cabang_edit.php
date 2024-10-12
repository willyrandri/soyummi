
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
                            <form class="form-horizontal" method='POST' action='<?php echo base_url(); ?>parameter/posteditcabang' enctype='multipart/form-data'>
                                 <?php 
                                //  var_dump($data_cabang);die();
                                 foreach($data_cabang as $u){ ?>
                                    <h4 class="card-title">Edit</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Kode Cabang</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" class="form-control" id="ktr" name="kodecabang" value="<?php echo $u->kodecabang ?>" >
                                            <input type="text" class="form-control" id="idktr" name="idkodecabang" value="<?php echo $u->kodecabang ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama Cabang</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="idpsv" name="namacabang" value="<?php echo $u->namacabang ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="idpsv" name="alamat" value="<?php echo $u->alamat ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Kota</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="idpsv" name="kota" value="<?php echo $u->kota ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Kantor Induk</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="idpsv" name="induk" value="<?php echo $u->induk ?>" required>
                                        </div>
                                    </div>
                                    <!--  -->
                                </div>
                                <hr>
                                
                        <?php } ?>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                        <a type="button" href="<?php echo base_url(); ?>parameter/cabang" class="btn btn-dark waves-effect waves-light">Cancel</a>
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
   <!-- script untuk terbilang -->