<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:37
 */

require_once "librerias/Utils.php";

echo '<div id="main_content">
            <h2>Empleo</h2>';


$date = $jobOfferItem[0]->getValueDecoded('date');
$dateFormatted = Utils::formatDateString($date);

echo '<div class="oferta_empleo" id="oferta_empleo_1">';
echo '<h3 class="titulo_seccion" id="puesto_oferta1">'.$jobOfferItem[0]->getValueDecoded("title").'</h3>';
echo '<div class="fecha">Publicada el: '. $dateFormatted.'</div>';

echo '<h4 class="title">Datos de contacto</h4>';
echo '<span class="listItem">Nombre Comercio : </span>'. $jobOfferItem[1]->getValueDecoded('name'). ' '. $jobOfferItem[0]->getValueDecoded('description') ;
echo '<br><span class="listItem">Telefono : </span>'. $jobOfferItem[1]->getValueDecoded('phoneNumber');
echo '<br><span class="listItem">Email : </span>'. $jobOfferItem[1]->getValueDecoded('email');

echo '<br><span class="listItem">Rango Salarial: </span>De '. $jobOfferItem[0]->getValueDecoded('salaryMin').' € hasta '. $jobOfferItem[0]->getValueDecoded('salaryMax').' €';

echo '</div>';