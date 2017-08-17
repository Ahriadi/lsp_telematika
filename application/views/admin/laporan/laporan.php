<!-- page content -->
<div class="right_col" role="main">
    <h2>Laporan Transaksi Bulanan</h2>

    <!-- sidebar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">

      </div>
      <!-- /.row (main row) -->

	  <!-- Default box -->
	  <!-- <div class="box"> -->
		<div class="box-header with-border">
			<div class="pull-right">
				<p id="tanggal"><?php echo date("d M Y"); ?></p>
			</div>
		</div>
		<div class="box-body">
		<div class=row>
						<?php echo form_open("laporan/find");?>
						<div class='col-md-8'>
						</div>
						<div class="col-md-4" align='right'>

							<div class='col-md-5'>
							<?php $option = array(
									''=>'- Pilih Bulan -',
									'1'=>'Januari',
									'2'=>'Februari',
									'3'=>'Maret',
									'4'=>'April',
									'5'=>'Mei',
									'6'=>'Juni',
									'7'=>'Juli',
									'8'=>'Agustus',
									'9'=>'September',
									'10'=>'Oktober',
									'11'=>'November',
									'12'=>'Desember'
							);
							echo form_dropdown('month',$option,'','class="form-control"');?>
							</div>
							<div class='col-md-5'>
							<?php

							  for($i=2016;$i<=date('Y');$i++){
								  $option2[$i] = $i;
							  }

							  foreach ($option2 as $value) {
							  }

							  echo form_dropdown('year',$option2,date('Y'),'class="form-control"');
								?>
							</div>
							<div class="col-md-1"><input type="submit" name="submit" class="btn btn-info btn-flat" title="Cari Data" value="Go"></div>
						</div>
						<?php echo form_close();?>
			</div><br>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<table border="1px" class="table table-bordered">
						<thead>
							<tr>
								<th style="width:5%">No</th>
								<th>Kode Transaksi</th>
								<th>Alamat</th>
								<th>Tanggal</th>
								<th>Jumlah</th>
								<th style="width:20%">Total Harga</th>
							</tr>
						</thead>
						<tbody>
              <?php
                $no=1;
                if($pesanan_di_proses){
                  foreach ($pesanan_di_proses as $v) {
              ?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $v->id_transaksi ?></td>
								<td><?php echo $v->nama_pesanan ?></td>
								<td><?php echo $v->tgl_pesan ?></td>
								<td><?php echo $v->jumlah ?></td>
								<td><?php echo ($v->jumlah*$v->harga) ?></td>
							</tr>
              <?php
                $no++;
                }
              }
              ?>
						</tbody>

					</table>
					<?php echo $link;?>

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
