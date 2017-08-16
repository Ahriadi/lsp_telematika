<br><br>
<!-- Section: team -->
    <section id="makanan" class="home-section bg-gray paddingbot-60">
		<div class="container marginbot-50">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="wow fadeInDown" data-wow-delay="0.1s">
					<div class="section-heading text-center">
					<h2 class="h-bold">Keranjang Belanja</h2>
					</div>
					</div>
					<div class="divider-short"></div>
				</div>
			</div>
		</div>

		<div class="container">
				<?php
					$message = $this->session->flashdata('notif');
								if($message){
									echo '<p class="alert alert-success text-center">'.$message .'</p>';
								}else{}
				?>
			<div class="row">
				<div class="col-lg-12">

						<table class="table table-bordered">
									<tr>
									  <th style="width: 50px">No</th>
									  <th style="width: 180px">#</th>
									  <th style="width: 350px">Produk</th>
									  <th style="width: 200px">Harga</th>
										<th style="width: 200px">Tujuan Pengiriman</th>
									  <th style="width: 200px">Jumlah</th>
									  <th style="width: 250px">Total</th>
									  <th style="width: 120px">#</th>
									</tr>
									<?php echo form_open('pembelian/simpan_pesanan');?>
									<?php 	if($belanja){
												$no = 1;
												foreach ($belanja as $v){
									?>
										<input type="hidden" name="id_pesanan[]" value="<?php echo $v->id_pesanan;?>">
										<tr>
										  <td><?php echo $no;?></td>
										  <td><img src="<?php echo base_url();?>assets/produk/<?php echo $v->gambar ?>"width="80" height="80" style="width: 100%;max-height: 100%" align="center"></td>
										  <td><?php echo $v->nama_pesanan;?></td>
										  <td>Rp. <?php echo number_format($v->harga,0,",","."); ?></td>
											<td><?php echo $v->alamat;?></td>
										  <td><?php echo $v->jumlah;?></td>
										  <td>Rp. <?php echo number_format(($v->harga * $v->jumlah),0,",","."); ?></td>
										  <td>
											<a href="<?php echo base_url();?>belanja/tampil_edit_keranjang_belanja?id=<?php echo $v->id_pesanan;?>" class="btn btn-warning btn-xs btn-flat" onClick=\'return confirm("Apakah anda ingin menghapus produk ini?")\'><i class="fa fa-edit"></i></a>
											<a  href="<?php echo base_url();?>belanja/hapus_keranjang_belanja?id=<?php echo $v->id_pesanan;?>" class="btn btn-danger btn-xs btn-flat" onClick=\'return confirm("Apakah anda ingin menghapus produk ini?")\'><i class="fa fa-trash"></i></a>
										  </td>
										</tr>
									<?php
									$no++;
												}
									?>
									<?php
										$n = 0;
										foreach ($belanja as $v){
											$total = $v->harga * $v->jumlah;
											$n = $n + $total;
										}
									?>
									<td colspan="6" align="center"> Total Pembayaran </td>
									<td style="color:green;"colspan="2"><b>Rp <?php echo number_format($n,0,",",".");?></b></td>
									<tr><td colspan="8" align="center"><button style="margin-top:15px;margin-bottom:15px;" type="submit" class="btn btn-skin btn-block btn-lg" >Kirim Pesanan</button></td>

									</tr>
									<?php } else { ?>
										<tr>
										  <th style="width: 10px" colspan='8'><center>Data Pesanan Tidak Ada</center></th>
										</tr>
									<?php } ?>
									<?php echo form_close();?>
									</table>
			</div>
			</div>
		</div>

	</section>
	<!-- /Section: team -->
