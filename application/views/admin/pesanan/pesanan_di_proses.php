<!-- page content -->
<div class="right_col" role="main">
    <h2>Pesanan Di Proses</h2>





    <!-- sidebar -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
          <div class="row">

          </div>
          <!-- /.row (main row) -->

    	  <!-- Default box -->
    	  <div class="box-header with-border">
    			<!-- <h3 class="box-title">Data Pesanan Di Proses</h3> -->
    			<div class="pull-right">
    				<p id="tanggal"><?php echo date("d M Y"); ?></p>
    			</div>
    		</div>
    		<div class="box-body">
    		<div class=row>
    						<?php echo form_open("pesanan_di_proses/find");?>
    						<div class='col-md-6'>
    							</div>

    							<div class='col-md-2'>
    							<?php $option = array(
    									'nama_lengkap'=>'Nama Lengkap',
    									'no_telepon'=>'Telepon'
    							);
    							echo form_dropdown('column',$option,'','class="form-control"');?>
    							</div>
    							<div class='col-md-3'><input type="text" class="form-control" name="data" placeholder="Cari">
    							</div>
    							<div class="col-md-1"><input type="submit" name="submit" class="btn btn-info btn-flat" title="Cari Data" value="Go"></div>

    						<?php echo form_close();?>
    			</div><br>
    			<div class="row">
    				<div class="col-lg-12 col-md-12">
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
                    if($pesanan_di_proses){
                      foreach ($pesanan_di_proses as $v) {
                  ?>
    							<tr>
    								<td><?php echo $no ?></td>
    								<td><?php echo $v->username ?></td>
    								<td><?php echo $v->alamat ?></td>
    								<td><?php echo $v->no_telepon ?></td>
    								<td><?php echo $v->tgl_pesan ?></td>
                    <th>
                      <div class="btn-group">
                        <a href="<?php echo base_url()?>pesanan_di_proses/detail?id_user=<?php echo $v->id_user; ?>" class="btn btn-primary btn-sm " >Lihat Pesanan</a>

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
    					<?php echo $link;?>

    				</div>
    			</div>
    		</div>

        </section>
        <!-- /.content -->
      </div>
      <!-- content -->






</div>
<!-- /page content -->
