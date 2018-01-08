<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KBU ONLINE MARKET</title>
    <?php $this->load->view('includes/head'); ?>
</head>
<body class="bd">
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
    <div class="h-bar">
        <div class="head-content">
            <div class="user-grup">
                <ul class="customer-menu">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>
                                <?php if ($this->session->userdata('Resim')) {?>
                                    <img src="<?php echo base_url('Uploads/Profil_Resim/').$this->session->userdata('Resim'); ?>" class="profile-image"  />
                                <?php } ?>
                                <?php if (!$this->session->userdata('AdSoyad'))
                                    echo "Hesabım";
                                else
                                    echo $this->session->userdata('AdSoyad');
                                ?>
                            </b> <span class="caret"></span></a>
                        <?php if (!$this->session->userdata('customer_in')) { ?>
                            <ul id="login-dp" class="dropdown-menu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form" role="form" method="post" action="<?=base_url()?>Home/Login">
                                                <div class="form-group">
                                                    <input type="email" class="form-control fc-sm" name="CustomerEmail" placeholder="Email Adresi" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control fc-sm" name="CustomerPassword" placeholder="Şifre" required>
                                                    <div class="help-block text-right">
                                                        <a href="<?php echo base_url()."Home/Forget"; ?>">
                                                            Şifreni Unuttun Mu ?
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block">Giriş</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="bottom text-center">
                                            Yeni Misin ?
                                            <a href="<?php echo base_url()."Home/SignUp"; ?>">
                                                <b>Üye Ol</b>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        <?php }
                         else  {?>
                        <ul id="login-dp" class="dropdown-menu">
                            <li><a href="<?=base_url()."Home/Sepet"?>"><stron><i class="fa fa-smile-o"></i>&nbsp;&nbsp;Sepetim&nbsp;<span class="label label-success"><?= $SC; ?></span></stron></a></li>
                            <li><a href="<?=base_url()."Home/Siparisler"?>"><stron><i class="fa fa-suitcase"></i>&nbsp;&nbsp;Siparişlerim</stron></a></li>
                            <li><a href="<?=base_url()."Home/Profile"?>"><stron><i class="fa fa-cogs"></i>&nbsp;&nbsp;Profil Ayarlarım</stron></a></li>
                            <li><a href="#"><strong><i class="fa fa-envelope"></i>&nbsp;&nbsp;İletişim Mesajlarım</strong></a></li>
                            <li><a href="#"><strong><i class="fa fa-comments"></i>&nbsp;&nbsp;Yorumlarım</strong></a></li>
                            <li><a href="#" ><strong><i class="fa fa-gift"></i>&nbsp;&nbsp;Hediye Puanlarım</strong></a></li>
                            <li><a href="<?=base_url();?>Home/LogOut"><stron><i class="glyphicon glyphicon-log-out"></i>&nbsp;&nbsp;Çıkış Yap</stron></a></li>
                        </ul>
                        <?php }?>
                    </li>
                </ul>
            </div>
            <div class="social-grup">
                <a href="#" class="social-btn"><i class="fa fa-facebook"></i> </a>
                <a href="#"  class="social-btn"><i class="fa fa-twitter"></i></a>
                <a href="#"  class="social-btn"><i class="fa fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="ana-content">
        <div class="row">
            <div class="col-md-12">
                <div class="ana-head">
                    <img src="http://localhost:1903/KbuMarket/assets/images/kbushopping.png" style="width:170px;">
                </div>

                <div id="main-nav" class="stellarnav">
                    <ul>
                        <li><a href="<?=base_url()?>">Ana Sayfa</a></li>
                        <?php
                        if ($Menuler) {
                            foreach ($Menuler as $menu) {
                                echo "<li>";
                                echo "<a href='".base_url()."Home/Category/".$menu->KategoriID."'>".$menu->KategoriAdi."</a>";
                                if (!empty($menu->sub)) {
                                    echo "<ul>";
                                    fetch_sub_menu($menu->sub);
                                    echo "</ul>";
                                }
                                echo "</li>";
                            }
                        }
                        function fetch_sub_menu($sub_menu)
                        {
                            foreach ($sub_menu as $menu) {
                                echo "<li>";
                                echo "<a href='".base_url()."Home/Category/".$menu->KategoriID."'>".$menu->KategoriAdi."</a>";
                                if (!empty($menu->sub)) {
                                    echo "<ul>";
                                    fetch_sub_menu($menu->sub);
                                    echo "</ul>";
                                }
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div><!-- .stellar-nav -->