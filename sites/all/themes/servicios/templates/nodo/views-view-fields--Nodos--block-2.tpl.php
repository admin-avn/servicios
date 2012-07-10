<?php
for($i = 1; $i < 10; $i++) {
        $fields['body']->content = str_replace("[foto$i]", "", $fields['body']->content);
}
?>

<div class="noticia-cuerpo">
	<div class="contenido"><?php print $fields['body']->content; ?></div>
	<div class="firma"><?php print $fields['field_firma_value']->content; ?></div>
	<p></p>
	<div class="copyright">&copy; AVN - <?php print $fields['created_1']->content; ?></div>
</div>
