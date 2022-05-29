<!-- box -->
<div class="box">
  <!-- box-header -->
  <div class="box-header with-border">
    <h3 class="box-title">Riwayat Sunting</h3>
    <h3 class="text-center text-bold"><?= $produk->judul; ?><br>
      <span><?= submission_status_color($produk->id_produk); ?></span>
    </h3>
    <div class="row">
      <div class=" col-md-4"></div>
      <div class="col-md-2 text-right">
        Lead Editor
      </div>
      <div class="col-md-2">
        : <?= ucfirst($lead_editor); ?>
      </div>
      <div class="col-md-4">

      </div>
    </div>
  </div>
  <!-- /.box-header -->
  <!-- box-body -->
  <div class="box-body">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title text-center">
          <a class="collapsed " role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Detail Produk
          </a>
        </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
          <div id="data_produk">
            <table class="table table-responsive table-bordered" id="riwayat_sunting">
              <tr>
                <td>Judul</td>
                <td><?= $produk->judul; ?></td>
              </tr>
              <tr>
                <td>Jenis Karya Tulis Ilmiah</td>
                <td><?= check_kti($produk->id_kti); ?></td>
              </tr>
              <tr>
                <td>Edisi</td>
                <td><?= $produk->edisi; ?></td>
              </tr>
              <tr>
                <td>Tanggal Submit</td>
                <td><?= $produk->tgl_submit; ?></td>
              </tr>
              <tr>
                <td>ISBN</td>
                <td><?= $produk->no_isbn; ?></td>
              </tr>
              <tr>
                <td>File Hak Cipta</td>
                <td><?= tombol_detail_hak_cipta($produk->id_produk); ?></a></td>
              </tr>
              <tr>
                <td>Daftar Penulis</td>
                <td>
                  <ol>
                    <?php foreach ($daftar_penulis as $penulis) : ?>
                      <li><?= $penulis->first_name . " " . $penulis->last_name . " (" . $penulis->email . ")"; ?></li>
                    <?php endforeach; ?>
                  </ol>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<ul class="timeline">
  <?php
  foreach ($detail as $value) {
  ?>
    <li>
      <i class="fa fa-clock-o bg-blue"></i>
      <div class="timeline-item">
        <h3 class="timeline-header"><a href="#"><?= $value->nama_status; ?></a></h3>

        <div class="timeline-body">
          <table id="riwayat_sunting" class="table table-responsive">
            <tr>
              <td style="width: 30%;"><?php $user_group = $this->ion_auth->get_users_groups($value->user_id)->row();
                                      echo ucfirst($user_group->name);
                                      ?></td>
              <td>:</td>
              <td><?= $value->first_name . " " . $value->last_name . " (" . $value->email . ")"; ?></td>
            </tr>
            <?php if (isset($value->tgl_plotting)) { ?>
              <tr>
                <td>Tanggal Plotting</td>
                <td>:</td>
                <td><?= $value->tgl_plotting; ?></td>
              </tr>
            <?php } ?>
            <?php if (isset($value->tgl_selesai)) { ?>
              <tr>
                <td>Tanggal selesai</td>
                <td>:</td>
                <td><?= $value->tgl_selesai; ?></td>
              </tr>
            <?php } ?>
            <?php if (isset($value->nama_file)) { ?>
              <tr>
                <td>File Attachment</td>
                <td>:</td>
                <td><a href="<?= base_url('Submission/get_file_riwayat/' . $value->nama_file); ?>"><?= $value->nama_file; ?></a>
                </td>
              </tr>
            <?php } ?>
            <tr>
              <td>Status Produk</td>
              <td>:</td>
              <td><?= riwayat_status($value->status_kerjaan); ?></td>
            </tr>
            <tr>
              <td>Keterangan</td>
              <td>:</td>
              <td><?= $value->keterangan; ?></td>
            </tr>
          </table>
        </div>
      </div>
    </li>
  <?php } ?>
</ul>