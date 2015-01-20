<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 18/1/15
 * Time: 20:00
 */

require_once 'modules/user/model.php';

if (isset($_POST['forgetPass'])){

    if(isset($_POST['nickName']) && ($_POST['nickName'] != null)) {

        $nickName = $_POST['nickName'];
        $user = User::getByNickName($nickName);

        if ($user == null) {

            $message = "El nick indicado no está registrado";

            Tools::showMainContentResultMessage("¿Olvidó su contraseña?",$message,1);

        } else {

            sendPasswordEmail($user);

        }

    } else if(isset($_POST['email']) && ($_POST['email'] != null)) {

        $email = $_POST['email'];
        $user = User::getByEmailAddress($email);

        if ($user == null) {

            $message = "El email indicado no está registrado";

            Tools::showMainContentResultMessage("¿Olvidó su contraseña?",$message,1);

        } else {

            sendPasswordEmail($user);

        }

    } else {

        $message = "Rellene el nick o la email con el que se registró para recuperar su contraseña";

        Tools::showMainContentResultMessage("¿Olvidó su contraseña?",$message,1);

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

    $newPassword = Tools::generateRandomString();
    $body = "Tu nueva contraseña es ".$newPassword."";

    echo '<div class="center_container" >
            <h2>';Tools::showBackButton(2);echo '¿Olvidó su contraseña?</h2>
          </div>';

    if (mail($to, $subject, $body,$headers)) {

        echo("<p>Le hemos enviado la nueva clave a su email. Puede utilizarla ya para acceder a la web.</p>");
        User::updateUserPassword($user->getValueDecoded('idUser'),$newPassword);

    } else {

        echo("<p>Vaya..! Algo ha fallado, inténtelo de nuevo en unos minutos</p>");

    }


}
