<footer></footer>
</div>
</div>
</div>
</section>
<?php $this->load->view('includes/include_script');?>

<script type="application/javascript">
    var mesaj = "<?=$this->session->flashdata("Message");?>";
    if (mesaj!="") {
        var Kod = "<?=$this->session->flashdata("Kod");?>";
        MessageBoxShow("KBU ONLINE SHOPİNG", mesaj, Kod, Kod);
    }

</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        jQuery('.stellarnav').stellarNav({
            theme: 'kbu'
        });
    });
</script>
