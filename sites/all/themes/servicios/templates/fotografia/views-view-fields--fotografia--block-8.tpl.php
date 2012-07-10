<?php $key = $_GET['key']; ?>
<div class="banner-fotografia">
	<span class="titulo"><?php print $key; ?></span>
	<?php if(arg(2) == 'vertical'): ?>
		<div class="icono-cuadriculado">
			<a href="<?php print "/buscar/fotografias?key=" . $key; ?>">
				<img src="/sites/all/themes/servicios/images/vista-cuadricula.png" />
			</a>
		</div>
	<?php else: ?>
		<div class="icono-vertical">
			<a href="<?php print "/buscar/fotografias/vertical?key=" . $key; ?>">
				<img src="/sites/all/themes/servicios/images/vista-vertical.png" />
			</a>
		</div>
	<?php endif; ?>
</div>

<script>
        $(document).ready(function(){
		$('a#download-album').live('click',function() {
			var str = "";
			$('a.descargar-foto').each(function() {
				id = $(this).attr("id");
				str += "/" + id;
			});
                        $.ajax({
                                type: "POST",
                                url: "http://servicios.avn.info.ve/scripts/contador_album.php",
                                data: {fid: str, uid: "<?php print $userId; ?>"}
                        });
                });
        });
</script>
