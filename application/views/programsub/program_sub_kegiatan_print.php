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
    <h3 align="center">DATA Program Sub Kegiatan</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Program Kegiatan Id</th>
		<th>No Rekening</th>
		<th>Nama</th>
		<th>Tahun</th>
		<th>Anggaran</th>
		
            </tr><?php
            foreach ($programsub_data as $programsub)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $programsub->program_kegiatan_id ?></td>
		      <td><?php echo $programsub->no_rekening ?></td>
		      <td><?php echo $programsub->nama ?></td>
		      <td><?php echo $programsub->tahun ?></td>
		      <td><?php echo $programsub->anggaran ?></td>	
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