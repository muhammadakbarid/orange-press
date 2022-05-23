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
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul Produk</th>
              <th>ISBN Produk</th>
              <th>Tujuan Distribusi</th>
              <th>Jumlah</th>
              <th>Tanggal Distribusi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($list_distribusi as $value) {
            ?>
              <tr>
                <td class="text-center" style="width: 10px;"><?php echo $no++ ?></td>
                <td><?php echo $value->judul ?></td>
                <td><?php echo $value->no_isbn ?></td>
                <td><?php echo $value->tujuan_distribusi ?></td>
                <td><?php echo $value->jumlah ?></td>
                <td><?php echo $value->tanggal_distribusi ?></td>

              </tr>
            <?php } ?>

          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Judul Produk</th>
              <th>ISBN Produk</th>
              <th>Tujuan Distribusi</th>
              <th>Jumlah</th>
              <th>Tanggal Distribusi</th>

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