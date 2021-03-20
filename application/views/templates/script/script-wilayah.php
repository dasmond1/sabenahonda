
    
    <script type="text/javascript">
        $(document).ready(function(){
 
            $('#provinsiSEL').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo base_url('staff/getKota');?>",
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
                    url : "<?php echo base_url('staff/getKecamatan');?>",
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
                    url : "<?php echo base_url('staff/getKelurahan');?>",
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