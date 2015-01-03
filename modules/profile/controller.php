<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 21/11/14
 * Time: 18:54
 */

require_once 'modules/tools/Tools.php';
require_once 'modules/galery/model.php';

if (isset($_POST['Subir'])) {

    $configuration = \Configuration\Configuration::sharedInstance();

    //If its a valid file
    if (isset ($_FILES['profileImage'])) {

        if ($_FILES['profileImage']['error'] == 0) {

            //Confirm its a valid image type
            if (in_array ($_FILES['profileImage']['type'],$configuration->getAllowedMimeTypes())) {

                $fullpath = $configuration->getImagesFolder() . "/" . $_FILES['profileImage']['name'];

                //We can store a copy
                if (!move_uploaded_file ($_FILES['profileImage']['tmp_name'],$fullpath)) {

                    echo "There was an error uploading the file.";

                } else {
                    //Store on DDBB
                    Tools::updateImage($_POST['idImage'],$_FILES['profileImage'],$configuration->getImagesFolder());

                }

            } else {

                Tools::showMainContentResultMessage("Perfil","Tipo de imagen no soportado");

            }

        } else {

            Tools::showMainContentResultMessage("Perfil","Error al subir la imagen, inténtelo de nuevo");

        }

    } else {

        Tools::showMainContentResultMessage("Perfil","Error al subir la imagen, inténtelo de nuevo");

    }

} else if (isset($_SESSION ['userLoggedID'])) {

    require_once "user/model.php";

    $userData = User::getMemberProfile($_SESSION ['userLoggedID']);

    $userLogged = $userData[0];
    $userImage = $userData[1];
    $userImageBin = $userData[2];

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
        if ($userImageBin == null) {

            $userImagePath = 'images/personaDefectoG.jpg';

        } else {

            $userImagePath = Tools::pathForBinImage($userImage->getValueDecoded('imageName'),$userImageBin);

        }

        include_once 'tmpl.php';

    } else {

        Tools::showGenericErrorMessage();

    }

} else {

    Tools::showGenericErrorMessage();

}
