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
        <div class="form-group">
          <label for="">Jenis Karya Tulis Ilmiah</label>
          <input type="text" class="form-control" value="<?= $produk->nama_kti; ?>" disabled>
        </div>
        <div class="form-group">
          <label for="int">Pilih Paket <?php echo form_error('paket') ?></label>
          <select class="form-select form-control" name="paket" id="paket">
            <option value="NULL">-- Pilih Paket --</option>
            <?php foreach ($paket as $p) : ?>
              <option value="<?= $p->id_paket; ?>"><?= $p->nama_paket . " (" . rupiah($p->harga_paket) . ")"; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div id="pesan_paket" class="form-group">
        </div>
        <div class="form-group">
          <div class="custom-file">
            <label for="formFile" class="form-label">Bukti Bayar (Oposional)</label>
            <input type="file" class="custom-file-input form-control" id="file_attach" name="file_attach">
          </div>
        </div>
        <div class="form-group">
          <label for="decimal" class="form-label">Jumlah yang dibayar</label>
          <input type="text" name="jumlah_bayar" id="jumlah_bayar" class="form-control rupiah" placeholder="Masukan nominal yang telah dibayarkan.." value="">
        </div>
        <input type="hidden" name="id_produk" value="<?= $produk->id_produk; ?>">
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Bayar</button>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
    <div class="col-md-3"></div>

  </div>

  <script>
    // saat #paket diubah maka tampilkan harga_paket pada #pesan_paket
    $('#paket').change(function() {
      var id_paket = $('#paket').val();
      // if id_paket not null
      if (id_paket != 'NULL') {
        $.ajax({
          url: "<?php echo base_url('Submission/get_harga_paket') ?>",
          type: "POST",
          data: {
            id_paket: id_paket
          },
          success: function(data) {
            $('#pesan_paket').html(
              '<div class="bg-warning" style="padding:10px;">' + 'Silahkan bayar sebesar <b>' + data + '</b></div>'
            );
          }
        });
      } else {
        $('#pesan_paket').html('');
      }
    });
  </script>