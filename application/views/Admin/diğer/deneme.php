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
            <form action="<?php print base_url('Admin/Category/Deneme'); ?>" method="post">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" id="deneme" name="deneme" class="phone" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
            </div>
            </form>
            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" onclick="GetGuncelStokBildirimList()">
                Launch Modal
            </button>

        </div>
    </div><!-- mainpanel -->
</section>

<?php $this->load->view("includes/footer");?>
<script type="application/javascript">
    var baseurl = "<?php print base_url('Admin/Category/deneme'); ?>";

    function GetGuncelStokBildirimList() {
        var obj = new Object();
        obj.deneme = document.getElementById("deneme").value;
        $.ajax({
            type: "POST",
            url: baseurl,
            data: obj,
            dataType : 'Text',
            success: function (data) {
                console.log(data);
              /*  var objj = JSON.parse(data);
                alert(objj[0].ReyonAdi);*/
            },
            error: function () { alert("Hata:"); }
        });
    }
    $(document).ready(function() {

       // GetGuncelStokBildirimList();

       /* function GetGuncelStokBildirimList() {
            var deneme = document.getElementById("deneme").value;
            $.ajax({
                type: "POST",
                url: baseurl,
                data: "{deneme:" + deneme + "}",
                success: function (data) {
                    console.log(data);
                  //  var obj = JSON.parse(data);

                },
                error: function () { alert("Hata:"); }
            });
        }*/


    } );
</script>
</body>
</html>