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
    $headers = "From: alberto.perez.perez.g@gmail.com";
    $subject = $_POST['subject'];
    $body = $_POST['text'];

    echo '<div class="center_container" >
      <h2>Contacto</h2>

      </div>
     ';

    if (mail($to, $subject, $body,$headers)) {

        echo("<p>Ya hemos recibido tu mensaje! Gracias, le atenderemos lo antes posible.</p>");

    } else {

        echo("<p>Vaya..! Algo ha fallado, inténtelo de nuevo en unos minutos/p>");

    }

}