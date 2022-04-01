<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Produk Detail</h3>
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
        <table class="table">
	    <tr><td>Id Kti</td><td><?php echo $id_kti; ?></td></tr>
	    <tr><td>Judul</td><td><?php echo $judul; ?></td></tr>
	    <tr><td>Edisi</td><td><?php echo $edisi; ?></td></tr>
	    <tr><td>Tgl Submit</td><td><?php echo $tgl_submit; ?></td></tr>
	    <tr><td>No Isbn</td><td><?php echo $no_isbn; ?></td></tr>
	    <tr><td>File Hakcipta</td><td><?php echo $file_hakcipta; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('produk') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>