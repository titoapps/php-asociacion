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
if ($adminLogged) {

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
                    $path = Tools::pathForGaleryBinImage($imageName, $imageBin);
                    echo '<li>
                            <!--sacamos la foto y el nombre del sitio-->
                            <a rel="shadowbox[images];width=400;height=300" href="'.$path.'" title ="'.$imageName.'"><img src="'.$path.'" title ="'.$imageName.'"  width="800" height="300px;"/></a>
                            <!--img src="' . $path . '" title ="' . $imageName . '"  width="800" height="300px;"/-->';

                    if ($adminLogged) {
                        echo '<form id="deleteImageForm" action="index.php?option=galery" method="POST">
                                    <input type="hidden" id="idImage" name = "idImage" value = "' . $idImage . '"/>
                                    <input type="submit" value="Eliminar" name ="EliminarImagen"/>
                              </form>';
                    }
                    echo '</li>';

                }
      echo '</ul>
        </div>
        <!-- Controles del slider -->
        <a href="#" class="jcarousel-control-prev" data-jcarouselcontrol="true">‹</a>
        <a href="#" class="jcarousel-control-next" data-jcarouselcontrol="true">›</a>

        <!-- TODO:: botones de navegacion-->
        <p class="jcarousel-pagination" data-jcarouselpagination="true">
                <a href="#1"></a>
                <a href="#2"></a>
                <a href="#3"></a>
        </p>
        </div>
<div class="clear"></div>
<!--TODO::Esta parte es la que monta las miniaturas, si quieres quitarlo solo tiens que eliminar esta parte y el css correspondiente-->
<div class="wrapper-list">
		<ul>';
foreach ($images as $foto) {

    $imageBin = $foto->getValue("imageBin");
    $imageName = $foto->getValueDecoded("imageName");
    $path = Tools::pathForBinImage($imageName,$imageBin);
    echo '<li>
                        <!--sacamos la foto y el nombre del sitio-->
                        <a rel="shadowbox[galery];width=400;height=300" href="'.$path.'" title ="'.$imageName.'"><img src="'.$path.'" title ="'.$imageName.'"  width="100" height="80px;"/></a>
                      </li>';
}
echo '</ul>
</div>
</div>

<script>
	(function($) {
		$(function() {
			$(".jcarousel").jcarousel({
				animation: {
				duration: 800,
				easing:   "swing",
				complete: function() {
				}
		}
	});

        $(".jcarousel-control-prev")
            .on("jcarouselcontrol:active", function() {
                $(this).removeClass("inactive");
            })
            .on("jcarouselcontrol:inactive", function() {
                $(this).addClass("inactive");
            })
            .jcarouselControl({
                target: "-=1"
            });

        $(".jcarousel-control-next")
            .on("jcarouselcontrol:active", function() {
                $(this).removeClass("inactive");
            })
            .on("jcarouselcontrol:inactive", function() {
                $(this).addClass("inactive");
            })
            .jcarouselControl({
                target: "+=1"
            });

        $(".jcarousel-pagination")
            .on("jcarouselpagination:active", "a", function() {
                $(this).addClass("active");
            })
            .on("jcarouselpagination:inactive", "a", function() {
                $(this).removeClass("active");
            })
            .jcarouselPagination();
    });
})(jQuery);
</script>';
