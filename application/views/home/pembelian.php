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
				<?php
					$message = $this->session->flashdata('notif');
						if($message){
						  echo '<p class="alert alert-success text-center">'.$message .'</p>';
						}else{}
						?>
						<?php
						if($pembelian){
								$no = 1;
								foreach ($pembelian as $s){
				?>
						<table class="table table-bordered">
									<tr>
									  <th style="width: 50px">No</th>
									  <th style="width: 180px">#</th>
									  <th style="width: 350px">Produk</th>
									  <th style="width: 200px">Harga</th>
									  <th style="width: 200px">Tujuan Pengiriman</th>
									  <th style="width: 200px">Jumlah</th>
									  <th style="width: 250px">Total</th>
									</tr>
									<?php echo form_open('belanja/simpan_pesanan');?>
									<?php
										  $tampil_pembelian = $this->M_pembelian->tampil_pembelian($s->status);
										  if($tampil_pembelian){
											$no = 1;
											foreach ($tampil_pembelian as $v){
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
									</tr>
									  <?php
									  $no++;
											}
									  ?>
									  <?php
										$n = 0;
										foreach ($tampil_pembelian as $v){
										  $total = $v->harga * $v->jumlah;
										  $n = $n + $total;
										}
									  ?>
									<td colspan="6" align="center"> Total Pembayaran </td>
									<td style="color:green;"colspan="2"><b>Rp <?php echo number_format($n,0,",",".");?></b></td>
									  <?php
										$n = 0;
										$menunggu_konfirmasi = $this->M_pembelian->menunggu_konfirmasi($v->id_transaksi);
										$telah_di_konfirmasi = $this->M_pembelian->telah_di_konfirmasi($v->id_transaksi);
										$transaksi_selesai = $this->M_pembelian->transaksi_selesai($v->id_transaksi);
										if($menunggu_konfirmasi){
									  ?>
										  <tr><td colspan="7" align="center"><i style="margin-top:15px;margin-bottom:15px;" class="btn btn-warning btn-lg" >Menunggu Konfirmasi</i></td></tr>
									  <?php
										} else if ($telah_di_konfirmasi){ ?>
										  <tr><td colspan="7" align="center"><i style="margin-top:15px;margin-bottom:15px;" class="btn btn-warning btn-lg" >Telah di Konfirmasi, Silahkan Menunggu Telepon Dari Admin</i></td></tr>
									  <?php
										} else if ($transaksi_selesai){ ?>
										  <tr><td colspan="7" align="center"><a class="btn btn-success btn-lg" >Transaksi Selesai</a></td></tr>
									  <?php
										}
									  ?>
									  <?php } else { ?>
									<tr>
									  <th style="width:10px" colspan='8'><center>Data Pesanan Tidak Ada</center></th>
									</tr>
									<?php } ?>
									<?php echo form_close();?>
									</table>
									 <?php }
                        echo $link;
                        } else {}
                        ?>
			</div>
			</div>
		</div>

	</section>
	<!-- /Section: team -->
