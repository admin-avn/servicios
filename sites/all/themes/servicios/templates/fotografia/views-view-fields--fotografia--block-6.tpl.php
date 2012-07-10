<?php
$nid = arg(1);
$file = $nid . ".zip";
$file = str_replace(" ", "\ ", $file);
$file = str_replace("(", "\(", $file);
$file = str_replace(")", "\)", $file);
$path_to_file = '/var/www/servicios/sites/default/files/servicios/' . $file;

$md5_fotos = md5($fields['field_foto_fid']->content);
$md5_file = $nid . ".txt";
$md5_filepath = '/var/www/servicios/sites/default/files/servicios/'. $md5_file;
`echo $md5_fotos > $md5_filepath`;

$item = explode("sites", $fields['field_foto_fid']->content);
if(!file_exists($path_to_file)) {
	for($i = 1; $i < sizeof($item); $i++) {
		$item[$i] = "/var/www/servicios/sites" . $item[$i];
		if(file_exists($item[$i])) {
			`zip -j -0 $path_to_file $item[$i]`;
		}
	}
	`zip -z $path_to_file < $md5_filepath`;
} else {
	$md5_from_zip = trim(`unzip -l $path_to_file | grep '^[0-9a-f]'`);
	if($md5_from_zip != $md5_fotos) {
		`rm $path_to_file`;
	        for($i = 1; $i < sizeof($item); $i++) {
	                $item[$i] = "/var/www/servicios/sites" . $item[$i];
			if(file_exists($item[$i])) {
				`zip -j -0 $path_to_file $item[$i]`;
			}   
		}   
	        `zip -z $path_to_file < $md5_filepath`;
	}
}

$url_to_file = '/sites/default/files/servicios/' . $file;
global $user;
$userId = $user->uid;
?>

<?php if(arg(0) == 'foto' && is_numeric(arg(1))): ?>
	<div class="banner-fotografia">
		<div style="display: none"><?php print $md5_from_zip; ?></div>
		<span class="termino"><?php print $fields['tid']->content; ?></span>
		<span class="titulo"><?php print $fields['title']->content; ?></span>
		<div class="descargar-album">
		<a id="download-album" href="<?php print $url_to_file; ?>">Descargar &aacute;lbum</a>
		</div>
		<?php if(arg(2) == 'vertical'): ?>
			<div class="icono-cuadriculado">
				<a href="<?php print "/foto/" . $fields['nid']->content; ?>">
					<img src="/sites/all/themes/servicios/images/vista-cuadricula.png" />
				</a>
			</div>
		<?php else: ?>
			<div class="icono-vertical">
				<a href="<?php print "/foto/" . $fields['nid']->content . "/vertical"; ?>">
					<img src="/sites/all/themes/servicios/images/vista-vertical.png" />
				</a>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>

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
