<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 30/11/14
 * Time: 18:23
 */

require_once 'modules/user/model.php';

class Tools {

    /**
     * Checks if the user nick name already exists
     *
     * @param $nickName the user nickName
     * @return bool returns if the user nickName already exists
     */
    static function checkNick ($nickName) {

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
    static function checkEmail ($email) {

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
    static function checkDNI ($dni) {

        $user = User::getByDNI($dni);

        if ($user == null) {

            //TODO:check DNI with algorithm
            return true;


        } else

            return false;

    }

    /**
     * Shows a section title and message on the web main content.
     * @param $title The title text
     * @param $message The message text
     */
    static function showMainContentResultMessage($title,$message) {

        echo '<div id="main_content">';

        if($title!=null)

            echo '<h2>'.$title.'</h2>';

        if($message!=null)

            echo'<p>'.$message.'</p>';

        echo'</div>';

    }

    /**
     * Shows a generic error message on the web main content.
     */
    static function showGenericErrorMessage() {

        echo '<div id="main_content">';

            echo '<h2>Vaya! Esto no deberia pasar</h2>';

            echo'<p>Se ha producido un error inesperado, disculpe las molestias.</p>';

        echo'</div>';

    }

} 