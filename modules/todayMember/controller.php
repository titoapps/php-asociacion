<?php


require_once 'modules/members/model.php';

$memberInfo = Member::getTodayMember();

if ($memberInfo) {

    $member = $memberInfo[0];
    $image = $memberInfo[1];
    $address = $memberInfo[2];
    $street = $memberInfo[3];

    $streetString = $street->getValueDecoded("streetName").' '.$address->getValueDecoded("number");

    $floor = $address->getValueDecoded("floor");

    if ($floor!= null && $floor >= 0 ) {

        $floor = ($floor == 0) ? " Bajo":" Planta ".$floor;

        $streetString = $streetString . $floor;

    }

    if ($address->getValueDecoded("door")!= null )
        $streetString = $streetString. ' Puerta '.$address->getValueDecoded("door");

    $imageBin = $image->getValue("imageBin");
    $imageType = $image->getValueDecoded("imageType");
    $path = Tools::pathForBinImage($image->getValueDecoded("imageName"),$imageBin,$imageType);

    include 'tmpl.php';

}