<?php
/**
* Draws the members images on the left side menu
*/

echo '<h3>Asociados</h3>
<div id="asociados">';

    $index = 0;

    foreach ($members as $member) {

        $name = $member->getValueDecoded("name");
        $image = $images[$index]->getValueDecoded("imageName");
        $imageBin = $images[$index]->getValue("imageBin");
        $path = Tools::pathForBinImage($image,$imageBin);

        echo '<a href="#" id="link_asociado1" alt="'.$name.'">
            <img src="'.$path.'" alt="'.$image.'"/><br />
        </a>';
        $index++;
    }

    echo '<a href="index.php?option=members" class="ampliar_info">Ver Asociados</a></div>';
