<div class="video">
	<div class="video-reproductor">
		<?php if($fields['field_tipo_video_value']->content == "Local"): ?>
			<a id="ipad" href="<?php print $fields['field_video_flv_fid']->content; ?>" style="display: block; width: 646px; height: 488px;">
				<?php
				print theme("imagecache", "video-tapa-reproductor", $fields['field_tapa_fid']->content);
				print '<img class="playbutton" src="/sites/all/themes/servicios/images/playbutton.png">';
				?>
			</a>
			<script type="text/javascript" src="/sites/all/libraries/flowplayer3/example/flowplayer-3.2.6.min.js"></script> 
			<script src="/sites/all/libraries/flowplayer3/flowplayer.ipad-3.2.2.min.js"></script>  
			<script> 
				$f("ipad", "/sites/all/libraries/flowplayer3/flowplayer-3.2.7.swf", {
					clip: {
						autoPlay: true,
						autoBuffering: true
					},
					play: {
						replayLabel: 'Reproducir de nuevo'
					},
					plugins: {
						viral: {
							url: '/sites/all/libraries/flowplayer3/flowplayer.viralvideos-3.2.5.swf',
						}
					}
				}).ipad();
			</script>
		<?php else: ?>
			<object width="646" height="488">
				<param name="movie" value="<?php print $fields['field_video_youtube_url']->content; ?>"</param>
				<param name="allowFullScreen" value="true"></param>
				<param name="allowScriptAccess" value="always"></param>
				<embed src="<?php print $fields['field_video_youtube_url']->content; ?>"
					type="application/x-shockwave-flash"
					allowfullscreen="true"
					allowscriptaccess="always"
					width="646" height="484">
				</embed>
			</object>
		<?php endif; ?>
	</div>
	<div class="descripcion">
		<div class="titulo"><?php print $fields['title']->content; ?></div>
		<div class="contenido"><?php print $fields['body']->content; ?></div>
		<?php if(!empty($fields['field_video_hd_fid']->content)): ?>
			<div class="descargar"><a href="http://videohd.avn.info.ve/download/file/fid/<?php print $fields['php']->content; ?>"><img src="/sites/all/themes/servicios/images/descargar-azul.png"> Descargar</a></div>
		<?php endif; ?>
	</div>
	<div class="clear-float"></div>
</div>
