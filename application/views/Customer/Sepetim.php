
<?php $this->load->view('include_main/header');?>
<div class="main-panel">
    <div class="row">
        <div class="col-md-12">
            <div class="left-panel">
                <?php $this->load->view('include_main/CustomerMenu');
                ?>
            </div>
            <div class="right-panel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="btn btn-sm btn-danger" id="btnSeciliSil"><i class="fa  fa-eraser"></i>&nbsp;&nbsp;Seçili Ürün Sil</a>
                                <a href="<?= base_url('Home');?>/SepetTemizle" class="btn btn-sm btn-darkblue" id="btnTumunuSil"><i class="fa  fa-trash-o"></i>&nbsp;&nbsp;Tümünü Sil</a>
                                <a href="#" class="btn btn-sm btn-primary" id="btnUrunDetay"><i class="fa fa-eye"></i>&nbsp;&nbsp;Seçili Ürün Detay</a>
                                <a href="<?= base_url('Home');?>/Odeme" class="btn btn-sm btn-success" id="btnOdemeYap"><i class="fa fa-money"></i>&nbsp;&nbsp;Ödeme Yap</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="tblSepetList">
                                    <thead>
                                    <th>KODU</th>
                                    <th>RESİM</th>
                                    <th>ÜRÜN ADI</th>
                                    <th>BEDEN</th>
                                    <th>RENK</th>
                                    <th>MİKTAR</th>
                                    <th>SATIŞ FİYATI</th>
                                    </thead>
                                    <tbody>
                                    <?php $Toplam = 0;
                                    if ($Urunler) {
                                        foreach ($Urunler as $Urun){
                                            $Toplam += ($Urun->SatisFiyat*$Urun->Miktar);
                                            ?>
                                            <tr data-id="<?=$Urun->SepetID?>" data-UrunID="<?=$Urun->UrunID?>">
                                                <td><?=$Urun->Kodu ?></td>
                                                <td>
                                                    <?php if ($Urun->Resim) { ?>
                                                        <img src="<?= base_url('Uploads/Urun_Resim')."/".$Urun->Resim?>" height="30" width="40"/>
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('Uploads')?>/nopicture_min.png" title="Resim Yükle"/>
                                                    <?php } ?>
                                                </td>
                                                <td><?=$Urun->UrunAdi ?></td>
                                                <td><?=$Urun->Beden ?></td>
                                                <td><?=$Urun->Renk ?></td>
                                                <td><?=$Urun->Miktar ?></td>
                                                <td class="textRight"><?=$Urun->SatisFiyat." ".$Urun->Birim ?></td>
                                            </tr>
                                        <?php }
                                    }?>
                                    </tbody>
                                    <tfoot>
                                    <td colspan="6"><span>Genel Toplam :</span></td>
                                    <td class="textRight"><?php echo $Toplam." TL"; ?></td>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include_main/footer');?>
<script type="application/javascript">
    var baseurl = "<?php echo base_url('Home'); ?>/";

    $(document).ready(function() {
        $("#tblSepetList").dataTable({
            bDestroy: true,
            bFilter: true,
            bLengthChange: true,
            bPaginate: true,
            bInfo: false,
            bSort: true,
            aLengthMenu: [[10, 20,50,100,-1], [10,20,50,100,'All']],
        });
        $("#tblSepetList tbody tr").live('click', function () {
            if (this.firstChild.className == "dataTables_empty")
                return false;
            $("#tblSepetList .SelRow").removeClass("SelRow");
            $(this).addClass("SelRow");
            $("#btnSeciliSil").attr("href",baseurl+"SepetSil/"+$(this).attr("data-id"));
            $("#btnUrunDetay").attr("href",baseurl+"Product/"+$(this).attr("data-UrunID"));
        });
    });
</script>