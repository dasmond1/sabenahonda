<!-- jQuery -->
<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>js/adminlte.min.js"></script>

<script type="text/javascript">
    var start_time=+new Date();
    window.onload=function(){
        document.getElementById('rendertime').innerHTML = "Page render time: " + ((+new Date()-start_time)/1000);
    };
</script>

<script>
    $("#myalert").fadeTo(3000, 500).slideUp(500, function() {
      $("#myalert").slideUp(500);
    });
</script>

</body>

</html>