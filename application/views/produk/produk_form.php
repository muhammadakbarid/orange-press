<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Produk</h3>
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
            <label for="int">Id Kti <?php echo form_error('id_kti') ?></label>
            <input type="text" class="form-control" name="id_kti" id="id_kti" placeholder="Id Kti" value="<?php echo $id_kti; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Judul <?php echo form_error('judul') ?></label>
            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Edisi <?php echo form_error('edisi') ?></label>
            <input type="text" class="form-control" name="edisi" id="edisi" placeholder="Edisi" value="<?php echo $edisi; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Submit <?php echo form_error('tgl_submit') ?></label>
            <input type="text" class="form-control" name="tgl_submit" id="tgl_submit" placeholder="Tgl Submit" value="<?php echo $tgl_submit; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Isbn <?php echo form_error('no_isbn') ?></label>
            <input type="text" class="form-control" name="no_isbn" id="no_isbn" placeholder="No Isbn" value="<?php echo $no_isbn; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">File Hakcipta <?php echo form_error('file_hakcipta') ?></label>
            <input type="text" class="form-control" name="file_hakcipta" id="file_hakcipta" placeholder="File Hakcipta" value="<?php echo $file_hakcipta; ?>" />
        </div>
	    <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('produk') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>