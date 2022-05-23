<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $title; ?></h3>
      </div>

      <?php echo form_open_multipart($action); ?>
      <div class="box-body">
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
        <div class="form-group">
          <label for="">Jenis Karya Tulis Ilmiah</label>
          <input type="text" class="form-control" value="<?= $produk->nama_kti; ?>" disabled>
        </div>
        <div class="form-group">
          <label for="int">Paket Pembayaran</label>
          <p class="bg-warning text-bold" style="padding: 10px;"><?= $paket->nama_paket; ?></p>
        </div>
        <div class="form-group">
          <label for="int">File Bukti Bayar</label>
          <p class="bg-warning text-bold" style="padding: 10px;">
            <?php
            if ($pembayaran->bukti_bayar != '') {
              echo '<a href="' . base_url('Submission/get_bukti_bayar/' . $pembayaran->bukti_bayar) . '" target="_blank">' . $pembayaran->bukti_bayar . '</a>';
            }
            ?>
          </p>
        </div>
        <div class="form-group">
          <label for="int">Jumlah Bayar</label>
          <p class="bg-warning text-bold" style="padding: 10px;"><?= rupiah($pembayaran->jumlah); ?></p>
        </div>
        <input type="hidden" name="id_produk" value="<?= $produk->id_produk; ?>">
        <input type="hidden" name="id_pembayaran" value="<?= $pembayaran->id_bayar; ?>">
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Verifikasi Pembayaran</button>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
    <div class="col-md-3"></div>

  </div>