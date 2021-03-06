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
            <h2><i class="fa fa-rocket"></i> Ürüne Resim Ekleme</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url("Admin\Home"); ?>">Admin</a></li>
                    <li class="active"><a href="<?php echo base_url("Admin\Urunler"); ?>">Ürünler</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('Admin/Urunler/ResimYukle'); ?>/<?=$Urun->ID ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label textRight">Ürün :</label>

                            <div class="col-sm-2">
                                <label class="form-control fc-sm"><?=$Urun->Kodu ?> </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-control fc-sm"><?=$Urun->UrunAdi ?> </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label textRight">Eski Resim :</label>
                            <div class="col-md-3">
                                <?php if ($Urun->Resim) { ?>
                                    <img src="<?= base_url('Uploads/Urun_Resim')."/".$Urun->Resim ?>" alt="<?=$Urun->UrunAdi ?>" class="image-product" />
                                <?php } else { ?>
                                    <img src="<?= base_url('Uploads')?>/nopicture_max.png" class="image-product" />
                                <?php } ?>
                            </div>
                            <label class="col-sm-2 control-label textRight">Yeni Resim :</label>
                            <div class="col-sm-3">
                                <div class="col-md-12 textCenter">
                                    <img id="YeniResim" src="<?= base_url('Uploads')?>/nopicture_max.png" class="image-product"  />
                                </div>
                                <div class="col-md-12">
                                    <input type="file" name="Resim" id="Resim" class="form-control fc-sm file-upload" required/>
                                    <button class="btn btn-sm btn-block btn-success" id="btnResimSec"><i class="fa fa-picture-o"></i> Resim Seç</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- col-sm-5 -->
                </div><!-- row -->
                <div class="row">
                    <div class="col-sm-12 textCenter">
                        <input type="submit" class="btn btn-primary " value="Resmi Yükle"></input>
                        <a href="<?php echo base_url("Admin\Urunler"); ?>" class="btn btn-danger">İptal</a>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- mainpanel -->
</section>

<?php $this->load->view("includes/footer");?>

<script type="application/javascript">
    var baseurl = "<?php echo base_url('Admin/Urunler'); ?>/";
    $(document).ready(function() {
        $('#btnResimSec').click(function () { $('#Resim').click();
            return false;
        });
        $("#Resim").change(function() {
            readURL(this);
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#YeniResim').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
</body>
</html>