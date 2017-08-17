<!-- Section: intro -->
    <section id="intro" class="intro">
		<div class="intro-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
					<div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">
					<br><br><h2 style="font-size: 27px;" class="h-ultra">Selamat Datang di Rumah Makan Podoteko!</h2>
					</div>
					<div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.1s">
					<h4 class="h-light">Kebutuhan anda adalah prioritas kami.</h4>
					</div>


					</div>
					<div class="col-lg-6">
						<div class="form-wrapper">
						<div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">

							<div class="panel panel-skin">
							<div class="panel-heading">
									<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Login User </h3>
									</div>
									<div class="panel-body">
									    <div id="sendmessage">Your message has been sent. Thank you!</div>
                                        <div id="errormessage"></div>

    					                <?php echo form_open_multipart('Login_user/proses_login'); ?>
    										<div class="row">
    											<div class="col-xs-6 col-sm-6 col-md-6">
    												<div class="form-group">
    													<label>User Name</label>
    													<input type="text" type="text" name="username" placeholder="username " class="form-control input-md" data-rule="minlen:3" data-msg="Please enter at least 3 chars">
                                                        <div class="validation"></div>
    												</div>
    											</div>
    											<div class="col-xs-6 col-sm-6 col-md-6">
    												<div class="form-group">
    													<label>Password</label>
    													<input type="password" name="password" placeholder="password " class="form-control input-md" data-rule="minlen:3" data-msg="Please enter at least 3 chars">
                                                        <div class="validation"></div>
    												</div>
    											</div>
    										</div>

    										<input type="submit" value="masuk" class="btn btn-skin btn-block btn-lg">

    										<p class="lead-footer">Jika Belum punya akun? Silahkan <a style="font-size: 23px;" href="<?php echo base_url();?>home/daftar">Daftar</a></p>

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

	<!-- /Section: intro -->
