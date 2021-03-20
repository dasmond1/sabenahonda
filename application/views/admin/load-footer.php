<?php
$url = base_url('assets/img/logo-white.png');
$cari = array('|');
$ganti =[" <img src='$url' width='30px'> "];
$replace_pesan = str_replace($cari, $ganti, $displayvid['footer_text']);

?>
<marquee scrolldelay="75"><h3 class="text-white my-auto"><?= $replace_pesan; ?></h3></marquee>