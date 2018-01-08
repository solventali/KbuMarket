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
            <h2><i class="fa fa-rocket"></i> Ürün Galeri Resim Ekleme</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url("Admin\Home"); ?>">Admin</a></li>
                    <li class="active"><a href="<?php echo base_url("Admin\Urunler"); ?>">Ürünler</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('Admin/Urunler/GaleriYukle'); ?>/<?=$Urun->ID ?>">
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
                            <div class="row">
                                <div class="col-sm-12" id="galeriContent">
                                    <?php  if ($UResimler) {
                                        foreach ($UResimler as $UResim){ ?>
                                            <img  src="<?= base_url('Uploads/Galeri_Resim')."/".$UResim->Resim ?>" data-id="<?=$UResim->ID?>" class="galeri-product" />
                                        <?php }
                                    } ?><br/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
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
                        <a href="#" id="btnResimSil" class="btn btn-danger"><i class="fa fa-trash-o"></i> Seçili Resmi Sil</a>
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
        $(".galeri-product").live('click', function () {
            $("img").removeClass("SelImage");
            $(this).addClass("SelImage");
            var link=baseurl+"GaleriSil/"+$(this).attr("data-id");
            $("#btnResimSil").attr("href",link);
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