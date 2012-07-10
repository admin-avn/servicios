<td class="fecha"><?php print $fields['created']->content; ?></td>
<td class="galeria">
	<?php if(!empty($fields['field_imagen_fid']->content)): ?>
		<img src="/sites/all/themes/servicios/images/galeria_asociada.png" />
	<?php endif; ?>
</td>
<td class="nota">
	<span class="etiqueta"><?php print $fields['field_etiqueta_value']->content . " "; ?></span>
	<?php print $fields['title']->content . "<br />"; ?>
	<span class="termino"><?php print $fields['name']->content; ?></span>
</td>
