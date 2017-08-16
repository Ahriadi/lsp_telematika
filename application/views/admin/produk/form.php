<div class="right_col" role="main">


  <div class="box-header with-border">
    <h2>Tambah Data Produk</h2>
    <div class="pull-right">
      <p id="tanggal"><?php echo date("d M Y"); ?></p>
    </div>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div id="header">
            <div class="widget-body">
              <?php echo form_open_multipart('Produk/proses_tambah', 'class="form-horizontal", row-border'); ?>
              <div class="form-group">
                <label class="col-md-2 control-label">Nama Produk</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="nama_produk" placeholder="Masukkan Nama Produk" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Harga</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="harga" placeholder="Masukkan  harga" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Foto</label>
                <div class="col-md-6">
                  <input class="form-control" type="file" name="userfile" placeholder="Masukkan Nama Kategori">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-info">Simpan</button>
                  <button type="reset" class="btn btn-danger" title="kembali">Reset</button>
                  <?php echo anchor('produk', '<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="kembali ke index produk">Kembali</button>');  ?>
                </div>
              </div>

            </div>
        </div>
      </div>
    </div>
  </div>


</div>
