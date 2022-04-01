<!DOCTYPE html>
<html>
<head>
    <title>Tittle</title>
    <style type="text/css" media="print">
    @page {
        margin: 0;  /* this affects the margin in the printer settings */
    }
      table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
      }
      table th{
          -webkit-print-color-adjust:exact;
        border: 1px solid;

                padding-top: 11px;
    padding-bottom: 11px;
    background-color: #a29bfe;
      }
   table td{
        border: 1px solid;

   }
        </style>
</head>
<body>
    <h3 align="center">DATA File Attach</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Riwayat</th>
		<th>Nama File</th>
		<th>Url File</th>
		<th>Keterangan</th>
		<th>Create On</th>
		
            </tr><?php
            foreach ($file_attach_data as $file_attach)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $file_attach->id_riwayat ?></td>
		      <td><?php echo $file_attach->nama_file ?></td>
		      <td><?php echo $file_attach->url_file ?></td>
		      <td><?php echo $file_attach->keterangan ?></td>
		      <td><?php echo $file_attach->create_on ?></td>	
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