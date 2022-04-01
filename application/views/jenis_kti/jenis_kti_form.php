<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Jenis_kti</h3>
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
            <label for="varchar">Nama Kti <?php echo form_error('nama_kti') ?></label>
            <input type="text" class="form-control" name="nama_kti" id="nama_kti" placeholder="Nama Kti" value="<?php echo $nama_kti; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Harga Terbit <?php echo form_error('harga_terbit') ?></label>
            <input type="text" class="form-control" name="harga_terbit" id="harga_terbit" placeholder="Harga Terbit" value="<?php echo $harga_terbit; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Paket <?php echo form_error('nama_paket') ?></label>
            <input type="text" class="form-control" name="nama_paket" id="nama_paket" placeholder="Nama Paket" value="<?php echo $nama_paket; ?>" />
        </div>
	    <input type="hidden" name="id_kti" value="<?php echo $id_kti; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jenis_kti') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>