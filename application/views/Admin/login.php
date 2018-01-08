<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head'); ?>
</head>

<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

    <div class="signinpanel">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <img src="<?php echo base_url("assets") ?>/images/kbushopping.png" />
                        <form method="post" action="<?php echo base_url('Admin/Login/LoginControl'); ?>">
                            <p class="mt5 mb20">Hesabınıza Erişmek İçin Giriş Yapınız.</p>
                            <input type="text" class="form-control uname" name="txtEmail" placeholder="E Mail"  />
                            <input type="password" class="form-control pword" name="txtPassword" placeholder="Şifre"  required />
                            <a href="#"><small>Şifrenizi Mi Unuttunuz ?</small></a>
                            <button class="btn btn-success btn-block">Giriş</button>

                        </form>
                    </div>
                </div>
            </div><!-- col-sm-5 -->
        </div><!-- row -->

        <div class="signup-footer">
            <div class="pull-left">
                &copy; <?php echo date("Y"); ?>. Tüm Hakları Saklıdır. Kbu Web Team
            </div>
            <div class="pull-right">
                Created By: <a href="#" target="_blank">Ali KARA</a>
            </div>
        </div>

    </div><!-- signin -->

</section>
<?php $this->load->view('includes/include_script');?>
<script type="application/javascript">
    var alarm = "<?=$this->session->flashdata("Message");?>";
    if (alarm!="")
        MessageBoxShow("Kullanıcı Girişi",alarm,"3","danger");

</script>
</body>
</html>