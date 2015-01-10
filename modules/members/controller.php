<?php

require_once 'model.php';

$membersInfo = Member::getFullMembersInfo();

/*$members,$images,$address,$streets,$totalRows);*/

$members = $membersInfo[0];
$images = $membersInfo[1];
$addresses = $membersInfo[2];
$streets = $membersInfo[3];

$index = 0;

echo '<div id="main_content"><div id="members">
                <h2>Asociados</h2>';

foreach ($members as $member) {

    $image = $images [$index];
    $address = $addresses [$index];
    $street = $streets [$index];
    $imageName = $image->getValue("imageName");
    $imageBin = $image->getValue("imageBin");
    $imageType = $image->getValueDecoded("imageType");
    $path = Tools::pathForBinImage($imageName,$imageBin,$imageType);

    $streetString = $street->getValueDecoded("streetName").' '.$address->getValueDecoded("number");

    $floor = $address->getValueDecoded("floor");

    if ($floor!= null && $floor >= 0 ) {

        $floor = ($floor == 0) ? " Bajo":" Planta ".$floor;

        $streetString = $streetString . $floor;

    }

    if ($address->getValueDecoded("door")!= null )
        $streetString = $streetString. ' Puerta '.$address->getValueDecoded("door");


    include 'tmpl.php';

    $index ++;

}

echo '</div></div>';