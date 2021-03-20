
<script type="text/javascript">
        $(document).ready(function(){ 
            $('#no_ktp').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo base_url('staff/parsingKTP');?>",
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