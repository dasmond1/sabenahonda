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