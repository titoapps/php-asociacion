<?php
/*echo ' <div id="galeria">
                <h2>Galería</h2>
                <div id="galeria_contenedor">
                    <img id="galeria_imagen_izq" src="images/galery/escaparatefruteria.jpg" alt="Galeria de imagenes"/>
                    <img id="galeria_imagen_centro" src="images/galery/callefloranes.jpg" alt="Galeria de imagenes"/>
                    <img id="galeria_imagen_der" src="images/galery/escaparatemodels.jpg" alt="Galeria de imagenes"/>
                </div>
            </div>';*/

echo '<h2>Galería</h2>
        <div id="galeria">';

$cont = 1;

foreach ($images as $foto) {

    $imageBin = $foto->getValue("imageBin");
    $idImage = $foto->getValue("idImage");
    $imageName = $foto->getValueDecoded("imageName");
    $path = Tools::pathForGaleryBinImage($imageName, $imageBin);

    echo '<div class="img' . $cont . '"><a href="index.php?option=galery"><img src="' . $path . '" alt="' . $cont . '"></a></div>';
}

echo'</div>';
