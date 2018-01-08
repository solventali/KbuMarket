
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
                        <form method="post" action="<?php echo base_url('Home/CustomerGuncelle'); ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Adı Soyadı :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control fc-sm" name="AdSoyad" required value="<?=$Customer->AdSoyad?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">E Mail :</label>
                                        <div class="col-sm-8">
                                            <input type="email"  class="form-control fc-sm" name="Email" required value="<?=$Customer->Email; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Şifre :</label>
                                        <div class="col-sm-8">
                                            <input type="password"  class="form-control fc-sm" name="Sifre" required value="<?=$Customer->Sifre; ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Adres :</label>
                                        <div class="col-sm-8">
                                            <textarea rows="2" class="form-control fc-sm" name="Adres" ><?=$Customer->Adres; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Şehir :</label>
                                        <div class="col-sm-8">
                                            <input type="text"  class="form-control fc-sm"  name="Sehir" required value="<?=$Customer->Sehir; ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Telefon :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control fc-sm" id="Telefon" name="Telefon" required value="<?=$Customer->Telefon; ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Doğum Tarihi :</label>
                                        <div class="col-sm-8">
                                            <input type="text"  class="form-control fc-sm" id="DogumTarihi" name="DogumTarihi" required
                                                   value="<?=date("d.m.Y",strtotime($Customer->DogumTarihi)); ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12 textCenter">
                                            <?php if ($Customer->Resim) { ?>
                                                <img src="<?php echo base_url('Uploads/Profil_Resim/').$Customer->Resim; ?>" class="image-product"  />
                                            <?php } else { ?>
                                                <img src="<?= base_url('Uploads/Profil_Resim')?>/nopicture_max.png" class="image-product"  />
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12 textCenter">
                                            <button type="button" onclick="ResimSec()" class="btn btn-sm btn-orange"><i class="fa fa-picture-o"></i> &nbsp;Resim Değiştir </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Cinsiyet :</label>
                                        <div class="col-sm-8">
                                            <select class="form-control fc-sm" name="Cinsiyet">
                                                <option value="Bay" <?php if ($Customer->Cinsiyet=="Bay") echo "selected"; ?> >Bay</option>
                                                <option value="Bayan"  <?php if ($Customer->Cinsiyet=="Bayan") echo "selected"; ?>>Bayan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label textRight">Açıklama :</label>
                                        <div class="col-sm-8">
                                            <textarea rows="2" class="form-control fc-sm" name="Aciklama" placeholder="Açıklama"><?=$Customer->Aciklama; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-3">
                                    <input type="hidden" name="ID" value="<?=$Customer->ID; ?>" />
                                    <button class="btn btn-sm btn-block btn-orange"><i class="fa fa-check"></i>&nbsp;Kaydet</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myProfilPicture" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Profil Resmi Seç</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('Home/ProfilResimYukle'); ?>/<?=$Customer->ID ?>">
                            <div class="form-group">
                                <div class="col-md-12 textCenter">
                                    <img id="YeniResim" src="<?= base_url('Uploads')?>/nopicture_max.png" class="image-product"  />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 textCenter">
                                        <input type="file" name="Resim" id="Resim" class="form-control fc-sm file-upload" required/>
                                        <button class="btn btn-sm btn-success" id="btnResimSec"><i class="fa fa-picture-o"></i> Resim Seç</button>
                                        <button class="btn btn-sm btn-orange" ><i class="fa fa-save"></i> Kaydet</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
<?php $this->load->view('include_main/footer');?>
<script type="application/javascript">
    var baseurl = "<?php echo base_url('Home'); ?>/";
    function ResimSec() {
        $("#myProfilPicture").modal("show");
        return false;
    }
    $(document).ready(function() {

        $("#Telefon").mask("(999) 999-9999");
        $('#DogumTarihi').datetimepicker({
            dayOfWeekStart: 1,
            yearStart: 1900,
            lang: 'tr',
            timepicker: false,
            mask: true,
            format: 'd.m.Y'
        });
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