<?php

include_once 'galery/model.php';

if (isset($_GET['option']) && $_GET['option']=='galery') {


    if (isset($_POST['Subir'])) {

        $configuration = \Configuration\Configuration::sharedInstance();

        //If its a valid file
        if (isset ($_FILES['galeryImage'])) {

            if ($_FILES['galeryImage']['error'] == 0) {

                //Confirm its a valid image type
                if (in_array ($_FILES['galeryImage']['type'],$configuration->getAllowedMimeTypes())) {

                    $fullpath = $configuration->getImagesFolder() . "/" . $_FILES['galeryImage']['name'];

                    //We can store a copy
                    if (!move_uploaded_file ($_FILES['galeryImage']['tmp_name'],$fullpath)) {

                        echo "There was an error uploading the file.";

                    } else {
                        //Store on DDBB
                        $result = Tools::insertGaleryImage($_FILES['galeryImage'],$configuration->getImagesFolder());

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

    } else {

        $images = Image::getGaleryImages();

        include 'tmplDetail.php';

    }

} else

    include 'tmpl.php';

