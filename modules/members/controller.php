<?php

require_once 'model.php';

$membersInfo = Member::getFullMembersInfo();

$members = $membersInfo[0];
$images = $membersInfo[1];
$addresses = $membersInfo[2];
$streets = $membersInfo[3];

$index = 0;

echo '<div id="main_content"><div id="members">';
echo '<h2>';Tools::showBackButton(1);echo 'Asociados</h2> ';

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