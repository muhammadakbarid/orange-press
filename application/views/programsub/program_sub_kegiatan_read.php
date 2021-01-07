<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Program Sub Kegiatan Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table">
                    <tr>
                        <td>Program Kegiatan</td>
                        <td><?php echo $program_kegiatan_id; ?></td>
                    </tr>
                    <tr>
                        <td>No Rekening</td>
                        <td><?php echo $no_rekening; ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><?php echo $nama; ?></td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td><?php echo $tahun; ?></td>
                    </tr>
                    <tr>
                        <td>Anggaran</td>
                        <td><?php echo rupiah($anggaran); ?></td>
                    </tr>
                    <tr>
                        <td><a href="<?php echo site_url('programsub') ?>" class="btn bg-purple">Cancel</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>