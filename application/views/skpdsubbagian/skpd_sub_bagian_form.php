<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Skpd_sub_bagian</h3>
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
                        <label for="int">SKPD <?php echo form_error('skpd_id') ?></label>
                        <select name="skpd_id" class="form-control" id="skpd_id">
                            <option value="">Pilih SKPD</option>
                            <?php if ($list_skpd) : ?>
                                <?php foreach ($list_skpd as $ls) : ?>
                                    <option value="<?php echo $ls->id ?>" <?php echo ($skpd_id == $ls->id ? "selected" : "") ?>><?php echo $ls->nama ?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="int">Bagian SKPD <?php echo form_error('skpd_bagian_id') ?></label>
                        <select name="skpd_bagian_id" class="form-control" id="skpd_bagian_id">
                            <option value="">Pilih Bagian SKPD</option>
                            <?php if ($list_bagian) : ?>
                                <?php foreach ($list_bagian as $lb) : ?>
                                    <option value="<?php echo $lb->id ?>" <?php echo ($skpd_bagian_id == $lb->id ? "selected" : "") ?>><?php echo $lb->nama ?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama Sub Bagian SKPD <?php echo form_error('nama') ?></label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Deskripsi <?php echo form_error('deskripsi') ?></label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi" value="<?php echo $deskripsi; ?>" />
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('skpdsubbagian') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#skpd_id').change(function() { // id select yang dipilih
            $("#skpd_bagian_id").prop("disabled", true);
            var skpd_id = $("#skpd_id").val();
            $.ajax({
                url: "<?php echo site_url(); ?>SkpdSubBagian/get_skpd_bagian",
                method: "POST",
                data: {
                    p_skpd_id: skpd_id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    if (data.length == 0) {
                        alert('Tidak Data Bagian SKPD yang Anda pilih, silahkan input dulu')
                    } else {
                        html = '<option value=>Pilih Bagian SKPD</option>';
                        for (i = 0; i < data.length; i++) {
                            html += '<option value=' + data[i].id + '>' + data[i].nama + '</option>';
                        }
                        $("#skpd_bagian_id").prop("disabled", false);
                        $('#skpd_bagian_id').html(html);
                    }

                }
            });
        });
    });
</script>