
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
                            <form class="form-horizontal" method='POST' action='<?php echo base_url(); ?>parameter/posteditmenu' enctype='multipart/form-data'>
                                 <?php 
                                //  var_dump($data_cabang);die();
                                 foreach($menuedit as $u){ ?>
                                    <h4 class="card-title">Edit</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">id</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name='noid' id="noid" value=<?php echo $u->noid; ?> readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama Menu</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="namamenu" name="namamenu" value="<?php echo $u->namamenu ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Harga</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $u->harga ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hari kadarluasa</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="kadarluasa" name="kadarluasa" value="<?php echo $u->kadarluasa ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nomor Urut</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="norut" name="norut" value="<?php echo $u->norut ?>" required>
                                        </div>
                                    </div>
                                    <!--  -->
                                </div>
                                <hr>
                                
                        <?php } ?>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                        <a type="button" href="<?php echo base_url(); ?>parameter/menu" class="btn btn-dark waves-effect waves-light">Cancel</a>
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