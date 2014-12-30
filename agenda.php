<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 29/07/14
 * Time: 21:19
 */

$agendaItems = Agenda::getAgendaItems(-1);

echo '<h2>Agenda</h2> ';

if ($agendaItems !=null) {

    foreach ($agendaItems as $key => $agendaItem) {

        $title = $agendaItem->getValueDecoded('title');
        $subtitle = $agendaItem->getValueDecoded('subtitle');
        $description = $agendaItem->getValueDecoded('description');
        $startDate = $agendaItem->getValueDecoded("date");

        echo '<div class="evento">';

        echo'<h3 class="titulo_seccion">'.$title.'</h3>';
        echo '<div class="fecha">'.$startDate.'</div>';

        if ($subtitle != null) {

            echo '<p>'.$subtitle.'</p>';

        }

        if ($description != null) {

            echo '<p>'.$description.'</p>';

        }
        echo '<p class="detalle_noticia">'.$description.'</p>';

        echo '</div>';

    }

}


?>
