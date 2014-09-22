<?php

require_once 'model.php';

if(isset($_GET['option'])) {

    echo '<div id="main_content">';

    echo '<h2>Noticias</h2> ';

    if (isset($_GET['idNew'])) {

        $idNew = $_GET['idNew'];
        $new = News::getNew($idNew);

        if ($new != null) {

            $title = $new->getValueDecoded('title');
            $subtitle = $new->getValueDecoded('subtitle');
            $description = $new->getValueDecoded('description');
            $startDate = $new->getValueDecoded("startDate");

            include 'tmplDetail.php';

        }

    } else {

        $newsToShow = News::getCurrentNews(-1);



        if ($newsToShow != null) {

            foreach ($newsToShow as $new) {

                $title = $new->getValueDecoded('title');
                $subtitle = $new->getValueDecoded('subtitle');
                $description = $new->getValueDecoded('description');
                $startDate = $new->getValueDecoded("startDate");

                include 'tmpl.php';

            }

        }

    }


    echo '</div>';

} else {

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

}

