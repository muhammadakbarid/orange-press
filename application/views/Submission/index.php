<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">List Submission</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
            <i class="fa fa-refresh"></i></button>
        </div>
      </div>
      <div class="box-body">
        <a class="btn btn-primary" href="<?= base_url('Submission/submit'); ?>">Add Submission</a>
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
              <th>Draft Buku</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($submission as $value) {
            ?>
              <tr>
                <td class="text-center" style="width: 10px;"><?php echo $no++ ?></td>
                <td><a href="<?= base_url('Riwayat/detail/' . $value->id_produk); ?>"><?php echo $value->judul ?></a></td>
                <td><?php echo check_kti($value->id_kti) ?></td>
                <td><?php echo $value->edisi ?></td>
                <td><?php echo date_surat($value->tgl_submit) ?></td>
                <td><?php echo $value->no_isbn ?></td>
                <td><?= tombol_download($value->id_produk); ?></td>
                <td><?php echo submission_status_color($value->id_produk) ?></td>
                <td><?php echo submission_check_action_penulis($value->id_produk) ?></td>
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

  $(document).on('click', '#approve', function() {
    Swal.fire({
      title: 'Are you sure to approve?',
      showCancelButton: true,
      input: 'textarea',
      inputLabel: 'Masukan Keterangan',
      inputPlaceholder: 'Tulis keterangan disini...',
      inputAttributes: {
        'aria-label': 'Tulis keterangan disini'
      },
      confirmButtonText: 'Approve',
      confirmButtonColor: '#00a65a',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        var id = $(this).data('id');
        var keterangan = result.value;

        var url = "<?php echo base_url('Submission/approve_dummy/') ?>";
        $.ajax({
          url: url,
          type: "POST",
          data: {
            id: id,
            keterangan: keterangan
          },
          success: function() {
            location.reload();
          }
        });
      }
    })
  });

  // if reject is clicked
  $(document).on('click', '#reject', function() {
    Swal.fire({
      title: 'Are you sure to reject?',
      showCancelButton: true,
      confirmButtonText: 'Reject',
      confirmButtonColor: '#d33',
      input: 'textarea',
      inputLabel: 'Masukan Keterangan',
      inputPlaceholder: 'Tulis keterangan disini...',
      inputAttributes: {
        'aria-label': 'Tulis keterangan disini'
      },
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        var id = $(this).data('id');
        var keterangan = result.value;
        var url = "<?php echo base_url('Submission/reject_dummy/') ?>";
        $.ajax({
          url: url,
          type: "POST",
          data: {
            id: id,
            keterangan: keterangan
          },
          success: function() {
            location.reload();
          }
        });
      }
    })
  });

  $(document).on('click', '#approve_cetak', function() {
    Swal.fire({
      title: 'Yakin sudah selesai mencetak?',
      showCancelButton: true,
      confirmButtonText: 'Approve',
      confirmButtonColor: '#00a65a',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        var id = $(this).data('id');
        var url = "<?php echo base_url('Submission/approve_cetak/') ?>";
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