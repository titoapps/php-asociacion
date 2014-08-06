<?php
/**
* Draws the members images on the left side menu
*/
echo '<h3 class="titulo_seccion">'.$title.'</h3>';

echo '<p class="fecha">'.$startDate.'</p>';

if ($subtitle != null) {

    echo '<p>'.$subtitle.'</p>';

}

echo '<p class="detalle_noticia">'.$description.'</p> <p><a href="#" class="ampliar_info">Leer más..</a></p>';
