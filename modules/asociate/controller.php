<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:50
 */

if(isset($_POST['send'])) {

    include_once 'asociateForm.php';

} else {

    require_once 'search/Activities.class.php';
    require_once "members/model.php";

    $allActivities = Activities::getActivities();
    $allStreets = Street::getStreets();

    include_once 'tmpl.php';

}

/**
 * Process the user registration form
 * @param $values
 */
function processForm( $values ) {

    $to = "alberto.perez.perez@hotmail.com";
    $headers = "From: ".$_POST['email'];
    $headers = "From: alberto.perez.perez.g@gmail.com";
    $subject = "Asociacion de Comerciantes de Alonso y Floranes";
    $body = $_POST['text'];

//    echo '<div class="center_container" >
//      <h2>';Tools::showBackButton(1);echo 'Adhesion a la asociación</h2>
//
//      </div>
//     ';
//
//    if (mail($to, $subject, $body,$headers)) {
//
//        echo("<p>Ya hemos recibido tu mensaje! Gracias, le atenderemos lo antes posible.</p>");
//
//    } else {
//
//        echo("<p>Vaya..! Algo ha fallado, inténtelo de nuevo en unos minutos</p>");
//
//    }

}