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
                        <form method="post" action="<?php echo base_url('Home/PasswordOnay'); ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info textCenter">
                                        <span><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;Yeniden Şifre Oluşturma</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Yeni Şifre :</label>
                                        <div class="col-sm-6">
                                            <input type="Password"  class="form-control fc-sm" name="Sifre" required placeholder="Şifre"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Yeniden Yeni Şifre :</label>
                                        <div class="col-sm-6">
                                            <input type="Password"  class="form-control fc-sm" name="SifreYeniden" required placeholder="Şifre"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">&nbsp;</label>
                                        <div class="col-sm-4">
                                            <input type="hidden" name="Key" value="<?= $Key; ?>" />
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
