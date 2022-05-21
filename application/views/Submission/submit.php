<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $title; ?></h3>
      </div>

      <?php echo form_open_multipart('Submission/submit'); ?>
      <div class="box-body">
        <?php if ($this->session->flashdata('message')) : ?>
          <div class="form-group">
            <?= $this->session->flashdata('message'); ?>
          </div>
        <?php endif; ?>
        <?php
        if ($message != "") {
        ?>
          <div id="infoMessage" class="callout callout-danger"><?php echo $message; ?></div>
        <?php } ?>
        <div class="form-group">
          <label for="judul">Judul</label>
          <input type="text" class="form-control" id="judul" value="<?= $judul; ?>" name="judul">
          <?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <div class="custom-file">
                <label for="formFile" class="form-label">Draft Buku</label>
                <input type="file" class="custom-file-input form-control" id="file_attach" name="file_attach">
              </div>
            </div>
            <div class="col-md-6">
              <label for="edisi">Edisi</label>
              <input type="text" class="form-control" id="edisi" value="<?= $edisi; ?>" name="edisi">
              <?= form_error('edisi', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="int">Jenis Karya Tulis Ilmiah <?php echo form_error('jenis_kti') ?></label>
          <select class="form-select form-control" name="jenis_kti" id="jenis_kti">
            <option value="">-- Pilih Karya Tulis Ilmiah --</option>
            <?php
            foreach ($jenis_kti as $jenis_kti) {
              echo "<option value='" . $jenis_kti->id_kti . "'";
              echo ">" . $jenis_kti->nama_kti . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="date">Tim Penulis</label>
          <select class="form-control select2" name="tim_penulis[]" id="tim_penulis[]" multiple="multiple" value="<?= $tim_penulis; ?>">
            <?php if ($list_penulis) : ?>
              <?php foreach ($list_penulis as $value) : ?>
                <?php if (check_is_empty($value->id) == 1) { ?>
                  <option value="<?php echo $value->id ?>"><?php echo $value->first_name ?> <?php echo $value->last_name ?> (<?php echo $value->email . " - " . $value->bidang_kompetensi ?>)</option>
                <?php } ?>
              <?php endforeach ?>
            <?php endif ?>
          </select>
        </div>


      </div>

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
  <div class="col-md-3"></div>

</div>