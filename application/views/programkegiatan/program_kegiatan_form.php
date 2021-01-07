<div class="row">
    <div class="col-xs-12 col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Program_kegiatan</h3>
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
                        <label for="int">Program <?php echo form_error('program_id') ?></label>
                        <select name="program_id" class="form-control select2" style="width: 100%;" id="program_id">
                            <option value="">Pilih Program</option>
                            <?php if ($list_program) : ?>
                                <?php foreach ($list_program as $lpr) : ?>
                                    <option value="<?php echo $lpr->id ?>" <?php echo ($program_id == $lpr->id ? "selected" : "") ?>><?php echo $lpr->no_rekening ?> - <?php echo $lpr->nama ?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">No Rekening <?php echo form_error('no_rekening') ?></label>
                        <input type="text" class="form-control" name="no_rekening" id="no_rekening" placeholder="No Rekening" value="<?php echo $no_rekening; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('programkegiatan') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#program_id').change(function() { // id select yang dipilih
            var program_id = $("#program_id").val();
            $.ajax({
                url: "<?php echo site_url(); ?>ProgramKegiatan/get_no_rekening",
                method: "POST",
                data: {
                    p_program_id: program_id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('#no_rekening').val(data.no_rekening + ".");
                }
            });
        });
    });
</script>