
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
                        <a href="#" class="btn btn-sm btn-primary" id="btnSiparisDetay"> Seçili Sipariş Detayı</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="tblSiparisList">
                            <thead>
                                <th>SİPARİŞ NO</th>
                                <th>MÜŞTERİ ADI</th>
                                <th>TARİH</th>
                                <th>BEDEN</th>
                                <th>RENK</th>
                                <th>MİKTAR</th>
                                <th>SATIŞ FİYATI</th>
                            </thead>
                            <tbody>
                                <?php
                                    if ($Siparisler) {
                                        foreach ($Siparisler as $Siparis){ ?>
                                        <tr data-id="<?=$Siparis->SiparisID?>" class="<?php
                                            if ($Siparis->SiparisDurumu=="Teslim Edildi") {echo "delivered"; }
                                        if ($Siparis->SiparisDurumu=="Kargoda") {echo "cargo"; }
                                        ?>">
                                            <td><?=$Siparis->SiparisID ?></td>
                                            <td><?=$Siparis->AdSoyad ?></td>
                                            <td><?=date("d.m.Y H:i:s",strtotime($Siparis->Tarih))?></td>
                                            <td><?=$Siparis->OdemeTuru ?></td>
                                            <td><?=$Siparis->OdemeDurumu ?></td>
                                            <td><?=$Siparis->SiparisDurumu ?></td>
                                            <td><?=$Siparis->FaturaTelefon ?></td>
                                        </tr>
                                    <?php }
                                }?>
                            </tbody>
                        </table>
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
        $("#tblSiparisList").dataTable({
            bDestroy: true,
            bFilter: true,
            bLengthChange: true,
            bPaginate: true,
            bInfo: false,
            bSort: true,
            aLengthMenu: [[10, 20,50,100,-1], [10,20,50,100,'All']],
        });
        $("#tblSiparisList tbody tr").live('click', function () {
            if (this.firstChild.className == "dataTables_empty")
                return false;
            $("#tblSiparisList .SelRow").removeClass("SelRow");
            $(this).addClass("SelRow");
            $("#btnSiparisDetay").attr("href",baseurl+"SiparisDetay/"+$(this).attr("data-id"));
        });
    });
</script>