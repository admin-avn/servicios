<?php
global $user;
$userId = $user->uid;
?>

<?php if (!empty($title)): ?>
	<h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
	<div class="<?php print $classes[$id]; ?>">
		<?php print $row; ?>
	</div>
<?php endforeach; ?>

<script>
	$(document).ready(function(){
		$('a.descargar-foto').live('click',function() {
			var id = $(this).attr("id");
			$.ajax({
				type: "POST",
				url: "http://servicios.avn.info.ve/scripts/contador.php",
				data: {fid: id, uid: "<?php print $userId; ?>"}
			});
		});
	});
</script>
