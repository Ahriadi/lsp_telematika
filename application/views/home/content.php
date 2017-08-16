
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
      </div>
    </div>
  </div>
  </section>

<!-- /Section: intro -->

<!-- Section: team -->
  <section id="makanan" class="home-section bg-gray paddingbot-60">
  <div class="container marginbot-50">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
        <div class="wow fadeInDown" data-wow-delay="0.1s">
        <div class="section-heading text-center">
        <h2 class="h-bold">Menu Makanan</h2>
        </div>
        </div>
        <div class="divider-short"></div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">

          <div id="grid-container" class="cbp-l-grid-team">
              <ul>
      <?php
        if($produk){
        foreach ($produk as $v) {
      ?>

      <?php //echo form_open('belanja/tambah_keranjang_belanja');?>
        <li class="cbp-item psychiatrist">
          <?php if ($this->session->userdata('id_user')) {?>
          <a href="<?php echo base_url();?>belanja/tambah_keranjang_belanja?id_produk=<?php echo $v->id_produk ?>&&nama_produk=<?php echo $v->nama_produk ?>&&id_kategori=<?php echo $this->input->get('id_kategori') ?>" class="cbp-caption">
            <?php } else {?>
          <a href="<?php echo base_url();?>home/login" class="cbp-caption ">
            <?php }?>

              <div class="cbp-caption-defaultWrap">
                              <img src="<?php echo base_url();?>assets/produk/<?php echo $v->gambar ?>" alt="" width="300px" height="200px">
              </div>
              <div class="cbp-caption-activeWrap">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-text">Pesan</div>
                    </div>
                  </div>
              </div>
          </a>
                      <a href="doctors/member1.html" class="cbp-singlePage cbp-l-grid-team-name"><?php echo $v->nama_produk; ?></a>
                      <div class="cbp-l-grid-team-position">Harga Rp. <?php echo number_format($v->harga,0,",","."); ?></span></p></div>

                  </li>
      <?php //echo form_close();?>
      <?php
        }
      }
      ?>
              </ul>
          </div>
    </div>
    </div>
  </div>

</section>
<!-- /Section: team -->
