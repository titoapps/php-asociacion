<?php

include_once 'galery/model.php';

if (isset($_GET['option']) && $_GET['option']=='galery') {

    $images = Image::getGaleryImages();
    include 'tmplDetail.php';

} else

    include 'tmpl.php';

