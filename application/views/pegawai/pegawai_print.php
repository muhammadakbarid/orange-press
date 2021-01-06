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
    <h3 align="center">DATA Pegawai</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nip</th>
		<th>Nama</th>
		<th>Jenis Kelamin</th>
		<th>Jabatan</th>
		<th>Pangkat Id</th>
		<th>Jabatan Status</th>
		<th>Jabatan Fungsi</th>
		<th>Eselon</th>
		<th>Skpd Sub Bagian Id</th>
		<th>Komisi</th>
		<th>Status</th>
		<th>Create On</th>
		<th>Users Id</th>
		
            </tr><?php
            foreach ($pegawai_data as $pegawai)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pegawai->nip ?></td>
		      <td><?php echo $pegawai->nama ?></td>
		      <td><?php echo $pegawai->jenis_kelamin ?></td>
		      <td><?php echo $pegawai->jabatan ?></td>
		      <td><?php echo $pegawai->pangkat_id ?></td>
		      <td><?php echo $pegawai->jabatan_status ?></td>
		      <td><?php echo $pegawai->jabatan_fungsi ?></td>
		      <td><?php echo $pegawai->eselon ?></td>
		      <td><?php echo $pegawai->skpd_sub_bagian_id ?></td>
		      <td><?php echo $pegawai->komisi ?></td>
		      <td><?php echo $pegawai->status ?></td>
		      <td><?php echo $pegawai->create_on ?></td>
		      <td><?php echo $pegawai->users_id ?></td>	
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