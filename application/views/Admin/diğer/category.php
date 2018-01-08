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
            <h2><i class="fa fa-home"></i> Blank <span>Subtitle goes here...</span></h2>
            <div class="breadcrumb-wrapper">
                <span class="label">You are here:</span>
                <ol class="breadcrumb">
                    <li><a href="index.html">Bracket</a></li>
                    <li class="active">Blank</li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="phone" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                        Launch Modal
                    </button>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="tblCategoryList">
                    </table>
                </div>
            </div>
        </div>
    </div><!-- mainpanel -->
</section>

<?php $this->load->view("includes/footer");?>

<script type="application/javascript">
    var baseurl = "<?php print base_url('Admin/Category/CategoryList'); ?>";

    $(document).ready(function() {

        GetCategoryList();

        function GetCategoryList() {
            $.ajax({
                type: "POST",
                url: baseurl,
                success: function (data) {
                    console.log(data);
                   var obj = JSON.parse(data);
                    $("#tblCategoryList").dataTable({
                        aaData: obj,
                        bDestroy: true,
                        bFilter: true,
                        bLengthChange: false,
                        bPaginate: true,
                        bInfo:false,
                        bSort: true,
                        aoColumns: [
                            { sTitle: "SIRA NO", mData: "Id" },
                            { sTitle: "KATEGORİ ADI", mData: "Adi" },
                            { sTitle: "AÇIKLAMA", mData: "Aciklama" },
                            { sTitle:"DURUM", mData:"Aktif", mRender: function (data) {
                                    if (data=="1")
                                        return "<span class=\"label label-success\">Aktif</span>";
                                    else
                                        return "<span class=\"label label-danger\">Pasif</span>";
                                }
                            }
                        ]
                    });
                },
                error: function () { alert("Hata:"); }
            });
        }
        $("#tblCategoryList tbody tr").live('click', function () {
            if (this.firstChild.className == "dataTables_empty")
                return false;
            $("#tblCategoryList .SelRow").removeClass("SelRow");
            $(this).addClass("SelRow");
        });


        // Input Masks
        //jQuery("#date").mask("99/99/9999");
        jQuery(".phone").mask("(999) 999-9999");
        //jQuery("#ssn").mask("999-99-9999");

    } );
</script>
</body>
</html>