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
            <h2><i class="fa fa-qrcode"></i> Yorum Listeleme</h2>
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
                <div class="col-md-12">
                    <a class="btn btn-xxs btn-info" id="btnDuzenle" href="#"><i class="fa fa-refresh"></i> Seçili Yorum Görüntüle</a>
                    <a class="btn btn-xxs btn-danger" id="btnSil" href="#"><i class="fa fa-trash-o"></i> Seçili Yorum Sil</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="tblYorumList">
                        <thead>
                        <th>KAYIT TARİHİ</th>
                        <th>YORUM BAŞLIK</th>
                        <th>ÜRÜN ADI</th>
                        <th>MÜSTERİ ADI</th>
                        <th>PUAN</th>
                        <th>DURUM</th>
                        </thead>
                        <tbody>
                        <?php  if ($Yorumlar) {
                            foreach ($Yorumlar as $Yorum){ ?>
                                <tr data-id="<?=$Yorum->YorumID; ?>">
                                    <td><?=date("d.m.Y H:i:s",strtotime($Yorum->Tarih))?></td>
                                    <td><?=$Yorum->Baslik; ?></td>
                                    <td><?php echo $Yorum->Kodu." - ".$Yorum->UrunAdi; ?></td>
                                    <td><?=$Yorum->AdSoyad; ?></td>
                                    <td><?=$Yorum->Puan; ?></td>
                                    <td>
                                        <?php
                                        if ($Yorum->Durum==1)
                                            echo "<span class='label label-success'>Onaylandı</span>";
                                        else if ($Yorum->Durum==2)
                                            echo "<span class='label label-danger'>Reddedildi</span>";
                                        else
                                            echo "<span class='label label-info'>Belirsiz</span>";
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
    var baseurl = "<?php echo base_url('Admin/Yorumlar'); ?>/";
    $(document).ready(function() {

        $("#tblYorumList").dataTable({
            bDestroy: true,
            bFilter: true,
            bLengthChange: true,
            bPaginate: true,
            bInfo: false,
            bSort: true,
            aLengthMenu: [[10, 20,50,100,-1], [10,20,50,100,'All']],
        });
        $("#tblYorumList tbody tr").live('click', function () {
            if (this.firstChild.className == "dataTables_empty")
                return false;
            $("#tblYorumList .SelRow").removeClass("SelRow");
            $(this).addClass("SelRow");
            $("#btnDuzenle").attr("href",baseurl+"Duzenle/"+$(this).attr("data-id"));
            $("#btnSil").attr("href",baseurl+"Sil/"+$(this).attr("data-id"));
        });
    } );
</script>
</body>
</html>