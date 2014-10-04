<?php

require_once 'model.php';
require_once "librerias/Utils.php";

if(isset($_GET['option'])) {

    echo '<div id="main_content">';

    echo '<h2>Noticias</h2> ';

    if (isset($_POST['Terminar'])) {

        $startDateString = utf8_decode($_POST['startDate']);
        $endDateString = utf8_decode($_POST['endDate']);

        $data = array(

            "idNew" => utf8_decode($_POST['idNew']),
            "title" => utf8_decode($_POST['title']),
            "subtitle" => utf8_decode($_POST['subtitle']),
            "description" => utf8_decode($_POST['description']),
            "startDate" =>$startDateString,
            "endDate" => $endDateString,

        );


        News::update($data);

        $idNew =$_POST['idNew'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $description = $_POST['description'];
        $dateFormatted = $_POST['startDate'];
        $endDateFormatted = $_POST['endDate'];

        include 'tmplDetail.php';

    } else if (isset($_GET['idNew'])) {

        $idNew = $_GET['idNew'];
        $new = News::getNew($idNew);

        if ($new != null) {

            $title = $new->getValueDecoded('title');
            $subtitle = $new->getValueDecoded('subtitle');
            $description = $new->getValueDecoded('description');
            $startDate = $new->getValueDecoded("startDate");
            $endDate = $new->getValueDecoded("endDate");

            $dateFormatted = Utils::formatDateString($startDate);
            $endDateFormatted = Utils::formatDateString($endDate);

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
                $startDate = Utils::formatDateString($startDate);

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
            $startDate = Utils::formatDateString($startDate);

            include 'tmpl.php';

        }

    }

}

