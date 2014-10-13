<?php

require_once 'model.php';


if (isset($_GET['idOffer'])) {

    $idOffer = $_GET['idOffer'];

    $jobOfferItem = JobOffers::getJobOffersById($idOffer);

    include_once 'tmpl.php';


} else if (isset($_GET['option'])) {

    $jobOffers = JobOffers::getJobOffers(-1);

    include_once 'tmplPreview.php';

} else {

    $jobOffers = JobOffers::getJobOffers(3);

    include_once 'tmplPreview.php';

}