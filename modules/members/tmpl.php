<?php
/**
* Draws the members images on the left side menu
*/

echo '<h3>Asociados</h3>
<div id="asociados">';

    $index = 0;

    foreach ($members as $member) {

    $name = $member->getValueDecoded("name");
    $path = $images[$index]->getValueDecoded("path");
    $image = $images[$index]->getValueDecoded("imageName");
    echo '<a href="#" id="link_asociado1" alt="'.$name.'">
        <img src="'.$path.'" alt="'.$image.'"/><br />
    </a>';
    $index++;
    }

    echo '<a href="#" class="ampliar_info">Ver Asociados</a></div>';
