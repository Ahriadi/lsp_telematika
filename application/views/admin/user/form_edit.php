<div class="right_col" role="main">


  <div class="box-header with-border">
    <h2>Edit Data User</h2>
    <div class="pull-right">
      <p id="tanggal"><?php echo date("d M Y"); ?></p>
    </div>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div id="header">
            <div class="widget-body">

              <?php echo form_open_multipart('user/proses_edit', 'class="form-horizontal", row-border'); ?>
              <div class="form-group">
                <div class="col-md-6">
                  <input class="form-control" type="hidden" name="id_user" value="<?php echo $entry->id_user?>" readonly>
                  <!-- <input class="form-control" type="hidden" name="id_user" value="<?php echo $entry->id_user ?>" maxlength="100"  readonly> -->
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Nama Lengkap</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="nama_lengkap" value="<?php echo $entry->nama_lengkap?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Alamat</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="alamat" value="<?php echo $entry->alamat?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Email</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="email" value="<?php echo $entry->email?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">No Telepon</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="no_telepon" value="<?php echo $entry->no_telepon?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Username</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="username" value="<?php echo $entry->username?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Password</label>
                <div class="col-md-6">
                  <input class="form-control" type="password" name="password" >
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-info">Simpan</button>
                  <button type="reset" class="btn btn-danger" title="kembali">Reset</button>
                  <?php echo anchor('produk', '<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="kembali ke produk">Kembali</button>');  ?>
                </div>
              </div>

            </div>
        </div>
      </div>
    </div>
  </div>


</div>
