<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><?php echo lang('edit_user_heading'); ?></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
            <i class="fa fa-refresh"></i></button>
        </div>
      </div>


      <!-- /.box-header -->
      <div class="box-body">
        <p><?php echo lang('edit_user_subheading'); ?></p>
        <?php
        if ($message != "") {
        ?>
          <div id="infoMessage" class="callout callout-danger"><?php echo $message; ?></div> <?php } ?>
        <?php echo form_open_multipart(uri_string()); ?>

        <div class="form-group">
          <?php echo lang('edit_user_fname_label', 'first_name'); ?> <br />
          <?php echo form_input($first_name); ?>
        </div>

        <div class="form-group">
          <?php echo lang('edit_user_lname_label', 'last_name'); ?> <br />
          <?php echo form_input($last_name); ?>
        </div>
        <div class="form-group">
          <?php echo lang('edit_user_email_label', 'email'); ?> <br />
          <?php echo form_input($email); ?>
        </div>

        <div class="form-group">
          <div class="custom-file">
            <label for="formFile" class="form-label">Photo</label>
            <input type="file" class="custom-file-input form-control" id="image" name="image">
            <label for="formFile" class="form-label">
              File : <a class="text-light" href="<?= base_url('/assets/uploads/image/profile/'); ?><?php echo $image['value'] ?>"><?php echo $image['value']; ?></a>
            </label>

          </div>
        </div>

        <div class="form-group">
          <label for="">Nomor Kartu Tanda Penduduk (KTP)</label>
          <?php echo form_input($no_ktp); ?>
        </div>
        <div class="form-group">
          <label for="">Nomor Induk Pekerja (NIP)</label>
          <?php echo form_input($nip); ?>
        </div>
        <div class="form-group">
          <label for="">Nomor Pokok Wajib Pajak (NPWP)</label>
          <?php echo form_input($no_npwp); ?>
        </div>
        <div class="form-group">
          <label for="int">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
          <select class="form-select form-control" name="jenis_kelamin" id="jenis_kelamin">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <?php
            foreach ($jenis_kelamin_opt as $value) {
              echo "<option value='" . $value . "'";
              if ($jenis_kelamin['value'] == $value) {
                echo " selected";
              }
              echo ">" . $value . "</option>";
            }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="">Tempat Lahir</label>
          <?php echo form_input($tempat_lahir); ?>
        </div>

        <div class="form-group">
          <label for="date">Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></label>
          <input type="text" class="form-control formdate" name="tanggal_lahir" id="tanggal_lahir" required="true" value="<?php echo $tanggal_lahir['value']; ?>" />
        </div>
        <div class="form-group">
          <label for="">Alamat</label>
          <?php echo form_input($alamat); ?>
        </div>
        <div class="form-group">
          <label for="">Nomor HP</label>
          <?php echo form_input($no_hp); ?>
        </div>
        <div class="form-group">
          <label for="">Profesi</label>
          <?php echo form_input($profesi); ?>
        </div>



        <div class="form-group">
          <label for="int">Bidang Kompetensi <?php echo form_error('bidang_kompetensi') ?></label>
          <select class="form-select form-control" name="bidang_kompetensi" id="bidang_kompetensi">
            <option value="">-- Pilih Bidang Kompetensi --</option>
            <?php
            foreach ($bidang_kompetensi_opt as $value) {
              echo "<option value='" . $value . "'";
              if ($bidang_kompetensi['value'] == $value) {
                echo " selected";
              }
              echo ">" . $value . "</option>";
            }
            ?>
          </select>
        </div>



        <div class="form-group">
          <?php echo lang('edit_user_password_label', 'password'); ?> <br />
          <?php echo form_input($password); ?>
        </div>

        <div class="form-group">
          <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?><br />
          <?php echo form_input($password_confirm); ?>
        </div>

        <?php if ($this->ion_auth->is_admin()) : ?>
          <div class="form-group">
            <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
            <?php foreach ($groups as $group) : ?>
              <div class="checkbox">
                <label class="col-md-3">
                  <?php
                  $gID = $group['id'];
                  $checked = null;
                  $item = null;
                  foreach ($currentGroups as $grp) {
                    if ($gID == $grp->id) {
                      $checked = ' checked="checked"';
                      break;
                    }
                  }
                  ?>
                  <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>" <?php echo $checked; ?>>
                  <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                </label>
              </div>
            <?php endforeach ?>
          </div>
        <?php endif ?>

        <?php echo form_hidden('id', $user->id); ?>
        <?php echo form_hidden($csrf); ?>
        <div class="row">
          <div class="col-md-12" style="margin-top:10px;">
            <p><?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn bg-purple clearfix" style="clear:both"'); ?></p>
          </div>
        </div>
        <?php echo form_close(); ?>

      </div>
    </div>
  </div>
</div>