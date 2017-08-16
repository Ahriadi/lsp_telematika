<!-- page content -->
<div class="right_col" role="main">
    <h2>Transaksi Selesai</h2>

    <!-- sidebar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">


	  <!-- Default box -->
	  <!-- <div class="box"> -->
		<div class="box-header with-border">
			<div class="pull-right">
				<p id="tanggal"><?php echo date("d M Y"); ?></p>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">

				<?php
					$no=1;
					if($transaksi_selesai){
					  foreach ($transaksi_selesai as $s) {
				?>
					<table border="1px" class="table table-bordered">
						<thead>
							<tr>
								<th style="width:5%">No</th>
								<th>Nama Pembeli</th>
								<th>Alamat</th>
								<th>Telepon</th>
								<th>Tanggal</th>
								<th style="width:20%">Detail</th>
							</tr>
						</thead>
						<tbody>
              <?php
                $no=1;
                if($transaksi_selesai){
                  foreach ($transaksi_selesai as $v) {
              ?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $v->username ?></td>
								<td><?php echo $v->alamat ?></td>
								<td><?php echo $v->no_telepon ?></td>
								<td><?php echo $v->tgl_pesan ?></td>
                <th>
                  <div class="btn-group">
                    <a href="<?php echo base_url()?>transaksi_selesai/detail?id_user=<?php echo $v->id_user; ?>" class="btn btn-primary btn-sm " >Lihat Pesanan</a>

                    </div>
                </th>
							</tr>
              <?php
                $no++;
                }
              }
              ?>
						</tbody>

					</table>
					 <?php
                }
              } else {
					echo "<center><b>DATA TIDAK ADA</b><center>";
			  }
              ?>
				</div>
			</div>
		</div>
	  <!-- </div> -->

    </section>
    <!-- /.content -->
  </div>
  <!-- content -->




</div>
<!-- /page content -->
