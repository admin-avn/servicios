<?php
list($width, $height) = getimagesize($fields['field_foto_fid_1']->content);
$datos = explode('~', $fields['field_foto_data_1']->content);
$size = filesize($fields['field_foto_fid_1']->content);
$size /= 1024;
$contenido = '<table class=lightbox-foto><tr>';
$contenido .= '<td class=etiqueta>Fuente:</td><td class=contenido>' . $fields['tid']->content  . '</td>';
$contenido .= '</tr><tr>';
$contenido .= '<td class=etiqueta>Gu&iacute;a: </td><td class=contenido>' . $fields['title']->content . '</td>';
$contenido .= '</tr><tr>';
$contenido .= '<td class=etiqueta>Descripci&oacute;n: </td><td class=contenido>' . trim($datos[0]) . '</td>';
$contenido .= '</tr><tr>';
$contenido .= '<td class=etiqueta>Lugar: </td><td class=contenido>' . $datos[1] . '</td>';
$contenido .= '</tr><tr>';
$contenido .= '<td class=etiqueta>Fecha: </td><td class=contenido>' . $fields['created']->content .  '</td>';
$contenido .= '</tr><tr>';
$contenido .= '<td class=etiqueta>Fot&oacute;grafo: </td><td class=contenido>' . $fields['field_foto_data']->content . '</td>';
$contenido .= '</tr><tr>';
$contenido .= '<td class=etiqueta>Dimensiones: </td><td class=contenido>' . $width . 'x' . $height . ' P&iacute;xeles' . '</td>';
$contenido .= '</tr><tr>';
$contenido .= '<td class=etiqueta>Peso: </td><td class=contenido>' . $size . ' Kb</td>';
$contenido .= '</tr><tr>';
$contenido .= '<td><a href=/download/file/fid/' . $fields['php']->content . '>Descargar</a></td>';
$contenido .= '</tr></table>';
?>

<?php
if(!empty($fields['field_foto_fid_1']->content)) {
	list($width, $height) = getimagesize($fields['field_foto_fid_1']->content);
}

$fid = $fields['php']->content;
/*
$db_hostname = 'jigoku';
$db_database = 'servicios';
$db_username = 'fflores';
$db_password = 'cbc150';

$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if(!$db_server) die("No se pudo conectar al servidor MySQL: " . mysql_error());

mysql_select_db($db_database) or die("No se pudo conectar a la base de datos: " . mysql_error());

$query = "select filesize, filepath from files where fid = $fid";
$result = mysql_query($query);
if(!$result) die("No se pudo acceder a la base de datos: " . mysql_error());

while($row = mysql_fetch_object($result)) {
	if($row->filesize < 100) {
		$filepath = "/data/www/servicios/" . $row->filepath;
		$size = `du -b $filepath`;
		$regexp = trim(substr($size, 0, 7));
		$query_update = "update files set filesize = $regexp where fid = $fid";
		$result_update = mysql_query($query_update);
		mysql_free_result($result_update);
	}
}

mysql_free_result($result);

mysql_close($db_server);
 */
?>
<?php if(arg(2) == 'vertical'): ?>
	<div class="foto-vertical">
		<div class="miniatura">
			<?php if($height > $width): ?>
				<a rel="lightbox[imagen][<?php print $contenido; ?>]" href="<?php print "/" . $fields['field_foto_fid_1']->content; ?>">
					<img src="<?php print '/' . $fields['field_foto_fid_2']->content; ?>" />
				</a>
			<?php else: ?>
				<a rel="lightbox[imagen][<?php print $contenido; ?>]" href="<?php print "/" . $fields['field_foto_fid_1']->content; ?>">
					<img src="<?php print '/' . $fields['field_foto_fid']->content; ?>" />
				</a>
			<?php endif; ?>
		</div>
		<div class="leyenda"><span>Leyenda:</span> <?php print $fields['field_foto_data_1']->content; ?></div>
		<div class="autor"><span>Cr&eacute;ditos:</span> <?php print $fields['field_foto_data']->content; ?></div>
		<div class="fecha"><span>Fecha:</span> <?php print $fields['created']->content; ?></div>
		<div class="descargar">
			<a class="descargar-foto" id="<?php print $fields['php']->content; ?>"href="<?php print '/download/file/fid/'.$fields['php']->content; ?>">
				<img src="/sites/all/themes/servicios/images/descargar-azul.png"> Descargar
			</a>
		</div>
	</div>
<?php else: ?>
	<div class="foto">
		<div class="miniatura">
			<?php if($height > $width): ?>
				<a rel="lightbox[imagen][<?php print $contenido; ?>]" href="<?php print "/" . $fields['field_foto_fid_1']->content; ?>">
					<img src="<?php print '/' . $fields['field_foto_fid_2']->content; ?>" />
				</a>
			<?php else: ?>
				<a rel="lightbox[imagen][<?php print $contenido; ?>]" href="<?php print "/" . $fields['field_foto_fid_1']->content; ?>">
					<img src="<?php print '/' . $fields['field_foto_fid']->content; ?>" />
				</a>
			<?php endif; ?>
		</div>
		<div class="datos">
			<div class="fecha"><?php print date('d-m-Y', $fields['php_1']->content); ?></div>
			<div class="hora"><?php print date('H:i', $fields['php_1']->content); ?></div>
			<div class="descargar">
				<a class="descargar-foto" id="<?php print $fields['php']->content; ?>" href="<?php print '/download/file/fid/' . $fields['php']->content; ?>">
					<img src="/sites/all/themes/servicios/images/descargar-blanco.png">
				</a>
			</div>
		</div>
	</div>
<?php endif; ?>
