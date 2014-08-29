<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 29/08/14
 * Time: 16:08
 */

if (!isset($_SESSION['alreadyAnswered'])) {
    //the user hasnt already answered the survey, we insert the response

    require_once 'model.php';

    Survey::insertSurveyResponse('1',$valor);

}

echo '<h3>Participe</h3>
            <div id="encuestas">
                <form>
                    <fieldset>
                        <legend>Encuesta</legend>';



echo'<span>¡Gracias por participar!</span>
         </fieldset>
         </form>
         </div>';