<?php  if (count(Validation::errors("login")) > 0) :?>
	<div class="row justify-content-center">
		<div class="error">
			<?php foreach (Validation::errors("login") as $error) : ?>
			<p><?php echo $error ?> </p>
			<?php endforeach ?>
		</div>
	</div>
<?php  endif ?>