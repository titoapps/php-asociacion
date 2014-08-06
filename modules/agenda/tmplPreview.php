<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:26
 */

echo '<div id="agenda">
      <h2>Agenda</h2>';

foreach ($agendaItems as $agendaItem) {

    echo '<div class="evento">';
    echo'<div class="fecha">'.$agendaItem->getValueDecoded("date").'</div>';
    echo'<h3 class="titulo_seccion">'.$agendaItem->getValueDecoded("title").'</h3>';
    echo'<p>'.$agendaItem->getValueDecoded("subtitle").'</p>';
    echo'<p><a href="#" class="ampliar_info">Leer más..</a></p>';
    echo' </div>';

}

echo '</div>';