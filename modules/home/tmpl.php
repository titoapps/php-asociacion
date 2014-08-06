<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 29/07/14
 * Time: 21:11
 */

echo '<div id="main_header">';

include 'modules/search/controller.php';
include_once 'modules/todayMember/controller.php';

echo '</div>';

echo '<div id="main_content">';

include_once 'modules/news/controller.php';
include_once 'modules/galery/controller.php';

echo '<div id="main_footer">';

include_once 'modules/agenda/controller.php';
include_once 'modules/jobOffers/controller.php';

echo '</div>
      </div>';