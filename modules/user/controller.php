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

$loginError = false;

if (isset($_POST["logout"])) {

    $_SESSION ['userLoggedNick'] = null;
    $_SESSION ['userLoggedUserType'] = null;
    $userName = null;

    session_destroy();

    ob_start(); // ensures anything dumped out will be caught

    // do stuff here
    $url = 'index.php'; // this can be set based on whatever

    // clear out the output buffer
    while (ob_get_status())
    {
        ob_end_clean();
    }

    // we go to index to force refreshing the rest of the web
    header( "Location: $url" );

} else if (isset($_POST["login"])) {

    $userNick = $_POST['user'];
    $password = $_POST['password'];

    $user = User::authenticate($userNick,$password);

    if ($user == null) {
        //TODO: redirigir a index, error usuario a $session
        $loginError = true;

    } else {

        //TODO: redirigir a index, añadir usuario a $session
        $userName = $user->getValueDecoded('nickName');
        $_SESSION ['userLoggedNick'] = $userName;
        $_SESSION ['userLoggedUserType'] = $user->getValueDecoded('idUserType');
        $_SESSION ['userLoggedID'] = $user->getValueDecoded('idUser');

    }
    include_once 'tmpl.php';

} else if (isset($_SESSION ['userLoggedNick'])) {

    $userName = $_SESSION ['userLoggedNick'];
    include_once 'tmpl.php';

} else {

    include_once 'tmpl.php';

}