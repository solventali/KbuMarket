<div class="headerbar">
    <a class="menutoggle"><i class="fa fa-bars"></i></a>

    <div class="header-right">
        <ul class="headermenu">
            <li>
                <div class="btn-group">
                    <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-envelope"></i>
                        <span class="badge">1</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-head pull-right">
                        <h5 class="title">You Have 1 New Message</h5>
                        <ul class="dropdown-list gen-list">
                            <li class="new">
                                <a href="#">
                                    <span class="thumb"><img src="<?php echo base_url("assets") ?>/images/photos/user1.png" alt="" /></span>
                                    <span class="desc">
                      <span class="name">Ali KARA <span class="badge badge-success">Yeni</span></span>
                      <span class="msg">Yeni Proje iyi mi hacııı</span>
                    </span>
                                </a>
                            </li>
                            <li class="new"><a href="#">Tüm Mesajları Oku</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url("assets") ?>/images/photos/loggeduser.png" alt="" />
                            <?=$this->session->userdata('AdSoyad')?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                        <li><a href="profile.html"><i class="glyphicon glyphicon-user"></i>Profilim</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Hesap Ayarları</a></li>
                        <li><a href="<?php echo base_url('Admin/Login/LogOut'); ?>"><i class="glyphicon glyphicon-log-out"></i> Çıkış</a></li>
                    </ul>
                </div>
            </li>

        </ul>
    </div><!-- header-right -->

</div><!-- headerbar -->