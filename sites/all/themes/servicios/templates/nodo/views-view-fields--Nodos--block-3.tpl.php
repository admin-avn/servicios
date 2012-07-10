<?php if(!empty($fields['field_imagen_fid']->content)): ?>
	<div class="noticia-imagen">
		<div class="imagen"><?php print $fields['field_imagen_fid']->content; ?></div>
		<div class="datos">Autor:
			<span class="titulo"><?php print $fields['field_imagen_data']->content; ?></span>
			<span class="descarga">
				<a href="<?php print '/download/file/fid/'.$fields['php']->content; ?>">
					<img src="/sites/all/themes/servicios/images/descargar.png">
				</a>
			</span>
		</div>
	</div>
<?php endif; ?>
