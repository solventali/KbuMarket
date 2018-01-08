<?php $this->load->view('include_main/header'); ?>

<div class="main-panel">
    <div class="row">
        <div class="col-md-12">
            <div class="left-panel">
                <?php $this->load->view('include_main/sidemenu'); ?>
            </div>
            <div class="right-panel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slide-container">
                                    <div class="p-slider">
                                        <div class="slide-resim">
                                            <?php if ($Resimler) {
                                                foreach ($Resimler as $Resim) { ?>
                                                    <div class="slide-item">
                                                        <img src="<?= base_url('Uploads/Galeri_Resim') . "/" . $Resim->Resim ?>"
                                                             alt="resim "/>
                                                    </div>
                                                <?php }
                                            } ?>
                                        </div>
                                    </div>
                                    <ul class="slide-button">
                                        <?php if ($Resimler) {
                                            foreach ($Resimler as $Resim) { ?>
                                                <li>
                                                    <a href="#">
                                                        <img src="<?= base_url('Uploads/Galeri_Resim') . "/" . $Resim->Resim ?>"/>
                                                    </a>
                                                </li>
                                            <?php }
                                        } ?>
                                    </ul>
                                    <div class="slvnt-prev slvnt-buton"></div>
                                    <div class="slvnt-next slvnt-buton"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="product-name">
                                                    <span>
                                                        <?php echo $Urun->UrunAdi . " - " . $Urun->Kodu ?>
                                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center product-description">
                                <span>
                                    <?= $Urun->Aciklama; ?>
                                </span>
                            </div>
                        </div>
                        <div class="row product-description">
                            <div class="col-md-12 textCenter">
                                <div class="col-sm-4">&nbsp;</div>
                                <div class="col-sm-4">
                                    <div id="ProductRateYo"></div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="col-sm-4">&nbsp;</div>
                                <div class="col-sm-8">
                                    <div class="comments-container">
                                        <a href="javascript:GoComments()" class="product-comments">
                                            Yorum (<span content="48">48</span>)
                                        </a>
                                        <span class="comment-seperator">|</span>
                                        <a href="#" class="product-comments">
                                            Yorum Yap
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center product-description">
                            <div class="col-md-12">
                                <span class="price "><?= $Urun->SatisFiyat ?>&nbsp;<?= $Urun->Birim ?></span>
                            </div>
                        </div>
                        <form method="post" action="<?php echo base_url('Home/SepetEkle'); ?>/<?= $Urun->ID; ?>">
                            <div class="row product-description">
                                <div class="col-md-12 ">
                                    <?php if ($Urun->Renk == "1") { ?>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Renk :</label>
                                            <div class="col-sm-8">
                                                <select name="Renk" class="form-control fc-sm" required>
                                                    <option value="Kırmızı">Kırmızı</option>
                                                    <option value="Mavi">Mavi</option>
                                                    <option value="Siyah">Siyah</option>
                                                    <option value="Beyaz">Beyaz</option>
                                                    <option value="Yeşil">Yeşil</option>
                                                    <option value="Sarı">Sarı</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($Urun->Beden == "1") { ?>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Beden :</label>
                                            <div class="col-sm-8">
                                                <select name="Beden" class="form-control fc-sm" required>
                                                    <option value="32">32</option>
                                                    <option value="34">34</option>
                                                    <option value="36">36</option>
                                                    <option value="38">38</option>
                                                    <option value="40">40</option>
                                                    <option value="42">42</option>
                                                    <option value="44">44</option>
                                                    <option value="46">46</option>
                                                    <option value="48">48</option>
                                                    <option value="50">50</option>
                                                    <option value="52">52</option>
                                                    <option value="54">54</option>
                                                    <option value="56">56</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Adet :</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control fc-sm" required name="Miktar"
                                                   id="Miktar" value="1"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">&nbsp;</div>
                                        <div class="col-sm-8">
                                            <button class="btn btn-block btn-sm btn-orange">Sepete Ekle</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs nav-orange">
                <li id="t1_1" class="active"><a href="#tab_1_1" data-toggle="tab"><strong>Ürün Detayı</strong></a></li>
                <li id="t1_2" class=""><a href="#tab_1_2" data-toggle="tab"><strong>Yorumlar</strong></a></li>
                <li id="t1_3" class=""><a href="#tab_1_3" data-toggle="tab"><strong>Kredi ve Taksit Seçenekleri</strong></a></li>
                <li id="t1_4" class=""><a href="#tab_1_4" data-toggle="tab"><strong>İade Koşulları</strong></a></li>
            </ul>
            <div class="tab-content mb30">
                <div class="tab-pane active" id="tab_1_1">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $Urun->Detay; ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_1_2">
                    <div class="row">
                        <div class="col-md-9">
                            <?php if ($this->session->userdata('CustomerID')) { ?>
                                <form method="post" action="<?php echo base_url('Home/YorumYap'); ?>/<?= $Urun->ID; ?>">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Puan :</label>
                                        <div class="col-sm-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="rateYo"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Baslik :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control fc-sm" name="Baslik" required
                                                   placeholder="Başlık"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Yorum :</label>
                                        <div class="col-sm-8">
                                            <textarea rows="4" class="form-control fc-sm" name="Yorum"
                                                      placeholder="Yorum" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="hidden" name="Puan" id="Puan" value="0"/>
                                            <button class="btn btn-sm btn-block btn-orange"><i class="fa fa-check"></i>&nbsp;Yorumu
                                                Gönder
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_1_3">
                    <div class="row">
                        <div class="col-md-12">
                            c
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_1_4">
                    <div class="row">
                        <div class="col-md-12">
                            d
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include_main/footer'); ?>
<script type="application/javascript">
    var Puans = "<?php echo $Puans;?>";

    function GoComments() {
        $(".nav-tabs>li").removeClass("active");
        $("#t1_2").addClass("active");
        $(".tab-pane").removeClass("active");
        $("#tab_1_2").addClass("active");
        document.getElementById('tab_1_2').scrollIntoView();
    }

    $(document).ready(function () {
        $("#rateYo").rateYo({
            rating: Puans,
            onSet: function (rating, rateYoInstance) {
                $("#Puan").val(rating);
                //   alert("Rating is set to: " + rating);
            },
            onChange: function (rating, rateYoInstance) {

                $(this).next().text(rating);
            }
        });
        $("#ProductRateYo").rateYo({
            rating: Puans
        });
    });
</script>