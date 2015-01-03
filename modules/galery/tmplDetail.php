<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 16/11/14
 * Time: 13:31
 */

echo '<div id="main_content">

      <h2>Galería</h2>';

//we provide de posibility to add a new image to the galery if the user is the administator
if (isset($_SESSION ['userLoggedUserType']) && $_SESSION ['userLoggedUserType'] == 1) {

    echo'<form id="sendImageForm" action="index.php?option=galery" method="POST" enctype="multipart/form-data">
            <label for="file">Añadir imagen</label>
            <input type="file" id="" name="galeryImage" value="galeryImage"/>
            <input type="submit" value="Subir" name ="Subir" title="Subir"/>
        </form>';
}
    echo '<!--slider-->
    <div class="jcarousel-wrapper">
        <div class="jcarousel">
            <ul>';

                foreach ($images as $foto) {

                      $imageBin = $foto->getValue("imageBin");
                      $idImage = $foto->getValue("idImage");
                      $imageName = $foto->getValueDecoded("imageName");
                      $path = Tools::pathForBinImage($imageName,$imageBin);
                    echo '<li>
                            <!--sacamos la foto y el nombre del sitio-->
                            <img id='.$idImage.' src="'.$path.'" title ="'.$imageName.'"  width="800" height="300px;"/>
                          </li>';
                }
      echo '</ul>
        </div>
        <!-- Controles del slider -->
        <a href="#" class="jcarousel-control-prev" data-jcarouselcontrol="true"><</a>
        <a href="#" class="jcarousel-control-next" data-jcarouselcontrol="true">></a>
    </div>
    </div>

    <script>
            $(".jcarousel")
                    .jcarousel({
                    })
                    .jcarouselAutoscroll({
                        interval: 3000,
                        target: "+=1",
                        autostart: true,
                        wrap: "circular"
                    });
           $(".jcarousel-control-prev")
            .jcarouselControl({
                target: "-=1"
            });

        $(".jcarousel-control-next")
            .jcarouselControl({
                target: "+=1"
            });

    </script>';
