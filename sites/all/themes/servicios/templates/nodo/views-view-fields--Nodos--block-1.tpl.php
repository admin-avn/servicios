<div class="noticia-encabezado">
	<div class="imprimir"><?php print $fields['nid']->content; ?></div>
	<div class="descargar"><?php print $fields['nid_1']->content; ?></div>
	<?php if(!empty($fields['php']->content)): ?>
		<div class="anterior">
			<a href="<?php print "/node/" . $fields['php']->content; ?>"><img src="/sites/all/themes/servicios/images/anterior.png" />ANTERIOR</a>
		</div>
	<?php else: ?>
		<div class="anterior"><img src="/sites/all/themes/servicios/images/anterior.png" />ANTERIOR</div>
	<?php endif; ?>
	<?php if(!empty($fields['php_1']->content)): ?>
		<div class="siguiente">
			<a href="<?php print "/node/" . $fields['php_1']->content; ?>">SIGUIENTE<img src="/sites/all/themes/servicios/images/siguiente.png" /></a>
		</div>
	<?php else: ?>
		<div class="siguiente">SIGUIENTE<img src="/sites/all/themes/servicios/images/siguiente.png" /></div>
	<?php endif; ?>
	<div class="termino"><?php print $fields['tid']->content; ?></div>
	<div class="etiqueta">
		<span><?php print $fields['field_etiqueta_value']->content; ?></span>
		<span><?php print $fields['created']->content . " (GMT -04:30)"; ?></span>
	</div>
	<div class="titulo"><?php print $fields['title']->content; ?></div>
</div>
