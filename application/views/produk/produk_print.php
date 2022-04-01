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
    <h3 align="center">DATA Produk</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Kti</th>
		<th>Judul</th>
		<th>Edisi</th>
		<th>Tgl Submit</th>
		<th>No Isbn</th>
		<th>File Hakcipta</th>
		
            </tr><?php
            foreach ($produk_data as $produk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $produk->id_kti ?></td>
		      <td><?php echo $produk->judul ?></td>
		      <td><?php echo $produk->edisi ?></td>
		      <td><?php echo $produk->tgl_submit ?></td>
		      <td><?php echo $produk->no_isbn ?></td>
		      <td><?php echo $produk->file_hakcipta ?></td>	
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