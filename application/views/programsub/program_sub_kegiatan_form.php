<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Program_sub_kegiatan</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group">
                        <label for="int">Program Kegiatan <?php echo form_error('program_kegiatan_id') ?></label>
                        <select name="program_kegiatan_id" class="form-control select2" style="width: 100%;">
                            <option value="">Pilih Program</option>
                            <?php if ($list_program_kegiatan) : ?>
                                <?php foreach ($list_program_kegiatan as $lpk) : ?>
                                    <option value="<?php echo $lpk->id ?>" <?php echo ($program_kegiatan_id == $lpk->id ? "selected" : "") ?>><?php echo $lpk->no_rekening ?> - <?php echo $lpk->nama ?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Kode Rekening <?php echo form_error('no_rekening') ?></label>
                        <input type="text" class="form-control" name="no_rekening" id="no_rekening" placeholder="No Rekening" value="<?php echo $no_rekening; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="int">Tahun <?php echo form_error('tahun') ?></label>
                            <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" />
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="decimal">Anggaran <?php echo form_error('anggaran') ?></label>
                            <input type="text" class="form-control rupiah" name="anggaran" id="anggaran" placeholder="Anggaran" value="<?php echo $anggaran; ?>" />
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('programsub') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>