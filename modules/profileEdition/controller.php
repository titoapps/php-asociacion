<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 30/11/14
 * Time: 20:43
 */

require_once 'modules/tools/Tools.php';
require_once "user/model.php";

echo '<div id="main_content">
          <h2>Mi Perfil</h2>';

if (isset($_SESSION ['userLoggedID'])
    && isset($_POST['idUser'])
    && isset($_SESSION ['userLoggedID']) == isset($_POST['idUser'])) {

    $userData = User::getMemberProfile($_POST['idUser']);

    $userLogged = $userData[0];
    $userImage = $userData[1];

    if ($userLogged != null) {

        $idUser = $userLogged->getValueDecoded('idUser');
        $nickName = $userLogged->getValueDecoded('nickName');
        $name = $userLogged->getValueDecoded('name');
        $surname = $userLogged->getValueDecoded('surname');
        $phoneNumber = $userLogged->getValueDecoded('phoneNumber');
        $email = $userLogged->getValueDecoded('email');
        $age = $userLogged->getValueDecoded('age');
        $streetName = $userLogged->getValueDecoded('streetName');
        $postalCode = $userLogged->getValueDecoded('postalCode');
        $number = $userLogged->getValueDecoded('number');
        $floor = $userLogged->getValueDecoded('floor');
        $door = $userLogged->getValueDecoded('door');

        //if user image is not set, we have to choose a default image
        if ($userImage == null) {

            $userImagePath = 'images/personaDefectoG.jpg';

        } else {

            $userImagePath = $userImage->getValueDecoded('path');

        }

        include_once 'tmpl.php';

    } else {

        Tools::showGenericErrorMessage();

    }

} else {

    Tools::showGenericErrorMessage();
}


/**
 * Process the user profile update form
 * @param $values
 */
function processForm( $values ) {

    $name = mysql_real_escape_string(strip_tags($values['name']));
    $surname = mysql_real_escape_string(strip_tags($values['surname']));
    $phoneNumber = mysql_real_escape_string(strip_tags($values['phoneNumber']));
    $age = mysql_real_escape_string(strip_tags($values['age']));
    $age = $age + 17;//we have to correct to obtain the original value
    $streetName = mysql_real_escape_string(strip_tags($values['streetName']));
    $number = mysql_real_escape_string(strip_tags($values['number']));
    $floor = mysql_real_escape_string(strip_tags($values['floor']));
    $door = mysql_real_escape_string(strip_tags($values['door']));
    $postalCode = mysql_real_escape_string(strip_tags($values['postalCode']));
    $idUser = mysql_real_escape_string(strip_tags($values['idUser']));

//TODO:FALTA SUBIR IMAGEN!!

    $userProfile = array(

        "name" => utf8_decode($name),
        "surname" => utf8_decode($surname),
        "phoneNumber" => utf8_decode($phoneNumber),
        "age" => utf8_decode($age),
        "streetName" => utf8_decode($streetName),
        "number" => utf8_decode($number),
        "floor" => utf8_decode($floor),
        "door" => utf8_decode($door),
        "postalCode" => utf8_decode($postalCode),
        "idUser" => utf8_decode($idUser),

    );

    $error = User::updateUserProfile($userProfile);

    if ($error == null) {

        Tools::showMainContentResultMessage(null,'Tu perfil ha sido actualizado');

    } else {

        Tools::showGenericErrorMessage();

    }

}

echo '</div>';