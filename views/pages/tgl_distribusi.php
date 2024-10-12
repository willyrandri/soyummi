<form method="post" action="<?php echo site_url('Laporan/distribusi_tampil'); ?>">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pilih Tanggal</h6>
                </div>
                <div class="card-body">
                <div>
                    <label for="startDate">Start Date:</label>
                    <input class="form-control" type="date" id="startDate" name="startDate">
                </div>
                <br>
                <div>
                    <label for="endDate">End Date:</label>
                    <input class="form-control" type="date" id="endDate" name="endDate">
                </div>
                <br>
                <button class="btn btn-success" type="submit">Filter</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>