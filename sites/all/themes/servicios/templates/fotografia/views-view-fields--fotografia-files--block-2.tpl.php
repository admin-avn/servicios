<?php
if(!empty($fields['field_foto_fid']->content)) {
        list($width, $height) = getimagesize($fields['field_foto_fid']->content);
}
?>

<div id="ultimas-fotografias">
	<div class="ultimas-fotografias">
		<?php if($width > $height): ?>
			<div class="destacado-portada"><a href="/ultimas-fotografias"><?php print theme('imagecache', 'fotografia-principal', $fields['field_foto_fid']->content); ?></a></div>
		<?php else: ?>
			<div class="destacado-portada"><a href="/ultimas-fotografias"><?php print theme('imagecache', 'fotografia-principal-vertical', $fields['field_foto_fid']->content); ?></a></div>
		<?php endif; ?>
		<div class="destacado-titulo"><a href='/ultimas-fotografias'>Últimas fotografías</a></div>
	</div>
</div>
