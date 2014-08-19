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
    $subject = $_POST['subject'];
    $body = $_POST['text'];

    if (mail($to, $subject, $body,$headers)) {

        echo("<p>Email successfully sent!</p>");

    } else {

        echo("<p>Email delivery failed…</p>");

    }


    http_redirect('index.php?option=contact');

}