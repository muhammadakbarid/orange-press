<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> File_attach</h3>
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
            <label for="int">Id Riwayat <?php echo form_error('id_riwayat') ?></label>
            <input type="text" class="form-control" name="id_riwayat" id="id_riwayat" placeholder="Id Riwayat" value="<?php echo $id_riwayat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama File <?php echo form_error('nama_file') ?></label>
            <input type="text" class="form-control" name="nama_file" id="nama_file" placeholder="Nama File" value="<?php echo $nama_file; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Url File <?php echo form_error('url_file') ?></label>
            <input type="text" class="form-control" name="url_file" id="url_file" placeholder="Url File" value="<?php echo $url_file; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Keterangan <?php echo form_error('keterangan') ?></label>
            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Create On <?php echo form_error('create_on') ?></label>
            <input type="text" class="form-control" name="create_on" id="create_on" placeholder="Create On" value="<?php echo $create_on; ?>" />
        </div>
	    <input type="hidden" name="id_file" value="<?php echo $id_file; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('file_attach') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>