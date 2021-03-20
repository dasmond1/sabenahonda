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