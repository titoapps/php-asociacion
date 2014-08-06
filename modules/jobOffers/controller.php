<?php

require_once 'model.php';

$jobOffers = JobOffers::getJobOffers(3);

include_once 'tmpl.php';