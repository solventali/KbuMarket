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
            <h2><i class="fa fa-rocket"></i> Ürün Listeleme</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url("Admin\Home"); ?>">Admin</a></li>
                    <li class="active"><a href="<?php echo base_url("Admin\Urunler"); ?>">Ürünler</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-primary btn-xxs" href="<?= base_url('Admin/Urunler/YeniUrun')?>"><i class="fa fa-plus"></i> Yeni Ürün</a>
                    <a id="btnUrunResimEkle" class="btn btn-xxs btn-orange" href="#"><i class="fa fa-picture-o"></i> Ürün Resmi Ekle</a>
                    <a id="btnGaleriEkle" class="btn btn-xxs btn-primary" href="#"><i class="fa fa-picture-o"></i> Galeri Resmi Ekle</a>
                    <a id="btnDuzenle" class="btn btn-xxs btn-info" href="#"><i class="fa fa-refresh"></i> Seçili Ürün Düzenle</a>
                    <a id="btnSil" class="btn btn-xxs btn-danger" href="#"><i class="fa fa-trash-o"></i> Seçili Ürün Sil</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="tblKategoriList">
                        <thead>
                        <th>KODU</th>
                        <th>RESİM</th>
                        <th>ÜRÜN ADI</th>
                        <th>KATEGORİ ADI</th>
                        <th>MİKTAR</th>
                        <th>ALIŞ FİYATI</th>
                        <th>SATIŞ FİYATI</th>
                        <th>MİADI</th>
                        <th>DURUM</th>
                        </thead>
                        <tbody>
                        <?php  if ($Urunler) {
                            foreach ($Urunler as $Urun){ ?>
                                <tr data-id="<?=$Urun->ID?>">
                                    <td><?=$Urun->Kodu ?></td>
                                    <td>
                                        <?php if ($Urun->Resim) { ?>
                                            <img src="<?= base_url('Uploads/Urun_Resim')."/".$Urun->Resim?>" height="30" width="40"/>
                                        <?php } else { ?>
                                            <img src="<?= base_url('Uploads')?>/nopicture_min.png" title="Resim Yükle"/>
                                        <?php } ?>
                                    </td>
                                    <td><?=$Urun->UrunAdi ?></td>
                                    <td><?=$Urun->KategoriAdi ?></td>
                                    <td><?=$Urun->Miktar ?></td>
                                    <td><?=$Urun->AlisFiyat." ".$Urun->Birim  ?></td>
                                    <td><?=$Urun->SatisFiyat." ".$Urun->Birim ?></td>
                                    <td><?=date("d.m.Y",strtotime($Urun->Miad))?></td>
                                    <td>
                                        <?php
                                        if ($Urun->Durum==1)
                                            echo "<span class='label label-success'>Aktif</span>";
                                        else
                                            echo "<span class='label label-danger'>Pasif</span>";
                                        ?>
                                    </td>
                                </tr>
                            <?php }
                        }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- mainpanel -->
</section>

<?php $this->load->view("includes/footer");?>
<script type="application/javascript">
    var baseurl = "<?php echo base_url('Admin/Urunler'); ?>/";
    $(document).ready(function() {

        $("#tblKategoriList").dataTable({
            bDestroy: true,
            bFilter: true,
            bLengthChange: true,
            bPaginate: true,
            bInfo: false,
            bSort: true,
            aLengthMenu: [[10, 20,50,100,-1], [10,20,50,100,'All']],
        });
        $("#tblKategoriList tbody tr").live('click', function () {
            if (this.firstChild.className == "dataTables_empty")
                return false;
            $("#tblKategoriList .SelRow").removeClass("SelRow");
            $(this).addClass("SelRow");
            $("#btnUrunResimEkle").attr("href",baseurl+"ResimEkle/"+$(this).attr("data-id"));
            $("#btnGaleriEkle").attr("href",baseurl+"GaleriEkle/"+$(this).attr("data-id"));
            $("#btnDuzenle").attr("href",baseurl+"Duzenle/"+$(this).attr("data-id"));
            $("#btnSil").attr("href",baseurl+"Sil/"+$(this).attr("data-id"));
        });
    } );
</script>
</body>
</html>