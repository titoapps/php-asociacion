<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 31/08/14
 * Time: 16:48
 */

require_once ('model.php');

echo '<h3>Participe</h3>
            <div id="encuestas">
                <form>
                    <fieldset>
                        <legend>Encuesta</legend>';

//echo '<label>'.$survey->getValueDecoded("surveyTitle").'</label><br/><br/>';

$sum = 0;

foreach ($surveyResults as $key => $result) {

    $itemCount = $result->getValueDecoded("count");
    $sum = $sum + $itemCount;

}

foreach ($surveyResults as $key =>  $result) {

    $count = $result->getValueDecoded("count");
    $width = $count / $sum * 100;

    echo '<label>'.$result->getValueDecoded("answerTitle").'</label><br/><br/>';

    if ($width == 0) {

        echo '<div style="background-color : clear; color:black; width:100%; height: 1em" >'.round($width).' % </div><br/>';

    } else {

        echo '<div style="background-color : #0066cc; color:white; width:'.$width.'%; height: 1em" >'.round($width).' % </div><br/>';

    }




}

echo'<br/>';

if($showBackButton) {

   echo '<input type="submit" value="Volver" name="Volver" />';

}
echo'</fieldset>
     </form>
     </div>';
