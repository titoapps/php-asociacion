<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 30/11/14
 * Time: 18:23
 */

/**
 * Checks if the user nick name already exists
 *
 * @param $nickName the user nickName
 * @return bool returns if the user nickName already exists
 */
function checkNick ($nickName) {

    require_once 'modules/user/model.php';

    $user = User::getByNickName($nickName);

    if ($user == null)

        return true;

    else

        return false;

}

/**
 * Checks if the user email already exists
 *
 * @param $email the user email
 * @return bool returns if the user email already exists
 */
function checkEmail ($email) {

    require_once 'modules/user/model.php';

    $user = User::getByEmailAddress($email);

    if ($user == null)

        return true;

    else

        return false;

}
/**
 * Checks if the user DNI is already registered
 *
 * @param $dni user dni
 * @return bool returns if the user $dni is already registered
 */
function checkDNIExists ($dni) {

    require_once 'modules/user/model.php';

    $user = User::getByDNI($dni);

    if ($user == null) {

        //TODO:check DNI with algorithm
        return true;


    } else

        return false;

}

/**
 * Checks if the user DNI format is correct or not
 *
 * @param $dni user dni
 * @return bool returns if the user $dni and its correct or not
 */
function checkValidDNI ($dni) {

//    $letra = substr($dni, -1);
//    $numeros = substr($dni, 0, -1);
//
//    if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
//
//        return true;
//
//    }else{
//
//        return false;
//
//    }

    if (strlen($dni) != 9 ||
        preg_match('/^[XYZ]?([0-9]{7,8})([A-Z])$/i', $dni, $matches) !== 1) {
        return false;
    }

    $map = 'TRWAGMYFPDXBNJZSQVHLCKE';

    list(, $number, $letter) = $matches;

    return strtoupper($letter) === $map[((int) $number) % 23];

}

class Tools {

    /**
     * Shows the back button linked to an url
     * @param int $link The link
     */
    static function showBackButtonToLink ($link) {

        if ($link == null) {

            echo '<div class="backLink">
                    <a href="javascript:history.back(1)" ><img src="images/volver.png" alt="imagen volver" name="volver"></a>
                </div>';

        } else  {

            echo '<div class="backLink">
                    <a href='.$link.' ><img src="images/volver.png" alt="imagen volver" name="volver"></a>
                </div>';
        }

    }

    /**
     * Shows the back button
     * @param int $back The back link counter. Default 1.
     */
    static function showBackButton ($back = 1) {

        if ($back >= 1) {

            echo '<div class="backLink">
                    <a href="javascript:history.back(' . $back . ')" ><img src="images/volver.png" alt="imagen volver" name="volver"></a>
                </div>';

        }

    }

    /**
     * Shows a section title and message on the web main content.
     * @param string $title title text
     * @param string $message message text
     * @param int $back The back link counter. Default 0.
     */
    static function showMainContentResultMessage($title,$message,$back = 0) {

        echo '<div id="main_content">';

        if($title != null)

            echo '<h2>'.$title.'</h2>';

        if($message != null)

            echo'<p>'.$message.'</p>';

        if ($back > 0)

            Tools::showBackButton($back);

        echo'</div>';

    }

    /**
     * Shows a generic error message on the web main content.
     */
    static function showGenericErrorMessage() {

        echo '<div id="main_content">';

            echo '<h2>Vaya! Esto no deberia pasar</h2>';

            echo'<p>Se ha producido un error inesperado, disculpe las molestias.</p>';

        echo'</div>';

    }



    /**
     * Inserts a galery image with the info provided
     *
     * @param $imageInfo the image full info to set
     * @param $path the temporal path of the new image
     * @return the insertion result
     */
    static function insertGaleryImage ($imageInfo,$path) {

        if ($path != null && $imageInfo != null) {

            $configuration = \Configuration\Configuration::sharedInstance();

            $ficheroTipo = $imageInfo['type'];
            $allowedMimeTypes = $configuration->getAllowedMimeTypes();
            $allowedFileTypes = $configuration->getAllowedFileTypes();

            $imagePath = $path . "/" . $imageInfo['name'];

            switch ($ficheroTipo) {

                case $allowedMimeTypes[0]:
                    $img = imagecreatefromjpeg($imagePath);
                    $fileExtension = $allowedFileTypes[0];

                    break;

                case $allowedMimeTypes[1]:

                    $img = imagecreatefromjpeg($imagePath);
                    $fileExtension = $allowedFileTypes[1];
                    break;

                case $allowedMimeTypes[2]:

                    $img = imagecreatefrompng($imagePath);
                    $fileExtension = $allowedFileTypes[2];

                    break;

                case $allowedMimeTypes[3]:

                    $img = imagecreatefromgif($imagePath);
                    $fileExtension = $allowedFileTypes[3];
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

            }

            $fp= fopen($newImagePath,'rb');
            $size = filesize($newImagePath);

            $imagenBinaria = fread($fp,$size);

            // Borra archivos temporales si es que existen
            @unlink($newImagePath);

            Image::insertGaleryImage($imagenBinaria,$imageInfo['name'],$fileExtension);

            fclose($fp);

            return $result;

        }

    }

    /**
     * Update an image with the info provided
     *
     * @param $idImage the id of the image to update
     * @param $imageInfo the image full info to set
     * @param $path the temporal path of the new image
     * @return the insertion result
     */
    static function updateImage ($idImage,$imageInfo,$path) {

        if ($idImage != null && $path != null) {

            $configuration = \Configuration\Configuration::sharedInstance();

            $ficheroTipo = $imageInfo['type'];
            $allowedMimeTypes = $configuration->getAllowedMimeTypes();
            $allowedFileTypes = $configuration->getAllowedFileTypes();

            $imagePath = $path . "/" . $imageInfo['name'];

            switch ($ficheroTipo) {

                case $allowedMimeTypes[0]:
                    $img = imagecreatefromjpeg($imagePath);
                    $fileExtension = $allowedFileTypes[0];

                    break;

                case $allowedMimeTypes[1]:

                    $img = imagecreatefromjpeg($imagePath);
                    $fileExtension = $allowedFileTypes[1];
                    break;

                case $allowedMimeTypes[2]:

                    $img = imagecreatefrompng($imagePath);
                    $fileExtension = $allowedFileTypes[2];
                    break;

                case $allowedMimeTypes[3]:

                    $img = imagecreatefromgif($imagePath);
                    $fileExtension = $allowedFileTypes[3];
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

            }

            $fp= fopen($newImagePath,'rb');
            $size = filesize($newImagePath);

            $imagenBinaria = fread($fp,$size);

            // Borra archivos temporales si es que existen
            @unlink($newImagePath);

            Image::updateImage($idImage,$imagenBinaria,$fileExtension);

            fclose($fp);

            return $result;

        }

    }


    /**
     * Loads an image binary,stores on a tmp folder and returns the path to show it.
     * @param $imageBin the image binary
     * @param $type the image type
     * @return the image path
     */
    static function pathForBinImage ($name,$imageBin,$type) {

        $configuration = \Configuration\Configuration::sharedInstance();

        $path = $configuration->getImagesFolder() . "/" . $name .'.'.$type;

        file_put_contents($path, $imageBin);

        return $path;

    }

    /**
     * Loads a galery image binary,stores on a tmp folder and returns the path to show it.
     * @param $imageBin the image binary
     * @param $type the image type
     * @return the image path
     */
    static function pathForGaleryBinImage ($name,$imageBin,$type) {

        $configuration = \Configuration\Configuration::sharedInstance();

        $path = $configuration->getGaleryImagesFolder() . "/" . $name.'.'.$type;

        file_put_contents($path, $imageBin);

        return $path;

    }

}