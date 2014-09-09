<?php

require_once 'modules/user/model.php';

if (isset($_POST['addUser'])) {

    $NIF = $_POST['nif'];
    $age = $_POST['age'];
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

    $data = array ('NIF' => $NIF,
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
    $user->insert();

} else {

    include 'tmpl.php';

}