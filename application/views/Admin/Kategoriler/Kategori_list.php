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
            <h2><i class="fa fa-qrcode"></i> Kategori Listeleme</h2>
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
                <div class="col-md-12">
                    <a class="btn btn-xxs btn-primary" href="<?= base_url('Admin/Kategoriler/YeniKategori')?>"><i class="fa fa-plus"></i> Yeni Kategori</a>
                    <a class="btn btn-xxs btn-info" id="btnDuzenle" href="#"><i class="fa fa-refresh"></i> Seçili Kategori Düzenle</a>
                    <a class="btn btn-xxs btn-danger" id="btnSil" href="#"><i class="fa fa-trash-o"></i> Seçili Kategori Sil</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="tblKategoriList">
                        <thead>
                        <th>ÜST KATEGORİ</th>
                        <th>KATEGORİ ADI</th>
                        <th>DURUM</th>
                        </thead>
                        <tbody>
                        <?php  if ($Kategoriler) {
                            foreach ($Kategoriler as $Kategori){ ?>
                                <tr data-id="<?=$Kategori->KategoriID?>">
                                    <td><?=$Kategori->UstAdi ?></td>
                                    <td><?=$Kategori->KategoriAdi ?></td>
                                    <td>
                                        <?php
                                        if ($Kategori->Aktif==1)
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
    var baseurl = "<?php echo base_url('Admin/Kategoriler'); ?>/";
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
            $("#btnDuzenle").attr("href",baseurl+"Duzenle/"+$(this).attr("data-id"));
            $("#btnSil").attr("href",baseurl+"Sil/"+$(this).attr("data-id"));
        });
    } );
</script>
</body>
</html>