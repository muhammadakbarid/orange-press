<div class="row">
      <div class="col-xs-12 col-md-6">
            <div class="box">
                  <div class="box-header">
                        <h3 class="box-title"><?php echo lang('create_user_heading'); ?></h3>
                        <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                              <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                                    <i class="fa fa-refresh"></i></button>
                        </div>
                  </div>


                  <!-- /.box-header -->
                  <div class="box-body">
                        <p><?php echo lang('create_user_subheading'); ?></p>
                        <?php
                        if ($message != "") {
                        ?>
                              <div id="infoMessage" class="callout callout-danger"><?php echo $message; ?></div>
                        <?php } ?>
                        <?php echo form_open("auth/create_user"); ?>

                        <p>
                              <?php echo lang('create_user_fname_label', 'first_name'); ?> <br />
                              <?php echo form_input($first_name); ?>
                        </p>

                        <p>
                              <?php echo lang('create_user_lname_label', 'last_name'); ?> <br />
                              <?php echo form_input($last_name); ?>
                        </p>

                        <?php
                        if ($identity_column !== 'email') {
                              echo '<p>';
                              echo lang('create_user_identity_label', 'identity');
                              echo '<br />';
                              echo form_error('identity');
                              echo form_input($identity);
                              echo '</p>';
                        }
                        ?>

                        <p>
                              <?php echo lang('create_user_email_label', 'email'); ?> <br />
                              <?php echo form_input($email); ?>
                        </p>


                        <p>
                              <label for="">Nomor KTP</label>
                              <?php echo form_input($no_ktp); ?>
                        </p>
                        <p>
                              <label for="">Nomor Induk Pekerja</label>
                              <?php echo form_input($nip); ?>
                        </p>
                        <p>
                              <label for="">Nomor NPWP</label>
                              <?php echo form_input($no_npwp); ?>
                        </p>
                        <p>
                              <label for="">Jenis Kelamin</label>
                              <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="Laki-Laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                              </select>
                        </p>
                        <p>
                              <label for="">Tempat Lahir</label>
                              <?php echo form_input($tempat_lahir); ?>
                        </p>
                        <p>
                              <label for="">Tanggal Lahir</label>
                              <?php echo form_input($tanggal_lahir); ?>
                        </p>
                        <p>
                              <label for="">Alamat</label>
                              <?php echo form_input($alamat); ?>
                        </p>
                        <p>
                              <label for="">Nomor Telepon</label>
                              <?php echo form_input($no_hp); ?>
                        </p>
                        <p>
                              <label for="">Profesi</label>
                              <?php echo form_input($profesi); ?>
                        </p>
                        <p>
                              <label for="">Nama Instansi</label>
                              <?php echo form_input($nama_instansi); ?>
                        </p>
                        <p>
                              <label for="">Alamat Instansi</label>
                              <?php echo form_input($alamat_instansi); ?>
                        </p>
                        <p>
                              <label for="">Email Instansi</label>
                              <?php echo form_input($email_instansi); ?>
                        </p>
                        <p>
                              <label for="">Nomor Telepon Instansi</label>
                              <?php echo form_input($no_telp_instansi); ?>
                        </p>
                        <p>
                              <label for="">Scan Form Penulis</label>
                              <?php echo form_input($sc_form_penulis); ?>
                        </p>
                        <p>
                              <label for="">Scan KTP</label>
                              <?php echo form_input($sc_ktp); ?>
                        </p>
                        <p>
                              <label for="">Scan CV</label>
                              <?php echo form_input($sc_cv); ?>
                        </p>
                        <p>
                              <label for="">Scan NPWP</label>
                              <?php echo form_input($sc_npwp); ?>
                        </p>
                        <p>
                              <label for="">Scan Foto</label>
                              <?php echo form_input($sc_foto); ?>
                        </p>
                        <p>
                              <label for="">Bidang Kompetensi</label>
                              <?php echo form_input($bidang_kompetensi); ?>
                        </p>

                        <p>
                              <?php echo lang('create_user_password_label', 'password'); ?> <br />
                              <?php echo form_input($password); ?>
                        </p>

                        <p>
                              <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?> <br />
                              <?php echo form_input($password_confirm); ?>
                        </p>


                        <p><?php echo form_submit('submit', lang('create_user_submit_btn'), 'class="btn bg-purple"'); ?></p>

                        <?php echo form_close(); ?>

                  </div>
            </div>
      </div>
</div>