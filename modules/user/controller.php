<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:42
 */

require_once 'model.php';

//TODO: store 'remember me' on cookies??

$userName = null;

if (isset($_POST["logout"])) {

    $_SESSION ['userLoggedNick'] = null;
    $_SESSION ['userLoggedUserType'] = null;
    $userName = null;
    include_once 'tmpl.php';

} else if (isset($_POST["login"])) {

    $userNick = $_POST['user'];
    $password = $_POST['password'];

    $user = User::authenticate($userNick,$password);

    if ($user == null) {
        //TODO: redirigir a index, error usuario a $session
        echo '<h1>ERROR de autenticacion</h1>';

    } else {

        //TODO: redirigir a index, añadir usuario a $session
        $userName = $user->getValueDecoded('nickName');
        $_SESSION ['userLoggedNick'] = $userName;
        $_SESSION ['userLoggedUserType'] = $user->getValueDecoded('idUserType');

        include_once 'tmpl.php';

    }

} else if (isset($_SESSION ['userLoggedNick'])) {

    $userName = $_SESSION ['userLoggedNick'];
    include_once 'tmpl.php';

} else {

    include_once 'tmpl.php';

}