<?php

require_once 'modules/user/model.php';

include 'tmpl.php';

/**
 * Process the user registration form
 * @param $values
 */
function processForm( $values ) {

    $nickName = $values["nickName"];

    $DNI = $values['dni'];
    $age = $values['age'];

    if ($age == "-")
        $age = -1;

    $password = $values['password'];
    $name = $values['name'];
    $nickName = $values['nickName'];
    $surname = $values['surname'];
    //$idImage = $values['nif'];
    $street = $values['streetInputName'];
    $CP = $values['CP'];

    $streetNumber = $values['streetNumber'];
    $floor = $values['floor'];
    $door = $values['door'];

    $phoneNumber = $values['phone'];
    $email = $values['email'];
    $idUserType = 2;
    $joinDate = date("Y-m-d");
    $gender = $values['gender'];

    $data = array ('NIF' => $DNI,
        'age' => $age,
        'password' => $password,
        'name' => $name,
        'nickName' => $nickName,
        'surname' => $surname,
        'idImage' => null,
        'idAddress' => $name,
        'phoneNumber' => $phoneNumber,
        'email' => $email,
        'idUserType' => $idUserType,
        'joinDate' => $joinDate,
        'gender' => $gender);

    $user = new User($data);
    $result = $user->insert();

    if ($result == null) {

        $result = "Ya hemos recibido tu solicitud, en unos minutos recibirás un email de confirmación y una clave
                   para acceder a la web. ¡Gracias por unirte!";

    }

    include 'tmplUserAdded.php';

}

/**
 * Checks if the user nick name already exists
 *
 * @param $nickName the user nickName
 * @return bool returns if the user nickName already exists
 */
function checkNick ($nickName) {

    $user = User::getByNickName($nickName);

    if ($user == null)

        return true;

    else

        return false;

}

/**
 * Checks if the user email already exists
 *
 * @param $email the user email
 * @return bool returns if the user email already exists
 */
function checkEmail ($email) {

    $user = User::getByEmailAddress($email);

    if ($user == null)

        return true;

    else

        return false;

}

/**
 * Checks if the user DNI
 *
 * @param $dni user dni
 * @return bool returns if the user $dni already exists and its correct or not
 */
function checkDNI ($dni) {

    $user = User::getByDNI($dni);

    if ($user == null) {

        //TODO:check DNI with algorithm
        return true;


    } else

        return false;

}
