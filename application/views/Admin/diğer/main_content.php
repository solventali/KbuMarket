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
            <!-- content goes here... -->
            <a class="btn btn-default">.btn-default</a>
            <a class="btn btn-primary">.btn-primary</a>
            <a class="btn btn-success">.btn-success</a>
            <a class="btn btn-warning">.btn-warning</a>
            <br>
            <?php echo base_url()."includes/head"?>
        </div>
    </div><!-- mainpanel -->
</section>
<div class="footer">
    <?php echo date("Y"); ?> &copy; Kbu Market Management Panel
</div>

<?php $this->load->view("includes/footer");?>


</body>
</html>