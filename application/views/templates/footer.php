<footer class="main-footer">
    <strong class="mx-auto">Copyright &copy; <?= date('Y'); ?> <a href="https://hondalambarona.id">Lambarona Sakti</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>js/adminlte.js"></script>

<!-- Select2 -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.full.min.js"></script>

<!-- DataTables -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- ChartJS -->
<script src="<?= base_url('assets/'); ?>plugins/chart.js/Chart.min.js"></script>

<script src="<?= base_url('assets/'); ?>js/lightbox.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js">
</script>
<script type="text/javascript">
 $(document).ready(function() {
     if ($.cookie('pop') == null) {
         $('#papanInformasi').modal('show');
         $.cookie('pop', '1');
     }
 });
</script>


<script type="text/javascript">
$(document).ready(function(){
$('#no_ktp').change(function(){ 
var id=$(this).val();
$.ajax({
url : "../api/parsingKTP",
method : "POST",
data : {id: id},
async : true,
dataType : 'json',
success: function(data){
$("#tanggal_lahir").val(data.tanggal_lahir);
$("#jenis_kelamin").val(data.jenis_kelamin);
$("#jk").val(data.jk);
}
});
return false;
}); 

});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('#no_mesin').change(function(){ 
var id=$(this).val();
$.ajax({
url : "<?php echo base_url('penjualan/showData');?>",
method : "POST",
data : {id: id},
async : true,
dataType : 'json',
success: function(data){
                    $("#no_rangka").val(data.no_rangka);
                    $("#tipe").val(data.kode_unit);
                    $("#tahun").val(data.tahun);
                    $("#warna").val(data.warna);
                    $("#no_spg").val(data.no_spg);
                    $("#no_doh").val(data.no_doh);

}
});
return false;
}); 

});
</script>

<script>
  $(function() {
  $(".updateCDB").click(function() {
    id = $(this).data('id');
    nama = $(this).data('nama');
    $("#updateModal #post-id").val(id);
    $("#updateModal #post-nama").val(nama);
  });
});
</script>

<script type="text/javascript">
    function changeFunc() {
    var selectBox = document.getElementById("selectBox");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if (selectedValue == "other" || selectedValue=="pameran"){
            $('#textboxes').show();
        }
        else {
            $('#textboxes').hide();
        }
    }
</script>

<script>
  $(function() {
  $(".updatePosisi").click(function() {
    id = $(this).data('id');
    posisi_unit = $(this).data('posisi');
    status_unit = $(this).data('status');
    $("#updatePosisi #post-id").val(id);
    $("#updatePosisi #post-posisi").val(posisi_unit);
    $("#updatePosisi #post-status").val(status_unit);
  });
});
</script>

<script>
  $(function() {
  $(".ultahModal").click(function() {
    id = $(this).data('id');
    nama = $(this).data('nama');
    umur = $(this).data('umur');
    $("#ultahModal #post-id").val(id);
    $("#ultahModal #post-nama").val(nama);
    $("#ultahModal #post-umur").val(umur);
  });
});
</script>

<script>
  $(function() {
  $(".sendtosms").click(function() {
    id = $(this).data('id');
    $("#sendtosms #post-id").val(id);
  });
});
</script>

<script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>


<script>
  $(function() {
  $(".delete").click(function() {
    id = $(this).data('id');
    $("#deleteModal #post-id").val(id);
  });
});
</script>
<script>
  $(function() {
  $(".status").click(function() {
    id = $(this).data('id');
    $("#statusModal #post-id").val(id);
  });
});
</script>
<script>
  $(function() {
  $(".update").click(function() {
    id = $(this).data('id');
    $("#updateModal #post-id").val(id);
  });
});
</script>

<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
})
</script>

<script>
  $(function () {
    $('#dataTableUser').DataTable({
        "paging": true,
        "lengthChange": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true
    });
  });
</script>

<script>
  $(function () {
    $('#chatTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "pageLength": 5, 
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        "responsive": true
    });
  });
</script>

<script>
    $("#myalert").fadeTo(5000, 500).slideUp(500, function() {
      $("#myalert").slideUp(500);
    });
</script>

<script>
function myFunction() {
  var x = document.getElementById("passwordlama");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<script>
function myFunction1() {
  var x = document.getElementById("passwordbaru");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script type="text/javascript">
        $(document).ready(function(){
 
            $('#provinsiSEL').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "../api/getKota",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){

                        var html = '';
                        var i;
                            html = '<option>Pilih Kota</option>';
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id+'>'+data[i].id+' - '+data[i].name+'</option>';                            
                        }
                        $('#kotaSEL').html(html);
                        
 
                    }
                });
                return false;
            }); 
             
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
 
            $('#kotaSEL').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "../api/getKecamatan",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;
                            html = '<option>Pilih Kecamatan</option>';
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id+'>'+data[i].id+' - '+data[i].name+'</option>';
                        }
                        $('#kecamatanSEL').html(html);
 
                    }
                });
                return false;
            }); 
             
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
 
            $('#kecamatanSEL').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "../api/getKelurahan",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;
                            html = '<option>Pilih Desa</option>';
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id+'>'+data[i].id+' - '+data[i].name+'</option>';
                        }
                        $('#keluarahanSEL').html(html);
 
                    }
                });
                return false;
            }); 
             
        });
    </script>
    
    <script>
  var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener("keyup", function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, "Rp. ");
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
  </script>

<script type="text/javascript">
$(document).ready(function(){
$('#no_mesin').change(function(){ 
var id=$(this).val();
$.ajax({
url : "<?php echo base_url('posinpur/showData');?>",
method : "POST",
data : {id: id},
async : true,
dataType : 'json',
success: function(data){
                    $("#no_rangka").val(data.no_rangka);
                    $("#tipe").val(data.kode_unit);
                    $("#tahun").val(data.tahun);
                    $("#warna").val(data.warna);
                    $("#no_spg").val(data.no_spg);
                    $("#no_doh").val(data.no_doh);

}
});
return false;
}); 

});
</script>


</body>
</html>