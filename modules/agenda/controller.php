<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 29/07/14
 * Time: 21:19
 */

require_once 'modules/agenda/model.php';
require_once "librerias/Utils.php";

if(isset($_GET['option'])) {

    echo '<div id="main_content">';

    if (isset($_GET['idAgenda'])) {

        echo '<h2>';Tools::showBackButton(1);echo 'Agenda</h2> ';

        $idAgenda = $_GET['idAgenda'];
        $agendaItem = Agenda::getAgendaFromId($idAgenda);

        $idAgenda = $agendaItem->getValueDecoded('idAgenda');
        $title = $agendaItem->getValueDecoded('title');
        $subtitle = $agendaItem->getValueDecoded('subtitle');
        $description = $agendaItem->getValueDecoded('description');
        $startDate = $agendaItem->getValueDecoded("date");
        $startDate = Utils::formatDateString($startDate);

        include_once 'tmpl.php';

    } else {

        echo '<h2>Agenda</h2> ';

        $agendaItems = Agenda::getAgendaItems();

        if ($agendaItems != null) {

            foreach ($agendaItems as $key => $agendaItem) {

                $idAgenda = $agendaItem->getValueDecoded('idAgenda');
                $title = $agendaItem->getValueDecoded('title');
                $subtitle = $agendaItem->getValueDecoded('subtitle');
                $description = $agendaItem->getValueDecoded('description');
                $startDate = $agendaItem->getValueDecoded("date");
                $startDate = Utils::formatDateString($startDate);

                include_once 'tmplPreview.php';

            }

        }

    }

    echo '</div>';

} else {

    echo '<div id="agenda">
      <h2>Agenda</h2>';

    $agendaItems = Agenda::getAgendaItems(3);

    include_once 'tmplPreview.php';

    echo '</div>';
}
?>
