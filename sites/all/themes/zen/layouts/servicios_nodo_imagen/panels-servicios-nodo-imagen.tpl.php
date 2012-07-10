<div class="contenedor-nodo" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
	<?php if($content['arriba']): ?>
		<div class="arriba">
			<div class="inside"><?php print $content['arriba']; ?></div>
		</div>
	<?php endif; ?>
	<div class="medio">
		<?php if($content['izquierda']): ?>
			<div class="izquierda">
				<div class="inside"><?php print $content['izquierda']; ?></div>
			</div>
		<?php endif; ?>
		<?php if($content['izquierda']): ?>
			<div class="derecha">
				<div class="inside"><?php print $content['derecha']; ?></div>
			</div>
		<?php endif; ?>
		<div class="clear-float"></div>
	</div>
</div>
