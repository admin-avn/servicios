<table class="video-admin">
	<?php foreach ($rows as $id => $row): ?>
		<tr class="<?php print $classes[$id]; ?>">
			<?php print $row; ?>
		</tr>
	<?php endforeach; ?>
</table>
