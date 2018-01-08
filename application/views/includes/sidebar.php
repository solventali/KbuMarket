<div class="leftpanel">
    <div class="logopanel">
        <img src="<?php echo base_url("assets") ?>/images/kbushopping.png" style="width:170px;"/>
    </div><!-- logopanel -->
    <div class="leftpanelinner">
        <h5 class="sidebartitle">Ana Menü</h5>
        <ul class="nav nav-pills nav-stacked nav-bracket">
            <li><a href="<?=base_url("Admin\Home");?>"><i class="fa fa-home"></i> <span>Ana Sayfa</span></a></li>
            <li><a href="<?=base_url("Admin\Ayarlar");?>"><i class="fa fa-cogs"></i> <span>Ayarlar</span></a></li>
            <li><a href="<?=base_url("Admin\Uyeler");?>"><i class="fa fa-users"></i> <span>Üyeler</span></a></li>
            <li class="nav-parent"><a href="#"><i class="fa fa-edit"></i> <span>Ürün İşlemleri</span></a>
                <ul class="children">
                    <li><a href="<?=base_url("Admin\Kategoriler");?>"><i class="fa fa-qrcode"></i> <span>Kategoriler</span></a></li>
                    <li><a href="<?=base_url("Admin\Urunler");?>"><i class="fa fa-rocket"></i> <span>Ürünler</span></a></li>
                </ul>
            </li>
            <li><a href="<?=base_url("Admin\Yorumlar");?>"><i class="fa fa-comments"></i> <span>Yorumlar</span></a></li>
        </ul>
    </div><!-- leftpanelinner -->
</div><!-- leftpanel -->