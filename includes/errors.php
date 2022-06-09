<?php if (count($errors) > 0) : ?>
  <div class="message error validation_errors" >
	  <!-- best used when accessing arrays because store a key value pair -->
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php endif ?>