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
            <h2><i class="fa fa-users"></i> Üye Listeleme</h2>
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
                <div class="col-md-12">
                    <a class="btn btn-xxs btn-primary" href="<?= base_url('Admin/Uyeler/YeniUye')?>"><i class="fa fa-plus"></i> Yeni Üye</a>
                    <a class="btn btn-xxs btn-info" id="btnDuzenle" href="#"><i class="fa fa-refresh"></i> Seçili Üye Düzenle</a>
                    <a class="btn btn-xxs btn-danger" id="btnSil" href="#"><i class="fa fa-trash-o"></i> Seçili Üye Sil</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="tblUyeList">
                        <thead>
                            <th>ADI SOYADI</th>
                            <th>E MAİL</th>
                            <th>YETKİ</th>
                            <th>DOĞUM TARİHİ</th>
                            <th>TELEFON</th>
                            <th>DURUM</th>
                        </thead>
                        <tbody>
                            <?php if ($Uyeler) {
                            foreach ($Uyeler as $Uye){ ?>
                                <tr data-id="<?=$Uye->UyeID?>">
                                    <td><?=$Uye->AdSoyad ?></td>
                                    <td><?=$Uye->Email ?></td>
                                    <td>
                                        <?php
                                            if ($Uye->Yetki==1)
                                                echo "<span class='label label-success'>Satıcı</span>";
                                            else
                                                echo "<span class='label label-primary'>Admin</span>";
                                        ?>
                                    </td>
                                    <td><?=date("d.m.Y",strtotime($Uye->DgmTarih))?></td>
                                    <td><?=$Uye->Telefon?></td>
                                    <td>
                                        <?php
                                        if ($Uye->Aktif==1)
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
    var baseurl = "<?php echo base_url('Admin/Uyeler'); ?>/";
    $(document).ready(function() {
        $("#tblUyeList").dataTable({
            bDestroy: true,
            bFilter: true,
            bLengthChange: true,
            bPaginate: true,
            bInfo: false,
            bSort: true,
            aLengthMenu: [[10, 20,50,100,-1], [10,20,50,100,'All']]
        });
        $("#tblUyeList tbody tr").live('click', function () {
            if (this.firstChild.className == "dataTables_empty")
                return false;
            $("#tblUyeList .SelRow").removeClass("SelRow");
            $(this).addClass("SelRow");
            $("#btnDuzenle").attr("href",baseurl+"Duzenle/"+$(this).attr("data-id"));
            $("#btnSil").attr("href",baseurl+"Sil/"+$(this).attr("data-id"));
        });
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