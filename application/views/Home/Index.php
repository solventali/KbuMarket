
<?php $this->load->view('include_main/header');?>
<div class="main-panel">
    <div class="row">
        <div class="col-md-12">

            <div class="left-panel">
                <?php $this->load->view('include_main/sidemenu');?>
            </div>

            <div class="right-panel">
                <div class="row">
                    <div class="col-md-12">
                        <label class="best-new">En Yeni Ürünler</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12" >
                        <div id="paging">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <?php
                        if ($Urunler) {
                            foreach ($Urunler as $Urun) { ?>
                                <div class="col-lg-3 col-md-3 col-sm-3 product-a">
                                    <a href="<?=base_url()?>Home/Product/<?=$Urun->ID?>">
                                        <div class="product-box">
                                            <?php if ($Urun->Yeni==1) {?>
                                                <div class="product-box-new"><strong>Yeni</strong></div>
                                            <?php }?>
                                            <img class="product-box-image" src="<?= base_url('Uploads/Urun_Resim')."/".$Urun->Resim?>" />
                                            <div class="product-box-text"><strong><?=$Urun->UrunAdi; ?></strong></div>
                                            <div class="product-box-price"><strong><?php echo $Urun->SatisFiyat." ".$Urun->Birim ?></strong></div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                        }
                        else{ ?>
                            <div class="alert alert-success">
                                Listelenecek ürün Bulunamadı !!!
                            </div>
                        <?php }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('include_main/footer');?>


<script type="application/javascript">
    $(document).ready(function() {
   /* <div class="row">
            <div class="col-md-12">
            <div id="rateYo"></div>
            </div>
            </div>*/
        $("#rateYo").rateYo({
            rating: 4.5,
            onSet: function (rating, rateYoInstance) {

                alert("Rating is set to: " + rating);
            },
            onChange: function (rating, rateYoInstance) {

                $(this).next().text(rating);
            }
        });
    });
    $(function () {

        $("#rateYo1").rateYo({
            maxValue: 1,
            numStars: 1,
            starWidth: "40px"
        });
    });
</script>
</body>
</html>