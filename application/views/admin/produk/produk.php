

        <!-- page content -->
        <div class="right_col" role="main">


          <h2>Data Daftar Produk</h2>
        		<div class="box-header with-border">
        			<div class="pull-right">
        				<p id="tanggal"><?php echo date("d M Y"); ?></p>
        			</div>
        		</div>
        		<div class="box-body">
        			<div class="row">

        				<div class="col-lg-12 col-md-12">
        					<?php echo anchor('Produk/tambah', '<button class="btn btn-primary">Tambah Data</button>'); ?>
        					<?php echo anchor('Produk',
        						'<button type="button" class="btn btn-success
        						"data-toggle="tooltip" data-placement="top" title="Refresh Produk">
        						Refresh</button>'); ?>
        				  <!-- <?php echo anchor('Menu', '<button class="btn btn-primary">Kembali</button>'); ?> -->
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
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th style="width:15%">Pilihan</th>
        							</tr>
        						</thead>
        						<tbody>
                      <?php
                        $no=1;
                        if($produk){
                          foreach ($produk as $v) {
                      ?>
        							<tr>
        								<th><?php echo $no ?></th>
        								<th><?php echo $v->nama_produk; ?></th>
                        <th><?php echo $v->harga; ?></th>
                        <th><img id="slider" src="<?php echo base_url()."/assets/produk/".$v->gambar;?>" alt="..." width="100px" height="100px"></th>
        				<!--<th><img id="slider" src="<?php echo base_url()."/files/makanan/".$d->gambar;?>" alt="..." width="100px" height="100px"></th>-->
                        <!-- <th>
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Pilihan
                            <span class="caret"></span></button>
                              <ul class="dropdown-menu" role="menu">
                                  <li><?php echo anchor('produk/edit?id_produk='.$v->id_produk."",'Edit');?></li>
                                  <li><?php echo anchor('Produk/proses_hapus?id_produk='.$v->id_produk,
                                    'Hapus' ,
                                    "onclick=\"return confirm('Anda Yakin Akan Menghapus?')\""); ?>
                                  </li>
                              </ul>
                            </div>
                        </th> -->
                        <th>
                            <?php echo anchor('produk/edit?id_produk='.$v->id_produk, '<button class="btn btn-success">Edit</button>'); ?>
                            <?php echo anchor('Produk/proses_hapus?id_produk='.$v->id_produk, '<button class="btn btn-primary">Hapus</button>' , "onclick=\"return confirm('Anda Yakin Akan Menghapus?')\""); ?>
                        </th>
        							</tr>
                      <?php
                        $no++;
                        }
                      }
                      ?>
        						</tbody>

        					</table>
                  <?php echo $links ?>
        				</div>
        			</div>
        		</div>


        </div>
        <!-- /page content -->
