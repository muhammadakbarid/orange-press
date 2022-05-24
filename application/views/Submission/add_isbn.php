<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $title; ?></h3>
      </div>

      <?php echo form_open_multipart('Submission/add_isbn_action'); ?>
      <div class="box-body">
        <?php if ($this->session->flashdata('message')) : ?>
          <div class="form-group">
            <?= $this->session->flashdata('message'); ?>
          </div>
        <?php endif; ?>

        <div class="form-group">
          <label for="">Judul</label>
          <input type="text" class="form-control" value="<?= $produk->judul; ?>" disabled>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Edisi</label>
              <input type="text" class="form-control" value="<?= $produk->edisi; ?>" disabled>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Tanggal Submit</label>
              <input type="text" class="form-control" value="<?= date_surat($produk->tgl_submit); ?>" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Jenis Karya Tulis Ilmiah</label>
              <input type="text" class="form-control" value="<?= $produk->nama_kti; ?>" disabled>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="">Nomor ISBN<sup>*</sup></label>
          <input class="form-control" type="text" name="no_isbn" id="no_isbn">
        </div>
        <input type="hidden" name="id_produk" value="<?= $produk->id_produk; ?>">
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <?php echo form_close() ?>
      </div>
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