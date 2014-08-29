<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 19/08/14
 * Time: 20:40
 */

if (isset($_POST['send'])) {

    echo '<div class="center_container" >
        <h2>Contacto</h2>

        </div>';

    if(strtoupper($_REQUEST["captcha"]) == $_SESSION["captcha"]){
        // REMPLAZO EL CAPTCHA USADO POR UN TEXTO LARGO PARA EVITAR QUE SE VUELVA A INTENTAR
        $_SESSION["captcha"] = md5(rand()*time());

        $to = "alberto.perez.perez.g@gmail.com";
        $headers = "From: ".$_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['text'];



        if (mail($to, $subject, $body,$headers)) {

            echo("<p>Ya hemos recibido tu mensaje! Gracias, le atenderemos lo antes posible.</p>");

        } else {

            echo("<p>Vaya..! Algo ha fallado, inténtelo de nuevo en unos minutos/p>");

        }


    } else {

        // REMPLAZO EL CAPTCHA USADO POR UN TEXTO LARGO PARA EVITAR QUE SE VUELVA A INTENTAR
        $_SESSION["captcha"] = md5(rand()*time());

        echo("<p>Vaya..! El captcha no es correcto</p>");

    }


}