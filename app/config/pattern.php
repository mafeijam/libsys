<?php

return [
	'#@(block|extend|theme|start|get)(\(.*\))#' => '<?php \$this->$1$2 ?>',
	'#@(endif|endforeach)#i' 			        => '<?php $1 ?>',
	'#@(end|show|append|replace)#' 		        => '<?php \$this->$1() ?>',
	'#@(if |elseif |for |foreach )(\(.+\))#'    => '<?php $1$2 : ?>',
	'#@(else)#'							        => '<?php $1 : ?>',
	'#@debug#'									=> '<?php if (DEBUG) debug() ?>',
	'#{{(\s?\w+::.+)}}#' 						=> '<?=e($1)?>',
	'#{{(.+)}}#' 						        => '<?=e($1)?>',
	'#{!(.+)( or )(.+)!}#' 				        => '<?=isset($1) ? e($1) : $3?>',
	'#{!(.+)!}#' 						        => '<?=$1?>'
];