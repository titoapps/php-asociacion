<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 19/08/14
 * Time: 20:40
 */

if (isset($_POST['send'])) {

    $to = "alberto.perez.perez@hotmail.com";
    $headers = "From: ".$_POST['email'];
    $subject = "Asociacion de Comerciantes de Alonso y Floranes";
    $body = "informacion de asociacion de...";

    echo '<div class="center_container" >
      <h2>';Tools::showBackButton(2);echo 'Adhesion a la asociación</h2>

      </div>
     ';

    if (mail($to, $subject, $body,$headers)) {

        echo("<p>Ya hemos recibido tu mensaje! Gracias, le atenderemos lo antes posible.</p>");

    } else {

        echo("<p>Vaya..! Algo ha fallado, inténtelo de nuevo en unos minutos</p>");

    }

}
