<?php

require_once 'model.php';


if(isset($_GET['option'])) {

    echo '<div id="main_content">';

    echo '<h2>Noticias</h2> ';

    if (isset($_POST['Terminar'])) {

        $startDateString = utf8_decode($_POST['startDate']);
        $endDateString = utf8_decode($_POST['startDate']);

        echo $startDateString.'</br>';
        echo $endDateString.'</br>';

        $data = array(

            "idNew" => utf8_decode($_POST['idNew']),
            "title" => utf8_decode($_POST['title']),
            "subtitle" => utf8_decode($_POST['subtitle']),
            "description" => utf8_decode($_POST['description']),
            "startDate" =>$startDateString,
            "endDate" => $endDateString,

        );


        News::update($data);

    } else if (isset($_GET['idNew'])) {

        $idNew = $_GET['idNew'];
        $new = News::getNew($idNew);

        if ($new != null) {

            $title = $new->getValueDecoded('title');
            $subtitle = $new->getValueDecoded('subtitle');
            $description = $new->getValueDecoded('description');
            $startDate = $new->getValueDecoded("startDate");
            $endDate = $new->getValueDecoded("endDate");

            if (isset($_GET['comment'])) {
                //TODO:continue inserting comments on news
                //NewComment::getNewComments
                include 'tmplDetail.php';

            } else {

                //TODO:continue show comments in general
                include 'tmplDetail.php';

            }

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

