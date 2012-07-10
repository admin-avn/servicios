<?php
    $fotos_url = $_GET['fotos_url'];
    $url = explode(".jpg", $fotos_url);
    for($i = 1; $i < sizeof($url); $i++):
      $url_absoluto[$i] = '/var/www/servicios/sites/default/files/' . $url[$i] . '.jpg';
    endfor;
    $hash = "123";


    require_once("zip.inc");
    $zip = new zipfile();
    $files_to_zip = $url_absoluto;

    foreach ($files_to_zip as $filename) {
      $zip->addFile(file_get_contents(file_create_path($filename)), $filename); // the second parameter specifies the filename in the zip
    }

    if (!file_save_data($zip->file(), file_create_path('test.zip'))) {
      drupal_set_message(t('The zip could not be created.'), 'error');
    }
?>
