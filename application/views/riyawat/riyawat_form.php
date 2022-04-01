<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Riyawat</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
              <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Produk <?php echo form_error('id_produk') ?></label>
            <input type="text" class="form-control" name="id_produk" id="id_produk" placeholder="Id Produk" value="<?php echo $id_produk; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Plotting <?php echo form_error('tgl_plotting') ?></label>
            <input type="text" class="form-control" name="tgl_plotting" id="tgl_plotting" placeholder="Tgl Plotting" value="<?php echo $tgl_plotting; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Selesai <?php echo form_error('tgl_selesai') ?></label>
            <input type="text" class="form-control" name="tgl_selesai" id="tgl_selesai" placeholder="Tgl Selesai" value="<?php echo $tgl_selesai; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Status Kerjaan <?php echo form_error('status_kerjaan') ?></label>
            <input type="text" class="form-control" name="status_kerjaan" id="status_kerjaan" placeholder="Status Kerjaan" value="<?php echo $status_kerjaan; ?>" />
        </div>
	    <input type="hidden" name="id_riwayat" value="<?php echo $id_riwayat; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('riyawat') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>