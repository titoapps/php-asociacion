<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:47
 */

require_once 'model.php';

if (isset($_POST['Votar']) || isset($_SESSION['alreadyAnswered'])) {

    if (!isset($_SESSION['alreadyAnswered'])) {
        //the user hasn't already answered the survey, we insert the response
        $valor = $_POST['survey'];
        $idSurvey = $_POST['idSurvey'];

        require_once 'model.php';

        Survey::insertSurveyResponse($idSurvey,$valor);

        $_SESSION['alreadyAnswered'] = 'YES';

    }

    include_once 'surveyAnswer.php';

} else if (isset($_POST['Resultados'])) {

    $idSurvey = $_POST['idSurvey'];
    $surveyResults = Survey::getSurveyResults($idSurvey);

    include_once 'surveyResults.php';

} else {

    $surveyInfo = Survey::getCurrentSurvey();
    $survey = $surveyInfo [0];
    $answers = $surveyInfo [1];

    include_once 'tmpl.php';

}