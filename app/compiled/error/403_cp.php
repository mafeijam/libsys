<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet'>
	<link href="<?= css('debug') ?>" rel="stylesheet">
	<title>403 forbidden</title>
</head>
<body>
	<div class="debug-title">Access denied!</div>
	<?php if (DEBUG) debug() ?>
</body>
</html>