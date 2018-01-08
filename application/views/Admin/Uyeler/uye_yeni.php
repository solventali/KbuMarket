<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head'); ?>
</head>

<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
    <?php $this->load->view('includes/sidebar'); ?>
    <div class="mainpanel">
        <?php $this->load->view('includes/header'); ?>


        <div class="pageheader">
            <h2><i class="fa fa-users"></i> Yeni Üye Ekleme</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url("Admin\Home"); ?>">Admin</a></li>
                    <li class="active"><a href="<?php echo base_url("Admin\Uyeler"); ?>">Üyeler</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="<?php echo base_url('Admin/Uyeler/Kaydet'); ?>">
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Adı Soyadı :</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control fc-sm" name="AdSoyad" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">EMail Adresi :</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control fc-sm" name="Email" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Yetki :</label>
                            <div class="col-sm-8">
                                <select name="Yetki" class="form-control fc-sm" required>
                                    <option value="0">Seçiniz...</option>
                                    <option value="1">Satıcı</option>
                                    <option value="2">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Şifre :</label>
                            <div class="col-sm-8">
                                <input type="password"  class="form-control fc-sm" name="Sifre" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Telefon No :</label>
                            <div class="col-sm-8">
                                <input type="phone"  class="form-control fc-sm" name="Telefon" id="Telefon" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Doğum Tarihi :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control fc-sm" name="DgmTarih" id="DgmTarih"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Durum :</label>
                            <div class="col-sm-8">
                                <label class="form-control fc-sm">
                                    <input type="checkbox" id="Aktif" name="Aktif"/>Aktif
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 textCenter">
                                <input type="submit" class="btn btn-primary " value="Kaydet"></input>
                                <a href="<?php echo base_url("Admin\Uyeler"); ?>" class="btn btn-danger">İptal</a>
                            </div>
                        </div>
                    </form>
                </div><!-- col-sm-5 -->
            </div><!-- row -->
        </div>
    </div><!-- mainpanel -->
</section>

<?php $this->load->view("includes/footer");?>
<script type="application/javascript">
    $(document).ready(function() {
        $("#Aktif").live('change', function () {
            if ($("#Aktif").prop("checked")==true)
                $(this).val(1);
            else
                $(this).val(0);
        });
        $("#Telefon").mask("(999) 999-9999");
        $('#DgmTarih').datetimepicker({
            dayOfWeekStart: 1,
            yearStart: 1900,
            lang: 'tr',
            timepicker: false,
            mask: true,
            format: 'd.m.Y'
        });
    });
</script>
</body>
</html>