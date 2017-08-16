<div class="right_col" role="main">


  <div class="box-header with-border">
    <h2>Edit Data Produk</h2>
    <div class="pull-right">
      <p id="tanggal"><?php echo date("d M Y"); ?></p>
    </div>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div id="header">
            <div class="widget-body">

              <?php echo form_open_multipart('Produk/proses_edit', 'class="form-horizontal", row-border'); ?>
              <div class="form-group">
                <div class="col-md-6">
                  <input class="form-control" type="hidden" name="id_produk" value="<?php echo $entry->id_produk?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Nama Produk</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="nama_produk" value="<?php echo $entry->nama_produk?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Harga</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="harga" value="<?php echo $entry->harga?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Foto</label>
                <div class="col-md-6">
                  <img id="slider" src="<?php echo base_url().'assets/produk/'.$entry->gambar;?>" alt="..." width="100px" height="100px">
                  <br><br>
                  <input class="form-control" type="file" name="userfile">
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
