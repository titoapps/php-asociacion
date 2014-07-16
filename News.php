

<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 27/06/14
 * Time: 18:11
 */
require_once('php/model/News.class.php');

$newsToShow =  News::getCurrentNews();

echo '<h1>Noticias</h1> ';

if ($newsToShow !=null) {

    foreach ($newsToShow as $key => $new) {

        $title = $new->getValueDecoded('title');
        $subtitle = $new->getValueDecoded('subtitle');
        $description = $new->getValueDecoded('description');
        echo '<li>'.$title. '</li></br>';
        echo '<li>'.$subtitle. '</li></br>';
        echo '<li>'.$description. '</li></br>';


    }

}


?>
