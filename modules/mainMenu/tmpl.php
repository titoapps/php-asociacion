<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 21:24
 */

echo '<div id="header">
    	<div id="buscador_header">
        	Buscar
            <input id="texto_busqueda" value=""/>
            <input id="boton_buscar" type="image" name="buscar" src="images/lupa.png" title="Buscar"/>
        </div>
        <h1 id="headertitle">Asociación de Comerciantes<br /><span id="title_strong">Alonso y Floranes</span></h1>
    	<div id="menu">
        	<ul id="menuItems">';

$index = 0;

foreach ($menuOptions as $option => $optiontext) {

    $lineText = '<a href='.$menuReferences[$index].' name="menu_'.$optiontext.'" id="menu_'.$optiontext.'" rel="tab" ';

    $menuModule = $menuModules[$index];

    $lineText = $lineText . '><li id="menu_'.$optiontext.'" name="menu_'.$optiontext.'" rel="tab" ';

    if ($menuOption == $menuModule) {

        $lineText = $lineText . 'class="selected"';

    }

    $lineText = $lineText .'>'.ucfirst($optiontext).'</li></a>';

    $index ++;

    echo $lineText;
}

echo '</ul> </div> </div>';