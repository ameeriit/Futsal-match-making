<?php  if (count($fupdate_error) > 0) : ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <?php foreach ($fupdate_error as $error) : ?>
  	
  <strong><?php echo $error ?></strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
	<?php endforeach ?>
</div>
  	
<?php  endif ?>