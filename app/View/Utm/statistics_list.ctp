<?php

function renderTextList($array, $level = 1) {
	$text = '';

	foreach ($array as $key => $value) {
		$prefix = $level > 1 ? str_repeat('*', $level) . ' ' : '';

		if (is_array($value)) {
			$text .= $prefix . htmlspecialchars($key) . "\n";
			$text .= renderTextList($value, $level + 1);
		} else {
			$text .= $prefix . htmlspecialchars($value) . "\n";
		}
	}
	return $text;
}

echo '<pre>' . renderTextList($utms) . '</pre>';

?>

<br>

<?php echo $this->Paginator->numbers(); ?>

<?php echo $this->Paginator->prev(
	'« Previous',
	null,
	null,
	array('class' => 'disabled')
); ?>

<?php echo $this->Paginator->next(
	'Next »',
	null,
	null,
	array('class' => 'disabled')
); ?>

<?php echo $this->Paginator->counter(); ?>