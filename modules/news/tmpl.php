<?php
/**
* Draws the members images on the left side menu
*/

echo '<h3 class="titulo_seccion">'.$title.'</h3>';

echo '<p class="fecha">'.$startDate.'</p>';

if ($subtitle != null) {

    echo '<p>'.$subtitle.'</p>';

}

$title = $new->getValueDecoded('title');
$idNew = $new->getValueDecoded('idNew');

echo '<p class="detalle_noticia">'.$subtitle.'</p> <p><a href="index.php?option=news&idNew='.$idNew.'" class="ampliar_info">Leer más..</a></p>';
