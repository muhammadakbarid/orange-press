<!-- Default box -->
<div class="row">

  <!--  box edit-->
  <div class="col-md-6 col-xs-12">
    <div class="box box-primary">
      <!-- flashdata -->

      <div class="box-header with-border">
        <h3 class="box-title">Edit Profil</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <?php echo form_open_multipart('profile'); ?>
      <div class="box-body">
        <?php
        if ($this->ion_auth->in_group("penulis")) { ?>
          <?php if ($this->session->flashdata('message')) : ?>
            <div class="form-group">
              <?= $this->session->flashdata('message'); ?>
            </div>
          <?php endif; ?>
        <?php } ?>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="first_name">First Name</label>
              <input type="text" class="form-control" id="first_name" value="<?= $user['first_name']; ?>" name="first_name">
              <?= form_error('first_name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="col-md-6">
              <label for="last_name">Last Name</label>
              <input type="text" class="form-control" id="last_name" value="<?= $user['last_name']; ?>" name="last_name">
              <?= form_error('last_name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
        </div>


        <div class="form-group">
          <label for="email">Email address</label>
          <input type="text" class="form-control" id="email" value="<?= $user['email']; ?>" name="email">
          <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
          <div class="custom-file">
            <label for="formFile" class="form-label">Photo</label>
            <input type="file" class="custom-file-input form-control" id="image" name="image">
            <label for="formFile" class="form-label">
              File : <a class="text-light" href="<?= base_url('/assets/uploads/image/profile/'); ?><?php echo $user['image']; ?>"><?php echo $user['image']; ?></a>
            </label>

          </div>
        </div>
        <div class="form-group">
          <label for="no_ktp">Nomor Kartu Tanda Penduduk (KTP)</label>
          <input type="text" class="form-control" id="no_ktp" value="<?= $user['no_ktp']; ?>" name="no_ktp">
          <?= form_error('no_ktp', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
          <label for="nip">Nomor Induk Pekerja (NIP)</label>
          <input type="text" class="form-control" id="nip" value="<?= $user['nip']; ?>" name="nip">
          <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
          <label for="no_npwp">Nomor Pokok Wajib Pajak (NPWP)</label>
          <input type="text" class="form-control" id="no_npwp" value="<?= $user['no_npwp']; ?>" name="no_npwp">
          <?= form_error('no_npwp', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
          <label for="int">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
          <select class="form-select form-control" name="jenis_kelamin" id="jenis_kelamin">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <?php
            foreach ($jenis_kelamin as $jenis_kelamin) {
              echo "<option value='" . $jenis_kelamin . "'";
              if ($user['jenis_kelamin'] == $jenis_kelamin) {
                echo " selected";
              }
              echo ">" . $jenis_kelamin . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="tempat_lahir">Tempat Lahir</label>
          <input type="text" class="form-control" id="tempat_lahir" value="<?= $user['tempat_lahir']; ?>" name="tempat_lahir">
          <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
          <label for="date">Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></label>
          <input type="text" class="form-control formdate" name="tanggal_lahir" id="tanggal_lahir" required="true" value="<?php echo $user['tanggal_lahir']; ?>" />
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea type="text" class="form-control" id="alamat" value="<?= $user['alamat']; ?>" name="alamat"><?= $user['alamat']; ?></textarea>
          <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
          <label for="no_hp">Nomor Handphone</label>
          <input type="text" class="form-control" id="no_hp" value="<?= $user['no_hp']; ?>" name="no_hp">
          <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
          <label for="profesi">Profesi</label>
          <input type="text" class="form-control" id="profesi" value="<?= $user['profesi']; ?>" name="profesi">
          <?= form_error('profesi', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <!-- jika penulis -->
        <?php if ($this->ion_auth->in_group('penulis')) { ?>
          <div class="form-group">
            <label for="nama_instansi">nama_instansi</label>
            <input type="text" class="form-control" id="nama_instansi" value="<?= $user['nama_instansi']; ?>" name="nama_instansi">
            <?= form_error('nama_instansi', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="alamat_instansi">Alamat Instansi</label>
            <textarea type="text" class="form-control" id="alamat_instansi" value="<?= $user['alamat_instansi']; ?>" name="alamat_instansi"><?= $user['alamat_instansi']; ?></textarea>
            <?= form_error('alamat_instansi', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="email_instansi">email_instansi</label>
            <input type="text" class="form-control" id="email_instansi" value="<?= $user['email_instansi']; ?>" name="email_instansi">
            <?= form_error('email_instansi', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="no_telp_instansi">no_telp_instansi</label>
            <input type="text" class="form-control" id="no_telp_instansi" value="<?= $user['no_telp_instansi']; ?>" name="no_telp_instansi">
            <?= form_error('no_telp_instansi', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group">
            <div class="custom-file">
              <label for="sc_form_penulis" class="form-label">Scan Form Penulis</label>
              <input type="file" class="custom-file-input form-control" id="sc_form_penulis" name="sc_form_penulis">
              <label for="formFile" class="form-label">
                File : <a class="text-light" href="<?= base_url('/assets/uploads/files/sc_form_penulis/'); ?><?php echo $user['sc_form_penulis']; ?>"><?php echo $user['sc_form_penulis']; ?></a>
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="custom-file">
              <label for="sc_ktp" class="form-label">Scan KTP</label>
              <input type="file" class="custom-file-input form-control" id="sc_ktp" name="sc_ktp">
              <label for="formFile" class="form-label">
                File : <a class="text-light" href="<?= base_url('/assets/uploads/files/sc_ktp/'); ?><?php echo $user['sc_ktp']; ?>"><?php echo $user['sc_ktp']; ?></a>
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="custom-file">
              <label for="sc_cv" class="form-label">Scan CV</label>
              <input type="file" class="custom-file-input form-control" id="sc_cv" name="sc_cv">
              <label for="formFile" class="form-label">
                File : <a class="text-light" href="<?= base_url('/assets/uploads/files/sc_cv/'); ?><?php echo $user['sc_cv']; ?>"><?php echo $user['sc_cv']; ?></a>
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="custom-file">
              <label for="sc_npwp" class="form-label">Scan NPWP</label>
              <input type="file" class="custom-file-input form-control" id="sc_npwp" name="sc_npwp">
              <label for="formFile" class="form-label">
                File : <a class="text-light" href="<?= base_url('/assets/uploads/files/sc_npwp/'); ?><?php echo $user['sc_npwp']; ?>"><?php echo $user['sc_npwp']; ?></a>
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="custom-file">
              <label for="sc_foto" class="form-label">Scan Foto</label>
              <input type="file" class="custom-file-input form-control" id="sc_foto" name="sc_foto">
              <label for="formFile" class="form-label">
                File : <a class="text-light" href="<?= base_url('/assets/uploads/files/sc_foto/'); ?><?php echo $user['sc_foto']; ?>"><?php echo $user['sc_foto']; ?></a>
              </label>
            </div>
          </div>
        <?php } ?>
        <div class="form-group">
          <label for="int">Bidang Kompetensi <?php echo form_error('bidang_kompetensi') ?></label>
          <select class="form-select form-control" name="bidang_kompetensi" id="bidang_kompetensi">
            <option value="">-- Pilih Bidang Kompetensi --</option>
            <?php
            foreach ($bidang_kompetensi as $bidang_kompetensi) {
              echo "<option value='" . $bidang_kompetensi . "'";
              if ($user['bidang_kompetensi'] == $bidang_kompetensi) {
                echo " selected";
              }
              echo ">" . $bidang_kompetensi . "</option>";
            }
            ?>
          </select>
        </div>

      </div>


      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      <?= form_close();; ?>
    </div>
  </div>
  <!--  / box edit-->

  <div class="col-md-3 col-xs-12">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?= base_url('assets/uploads/image/profile/') . $user['image']; ?>" alt="User profile picture">
        <h3 class="profile-username text-center"><?= $user['first_name'] . ' ' . $user['last_name']; ?></h3>
        <p class="text-muted text-center">Jabatan : <?= $usergroups['name']; ?></p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Email</b> <a class="pull-right"><?= $email; ?></a>
          </li>
          <li class="list-group-item">
            <b>Name</b> <a class="pull-right"><?= $user['first_name'] . ' ' . $user['last_name']; ?></a>
          </li>
          <li class="list-group-item">
            <b>Account Created</b> <a class="pull-right"><?= dateIna($user['create_on']); ?></a>
          </li>
        </ul>
        <a href="<?= base_url(); ?>auth/logout" class="btn bg-purple btn-block"><b>Sign Out</b></a>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>

</div>