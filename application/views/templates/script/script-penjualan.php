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