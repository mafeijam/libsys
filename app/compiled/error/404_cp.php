<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet'>
	<link href="<?= css('debug') ?>" rel="stylesheet">
	<title>404 not found</title>
</head>
<body>
	<div class="debug-title">
	<p>The page you are looking for was not found!</p>
	<p class="small"><a href="<?= url() ?>">Go back to home</a></p>
	</div>
	<?php if (DEBUG) debug() ?>
</body>
</html>