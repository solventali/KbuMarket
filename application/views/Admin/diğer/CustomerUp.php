<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head'); ?>
</head>

<body class="signin">

<!-- Preloader-->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

    <div class="signuppanel">
        <div class="row">

            <div class="col-md-12">
                <form method="post" action="<?php echo base_url('Admin/Login/Register'); ?>">
                    <h3 class="nomargin">Kayıt Ol</h3>
                    <p class="mt5 mb20">Üye misiniz? <a href="<?php echo base_url('Admin/Login'); ?>"><strong>Giriş</strong></a></p>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Adı Soyadı</label>
                        <div class="col-sm-12">
                            <input type="text" placeholder="Adı Soyadı" class="form-control fc-sm" name="txtAdSoyad" id="txtAdSoyad" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">EMail Adresi</label>
                        <div class="col-sm-12">
                            <input type="email" placeholder="Email Adresi" class="form-control fc-sm" name="txtEmail" id="txtEmail" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Şifre</label>
                        <div class="col-sm-6">
                            <input type="password" placeholder="Şifre" class="form-control fc-sm" name="txtSifre" id="txtSifre" required />
                        </div>
                        <div class="col-sm-6">
                            <input type="password" placeholder="Şifre" class="form-control fc-sm" name="txtSifreAgain" id="txtSifreAgain" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Telefon No</label>
                        <div class="col-sm-12">
                            <input type="email" placeholder="Telefon Numarası" class="form-control fc-sm" name="txtTelefonNo" id="txtTelefonNo" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Doğum Tarihi</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control fc-sm" name="txtDgmTarih" id="txtDgmTarih" />
                        </div>
                    </div>
                </form>
                <button class="btn btn-success btn-block" id="growl1" onclick="SetUser()">Kaydet</button>
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

<script>
    var baseurl = "<?php print base_url('Admin/Login'); ?>/";
 /*   function  MesageAc() {
        var Type = document.getElementById("txtAdSoyad").value;
        var CType = document.getElementById("txtEmail").value;
        MessageBoxShow("Deneme","Denedim Olmuyor",Type,CType);
    }*/
    function  SetUser() {
        if ( document.getElementById("txtSifre").value == document.getElementById("txtSifreAgain").value ) {
            Users = new Object();
            Users.AdSoyad = document.getElementById("txtAdSoyad").value;
            Users.email = document.getElementById("txtEmail").value;
            Users.sifre = document.getElementById("txtSifre").value;
            Users.Telefon = document.getElementById("txtTelefonNo").value;
            Users.DgmTarih = document.getElementById("txtDgmTarih").value;
            $.ajax({
                type: "POST",
                url: baseurl+"Register",
                data: Users,
                dataType : 'Text',
                success: function (data) {
                    console.log(data);
                    MessageBoxShow("Kullanıcı Oluşturma",data,"0","info");
                },
                error: function (error) {
                    MessageBoxShow("Kullanıcı Oluşturma",error,"3","danger"); }
            });
        }
        else
        {
            MessageBoxShow("Kullanıcı Oluşturma","Girilen Şifreler Birbiriyle Uyumsuz","3","danger");
        }
    }


</script>
</body>
</html>