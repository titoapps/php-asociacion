<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 08/08/14
 * Time: 18:54
 */

require_once 'model.php';

//TODO: store 'remember me' on cookies??

if (isset($_POST["login"])) {

    $userName = $_POST['user'];
    $password = $_POST['password'];

    if ($userName == null) {

        echo '<h1>error usuario</h1>';

    } else if ($password == null) {

        echo '<h1>error password</h1>';

    } else {

    $user = User::authenticate($userName,$password);

    if ($user == null) {
        //TODO: redirigir a index, error usuario a $session
        echo '<h1>ERROR de autenticacion</h1>';

    } else {
        //TODO: redirigir a index, añadir usuario a $session
        echo '<h1>Login correcto</h1>';

        //http_redirect('index.php');
    }
    }

} else if (isset($_POST["newuser"])) {

    //TODO: redirigir a index, alta de usuario a session
    echo '<h1>ALTA USUARIO</h1>';

}