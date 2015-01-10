<?php

include_once 'galery/model.php';

if (isset($_GET['option']) && $_GET['option']=='galery') {

    //determines if the administrator is the person that is logged or not
    $adminLogged = isset($_SESSION ['userLoggedUserType']) && ($_SESSION ['userLoggedUserType'] == 1);

    if (isset($_POST['Subir'])) {

        $configuration = \Configuration\Configuration::sharedInstance();

            //If its a valid file
        if (isset ($_FILES['galeryImage'])) {

            if ($_FILES['galeryImage']['error'] == 0) {

                //Confirm its a valid image type
                if (in_array ($_FILES['galeryImage']['type'],$configuration->getAllowedMimeTypes())) {

                    $fullpath = $configuration->getGaleryImagesFolder() . "/" . $_FILES['galeryImage']['name'];

                    //We can store a copy
                    if (!move_uploaded_file ($_FILES['galeryImage']['tmp_name'],$fullpath)) {

                        echo "There was an error uploading the file.";

                    } else {
                        //Store on DDBB
                        $result = Tools::insertGaleryImage($_FILES['galeryImage'],$configuration->getGaleryImagesFolder());

                        if (!$result)
                            Tools::showGenericErrorMessage();
                        else
                            Tools::showMainContentResultMessage("Galería","Imagen añadida correctamente");

                    }

                } else {

                    Tools::showMainContentResultMessage("Galería","Tipo de imagen no soportado");

                }

            } else {

                Tools::showMainContentResultMessage("Galería","Error al subir la imagen, inténtelo de nuevo");

            }

        } else {

            Tools::showMainContentResultMessage("Galería","Error al subir la imagen, inténtelo de nuevo");

        }

    } else if (isset($_POST['EliminarImagen']) && isset($_POST['idImage'])) {

        echo $_POST['idImage'];
        Image::deleteImage($_POST['idImage']);

        $images = Image::getGaleryImages();

        include 'tmplDetail.php';

    } else {

        $images = Image::getGaleryImages();

        include 'tmplDetail.php';

    }

} else {

    $images = Image::getGaleryImages(5);

    include 'tmpl.php';

}
