<!-- box -->
<div class="box">
  <!-- box-header -->
  <div class="box-header with-border">
    <h3 class="box-title">Riwayat Sunting</h3>
    <h3 class="text-center text-bold"><?= $produk->judul; ?><br>
      <span><?= submission_status_color($produk->status); ?></span>
    </h3>
    <div class="row">
      <div class=" col-md-4"></div>
      <div class="col-md-2 text-right">
        Lead Editor
      </div>
      <div class="col-md-2">
        : <?= ucfirst($lead_editor); ?>
      </div>
      <div class="col-md-4"></div>
    </div>
    <div class="row">
      <div class=" col-md-4"></div>
      <div class="col-md-2 text-right">
        Editor Sunting
      </div>
      <div class="col-md-2">
        <?php
        // foreach editor sunting where not $lead_editor
        foreach ($editors as $editor_sunting) {
          if ($editor_sunting->user_id != $id_lead_editor) {
            echo ucfirst($editor_sunting->first_name) . ' ' . ucfirst($editor_sunting->last_name) . ', ';
          }
        }

        ?>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
  <!-- /.box-header -->
  <!-- box-body -->
  <div class="box-body">
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
          <table class="table">
            <tr>
              <td><?php $user_group = $this->ion_auth->get_users_groups($value->user_id)->row();
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
            <tr>
              <td>Status Produk</td>
              <td>:</td>
              <td><?= submission_status_color($value->status_kerjaan); ?></td>
            </tr>
          </table>
        </div>
      </div>
    </li>
  <?php } ?>
</ul>