<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 16/11/14
 * Time: 13:31
 */

echo '


<div id="main_content">

      <h2>Galería</h2>

<!--slider-->
<div class="jcarousel-wrapper">
    <div class="jcarousel">
        <ul>';

            foreach ($images as $foto) {

                  $imageBin = $foto->getValue("imageBin");
                  $imageName = $foto->getValueDecoded("imageName");
                  $path = Tools::pathForBinImage($imageName,$imageBin);
                echo '<li>
                        <!--sacamos la foto y el nombre del sitio-->
                        <img src="'.$path.'" title ="'.$imageName.'"  width="800" height="300px;"/>
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
