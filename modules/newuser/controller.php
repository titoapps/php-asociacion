<?php

require_once 'modules/user/model.php';

include 'tmpl.php';

/**
 * Process the user registration form
 * @param $values
 */
function processForm( $values ) {

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

    $data = array (
        'NIF' => $DNI,
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
        'gender' => $gender,
        'street' => $street,
        'CP' => $CP,
        'streetNumber' => $streetNumber,
        'floor' => $floor,
        'door' => $door);

    $user = new User($data);
    $result = $user->insert();

    if ($result == null) {

        Tools::showMainContentResultMessage('Alta nuevo usuario', 'Ya hemos recibido tu solicitud, en unos minutos recibirás un email de confirmación y una clave
                   para acceder a la web. ¡Gracias por unirte!');

    } else {

        Tools::showGenericErrorMessage();

    }

}

