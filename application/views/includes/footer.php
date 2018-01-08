
<div class="footer">
    <?php echo date("Y"); ?> &copy; Kbu Shopping Panel
</div>

<?php $this->load->view('includes/include_script');?>

<script type="application/javascript">
    var mesaj = "<?=$this->session->flashdata("Message");?>";
    if (mesaj!="") {
        var Kod = "<?=$this->session->flashdata("Kod");?>";
        MessageBoxShow("KBU ONLINE SHOPİNG", mesaj, Kod, Kod);
    }

</script>

