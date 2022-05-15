<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $title; ?></h3>
      </div>

      <form action="<?php echo base_url('Submission/bayar_action') ?>" method="POST">
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
          <div class="form-group">
            <label for="">File</label>
            <input type="text" class="form-control" value="<?= $produk->file_hakcipta; ?>" disabled>
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
                <label for="">Harga Terbit</label>
                <p class="text-bold bg-warning" style="padding: 10px;"><?= rupiah($produk->harga_terbit); ?></p>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Jenis Pembayaran</label>
            <select class="form-control" name="jenis_pembayaran" id="">
              <option value="Penerbitan">Penerbitan</option>
              <option value="Percetakan">Percetakan</option>
            </select>
          </div>
          <input type="hidden" name="jumlah_bayar" value="<?= $produk->harga_terbit; ?>">
          <input type="hidden" name="id_produk" value="<?= $produk->id_produk; ?>">
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Bayar</button>
          </div>
      </form>
    </div>
  </div>
  <div class="col-md-3"></div>

</div>