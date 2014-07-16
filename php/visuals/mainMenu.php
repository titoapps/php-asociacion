<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 08/07/14
 * Time: 20:31
 */

drawMenuHeader(0);

/**
 * Draws the site header
 */
function drawMenuHeader ($menuOption) {

    echo '<div id="header">
    	<div id="buscador_header">
        	Buscar
            <input id="texto_busqueda" value=""/>
            <input id="boton_buscar" type="image" name="buscar" src="images/lupa.png" title="Buscar"/>
        </div>
        <h1 id="headertitle">Asociación de Comerciantes<br /><span id="title_strong">Alonso y Floranes</span></h1>
    	<div id="menu">
        	<ul id="menuItems">';

    $configuration = \Configuration\Configuration::sharedInstance();
    $menuOptions = $configuration->getMenuOptions();

    $menuReferences = array('index.php','news.php','asociation.php','offers.php','agenda.php','asociate.php','contact.php');

    foreach ($menuOptions as $option => $optiontext) {

        $lineText =  '<li id="menu_'.$optiontext.'" rel="tab" ';

        if ($menuOption == $option) {

            $lineText = $lineText . ' class="selected"';

        }

        $lineText = $lineText . '><a href=# name="menu_'.$optiontext.'" id="menu_'.$optiontext.' rel="tab">'.ucfirst($optiontext).'</a></li>';

        echo $lineText;
    }

    echo '</ul> </div> </div>';

}