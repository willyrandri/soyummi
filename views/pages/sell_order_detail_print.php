<style>
    .image-container {
      display: flex !important;
      justify-content: space-between !important;
    }

    .image-container img {
      max-width: 48% !important; /* Adjust as needed */
    }

/* Define CSS for printing */
@media print {
  body * {
    visibility: hidden;
  }

  .printarea, .printarea * {
    visibility: visible;
  }

  /* Set margin to 0 for the printed page */
  @page {
    margin: 0;
  }

  /* Set margins for the .printarea class */
  .printarea {
    margin: 10;
    padding: 20;
    width: 95%;
    height: 80%;
    position: absolute;
    top: 5;
    left: 10;
    right: 10;
  }
}
  </style>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body ">
                            <div class="printarea">
                                <div class="row">
                                    <?php foreach($datamain as $u){ ?>
                                    <div class="col-6">
                                        <h3> &nbsp;<b class="text-danger">INVOICE</b></h3>
                                    </div> 
                                    <div class="col-6" style="text-align:right">
                                        <img src="<?php echo base_url(); ?>/dist/images/logo.jpg" alt="logo" width="35" />
                                    </div> 
                                </div>
                                <hr>
                                <!-- ISI -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-center text-center">
                                            <address>
                                            <?php
                                            
                                                ?>
                                            <h6> &nbsp;<b class="text-primary">SO YUMMUEH BABY FOOD</b></h6><?php
                                            
                                            ?>   
                                            ID : <?php echo $u->id_penjualan ?> 
                                            <br>
                                            <?php 
                                            $tanggal2 = date("d F Y", strtotime($u->tanggal_jual));
                                            echo $tanggal2; 
                                            ?>
                                            </address>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <!--  -->
                                
                                    <div class="row">
                                        <div class="col-12">
                                            <label> &nbsp; <h4>Detail Pemesanan :</h4></label>
                                        </div>
                                    </div>
                                    <div class="table-responsive table table-bordered">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Nama Menu</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>TotalHarga</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $i = 1;
                                            if ($datamenu) {
                                                foreach ($datamenu as $data) {
                                                    $id_penjualan = $data->id_penjualan;
                                                    $tanggal_produksi = $data->tanggal_produksi;
                                                    $tanggal_jual = $data->tanggal_jual;
                                                    $jumlah = $data->jumlah;
                                                    $harga = $data->harga;
                                                    $totalharga = $data->totalharga;
                                                    $statusjual = $data->statusjual;
                                                    $kodecabang = $data->kodecabang;
                                                    $noid = $data->noid;
                                                    $namamenu = $data->namamenu;
                                            ?>
                                            <tbody>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $namamenu ?></td>
                                                <td><?php echo number_format($harga,2,',','.') ?></td>
                                                <td><b><?= $jumlah ?></b></td>
                                                <td><?php echo number_format($totalharga,2,',','.') ?></td>
                                            </tr>
                                            </tbody>
                                            <?php 
                                                }
                                            } 
                                            ?>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                    <!-- END OF ISI -->
                                    <?php foreach($datamain as $x){ 
                                        $tharga = $x->totalharga;
                                        $tdiskon = $x->diskon;
                                        $tbayar = (($x->totalharga)-($x->diskon));
                                        ?>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-7">
                                        </div>
                                        <div class="col-5" style="text-align:right">
                                            <p><?php echo "Total Harga : ".number_format($tharga,0,',','.'); ?></p>
                                            <p><?php echo "Discount : ".number_format($tdiskon,0,',','.'); ?></p>
                                            <p><b><?php echo "Total Bayar : ".number_format($tbayar,0,',','.');?></b></p>
                                            <br>
                                            <p>* invoice ini dicetak digital</p>
                                            <br>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                 <?php } ?>
                                 
                                 
                            </div>
                        <div class="text-center">
                            <a href="<?php echo base_url(); ?>persediaan/orderaktiv" class="btn btn-lg btn-outline-primary" role="button">Back</a>
                            <button onclick="window.print()" id="print" class="btn btn-lg btn-outline-success" type="button"><span><i class="fa fa-print"></i> Print</span> </button>
                            <!-- <a href="<?php echo site_url('nota/nota_input_coa_pinbuk_pny/' . $noidx); ?>" class="btn btn-lg btn-outline-warning" role="button">Buat Pinbuk GL</a> -->
                    </div>
                </div>
            </div>
        </div>

            