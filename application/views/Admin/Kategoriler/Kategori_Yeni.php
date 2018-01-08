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
            <h2><i class="fa fa-qrcode"></i> Yeni Kategori Ekleme</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url("Admin\Home"); ?>">Admin</a></li>
                    <li class="active"><a href="<?php echo base_url("Admin\Kategoriler"); ?>">Kategoriler</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="<?php echo base_url('Admin/Kategoriler/Kaydet'); ?>">
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Üst Kategori :</label>
                            <div class="col-sm-8">
                                <select name="UstAdi" class="form-control fc-sm" required>
                                    <option value="0">Seçiniz...</option>
                                    <?php foreach ($UstKategoriler as $Kategori){ ?>
                                    <option value="<?=$Kategori->KategoriID ?>"><?=$Kategori->KategoriAdi ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Kategori Adı :</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control fc-sm" name="KategoriAdi" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Açıklama :</label>
                            <div class="col-sm-8">
                                <textarea name="Aciklama" class="form-control fc-sm" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Anahtar Kelimeler :</label>
                            <div class="col-sm-8">
                                <textarea name="Keywords" class="form-control fc-sm" rows="2"></textarea>
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
                                <a href="<?php echo base_url("Admin\Kategoriler"); ?>" class="btn btn-danger">İptal</a>
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
    });
</script>
</body>
</html>