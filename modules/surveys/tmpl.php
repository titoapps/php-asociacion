<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:46
 */

echo '<h3>Participe</h3>
            <div id="encuestas">
                <form action="index.php" method="POST">
                    <fieldset>
                        <legend>Encuesta</legend>';

echo '<label>'.$survey->getValueDecoded("surveyTitle").'</label><br/><br/>';

$checked = false;

foreach ($answers as $answer) {

    if ($checked) {

        echo '<input type="radio" name="survey" value='.$answer->getValueDecoded("idAnswer").'/>'.$answer->getValueDecoded("answerTitle").'<br/><br/>';

    } else {

        echo '<input type="radio" name="survey" value='.$answer->getValueDecoded("idAnswer").' />'.$answer->getValueDecoded("answerTitle").'<br/><br/>';

        $checked = true;

    }

}


echo'<br/>
         <input type="submit" value="Votar" name="Votar" />
         <input type="button" value="Resultados" name="Resultados" />
         </fieldset>
         </form>
         </div>';