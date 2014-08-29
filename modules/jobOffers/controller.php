<?php

require_once 'model.php';

if (isset($_GET['option'])){

    $jobOffers = JobOffers::getJobOffers(-1);

    include_once 'tmpl.php';

} else {

    $jobOffers = JobOffers::getJobOffers(3);

    include_once 'tmplPreview.php';

}