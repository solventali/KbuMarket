
<?php $this->load->view('include_main/header');?>
<div class="main-panel">
    <div class="row">
        <div class="col-md-12">
            <div class="left-panel">
                <?php $this->load->view('include_main/CustomerMenu'); ?>
            </div>
            <div class="right-panel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info textCenter">
                                    <span><i class="fa fa-credit-card fa-2x"></i>&nbsp;&nbsp;Ödeme ve Teslimat Bilgileri</span>
                                </div>
                            </div>
                        </div>
                        <form action="<?=base_url()?>/Home/OdemeOnay" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs nav-orange">
                                        <li id="t1_1" class="active"><a href="#tab_1_1" data-toggle="tab"><strong>Teslimat Bilgileri</strong></a></li>
                                        <li id="t1_2" class=""><a href="#tab_1_2" data-toggle="tab"><strong>Fatura Bilgileri</strong></a></li>
                                    </ul>
                                    <div class="tab-content mb30">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label textRight">Teslim Adı Soyadı :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="TeslimAdSoyad" class="form-control fc-sm" value="<?=$this->session->userdata('AdSoyad')?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label textRight">Teslim Telefon Numarası :</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" id="TeslimTelefon" name="TeslimTelefon" class="form-control fc-sm"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label textRight">Teslim Adres :</label>
                                                        <div class="col-sm-6">
                                                            <textarea rows="3" name="TeslimAdres" class="form-control fc-sm"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label textRight">Teslim İlçe - Şehir :</label>
                                                        <div class="col-sm-3">
                                                            <input type="text"  name="TeslimIlce" class="form-control fc-sm"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text"  name="TeslimSehir" class="form-control fc-sm"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_1_2">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label textRight">Fatura Adı Soyadı :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="FaturaAdSoyad" class="form-control fc-sm" value="<?=$this->session->userdata('AdSoyad')?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label textRight">Fatura Telefon Numarası :</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" id="FaturaTelefon" name="FaturaTelefon" class="form-control fc-sm"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label textRight">Fatura Adres :</label>
                                                        <div class="col-sm-6">
                                                            <textarea rows="3" name="FaturaAdres" class="form-control fc-sm"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label textRight">Fatura İlçe - Şehir :</label>
                                                        <div class="col-sm-3">
                                                            <input type="text"  name="FaturaIlce" class="form-control fc-sm"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text"  name="FaturaSehir" class="form-control fc-sm"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label textRight">Tutar :</label>
                                                        <div class="col-sm-3">
                                                            <input type="text"  name="Tutar" class="form-control fc-sm" readonly="readonly" value="<?=$Tutar ;?> TL" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">&nbsp;</div>
                                <div class="col-sm-3">
                                    <button class="btn btn-sm btn-primary btn-block"><i class="fa fa-money"></i>&nbsp;&nbsp;Satın Al</button>
                                </div>
                            </div>
                        </form>
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

        $("#TeslimTelefon").mask("(999) 999-9999");
        $("#FaturaTelefon").mask("(999) 999-9999");
    });
</script>