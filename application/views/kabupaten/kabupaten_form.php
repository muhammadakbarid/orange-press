<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Kabupaten</h3>
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
            <label for="char">Id Prov <?php echo form_error('id_prov') ?></label>
            <input type="text" class="form-control" name="id_prov" id="id_prov" placeholder="Id Prov" value="<?php echo $id_prov; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinytext">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Jenis <?php echo form_error('id_jenis') ?></label>
            <input type="text" class="form-control" name="id_jenis" id="id_jenis" placeholder="Id Jenis" value="<?php echo $id_jenis; ?>" />
        </div>
	    <input type="hidden" name="id_kab" value="<?php echo $id_kab; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kabupaten') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>