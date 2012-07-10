<?php
if(!empty($fields['field_foto_fid']->content)) {
	list($width, $height) = getimagesize($fields['field_foto_fid']->content);
	$size = filesize($fields['field_foto_fid']->content);
	$size /= 1024;

	$datos = explode('~', $fields['field_foto_data_1']->content);
	$contenido = '<table class=lightbox-foto><tr>';
	$contenido .= '</tr><tr>';
	$contenido .= '<td class=etiqueta>Descripci&oacute;n: </td><td class=contenido>' . $datos[0] . '</td>';
	$contenido .= '</tr><tr>';
	$contenido .= '<td class=etiqueta>Fot&oacute;grafo: </td><td class=contenido>' . $fields['field_foto_data']->content . '</td>';
	$contenido .= '</tr><tr>';
	$contenido .= '<td class=etiqueta>Lugar: </td><td class=contenido>' . $datos[1] . '</td>';
	$contenido .= '</tr><tr>';
	$contenido .= '<td class=etiqueta>Dimensiones: </td><td class=contenido>' . $width . 'x' . $height . ' P&iacute;xeles' . '</td>';
	$contenido .= '</tr><tr>';
	$contenido .= '<td class=etiqueta>Peso: </td><td class=contenido>' . $size . ' Kb</td>';
	$contenido .= '</tr><tr>';
	$contenido .= '<td><a href=/download/file/fid/' . $fields['php']->content . '>Descargar</a></td>';
	$contenido .= '</tr></table>';
} 
?>

<?php if(!empty($fields['field_foto_fid']->content)): ?>
	<div class="ultimas-noticias">
		<div class="foto">
			<div class="miniatura">
				<?php if($height > $width): ?>
					<a rel="lightbox[imagen][<?php print $contenido; ?>]" href="<?php print "/" . $fields['field_foto_fid']->content; ?>">
						<img src="<?php print '/' . $fields['field_foto_fid_2']->content; ?>" />
					</a>
				<?php else: ?>
					<a rel="lightbox[imagen][<?php print $contenido; ?>]" href="<?php print "/" . $fields['field_foto_fid']->content; ?>">
						<img src="<?php print '/' . $fields['field_foto_fid_1']->content; ?>" />
					</a>
				<?php endif; ?>
			</div>
			<div class="datos">
				<div class="fecha"><?php print $fields['timestamp']->content; ?></div>
				<div class="hora"><?php print $fields['timestamp_1']->content; ?></div>
				<div class="descargar">
					<a class="descargar-foto" id="<?php print $fields['php']->content; ?>" href="<?php print '/download/file/fid/' . $fields['php']->content; ?>">
						<img src="/sites/all/themes/servicios/images/descargar-blanco.png">
					</a>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
