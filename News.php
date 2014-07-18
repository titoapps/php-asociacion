
<?php
/**
 * Retrieves the current news to show and builds an html
 * User: albertoperezperez
 * Date: 27/06/14
 * Time: 18:11
 */
require_once('php/model/News.class.php');

$newsToShow =  News::getCurrentNews();

echo '<h2>Noticias</h2> ';

if ($newsToShow !=null) {

    foreach ($newsToShow as $key => $new) {

        $title = $new->getValueDecoded('title');
        $subtitle = $new->getValueDecoded('subtitle');
        $description = $new->getValueDecoded('description');
        $startDate = $new->getValueDecoded("startDate");

        echo '<h3 class="titulo_seccion">'.$title.'</h3>';

        echo '<p class="fecha">'.$startDate.'</p>';

        if ($subtitle != null) {

           echo '<p>'.$subtitle.'</p>';

        }

        echo '<p class="detalle_noticia">'.$description.'</p>';

    }

}

?>
