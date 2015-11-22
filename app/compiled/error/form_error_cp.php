<?php if (Session::has('error')) : ?>
	<div class="red">
		<?php foreach (flash('error') as $error) : ?>
		<p><i class="fa fa-exclamation-triangle"></i><?= $error ?></p>
		<?php endforeach ?>
	</div>
<?php endif ?>