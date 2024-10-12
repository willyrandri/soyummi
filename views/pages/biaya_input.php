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
                            <form id="dynamic-form" class="form-horizontal" role="form" method='POST' action='<?php echo base_url(); ?>biaya/post_biaya' enctype='multipart/form-data'>
                                    <h4 class="card-title">Biaya Operasinal</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Keterangan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name='keterangan' id="keterangan" placeholder="keterangan" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nominal" class="col-sm-3 text-right control-label col-form-label">Nominal</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name='nominal' id="nominal" placeholder="Nominal" required>
                                        </div>
                                    </div>
                                </div>      
                                <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">      
                                        <!-- Save Button -->
                                        <button type="submit" class="btn btn-info waves-effect waves-light text-right">Save</button>
                                        <!-- <button type="submit" class="btn btn-info waves-effect waves-light">Save</button> -->
                                        <a type="button" href="<?php echo base_url(); ?>biaya/biaya_menu" class="btn btn-dark waves-effect waves-light">Cancel</a>
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

