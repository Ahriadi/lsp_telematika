<!-- page content -->
<div class="right_col" role="main">
    <h2>Selamat Datang Admin</h2>




    <!-- sidebar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pesanan Masuk
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">

      </div>
      <!-- /.row (main row) -->

	  <!-- Default box -->
	  <!-- <div class="box"> -->
		<div class="box-header with-border">
			<h3 class="box-title">Data Pesanan Masuk</h3>
			<div class="pull-right">
				<p id="tanggal"><?php echo date("d M Y"); ?></p>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div align="right">
					<a href="<?php echo base_url();?>pesanan_masuk" class="btn btn-sm btn-warning">Kembali</a>
					<div><br>

					<table border="1px" class="table table-bordered">
						<thead>
							<tr>
							  <th style="width: 10px">No</th>
							  <th style="width: 100px"></th>
							  <th style="width: 300px">Produk</th>
							  <th style="width: 300px">Harga</th>
							  <th style="width: 300px">Jumlah</th>
							  <th style="width: 300px">Tujuan Pengiriman</th>
							  <th style="width: 300px">Total</th>
							</tr>
						</thead>
						<tbody>
				<?php echo form_open('pembelian/terima_pesanan');?>
              	<?php
					$no=1;
					if($pesanan_masuk){
					  foreach ($pesanan_masuk as $v) {
				?>
					<input type="hidden" name="id_pesanan[]" value="<?php echo $v->id_pesanan;?>">
					<input type="hidden" name="id_user" value="<?php echo $v->id_user;?>">
					<tr>
						  <td><?php echo $no;?></td>
						  <td><img src="<?php echo base_url();?>assets/produk/<?php echo $v->gambar ?>"width="80" height="80" style="width: 100%;max-height: 100%" align="center"></td>
						  <td><?php echo $v->nama_pesanan;?></td>
						  <td>Rp. <?php echo number_format($v->harga,0,",","."); ?></td>
						  <td><?php echo $v->jumlah;?></td>
						  <td><?php echo $v->alamat;?></td>
						  <td>Rp. <?php echo number_format(($v->harga * $v->jumlah),0,",","."); ?></td>
					</tr>


					<?php
					}
					$no++;
						$n = 0;
						foreach ($pesanan_masuk as $v){
							$total = $v->harga * $v->jumlah;
							$n = $n + $total;
						}
					?>
					<td colspan="5" align="center"> Total Pembayaran </td>
					<td style="color:green;"colspan="2"><b>Rp <?php echo number_format($n,0,",",".");?></b></td>
					<tr><td colspan="7" align="center"><button class="btn btn-success btn-flat btn-sm" >Terima Pesanan</button></td></tr>
              <?php } else {
              ?>

						<tr>
						  <th style="width: 10px" colspan='7'><center>Data Pesanan Tidak Ada</center></th>
						</tr>
			    <?php }
              ?>
						</tbody>
				   <?php echo form_close();?>
					</table>

				</div>
			</div>
		</div>
	  </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- </div> -->
  <!-- content -->











</div>
<!-- /page content -->
