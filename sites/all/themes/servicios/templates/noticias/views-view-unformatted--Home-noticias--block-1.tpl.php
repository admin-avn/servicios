<?php if (!empty($title)): ?>
	<h3><?php print $title; ?></h3>
<?php endif; ?>
<table class="contenedor-noticias"> 
	<?php foreach ($rows as $id => $row): ?>
		<tr class="noticia">
			<?php print $row; ?>
		</tr>
	<?php endforeach; ?>
</table>
<div class="titulo-home-noticias">ULTIMAS NOTICIAS</div>
