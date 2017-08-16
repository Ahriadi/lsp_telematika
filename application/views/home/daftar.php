<!-- Section: intro -->
    <section id="intro" class="intro">
		<div class="intro-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
					<div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">
					<h2 class="h-ultra">Selamat Datang di Rumah Makan Angkasa Nikmat!</h2>
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
									<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Buat Akun</h3>
									</div>
									<div class="panel-body">
									    <div id="sendmessage">Your message has been sent. Thank you!</div>
                      <div id="errormessage"></div>

  										  <?php echo form_open_multipart('Home/proses_daftar'); ?>
      										<div class="row">
      											<div class="col-xs-6 col-sm-6 col-md-6">
      												<div class="form-group">
      													<label>Nama Lengkap</label>
      													 <input type="text" name="nama_lengkap" placeholder="Nama Lengkap " class="form-control input-md">
                                                          <div class="validation"></div>
      												</div>
      											</div>
      											<div class="col-xs-6 col-sm-6 col-md-6">
      												<div class="form-group">
      													<label>User Name</label>
      													<input type="text" name="username" placeholder="User Name" class="form-control input-md">
                                                          <div class="validation"></div>
      												</div>
      											</div>
      										</div>

      										<div class="row">
      											<div class="col-xs-6 col-sm-6 col-md-6">
      												<div class="form-group">
      													<label>Password</label>
      													<input type="password" name="password" placeholder="Password " class="form-control input-md">
                                                          <div class="validation"></div>
      												</div>
      											</div>
      											<div class="col-xs-6 col-sm-6 col-md-6">
      												<div class="form-group">
      													<label>Email</label>
      													<input type="email" name="email" placeholder="Email" class="form-control input-md">
                                                          <div class="validation"></div>
      												</div>
      											</div>
      										</div>

      										<div class="row">
      											<div class="col-xs-6 col-sm-6 col-md-6">
      												<div class="form-group">
      													<label>Alamat</label>
      													<textarea name="alamat" placeholder="Alamat" rows='3' class="form-control input-md"></textarea>
                                                          <div class="validation"></div>
      												</div>
      											</div>
      											<div class="col-xs-6 col-sm-6 col-md-6">
      												<div class="form-group">
      													<label>No. Telepon</label>
      													<input type="text" name="no_telepon" placeholder="No. Telepon" class="form-control input-md">
                                                          <div class="validation"></div>
      												</div>
      											</div>
      										</div>

      										<input type="submit" value="Daftar" class="btn btn-skin btn-block btn-lg">


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
