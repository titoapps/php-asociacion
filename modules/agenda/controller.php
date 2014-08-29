<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 29/07/14
 * Time: 21:19
 */

require_once 'modules/agenda/model.php';


if(isset($_GET['option'])) {

    echo '<div id="main_content"><h2>Agenda</h2> ';

    $agendaItems = Agenda::getAgendaItems(2);

    if ($agendaItems != null) {

        foreach ($agendaItems as $key => $agendaItem) {

            $title = $agendaItem->getValueDecoded('title');
            $subtitle = $agendaItem->getValueDecoded('subtitle');
            $description = $agendaItem->getValueDecoded('description');
            $startDate = $agendaItem->getValueDecoded("date");

            include_once 'tmpl.php';
        }

    }

    echo '</div>';

} else {

    $agendaItems = Agenda::getAgendaItems(3);

    include_once 'tmplPreview.php';

}
?>
