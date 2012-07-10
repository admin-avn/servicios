<div class="contenedor-fotografia" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
	<?php if($content['arriba']): ?>
		<div class="arriba">
			<div class="inside"><?php print $content['arriba']; ?></div>
			<div class="clear-float"></div>
		</div>
	<?php endif; ?>
	<?php if($content['centro']): ?>
		<div class="centro">
			<div class="inside"><?php print $content['centro']; ?></div>
			<div class="clear-float"></div>
		</div>
	<?php endif; ?>
	<?php if($content['abajo']): ?>
		<div class="abajo">
			<div class="inside"><?php print $content['abajo']; ?></div>
			<div class="clear-float"></div>
		</div>
	<?php endif; ?>
</div>
