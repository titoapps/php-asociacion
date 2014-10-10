<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:27
 */

echo '<div class="evento">';

echo'<h3 class="titulo_seccion">'.$title.'</h3>';
echo '<div class="fecha">'.$startDate.'</div>';

if ($subtitle != null) {

    echo '<p>'.$subtitle.'</p>';

}

if ($description != null) {

    echo '<p class="detalle_noticia">'.$description.'</p>';

}


echo '</div>';