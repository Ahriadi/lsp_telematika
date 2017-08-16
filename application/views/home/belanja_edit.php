<br><br>
<!-- Section: team -->
    <section id="makanan" class="home-section bg-gray paddingbot-60">
		<div class="container marginbot-50">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="wow fadeInDown" data-wow-delay="0.1s">
					<div class="section-heading text-center">
					<h2 class="h-bold">Ubah Keranjang Belanja</h2>
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

					<div class="col-lg-3">
					</div>
					<div class="col-lg-6">
						<div class="form-wrapper">
						<div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">

							<div class="panel panel-skin">
							<div class="panel-heading">
									<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span></h3>
									</div>
									<div class="panel-body">
									    <div id="sendmessage">Your message has been sent. Thank you!</div>
                                        <div id="errormessage"></div>

										<?php echo form_open_multipart('belanja/update_keranjang_belanja'); ?>

										<input type="hidden" name="id_pesanan" class="form-control" value="<?php echo $entry->id_pesanan;?>" >

    										<div class="row">
    											<div class="col-xs-12 col-sm-12 col-md-12">
    												<div class="form-group">
    													<label>Nama Produk</label>
    													<input type="text" name="nama_produk" class="form-control input-md" value="<?php echo $entry->nama_pesanan;?>" readonly >
                                                        <div class="validation"></div>
    												</div>
    											</div>
    											<div class="col-xs-12 col-sm-12 col-md-12">
    												<div class="form-group">
    													<label>Harga</label>
														<input type="text" name="harga" class="form-control input-md" value="Rp. <?php echo number_format($entry->harga,0,",","."); ?>" readonly >
                                                        <div class="validation"></div>
    												</div>
    											</div>
    										</div>

    										<div class="row">
    											<div class="col-xs-12 col-sm-12 col-md-12">
    												<div class="form-group">
    													<label>Jumlah</label>
    													<input type="number" name="jumlah" class="form-control input-md" value="<?php echo $entry->jumlah;?>" >
                                                        <div class="validation"></div>
    												</div>
    											</div>
    											<div class="col-xs-12 col-sm-12 col-md-12">
    												<div class="form-group">
    													<label>Tujuan Pengiriman</label>
    													<textarea name="alamat" placeholder="Alamat" rows='3' class="form-control input-md"><?php echo $entry->alamat;?></textarea>
                              <div class="validation"></div>
    												</div>
    											</div>
    										</div>

    										<input type="submit" value="Simpan" class="btn btn-skin btn-lg">
    										<a class="btn btn-warning btn-lg" href="<?php echo base_url();?>belanja">Kembali</a>


    									<?php echo form_close();?>
								</div>
							</div>

						</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
	<!-- /Section: team -->
