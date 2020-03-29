<?php  if (count(Validation::errors("signUp")) > 0) :?>
	<div class="row justify-content-center">
		<div class="error">
			<?php foreach (Validation::errors("signUp") as $error) : ?>
			<p><?php echo $error ?> </p>
			<?php endforeach ?>
		</div>
	</div>
<?php  endif ?>