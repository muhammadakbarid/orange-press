<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">List Submission Editor</h3>
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
              <th>Judul</th>
              <th>Jenis</th>
              <th>Edisi</th>
              <th>Tanggal Submit</th>
              <th>Nomor ISBN</th>
              <th>File Hak Cipta</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($list_submission as $value) {
            ?>
              <tr>
                <td class="text-center" style="width: 10px;"><?php echo $no++ ?></td>
                <td><?php echo $value->judul ?></td>
                <td><?php echo $value->nama_kti ?></td>
                <td><?php echo $value->edisi ?></td>
                <td><?php echo date_surat($value->tgl_submit) ?></td>
                <td><?php echo $value->no_isbn ?></td>
                <td><a class="btn btn-xs btn-warning" href="<?= base_url('Submission/get_file_submission/' . $value->file_hakcipta); ?>">Download</a></td>
                <td><?php echo submission_status_color($value->status) ?></td>
                <td><?php echo submission_check_action_editor($value->status, $value->id_produk) ?></td>
              </tr>
            <?php } ?>

          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Jenis</th>
              <th>Edisi</th>
              <th>Tanggal Submit</th>
              <th>Nomor ISBN</th>
              <th>File Hak Cipta</th>
              <th>Status</th>
              <th>Action</th>

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

  // if approve is clicked
  $(document).on('click', '#sunting_naskah_approve', function() {
    Swal.fire({
      title: 'Are you sure to approve?',
      showCancelButton: true,
      confirmButtonText: 'Approve',
      confirmButtonColor: '#00a65a',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        var id = $(this).data('id');
        var url = "<?php echo base_url('Submission/penyuntingan_naskah_approve') ?>";
        $.ajax({
          url: url,
          type: "POST",
          data: {
            id: id,
          },
          success: function() {
            location.reload();
          }
        });
      }
    })
  });

  $(document).on('click', '#proofreading_approve', function() {
    Swal.fire({
      title: 'Are you sure to approve?',
      showCancelButton: true,
      confirmButtonText: 'Approve',
      confirmButtonColor: '#00a65a',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        var id = $(this).data('id');
        var url = "<?php echo base_url('Submission/proofreading_approve') ?>";
        $.ajax({
          url: url,
          type: "POST",
          data: {
            id: id,
          },
          success: function() {
            location.reload();
          }
        });
      }
    })
  });
</script>