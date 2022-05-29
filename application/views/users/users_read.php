<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table" id="riwayat_sunting">
                    <tr>
                        <td>Nama</td>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <td>No KTP</td>
                        <td><?php echo $no_ktp; ?></td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td><?php echo $nip; ?></td>
                    </tr>
                    <tr>
                        <td>No NPWP</td>
                        <td><?php echo $no_npwp; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td><?php echo $jenis_kelamin; ?></td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td><?php echo $tempat_lahir; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td><?php echo $tanggal_lahir; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><?php echo $alamat; ?></td>
                    </tr>
                    <tr>
                        <td>Nomor HP</td>
                        <td><?php echo $no_hp; ?></td>
                    </tr>
                    <tr>
                        <td>Profesi</td>
                        <td><?php echo $profesi; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Instansi</td>
                        <td><?php echo $nama_instansi; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat Instansi</td>
                        <td><?php echo $alamat_instansi; ?></td>
                    </tr>
                    <tr>
                        <td>Email Instansi</td>
                        <td><?php echo $email_instansi; ?></td>
                    </tr>
                    <tr>
                        <td>No Telp Instansi</td>
                        <td><?php echo $no_telp_instansi; ?></td>
                    </tr>
                    <tr>
                        <td>Scan Form Penulis</td>
                        <td><a href="<?= base_url('Submission/get_sc_form_penulis/' . $sc_form_penulis); ?>"><?php echo $sc_form_penulis; ?></a></td>
                    </tr>
                    <tr>
                        <td>Scan KTP</td>
                        <td><a href="<?= base_url('Submission/get_sc_ktp/' . $sc_ktp); ?>"><?php echo $sc_ktp; ?></a></td>
                    </tr>
                    <tr>
                        <td>Scan CV</td>
                        <td><a href="<?= base_url('Submission/get_sc_cv/' . $sc_cv); ?>"><?php echo $sc_cv; ?></a></td>
                    </tr>
                    <tr>
                        <td>Scan NPWP</td>
                        <td><a href="<?= base_url('Submission/get_sc_npwp/' . $sc_npwp); ?>"><?php echo $sc_npwp; ?></a></td>
                    </tr>
                    <tr>
                        <td>Scan foto</td>
                        <td><a href="<?= base_url('Submission/get_sc_foto/' . $sc_foto); ?>"><?php echo $sc_foto; ?></a></td>
                    </tr>
                    <tr>
                        <td>Bidang Kompetensi</td>
                        <td><?php echo $bidang_kompetensi; ?></td>
                    </tr>
                    <tr>
                        <td>Created On</td>
                        <td><?php echo $create_on; ?></td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td><?php echo $active; ?></td>
                    </tr>
                    <tr>
                        <td><a href="<?php echo site_url('users') ?>" class="btn bg-purple">Cancel</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>