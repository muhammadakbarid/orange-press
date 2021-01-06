<div class="row">
    <div class="col-xs-12 col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Pegawai</h3>
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
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="varchar">NIP <?php echo form_error('nip') ?></label>
                            <input type="text" class="form-control" name="nip" id="nip" placeholder="Nip" value="<?php echo $nip; ?>" />
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="varchar">Nama* <?php echo form_error('nama') ?></label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="enum">Jenis Kelamin* <?php echo form_error('jenis_kelamin') ?></label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" <?php echo ($jenis_kelamin == "L" ? "selected" : "") ?>>Laki-Laki</option>
                                <option value="P" <?php echo ($jenis_kelamin == "P" ? "selected" : "") ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="varchar">Jabatan <?php echo form_error('jabatan') ?></label>
                            <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="int">Golongan dan Pangkat <?php echo form_error('pangkat_id') ?></label>
                            <select name="pangkat_id" class="form-control select2" style="width: 100%;">
                                <option value="">Pilih Golongan Pangkat</option>
                                <?php if ($list_pangkat) : ?>
                                    <?php foreach ($list_pangkat as $pkt) : ?>
                                        <option value="<?php echo $pkt->id ?>" <?php echo ($pangkat_id == $pkt->id ? "selected" : "") ?>><?php echo $pkt->golongan ?> / <?php echo $pkt->ruang ?> / <?php echo $pkt->nama_pangkat ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="int">Menjabat Sebagai <?php echo form_error('jabatan_status') ?></label>
                            <select name="jabatan_status" class="form-control select2" style="width: 100%;">
                                <option value="">Pilih Menjabat Sebagai</option>
                                <?php foreach ($list_status_jabatan as $klsb => $vlsb) : ?>
                                    <option value="<?php echo $klsb ?>" <?php echo ($jabatan_status == $klsb ? "selected" : "") ?>><?php echo $vlsb ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="int">Jabatan Lain <?php echo form_error('jabatan_fungsi') ?></label>
                            <select name="jabatan_fungsi" class="form-control">
                                <option value="">Pilih Jabatan lain</option>
                                <?php foreach ($list_fungsi_jabatan as $klfj => $vlfj) : ?>
                                    <option value="<?php echo $klfj ?>" <?php echo ($jabatan_fungsi == $klfj ? "selected" : "") ?>><?php echo $vlfj ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="int">Eselon <?php echo form_error('eselon') ?></label>
                            <select name="eselon" class="form-control">
                                <option value="">Pilih Eselon</option>
                                <?php foreach ($list_eselon as $kesl => $vesl) : ?>
                                    <option value="<?php echo $kesl ?>" <?php echo ($eselon == $kesl ? "selected" : "") ?>>Eselon <?php echo $vesl ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="int">SKPD Bagian <?php echo form_error('skpd_bagian_id') ?></label>
                            <select name="skpd_bagian_id" class="form-control" id="skpd_bagian_id">
                                <option value="">Pilih SKPD Bagian</option>
                                <?php if ($list_skpd_bagian) : ?>
                                    <?php foreach ($list_skpd_bagian as $lsb) : ?>
                                        <option value="<?php echo $lsb->id ?>" <?php echo ($skpd_bagian_id == $lsb->id ? "selected" : "") ?>><?php echo $lsb->nama ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="int">Sub Bagian <?php echo form_error('skpd_sub_bagian_id') ?></label>
                            <select name="skpd_sub_bagian_id" class="form-control" id="skpd_sub_bagian_id">
                                <option value="">Pilih Sub Bagian</option>
                                <?php if ($list_skpd_sub_bagian) : ?>
                                    <?php foreach ($list_skpd_sub_bagian as $lssb) : ?>
                                        <option value="<?php echo $lssb->id ?>" <?php echo ($skpd_sub_bagian_id == $lssb->id ? "selected" : "") ?>><?php echo $lssb->nama ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="int">Komisi <?php echo form_error('komisi') ?></label>
                            <select name="komisi" class="form-control">
                                <option value="">Pilih Komisi</option>
                                <?php foreach ($list_komisi as $kkom => $vkom) : ?>
                                    <option value="<?php echo $kkom ?>" <?php echo ($komisi == $kkom ? "selected" : "") ?>>Eselon <?php echo $vkom ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="enum">Status <?php echo form_error('status') ?></label>
                            <select name="status" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="1" <?php echo ($status == "1" ? "selected" : "") ?>>Aktif</option>
                                <option value="0" <?php echo ($status == "0" ? "selected" : "") ?>>Non Aktif</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('pegawai') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Bantuan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-info-circle margin-r-5"></i> Jabatan</strong>
                <p class="text-muted">
                    Diisi dengan nama jabatan lengkap. <br>
                    Misalnya: Kepala Sub Bagian Program dan Keuangan.<br>
                    Jika Anggota Dewan, isi: Anggota Dewan<br>
                </p>
                <hr>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#skpd_bagian_id').change(function() { // id select yang dipilih
            $("#skpd_sub_bagian_id").prop("disabled", true);
            var skpd_id = $("#skpd_bagian_id").val();
            $.ajax({
                url: "<?php echo site_url(); ?>SkpdSubBagian/get_skpd_sub_bagian",
                method: "POST",
                data: {
                    p_skpd_bagian_id: skpd_id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    if (data.length == 0) {
                        alert('Tidak Data Sub Bagian SKPD yang Anda pilih, silahkan input terlebih dulu di menu SKPD')
                    } else {
                        html = '<option value=>Pilih Sub Bagian</option>';
                        for (i = 0; i < data.length; i++) {
                            html += '<option value=' + data[i].id + '>' + data[i].nama + '</option>';
                        }
                        $("#skpd_sub_bagian_id").prop("disabled", false);
                        $('#skpd_sub_bagian_id').html(html);
                    }

                }
            });
        });
    });
</script>