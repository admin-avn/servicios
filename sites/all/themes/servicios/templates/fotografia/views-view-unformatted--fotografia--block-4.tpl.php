<?php if (!empty($title)): ?>
	<h3><?php print $title; ?></h3>
<?php endif; ?>
<div id="agenda-fotografica">
	<?php foreach ($rows as $id => $row): ?>
		<div class="<?php print $classes[$id]; ?>">
			<?php print $row; ?>
		</div>
	<?php endforeach; ?>
</div>
