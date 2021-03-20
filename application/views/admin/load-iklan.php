<?php $i=0; foreach ($displayiklan as $key): ?>
<?php if ($i==0) {$set_ = 'active'; } else {$set_ = ''; } ?> 
<div class='carousel-item <?php echo $set_; ?>'>
<img src='<?= base_url('vendor/slide/').$key['image_url']; ?>' width="100%" height="auto">
</div>
<?php $i++; endforeach ?>
