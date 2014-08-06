<?php

require_once 'model.php';

$newsToShow =  News::getCurrentNews(3);

echo '<h2>Noticias</h2> ';

if ($newsToShow !=null) {

    foreach ($newsToShow as $new) {

        $title = $new->getValueDecoded('title');
        $subtitle = $new->getValueDecoded('subtitle');
        $description = $new->getValueDecoded('description');
        $startDate = $new->getValueDecoded("startDate");

        include 'tmpl.php';

    }

}

