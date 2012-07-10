<div class="contenedor-nodo" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
	<?php if($content['arriba']): ?>
		<div class="arriba">
			<div class="inside"><?php print $content['arriba']; ?></div>
		</div>
	<?php endif; ?>
</div>
