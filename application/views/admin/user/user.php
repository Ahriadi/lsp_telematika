

        <!-- page content -->
<div class="right_col" role="main">


    <h2>Data user</h2>
      <div class="box-header with-border">
        <div class="pull-right">
          <p id="tanggal"><?php echo date("d M Y"); ?></p>
        </div>
      </div>
      <div class="box-body">
        <div class="row">

          <div class="col-lg-12 col-md-12">
            <!-- <?php echo anchor('Produk/tambah', '<button class="btn btn-primary">Tambah Data</button>'); ?> -->
            <?php echo anchor('Produk',
              '<button type="button" class="btn btn-success
              "data-toggle="tooltip" data-placement="top" title="Refresh Produk">
              Refresh</button>'); ?>
            <?php echo anchor('', '<button class="btn btn-primary">Kembali</button>'); ?>
            <div style= "float:right;">
              <?php echo form_open('produk/search' ); ?>
              <input type="text" name="search">
              <input type="submit" value="SEARCH">
              <?php echo form_close(); ?>
            </div>


            <hr>

            <table border="1px" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width:5%">No</th>
                  <th>Nama Lengkap</th>
                  <th>Alamat</th>
                  <th>Email</th>
                  <th>No Telepon</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th style="width:15%">Pilihan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no=1;
                  if($user){
                    foreach ($user as $v) {
                ?>
                <tr>
                  <th><?php echo $no ?></th>
                  <th><?php echo $v->nama_lengkap; ?></th>
                  <th><?php echo $v->alamat; ?></th>
                  <th><?php echo $v->email; ?></th>
                  <th><?php echo $v->no_telepon; ?></th>
                  <th><?php echo $v->username; ?></th>
                  <th>********************************</th>
                  <th>
                      <?php echo anchor('user/edit?id_user='.$v->id_user, '<button class="btn btn-success">Edit</button>'); ?>
                      <?php echo anchor('user/proses_hapus?id_user='.$v->id_user, '<button class="btn btn-primary">Hapus</button>' , "onclick=\"return confirm('Anda Yakin Akan Menghapus?')\""); ?>
                  </th>
                </tr>
                <?php
                  $no++;
                  }
                }
                ?>
              </tbody>

            </table>
            <!-- <?php echo $links ?> -->
          </div>
        </div>
      </div>










</div>
