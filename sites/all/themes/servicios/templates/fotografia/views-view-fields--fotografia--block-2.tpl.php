<?php
if(!empty($fields['field_portada_fid']->content)) {
        list($width, $height) = getimagesize($fields['field_portada_fid']->content);
}
?>

<div id="ultimas-fotografias">
	<div class="ultimas-fotografias">
		<?php if($height > $width): ?>
			<div class="destacado-portada"><a href="/ultimas-fotografias"><?php ?></a></div>
		<?php else: ?>
			<div class="destacado-portada"><a href="/ultimas-fotografias"><?php ?></a></div>
		<?php endif; ?>
		<div class="destacado-titulo"><a href='/ultimas-fotografias'>Últimas fotografías</a></div>
	</div>
</div>
