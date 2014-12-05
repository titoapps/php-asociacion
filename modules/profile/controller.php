<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 21/11/14
 * Time: 18:54
 */

require_once 'modules/tools/Tools.php';

if (isset($_POST['submitImage'])) {

    $configuration = \Configuration\Configuration::sharedInstance();
    //require_once ("config.php");
    //require_once ("functions.php");

    //TODO:The image is not uploading
    //Si se trata de un archivo valido.
    if (isset ($_FILES['profileImage'])) {

        if ($_FILES['profileImage']['error'] == 0) {

            //Tenemos que confirmar que se trata de uno de los tipos autorizados.
            if (in_array ($_FILES['profileImage']['type'],$configuration->getAllowedMimeTypes())) {

                //Entonces podemos realizar la copia.
                if (!move_uploaded_file ($_FILES['profileImage']['tmp_name'], $configuration->getImagesFolder() . "/" . $_FILES['profileImage']['name'])) {

                    echo "There was an error uploading the file.";

                } else {
                    //Store on DDBB
                    echo "Done";
                }

            } else {

                echo "Not allowed mime type";

            }

        } else {

            echo "There is an error with the file.";

        }

    } else {

        echo "File not found.";

    }

} else if (isset($_SESSION ['userLoggedID'])) {

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
