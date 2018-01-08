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
            <h2><i class="fa fa-cogs"></i> Ayar Listeleme</h2>
            <div class="breadcrumb-wrapper">
                <span class="label">Burdasınız :</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url("Admin\Home"); ?>">Admin</a></li>
                    <li class="active"><a href="<?php echo base_url("Admin\Ayarlar"); ?>">Ayarlar</a></li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-xxs btn-primary" href="<?= base_url('Admin/Ayarlar/YeniAyar')?>"><i class="fa fa-plus"></i> Yeni Ayar</a>
                    <a class="btn btn-xxs btn-info" id="btnDuzenle" href="#"><i class="fa fa-refresh"></i> Seçili Ayar Düzenle</a>
                    <a class="btn btn-xxs btn-danger" id="btnSil" href="#"><i class="fa fa-trash-o"></i> Seçili Ayar Sil</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="tblAyarList">
                        <thead>
                        <th>KAYIT NO</th>
                        <th>ADI</th>
                        <th>TAM ADI</th>
                        <th>VERGİ NO</th>
                        <th>EMAİL</th>
                        <th>DURUM</th>
                        </thead>
                        <tbody>
                        <?php
                        if ($Ayarlar) {
                        foreach ($Ayarlar as $Ayar){ ?>
                            <tr data-id="<?=$Ayar->ID?>">
                                <td><?=$Ayar->ID ?></td>
                                <td><?=$Ayar->Adi ?></td>
                                <td><?=$Ayar->TamAdi ?></td>
                                <td><?=$Ayar->VergiNo ?></td>
                                <td><?=$Ayar->Email ?></td>
                                <td>
                                    <?php
                                    if ($Ayar->Aktif==1)
                                        echo "<span class='label label-success'>Aktif</span>";
                                    else
                                        echo "<span class='label label-danger'>Pasif</span>";
                                    ?>
                                </td>
                            </tr>
                        <?php } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- mainpanel -->
</section>

<?php $this->load->view("includes/footer");?>
<script type="application/javascript">
    var baseurl = "<?php echo base_url('Admin/Ayarlar'); ?>/";
    $(document).ready(function() {

        $("#tblAyarList").dataTable({
            bJQueryUI:true,
            bDestroy: true,
            bFilter: true,
            bLengthChange: true,
            bPaginate: true,
            bInfo: false,
            bSort: true,
            aLengthMenu: [[10, 20,50,100,-1], [10,20,50,100,'All']],
        });
        $("#tblAyarList tbody tr").live('click', function () {
            if (this.firstChild.className == "dataTables_empty")
                return false;
            $("#tblAyarList .SelRow").removeClass("SelRow");
            $(this).addClass("SelRow");
            $("#btnDuzenle").attr("href",baseurl+"Duzenle/"+$(this).attr("data-id"));
            $("#btnSil").attr("href",baseurl+"Sil/"+$(this).attr("data-id"));
        });
    } );
</script>
</body>
</html>