<?php
if(!empty($fields['field_portada_fid']->content)) {
        list($width, $height) = getimagesize($fields['field_portada_fid']->content);
} elseif(!empty($fields['field_foto_fid']->content)) {
        list($width, $height) = getimagesize($fields['field_foto_fid']->content);
}
?>

<div id="principal">
	<div class="principal">
		<?php if(!empty($fields['field_portada_fid']->content)): ?>
			<?php if($width > $height): ?>
				<div class="principal-portada"><a href="/foto/<?php print $fields['nid']->content; ?>"><?php print theme('imagecache', 'fotografia-principal', $fields['field_portada_fid']->content); ?></a></div>
			<?php else: ?>
				<div class="principal-portada"><a href="/foto/<?php print $fields['nid']->content; ?>"><?php print theme('imagecache', 'fotografia-principal-vertical', $fields['field_portada_fid']->content); ?></a></div>
			<?php endif; ?>
		<?php elseif(!empty($fields['field_foto_fid']->content)): ?>
			<?php if($width > $height): ?>
				<div class="principal-portada"><a href="/foto/<?php print $fields['nid']->content; ?>"><?php print theme('imagecache', 'fotografia-principal', $fields['field_foto_fid']->content); ?></a></div>
			<?php else: ?>
				<div class="principal-portada"><a href="/foto/<?php print $fields['nid']->content; ?>"><?php print theme('imagecache', 'fotografia-principal-vertical', $fields['field_foto_fid']->content); ?></a></div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="principal-titulo"><a href="/foto/<?php print $fields['nid']->content; ?>"><?php print $fields['title']->content; ?></a></div>
	</div>
</div>
