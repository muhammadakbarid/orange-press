<!DOCTYPE html>
<html>

<head>
  <title>Tittle</title>
  <style type="text/css" media="print">
    @page {
      margin: 0;
      /* this affects the margin in the printer settings */
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
    }

    table th {
      -webkit-print-color-adjust: exact;
      border: 1px solid;

      padding-top: 11px;
      padding-bottom: 11px;
      background-color: #a29bfe;
    }

    table td {
      border: 1px solid;

    }
  </style>
</head>

<body>
  <h3 align="center">DATA Riwayat</h3>
  <h4>Tanggal Cetak : <?= date("d/M/Y"); ?> </h4>
  <table class="word-table" style="margin-bottom: 10px">
    <tr>
      <th>No</th>
      <th>Id Produk</th>
      <th>Tgl Plotting</th>
      <th>Tgl Selesai</th>
      <th>Status Kerjaan</th>

    </tr><?php
          foreach ($Riwayat_data as $Riwayat) {
          ?>
      <tr>
        <td><?php echo ++$start ?></td>
        <td><?php echo $Riwayat->id_produk ?></td>
        <td><?php echo $Riwayat->tgl_plotting ?></td>
        <td><?php echo $Riwayat->tgl_selesai ?></td>
        <td><?php echo $Riwayat->status_kerjaan ?></td>
      </tr>
    <?php
          }
    ?>
  </table>
</body>
<script type="text/javascript">
  window.print()
</script>

</html>