<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 21/11/14
 * Time: 18:54
 */

if (isset($_SESSION ['userLoggedID'])) {

    require_once "user/model.php";

    $userData = User::getMemberProfile($_SESSION ['userLoggedID']);

    $userLogged = $userData[0];
    $userImage = $userData[1];

    //if user image is not set, we have to choose a default image
    if ($userImage == null){

        $userImagePath = 'images/members/carnicerialogo.jpg';

    } else {

        $userImagePath = $userImage->getValueDecoded('path');

    }


    include_once 'tmpl.php';

} else  {

    //TODO:Load default error page -> not allowed


}