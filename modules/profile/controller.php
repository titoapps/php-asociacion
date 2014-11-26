<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 21/11/14
 * Time: 18:54
 */

if (isset($_POST['Terminar'])) {

    $nickName = mysql_real_escape_string(strip_tags($_POST['nickName']));
    $name = mysql_real_escape_string(strip_tags($_POST['name']));
    $surname = mysql_real_escape_string(strip_tags($_POST['surname']));
    $phoneNumber = mysql_real_escape_string(strip_tags($_POST['phoneNumber']));
    $email = mysql_real_escape_string(strip_tags($_POST['email']));
    $age = mysql_real_escape_string(strip_tags($_POST['age']));
    $streetName = mysql_real_escape_string(strip_tags($_POST['streetName']));
    $number = mysql_real_escape_string(strip_tags($_POST['number']));
    $floor = mysql_real_escape_string(strip_tags($_POST['floor']));
    $door = mysql_real_escape_string(strip_tags($_POST['door']));
    $postalCode = mysql_real_escape_string(strip_tags($_POST['postalCode']));
    $idUser = mysql_real_escape_string(strip_tags($_POST['idUser']));

//TODO:FALTA SUBIR IMAGEN!!

    $userProfile = array(

        "nickName" => utf8_decode($nickName),
        "name" => utf8_decode($name),
        "surname" => utf8_decode($surname),
        "phoneNumber" => utf8_decode($phoneNumber),
        "email" => utf8_decode($email),
        "age" => utf8_decode($age),
        "streetName" => utf8_decode($streetName),
        "number" => utf8_decode($number),
        "floor" => utf8_decode($floor),
        "door" => utf8_decode($door),
        "postalCode" => utf8_decode($postalCode),
        "idUser" => utf8_decode($idUser),

    );

    User::updateUserProfile($userProfile);

} else if (isset($_SESSION ['userLoggedID'])) {

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