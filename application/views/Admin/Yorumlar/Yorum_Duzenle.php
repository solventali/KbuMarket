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
            <h2><i class="fa fa-qrcode"></i>Yorum Görüntüleme ve Onay</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url("Admin\Home"); ?>">Admin</a></li>
                    <li class="active"><a href="<?php echo base_url("Admin\Yorumlar"); ?>">Yorumlar</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <div class="row">
                <div class="col-md-8">

                    <form method="post" action="<?php echo base_url('Admin/Yorumlar/Guncelle'); ?>">
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Yorum Baslik :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control fc-sm" value="<?= $Yorum->Baslik; ?>" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Ürün Adı :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control fc-sm"
                                       value="<?php echo $Yorum->Kodu." - ".$Yorum->UrunAdi; ?>" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Müşteri Adı Soyadı :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control fc-sm"
                                       value="<?= $Yorum->AdSoyad; ?>" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Yorum Puanı :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control fc-sm"
                                       value="<?= $Yorum->Puan; ?>" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Yorum Detay :</label>
                            <div class="col-sm-8">
                                <textarea name="Yorum" rows="3" class="form-control fc-sm" readonly="readonly"><?=$Yorum->Yorum; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Yorum Onay Açıklama :</label>
                            <div class="col-sm-8">
                                <textarea name="YorumNeden" rows="3" class="form-control fc-sm"><?=$Yorum->YorumNeden; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label textRight">Durum :</label>
                            <div class="col-sm-8">
                                <select class="form-control fc-sm" name="Durum">
                                    <option value="0" <?php if ($Yorum->Durum=="0") echo "Selected" ?>>Belirsiz</option>
                                    <option value="1" <?php if ($Yorum->Durum=="1") echo "Selected" ?>>Onaylandı</option>
                                    <option value="2" <?php if ($Yorum->Durum=="2") echo "Selected" ?>>Reddedildi</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 textCenter">
                                <input type="hidden" name="YorumID"  value="<?= $Yorum->YorumID ?>"/>
                                <input type="submit" class="btn btn-primary " value="Güncelle"></input>
                                <a href="<?php echo base_url("Admin\Yorumlar"); ?>" class="btn btn-danger">İptal</a>
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