<?php

require_once 'model.php';

if (isset($_GET['idOffer'])) {
    //we show the detail of a job offer
    $idOffer = $_GET['idOffer'];

    $jobOfferItem = JobOffers::getJobOffersById($idOffer);

    include_once 'tmpl.php';


} else if (isset($_GET['option'])) {

    //we show the job offer section

    echo '<div id="main_content">';
    $jobOffers = JobOffers::getJobOffers(-1);

    include_once 'tmplPreview.php';

} else {

    //we show the job offer section preview

    $jobOffers = JobOffers::getJobOffers(3);

    include_once 'tmplPreview.php';

}