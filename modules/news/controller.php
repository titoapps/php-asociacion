<?php

require_once 'model.php';
require_once "librerias/Utils.php";

if(isset($_GET['option'])) {
    //News page

    echo '<div id="main_content">';

    if (isset($_GET['idNew'])) {

        echo '<h2>';Tools::showBackButton(1);echo'Noticias</h2> ';

        require_once "newComment.php";

        $reloadDataNeeded = true;
        $idNew = null;

        if (isset($_POST['Terminar'])) {

            //End editing a new, we update the database
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

            $reloadDataNeeded = false;

        } else if (isset($_POST['comment'])) {

            require_once "newComment.php";

            $idNew = $_POST['idNew'];

            $data = array(

                "idNew" => utf8_decode($idNew),
                "idUser" => utf8_decode($_SESSION ['userLoggedID']),
                "text" => utf8_decode($_POST['commentText']),
                "date" => utf8_decode(date('Y-m-d H:i:s')),

            );

            NewComment::insert($data);

        }

        //new detail
        if ($idNew == null) {

            $idNew = $_GET['idNew'];

        }


        $new = News::getNew($idNew);

        if ($new != null) {

            $newComments = NewComment::getNewComments($idNew);

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

    } else if (isset($_POST['anadir'])) {

        echo '<h2>';Tools::showBackButton(1);echo'Noticias</h2> ';

        //End editing a new, we update the database
        $startDateString = utf8_decode($_POST['startDate']);
        $endDateString = utf8_decode($_POST['endDate']);

        $data = array(

            "title" => utf8_decode($_POST['title']),
            "subtitle" => utf8_decode($_POST['subtitle']),
            "description" => utf8_decode($_POST['description']),
            "startDate" => $startDateString,
            "endDate" => $endDateString,

        );


        News::insert($data);

        $idNew = $_POST['idNew'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $description = $_POST['description'];
        $dateFormatted = $_POST['startDate'];
        $endDateFormatted = $_POST['endDate'];

        include 'tmplDetail.php';

    } else {

        echo '<h2>Noticias</h2> ';

        //Show all news
        $newsToShow = News::getCurrentNews(-1);
        echo '<script type="text/javascript" src="js/newsUtilities.js"></script>';

        if (isset($_SESSION ['userLoggedUserType']) && $_SESSION ['userLoggedUserType'] == 1) {

            /*echo'<p><a href="'.$uri.'&edit=edit" class="ampliar_info" onclick="startEdition()">Editar</a></p>';*/
            echo'<p><a href="#" class="ampliar_info" id="addNewLink" onclick="addNew()">Añadir Noticia</a></p>';

        }

        echo'<div id="newsContainer">';

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
        echo'</div>';

    }


    echo '</div>';

} else {

    //index page, no detail, only preview
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

