<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 24/09/14
 * Time: 21:03
 */
echo '<form>';
echo '<input class="element_above" type="text" id="title" name="title" required="required" value = "'.$title.'"/>';

echo '<input class="element_above" id="startDate" name="startDate" required="required" value = "'.$startDate.'"/>';

echo '<input class="element_above" id="subtitle" name="subtitle" required="required" value = "'.$subtitle.'"/>';
/*if ($subtitle != null) {

    echo '<p>'.$subtitle.'</p>';

}*/

$title = $new->getValueDecoded('title');
$idNew = $new->getValueDecoded('idNew');

//TODO:Cerrar todo al salir de logout, para evitar edicion sin usuario admin.
//TODO:Hacer formulario con PEAR. 
echo '<textarea class="element_above" id="description" name="description" cols="40" rows="10">'.$description.'</textarea>';
echo '<input type=submit value="Finalizar">';
echo '</form>';


