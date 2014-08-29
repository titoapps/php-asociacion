<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:47
 */

if (isset($_POST['Votar']) || isset($_SESSION['alreadyAnswered'])) {

    $valor = $_POST['survey'];
    include_once 'surveyAnswer.php';

} else {

    require_once 'model.php';

    $surveyInfo = Survey::getCurrentSurvey();
    $survey = $surveyInfo [0];
    $answers = $surveyInfo [1];

    include_once 'tmpl.php';

}