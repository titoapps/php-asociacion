<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:26
 */


foreach ($agendaItems as $agendaItem) {

    $date = $agendaItem->getValueDecoded("date");

    $startDate = Utils::formatDateString($date);

    echo '<div class="evento">';
    echo'<h3 class="titulo_seccion">'.$agendaItem->getValueDecoded("title").'</h3>';
    echo'<div class="fecha">'.$startDate.'</div>';
    echo'<p>'.$agendaItem->getValueDecoded("subtitle").'</p>';
    echo'<p><a href="index.php?option=agenda&idAgenda='.$agendaItem->getValueDecoded("idAgenda").'" class="ampliar_info">Leer más..</a></p>';
    echo' </div>';

}

