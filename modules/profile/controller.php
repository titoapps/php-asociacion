<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 21/11/14
 * Time: 18:54
 */

require_once 'modules/tools/Tools.php';

if (isset($_SESSION ['userLoggedID'])) {

    require_once "user/model.php";

    $userData = User::getMemberProfile($_SESSION ['userLoggedID']);

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

            $userImagePath = 'images/members/carnicerialogo.jpg';

        } else {

            $userImagePath = $userImage->getValueDecoded('path');

        }

        include_once 'tmpl.php';

    } else {

        Tools::showGenericErrorMessage();

    }

} else  {

    Tools::showGenericErrorMessage();

}
