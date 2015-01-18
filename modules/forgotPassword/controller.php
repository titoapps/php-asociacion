<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 18/1/15
 * Time: 20:00
 */

require_once 'modules/user/model.php';

if (isset($_POST['forgetPass'])){

    if(isset($_POST['nickName'])) {

        $nickName = $_POST['nickName'];
        $user = User::getByNickName($nickName);

        if ($user == null) {
            //error nick no encontrado
            $message = "El nick indicado no está registrado";

        } else {


        }

    } else if(isset($_POST['email'])) {

        $email = $_POST['email'];
        $user = User::getByEmailAddress($email);

        if ($user == null) {

            $message = "El email indicado no está registrado";
            //error, email no registrado
            include 'tmpl.php';

        } else {


        }

    } else {

        //Rellenar uno u otro
        $message = "Rellene el nick o la email con el que se registró para recuperar su contraseña";

        include 'tmpl.php';

    }



} else {

    include 'tmpl.php';

}

/**
 * Sends an aleatory new password to the user
 */
function sendPasswordEmail ($user) {

    $to = $user->getValueDecoded('email');
    $headers = "From: alberto.perez.perez.g@gmail.com";
    $subject = "Asociacion de Comerciantes de Alonso y Floranes";
    //TODO:GENERATE RANDOM PASSWORD
    $body = "Tu nueva contraseña es ".$newPassword."";

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