<?php

require_once('php/Configuration/Configuration.php');

/**
 * Draws the site left menu
 */
function drawLeftMenu () {

    echo '<div id="leftsecondary">';

    include_once 'user/controller.php';

    include_once 'membersPreview/controller.php';

    include_once 'surveys/controller.php';

    include_once 'contactLogo/controller.php';

    echo '</div> ';

}


