<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:50
 */

if(isset($_POST['send'])) {

    include_once 'asociateForm.php';

} else {

    require_once 'search/Activities.class.php';
    require_once "members/model.php";

    $allActivities = Activities::getActivities();
    $allStreets = Street::getStreets();

    include_once 'tmpl.php';

}

/**
 * Process the user registration form
 * @param $values
 */
function processForm( $values ) {

//Nothing to do

}