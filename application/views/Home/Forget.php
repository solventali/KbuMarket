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
                        <form method="post" action="<?php echo base_url('Home/SifreHatirlat'); ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info textCenter">
                                        <span><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;Şifremi Unuttum</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <span>Hesabınıza Ait Mail Adresinizi Giriniz ?</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Email Adresi :</label>
                                        <div class="col-sm-6">
                                            <input type="text"  class="form-control fc-sm" name="Email" required placeholder="Email Adresi"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Güvenlik Kodu : </label>
                                        <div class="col-sm-3">
                                            <input type="text"  class="form-control" name="GuvenlikKodu" required placeholder="Güvenlik Kodu"/>
                                        </div>
                                        <div class="col-sm-3">
                                            <?php echo $Captcha; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">&nbsp;</label>
                                        <div class="col-sm-4">
                                            <button class="btn btn-sm btn-block btn-orange"><i class="fa fa-check"></i>&nbsp;Sorgula</button>
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