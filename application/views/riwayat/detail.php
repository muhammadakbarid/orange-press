<ul class="timeline">
  <?php
  foreach ($detail as $value) {
  ?>
    <li class="time-label">
      <span class="bg-blue">
        <?= $value->tgl_plotting; ?><?= $value->tgl_selesai; ?>
      </span>
    </li>
    <li>
      <i class="fa fa-clock-o bg-blue"></i>
      <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i> <?= $value->tgl_plotting; ?><?= $value->tgl_selesai; ?></span>

        <h3 class="timeline-header"><a href="#"><?= $value->nama_status; ?></a></h3>

        <div class="timeline-body">
          Editor : <?= $value->first_name . " " . $value->last_name . " (" . $value->email . ")"; ?>
        </div>
      </div>
    </li>
  <?php } ?>
</ul>