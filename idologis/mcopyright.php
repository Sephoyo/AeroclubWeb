<?php
$copyright = $_POST['copyright']; // A filtrer

 
$fichierouvert = fopen ('copyright.txt', 'w'); // Mode w = fichier écrasé !!!
if (!fwrite($fichierouvert, $copyright)) {
  die("Impossible d'écrire dans le fichier 'copyright.txt'");
}
fclose ($fichierouvert);
$ressource = fopen('copyright.txt', 'rb');
echo fread($ressource, filesize('copyright.txt'));
?>