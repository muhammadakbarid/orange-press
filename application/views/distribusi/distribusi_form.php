<?php
// print_r($produk_distribusi);
// die;
?><div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Distribusi</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group">
                        <label for="id_produk">Produk</label>
                        <select class="form-control select2" required="true" name="id_produk">
                            <?php

                            foreach ($produk as $value) {
                                echo "<option value='" . $value->id_produk . "'";
                                if (isset($id_produk)) {
                                    if ($id_produk == $value->id_produk) {
                                        echo " selected";
                                    }
                                }
                                echo ">" . $value->judul . " (" . $value->no_isbn . ") " . "</option>";
                            }
                            ?>
                        </select>
                        <?= form_error('lead_editor', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah <?php echo form_error('jumlah') ?></label>
                        <input type="number" class="form-control" rows="3" name="jumlah" id="jumlah" placeholder="Jumlah Distribusi" value="<?php echo $jumlah; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tujuan_distribusi">Tujuan Distribusi <?php echo form_error('tujuan_distribusi') ?></label>
                        <input class="form-control" rows="3" name="tujuan_distribusi" id="tujuan_distribusi" placeholder="Tujuan Distribusi" value="<?php echo $tujuan_distribusi; ?>">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_distribusi">Tanggal Distribusi <?php echo form_error('tanggal_distribusi') ?></label>
                        <input class="formdate form-control" rows="3" name="tanggal_distribusi" id="tanggal_distribusi" placeholder="Tanggal Distribusi" value="<?php echo $tanggal_distribusi; ?>">
                    </div>


                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('distribusi') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>