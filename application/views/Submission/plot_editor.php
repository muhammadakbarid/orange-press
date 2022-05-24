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
          <label for="lead_editor"><?= $label; ?></label>
          <select class="form-control select2" required="true" name="editor">
            <?php
            foreach ($list_editor as $value) {
              echo "<option value='" . $value->id . "'";
              if (isset($id_lead_editor)) {
                if ($id_lead_editor == $value->id) {
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
  <div class="col-md-5">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Keterangan</h3>
      </div>
      <div class="box-body">
        <table class="table" id="riwayat_sunting">
          <?php foreach ($keterangan as $value) : ?>
            <tr>
              <td><?= riwayat_status($value->status_kerjaan); ?></td>
              <td>|</td>
              <td><?= $value->keterangan; ?></td>
            </tr>
          <?php endforeach ?>
        </table>
      </div>
    </div>
  </div>

</div>