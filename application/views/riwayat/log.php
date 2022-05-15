<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Log Riwayat</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
            <i class="fa fa-refresh"></i></button>
        </div>
      </div>

      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Editor</th>
              <th>Judul</th>
              <th>Tanggal Plotting</th>
              <th>Tanggal Selesai</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($log as $value) {
            ?>
              <tr>
                <td class="text-center" style="width: 10px;"><?php echo $no++ ?></td>
                <td><?php echo $value->first_name . $value->last_name . " (" . $value->email . ")" ?></td>
                <td><?php echo $value->judul ?></td>
                <td>
                  <?php
                  if ($value->tgl_plotting === NULL) {
                    echo '-';
                  } else {
                    echo date_surat($value->tgl_plotting);
                  }
                  ?>
                </td>
                <td>
                  <?php
                  if ($value->tgl_selesai === NULL) {
                    echo '-';
                  } else {
                    echo date_surat($value->tgl_selesai);
                  }
                  ?>
                </td>
                <td><?php echo $value->nama_status ?></td>
              </tr>
            <?php } ?>

          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Editor</th>
              <th>Judul</th>
              <th>Tanggal Plotting</th>
              <th>Tanggal Selesai</th>
              <th>Status</th>
            </tr>
          </tfoot>
        </table>

      </div>
    </div>
  </div>
</div>
<script>
  $(function() {
    $(' #example1').DataTable()
  });
</script>