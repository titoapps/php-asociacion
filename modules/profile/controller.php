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
    //require_once ("config.php");
    //require_once ("functions.php");

    //Si se trata de un archivo valido.
    if (isset ($_FILES['profileImage'])) {

        if ($_FILES['profileImage']['error'] == 0) {

            //Tenemos que confirmar que se trata de uno de los tipos autorizados.
            if (in_array ($_FILES['profileImage']['type'],$configuration->getAllowedMimeTypes())) {

                $fullpath = $configuration->getImagesFolder() . "/" . $_FILES['profileImage']['name'];

                //Entonces podemos realizar la copia.
                if (!move_uploaded_file ($_FILES['profileImage']['tmp_name'],$fullpath)) {

                    echo "There was an error uploading the file.";

                } else {
                    //Store on DDBB
                    updateImage($_POST['idImage'],$_FILES['profileImage'],$configuration->getImagesFolder());

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
        if ($userImage == null) {

            $userImagePath = 'images/members/carnicerialogo.jpg';

        } else {

            //load image from BINARY PATH
            $imageBinary = $userImageBin;
            $userImagePath = $userImage->getValueDecoded('imageBin');

            $configuration = \Configuration\Configuration::sharedInstance();

            $path = $configuration->getImagesFolder() . "/" ."temp.jpeg";

            file_put_contents($path, $imageBinary);

            $userImagePath = $path;

        }

        include_once 'tmpl.php';

    } else {

        Tools::showGenericErrorMessage();

    }

} else  {

    Tools::showGenericErrorMessage();

}

/**
 * Update a new user image
 * @param $idUser
 * @param $imagePath
 */
function updateImage ($idImage,$imageInfo,$path) {

    if ($idImage != null && $path != null) {

        $configuration = \Configuration\Configuration::sharedInstance();

        $ficheroTipo = $imageInfo['type'];
        $allowedMimeTypes = $configuration->getAllowedMimeTypes();
        $imagePath = $path . "/" . $imageInfo['name'];

        switch ($ficheroTipo) {

            case $allowedMimeTypes[0]:
                $img = imagecreatefromjpeg($imagePath);
                break;

            case $allowedMimeTypes[1]:

                $img = imagecreatefromjpeg($imagePath);
                break;

            case $allowedMimeTypes[2]:

                $img = imagecreatefrompng($imagePath);
                break;

            case $allowedMimeTypes[3]:

                $img = imagecreatefromgif($imagePath);
                break;

        }

        $imageSize = getimagesize($imagePath);
        $ancho = $imageSize[0];
        $alto = $imageSize[1];

        //Keep the image size relation
        $proporcionImagen = $ancho / $alto;
        $proporcionImagenMiniatura = $configuration->getImageMaxWidth() / $configuration->getImageMaxHeight();

        $miniaturaAncho = $configuration->getImageMaxWidth();
        $miniaturaAlto = $configuration->getImageMaxHeight();

        if ($proporcionImagen > $proporcionImagenMiniatura) {

            $miniaturaAncho = $configuration->getImageMaxWidth();
            $miniaturaAlto = $configuration->getImageMaxWidth() / $proporcionImagen;

        } else if ($proporcionImagen < $proporcionImagenMiniatura) {

            $miniaturaAncho = $configuration->getImageMaxHeight() * $proporcionImagen;
            $miniaturaAlto = $configuration->getImageMaxHeight();

        } else if ($proporcionImagen < $proporcionImagenMiniatura) {

            $miniaturaAlto = $configuration->getImageMaxHeight();
            $miniaturaAncho = $configuration->getImageMaxWidth();

        }

        $temporal = imagecreatetruecolor($miniaturaAncho, $miniaturaAlto);

        $result = imagecopyresampled($temporal, $img, 0, 0, 0, 0, $miniaturaAncho, $miniaturaAncho, $ancho, $alto);

        $newImagePath = $path . "/newImage.png";

        if ($result) {

            $result = imagejpeg($temporal, $newImagePath, 80);

            if (!$result )
                echo $imagePath. " todo bien";

        }

        $fp=fopen($newImagePath,'rb');
        $size = filesize($newImagePath);

        $imagenBinaria = fread($fp,$size);
//        $imagenBinaria = addslashes(fread($fp,$size));


        // Borra archivos temporales si es que existen
        @unlink($newImagePath);

        Image::updateImage($idImage,$imagenBinaria);

        fclose($fp);

    }

}