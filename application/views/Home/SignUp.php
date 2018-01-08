
<?php $this->load->view('include_main/header');?>
<div class="main-panel">
    <div class="row">
        <div class="col-md-12">
            <div class="left-panel">
                <?php $this->load->view('include_main/sidemenu');
                ?>
            </div>
<div class="right-panel">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="<?php echo base_url('Home/CustomerKaydet'); ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info textCenter">
                            <span><i class="fa fa-users fa-2x"></i>&nbsp;&nbsp;Hesap Oluştur</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Adı Soyadı :</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control fc-sm" name="AdSoyad" required placeholder="Adı Soyadı"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">E Mail :</label>
                            <div class="col-sm-8">
                                <input type="email"  class="form-control fc-sm" name="Email" required placeholder="E Mail Adresi"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Şifre :</label>
                            <div class="col-sm-4">
                                <input type="password"  class="form-control fc-sm" name="Sifre" required placeholder="Şifre"/>
                            </div>
                            <div class="col-sm-4">
                                <input type="password"  class="form-control fc-sm" name="SifreYeniden" required placeholder="Şifre Yeniden "/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Adres :</label>
                            <div class="col-sm-8">
                                <textarea rows="2" class="form-control fc-sm" name="Adres" placeholder="Adres"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Şehir :</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control fc-sm"  name="Sehir" required placeholder="Şehir"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Telefon :</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control fc-sm" id="Telefon" name="Telefon" required placeholder="Telefon"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Doğum Tarihi :</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control fc-sm" id="DogumTarihi" name="DogumTarihi" required placeholder="Doğum Tarihi"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Cinsiyet :</label>
                            <div class="col-sm-8">
                                <select class="form-control fc-sm" name="Cinsiyet">
                                    <option value="Bay">Bay</option>
                                    <option value="Bayan">Bayan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Açıklama :</label>
                            <div class="col-sm-8">
                                <textarea rows="2" class="form-control fc-sm" name="Aciklama" placeholder="Açıklama"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Güvenlik Kodu : </label>
                            <div class="col-sm-4">
                                <input type="text"  class="form-control" name="Captcha" required placeholder="Güvenlik Kodu"/>
                            </div>
                            <div class="col-sm-3">
                                <?php echo $Captcha; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-sm btn-block btn-orange"><i class="fa fa-check"></i>&nbsp;Kaydet</button>
                    </div>
                </div>
            </form>
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

        $("#Telefon").mask("(999) 999-9999");
        $('#DogumTarihi').datetimepicker({
            dayOfWeekStart: 1,
            yearStart: 1900,
            lang: 'tr',
            timepicker: false,
            mask: true,
            format: 'd.m.Y'
        });
    });
</script>