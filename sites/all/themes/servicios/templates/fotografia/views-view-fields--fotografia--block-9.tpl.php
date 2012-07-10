<?php
if(!empty($fields['field_portada_fid_2']->content)) {
	list($width, $height) = getimagesize($fields['field_portada_fid_2']->content);
} else {
	list($width, $height) = getimagesize($fields['field_foto_fid']->content);
}
?>
<div id="destacados">
	<div class="destacados">
		<div class="destacados-portada">
			<?php if(!empty($fields['field_portada_fid_2']->content)): ?>
				<?php if($height > $width): ?>
					<a href="<?php print "foto/" . $fields['nid']->content; ?>">
						<img src="<?php print $fields['field_portada_fid_1']->content; ?>">
					</a>
				<?php else: ?>
					<a href="<?php print "foto/" . $fields['nid']->content; ?>">
						<img src="<?php print $fields['field_portada_fid']->content; ?>">
					</a>
				<?php endif; ?>
			<?php else: ?>
				<?php if($height > $width): ?>
					<a href="<?php print "foto/" . $fields['nid']->content; ?>">
						<?php print theme('imagecache', 'fotografia-destacados-vertical', $fields['field_foto_fid']->content); ?>
					</a>
				<?php else: ?>
					<a href="<?php print "foto/" . $fields['nid']->content; ?>">
						<?php print theme('imagecache', 'fotografia-destacados', $fields['field_foto_fid']->content); ?>
					</a>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="destacados-taxonomia"><?php print $fields['name']->content; ?></div>
		<div class="destacados-titulo"><?php print $fields['title']->content; ?></div>
		<div class="destacados-fecha">Fecha: <?php print $fields['created']->content; ?></div>
	</div>
</div>
