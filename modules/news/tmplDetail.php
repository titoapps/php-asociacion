<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 22/09/14
 * Time: 20:59
 */

echo '<script type="text/javascript" src="js/newsUtilities.js"></script>';

echo '<div id="newContainer">
        <h3 class="titulo_seccion" id="title_static" title="'.$title.'">'.$title.'</h3>';

echo '<p class="fecha" id="startDate_static" title="'.$dateFormatted.'">'.$dateFormatted.'</p>';



if ($subtitle != null) {

    echo '<p id="subtitle_static" title="'.$subtitle.'" >'.$subtitle.'</p>';


}

echo '<p class="detalle_noticia" id="description_static" title="'.$description.'">'.$description.'</p> ';

echo '<input type="hidden" id="idNew" value = "'.$idNew.'" title="'.$idNew.'">';
echo '<input type="hidden" id="endDate_static" value = "'.$endDateFormatted.'" title="'.$endDateFormatted.'">';

$uri = $_SERVER['REQUEST_URI'];

if (isset($_SESSION ['userLoggedUserType']) && $_SESSION ['userLoggedUserType'] == 2) {

    echo'<p><a href="'.$uri.'&comment=comment" class="ampliar_info">Añadir Comentario</a></p>';

} else if (isset($_SESSION ['userLoggedUserType']) && $_SESSION ['userLoggedUserType'] == 1) {

    /*echo'<p><a href="'.$uri.'&edit=edit" class="ampliar_info" onclick="startEdition()">Editar</a></p>';*/
    echo'<p><a href="#" class="ampliar_info" onclick="startEdition()">Editar</a></p>';

}

echo'</div>';
