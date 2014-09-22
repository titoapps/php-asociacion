<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 22/09/14
 * Time: 20:59
 */

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

echo '<p class="detalle_noticia">'.$description.'</p> ';


