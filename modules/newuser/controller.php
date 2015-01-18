<?php

require_once 'modules/user/model.php';

if (isset($_POST['addUser'])) {

    $DNI = $_POST['dni'];
    $age = $_POST['age'];

    if ($age == "-")
        $age = -1;

    $password = $_POST['password'];
    $name = $_POST['name'];
    $nickName = $_POST['nickName'];
    $surname = $_POST['surname'];
    //$idImage = $_POST['nif'];
    $street = $_POST['streetInputName'];
    $CP = $_POST['CP'];

    $streetNumber = $_POST['streetNumber'];
    $floor = $_POST['floor'];
    $door = $_POST['door'];

    $phoneNumber = $_POST['phone'];
    $email = $_POST['email'];
    $idUserType = 2;
    $joinDate = date("Y-m-d");
    $gender = $_POST['gender'];

    $data = array(
        'NIF' => $DNI,
        'age' => $age,
        'password' => $password,
        'name' => $name,
        'nickName' => $nickName,
        'surname' => $surname,
        'idImage' => 1,
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

        Tools::showMainContentResultMessage('Alta nuevo usuario', 'Ya hemos recibido tu solicitud, ya puedes acceder con tu usuario y contraseña. ¡Gracias por unirte!');

    } else {

        Tools::showGenericErrorMessage();

    }

} else {

    include 'tmpl.php';

}

