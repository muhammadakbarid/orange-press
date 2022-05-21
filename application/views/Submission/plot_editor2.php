<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $title; ?></h3>
      </div>

      <?php echo form_open($action); ?>
      <div class="box-body">
        <?php if ($this->session->flashdata('message')) : ?>
          <div class="form-group">
            <?= $this->session->flashdata('message'); ?>
          </div>
        <?php endif; ?>

        <div class="form-group bg-warning" style="padding: 30px;">
          <h3 class="text-center"><b><?= $produk->judul; ?></b></h3>
        </div>
        <div class="form-group">
          <label for="editor"><?= $label; ?></label>
          <select class="form-control select2" required="true" name="editor" multiple>
            <?php
            foreach ($list_editor as $value) {
              echo "<option value='" . $value->id . "'";
              if (isset($id_editor)) {
                if ($id_editor == $value->id) {
                  echo " selected";
                }
              }
              echo ">" . $value->first_name . " " . $value->last_name . " (" . $value->email . ")" . "</option>";
            }
            ?>
          </select>
          <?= form_error('lead_editor', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
      </div>
      <div class="box-footer">
        <?php
        if (isset($id_riwayat)) {
        ?>
          <input type="hidden" name="id_riwayat" value="<?= $id_riwayat; ?>">
        <?php
        }
        ?>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <?= form_close();; ?>
    </div>
  </div>
  <div class="col-md-3"></div>

</div>