<?php

require_once 'Activities.class.php';
require_once "members/model.php";

$allActivities = Activities::getActivities();


if(isset($_GET['search'])) {

    //Search already done NOT IMPLEMENTED A COMPLETE SEARCH YET
    $name = null;
    $activity = null;
    $street = null;

    if (isset($_GET['name'])){

        $name = $_GET['name'];

    }

    if (isset($_GET['activity'])){

        $activity = $_GET['activity'];

    }
    if (isset($_GET['street'])){

        $street = $_GET['street'];

    }

    $membersInfo = Member::searchMembers($name,$activity,$street);

    $totalRows = $membersInfo[5];

    $members = $membersInfo[0];
    $images = $membersInfo[1];
    $addresses = $membersInfo[2];
    $streets = $membersInfo [3];
    $activities = $membersInfo [3];

    include 'searchMembers.php';

} else {

    $allStreets = Street::getStreets();

    include 'tmpl.php';

}

