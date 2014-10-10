<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:37
 */


echo '<div id="empleo">
            <h2>Empleo</h2>';

foreach ($jobOffers as $jobOffer) {

    $date = $jobOffer[0]->getValueDecoded('date');
    $dateFormatted = Utils::formatDateString($date);


    echo '<div class="oferta_empleo" id="oferta_empleo_1">';
    echo '<h3 class="titulo_seccion" id="puesto_oferta1">'.$jobOffer[0]->getValueDecoded("title").'</h3>';
    echo '<div class="fecha">Publicada el: '. $dateFormatted.'</div>';
    echo '<p><span class="nombre_comercio_oferta">'. $jobOffer[1]->getValueDecoded('name').'</span>
                    <span class="descripcion_oferta">'. $jobOffer[0]->getValueDecoded('description').'</span>
                    </p>
                    <p><a href="#" class="ampliar_info" title="Ir a detalle de oferta" id="enlace_detalle_oferta_1">Ver oferta..</a></p>
                </div>';

}

echo '</div>';