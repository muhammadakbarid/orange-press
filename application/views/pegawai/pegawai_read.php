<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Pegawai Detail</h3>
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
	    <tr><td>Nip</td><td><?php echo $nip; ?></td></tr>
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
	    <tr><td>Jabatan</td><td><?php echo $jabatan; ?></td></tr>
	    <tr><td>Pangkat Id</td><td><?php echo $pangkat_id; ?></td></tr>
	    <tr><td>Jabatan Status</td><td><?php echo $jabatan_status; ?></td></tr>
	    <tr><td>Jabatan Fungsi</td><td><?php echo $jabatan_fungsi; ?></td></tr>
	    <tr><td>Eselon</td><td><?php echo $eselon; ?></td></tr>
	    <tr><td>Skpd Sub Bagian Id</td><td><?php echo $skpd_sub_bagian_id; ?></td></tr>
	    <tr><td>Komisi</td><td><?php echo $komisi; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Create On</td><td><?php echo $create_on; ?></td></tr>
	    <tr><td>Users Id</td><td><?php echo $users_id; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('pegawai') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>