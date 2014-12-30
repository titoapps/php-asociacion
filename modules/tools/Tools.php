<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 30/11/14
 * Time: 18:23
 */

require_once 'modules/user/model.php';

class Tools {

    /**
     * Checks if the user nick name already exists
     *
     * @param $nickName the user nickName
     * @return bool returns if the user nickName already exists
     */
    static function checkNick ($nickName) {

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
    static function checkEmail ($email) {

        $user = User::getByEmailAddress($email);

        if ($user == null)

            return true;

        else

            return false;

    }

    /**
     * Checks if the user DNI
     *
     * @param $dni user dni
     * @return bool returns if the user $dni already exists and its correct or not
     */
    static function checkDNI ($dni) {

        $user = User::getByDNI($dni);

        if ($user == null) {

            //TODO:check DNI with algorithm
            return true;


        } else

            return false;

    }

    /**
     * Shows a section title and message on the web main content.
     * @param $title The title text
     * @param $message The message text
     */
    static function showMainContentResultMessage($title,$message) {

        echo '<div id="main_content">';

        if($title!=null)

            echo '<h2>'.$title.'</h2>';

        if($message!=null)

            echo'<p>'.$message.'</p>';

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
     * Insert an image with the info provided
     *
     * @param $idImage the id of the image to update
     * @param $imageInfo the image full info to set
     * @param $imagePath the temporal path of the new image
     */
    static function insertImage ($path) {

        if ($path != null) {



            $configuration = \Configuration\Configuration::sharedInstance();

//            $ficheroTipo = $imageInfo['type'];
//            $allowedMimeTypes = $configuration->getAllowedMimeTypes();
//            $allowedFileTypes = $configuration->getAllowedFileTypes();




        }

    }

    /**
     * Update an image with the info provided
     *
     * @param $idImage the id of the image to update
     * @param $imageInfo the image full info to set
     * @param $imagePath the temporal path of the new image
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
                    echo $imagePath. "Error al subir la imagen, inténtelo de nuevo mas tarde";

            }

            $fp= fopen($newImagePath,'rb');
            $size = filesize($newImagePath);

            $imagenBinaria = fread($fp,$size);
//        $imagenBinaria = addslashes(fread($fp,$size));


            // Borra archivos temporales si es que existen
            @unlink($newImagePath);

            Image::updateImage($idImage,$imagenBinaria);

            fclose($fp);

        }

    }

    /**
     * Loads an image binary,stores on a tmp folder and returns the path to show it.
     * @param $imageBin
     * @return the image path
     */
    static function pathForBinImage ($name,$imageBin) {

        $configuration = \Configuration\Configuration::sharedInstance();

        $path = $configuration->getImagesFolder() . "/" . $name;

        file_put_contents($path, $imageBin);

        return $path;

    }

}