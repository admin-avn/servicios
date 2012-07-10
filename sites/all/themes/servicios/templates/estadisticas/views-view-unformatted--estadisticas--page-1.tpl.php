<?php if (!empty($title)): ?>
	<h3><?php print $title; ?></h3>
<?php endif; ?>
<table class="cantidad-descargas">
	<?php foreach ($rows as $id => $row): ?>
		<?php print $row; ?>
	<?php endforeach; ?>
</table>
