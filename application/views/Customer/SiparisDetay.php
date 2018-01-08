
<?php $this->load->view('include_main/header');?>
<div class="main-panel">
    <div class="row">
        <div class="col-md-12">
            <div class="left-panel">
                <?php $this->load->view('include_main/CustomerMenu');
                ?>
            </div>
            <div class="right-panel">
                <div class="row">
                    <div class="col-md-3">
                        <a class="btn btn-block btn-sm btn-primary" href="<?php echo $this->agent->referrer(); ?>">Sipariş Listesi</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="nots nots-warning">
                                    <div class="col-md-2">
                                        <label class="col-sm-12 control-label textCenterR">Sipariş No</label>
                                        <label class="col-sm-12 control-label textCenterR bbold"><?=$Siparis->SiparisID; ?></label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-sm-12 control-label textCenterR">Tarih</label>
                                        <label class="col-sm-12 control-label textCenterR bbold">
                                            <?=date("d.m.Y H:i",strtotime($Siparis->Tarih))?>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-sm-12 control-label textCenterR">Ödeme Şekli - Durumu</label>
                                        <label class="col-sm-12 control-label textCenterR bbold"> <?php echo $Siparis->OdemeTuru." - ".$Siparis->OdemeDurumu;?> </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-sm-12 control-label textCenterR">Sipariş Durumu</label>
                                        <label class="col-sm-12 control-label textCenterR bbold"> <?= $Siparis->SiparisDurumu;?> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php if ($Urunler) {
                            foreach ($Urunler as $Urun) { ?>
                                <div class="nots nots-info">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="<?= base_url('Uploads/Urun_Resim')."/".$Urun->Resim?>" height="80" width="80"/>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="col-md-12">
                                                <span class="bbold"><?=$Urun->UrunAdi; ?></span>
                                            </div>
                                            <div class="col-md-12">
                                                <a class="btn btn-sm btn-orange" href="<?php echo base_url('Home')."/Product/".$Urun->UrunID; ?>">
                                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;Ürün Detayı
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <strong class="order-detail"><?= $Urun->Miktar; ?> Adet</strong>
                                        </div>
                                        <div class="col-md-2">
                                            <strong class="order-detail"><?= $Urun->Tutar; ?> TL</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="nots nots-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong class="orderAddTitle">Teslimat Bilgileri</strong>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="col-sm-12 control-label">
                                                <strong class="bbold">İsim Soyisim :</strong><?=$Siparis->TeslimAdSoyad; ?>
                                            </label>
                                            <label class="col-sm-12 control-label">
                                                <strong class="bbold">Adres :</strong>
                                                <?php echo $Siparis->TeslimAdres." ".$Siparis->TeslimIlce." - ".$Siparis->TeslimSehir ; ?>
                                            </label>
                                            <label class="col-sm-12 control-label">
                                                <strong class="bbold">Telefon :</strong><?=$Siparis->TeslimTelefon; ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong class="orderAddTitle">Fatura Bilgileri</strong>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="col-sm-12 control-label">
                                                <strong class="bbold">İsim Soyisim :</strong><?=$Siparis->FaturaAdsoyad; ?>
                                            </label>
                                            <label class="col-sm-12 control-label">
                                                <strong class="bbold">Adres :</strong>
                                                <?php echo $Siparis->FaturaAdres." ".$Siparis->FaturaIlce." - ".$Siparis->FaturaSehir ; ?>
                                            </label>
                                            <label class="col-sm-12 control-label">
                                                <strong class="bbold">Telefon :</strong><?=$Siparis->FaturaTelefon; ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include_main/footer');?>
<script type="application/javascript">
    var baseurl = "<?php echo base_url('Home'); ?>/";

    $(document).ready(function() {

    });
</script>