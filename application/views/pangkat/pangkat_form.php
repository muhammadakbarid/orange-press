<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Pangkat</h3>
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
            <label for="varchar">Golongan <?php echo form_error('golongan') ?></label>
            <input type="text" class="form-control" name="golongan" id="golongan" placeholder="Golongan" value="<?php echo $golongan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ruang <?php echo form_error('ruang') ?></label>
            <input type="text" class="form-control" name="ruang" id="ruang" placeholder="Ruang" value="<?php echo $ruang; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Pangkat <?php echo form_error('nama_pangkat') ?></label>
            <input type="text" class="form-control" name="nama_pangkat" id="nama_pangkat" placeholder="Nama Pangkat" value="<?php echo $nama_pangkat; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pangkat') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>