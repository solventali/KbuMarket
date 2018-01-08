<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head'); ?>
</head>

<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
    <?php $this->load->view('includes/sidebar'); ?>
    <div class="mainpanel">
        <?php $this->load->view('includes/header'); ?>


        <div class="pageheader">
            <h2><i class="fa fa-users"></i> Kbu Online Shopping Admin Panel</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url("Admin\Home"); ?>">Admin</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <div class="row">
                <div class="col-sm-12">
                    <div class="tile-navigation">
                        <a href="<?=base_url("Admin\Ayarlar");?>" >
                            <div class="tile yellow wide">
                                <div class="tile-icon"><i class="fa fa-cogs fa-5x"></i></div>
                                <div class="tile-text"><span>Ayar İşlemleri</span></div>
                            </div>
                        </a>
                        <a href="<?=base_url("Admin\Uyeler");?>" >
                            <div class="tile red squar">
                                <div class="tile-icon"><i class="fa fa-users fa-5x"></i></div>
                                <div class="tile-text"><span>Üye İşlemleri</span></div>

                            </div>
                        </a>
                        <a href="<?=base_url("Admin\Kategoriler");?>" >
                            <div class="tile purple squar">
                                <div class="tile-icon"><i class="fa fa-qrcode fa-5x"></i></div>
                                <div class="tile-text"><span>Kategori İşlemleri</span></div>
                            </div>
                        </a>
                        <a href="<?=base_url("Admin\Urunler");?>" >
                            <div class="tile blue squar">
                                <div class="tile-icon"><i class="fa fa-rocket fa-5x"></i></div>
                                <div class="tile-text"><span>Ürün İşlemleri</span></div>
                            </div>
                        </a>
                    </div>
                </div><!-- col-sm-12 -->
            </div><!-- row -->

        </div>
    </div><!-- mainpanel -->
</section>

<?php $this->load->view("includes/footer");?>
<script type="application/javascript">
    var alarm = "<?=$this->session->flashdata("Message");?>";
    if (alarm!="")
        MessageBoxShow("Yetki Hatasi",alarm,"3","danger");

</script>
</body>
</html>