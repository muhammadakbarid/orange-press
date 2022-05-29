<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $title; ?></h3>
      </div>

      <?php echo form_open_multipart($action); ?>
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
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Penulis</label>
              <ol>
                <?php foreach ($daftar_penulis as $value) : ?>
                  <li><a class="btn btn-xs btn-primary" href="<?= base_url('users/read/' . $value->id_user); ?>"><i class="fa fa-user"></i> &nbsp; <?= $value->first_name . " " . $value->last_name; ?></a></li>
                <?php endforeach; ?>
              </ol>
            </div>
          </div>
        </div>

        <!-- <div class="row"> -->
        <div class="form-group">
          <div class="custom-file">
            <label for="formFile" class="form-label"><?= $label; ?></label>
            <input type="file" class="custom-file-input form-control" id="file_attach" name="file_attach">
          </div>
        </div>
        <input type="hidden" name="id_produk" value="<?= $produk->id_produk; ?>">
        <!-- </div> -->
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