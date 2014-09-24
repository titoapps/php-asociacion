<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 22/09/14
 * Time: 20:59
 */


echo '<h3 class="titulo_seccion">'.$title.'</h3>';

echo '<p class="fecha">'.$startDate.'</p>';

if ($subtitle != null) {

    echo '<p>'.$subtitle.'</p>';

}

$title = $new->getValueDecoded('title');
$idNew = $new->getValueDecoded('idNew');

echo '<p class="detalle_noticia">'.$description.'</p> ';

$uri = $_SERVER['REQUEST_URI'];

if (isset($_SESSION ['userLoggedUserType']) && $_SESSION ['userLoggedUserType'] == 2) {

    echo'<p><a href="'.$uri.'&comment=comment" class="ampliar_info">Añadir Comentario</a></p>';

} else if (isset($_SESSION ['userLoggedUserType']) && $_SESSION ['userLoggedUserType'] == 1) {

    echo'<p><a href="'.$uri.'&edit=edit" class="ampliar_info">Editar</a></p>';

}


