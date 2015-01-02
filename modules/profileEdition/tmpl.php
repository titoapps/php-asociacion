<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 30/11/14
 * Time: 20:50
 */

require_once("QuickForm.php");

//TODO:check send and complete
$form = new HTML_QuickForm( "convertForm", "post", "index.php?option=profileEdition", "", null, true);
$form->removeAttribute( "name" );
$form->setRequiredNote ("* Los campos marcados con asterisco son obligatorios");


$textField = $form->addElement( "text", "name", "Nombre" );
$textField->setMaxLength("30");
$textField->setValue($name);
$form->addRule( "name", "Introduce tu nick", "required");
$form->addRule( "name", "El nombre sólo puede contener letras y guiones", "regex", "/^[\\-_a-zA-Z0-9]+$/" );


$textField = $form->addElement( "text", "surname", "Apellidos" );
$textField->setMaxLength("50");
$textField->setValue($surname);
$form->addRule( "surname", "Introduce tus apellidos", "required");
$form->addRule( "surname", "El apellido sólo puede contener letras y guiones", "regex", "/^[\\-_a-zA-Z0-9]+$/" );

$textField = $form->addElement( "text", "phoneNumber", "Teléfono de contacto" );
$textField->setMaxLength("9");
$textField->setValue($phoneNumber);
$form->addRule("phoneNumber", "El teléfono no es correcto", "numeric");
$form->addRule("phoneNumber", "Compruebe teléfono", "minlength",9);

$ageArray = array();
$ageArray [] = "-";

for ($cont = 18 ; $cont <= 100 ; $cont ++)
    $ageArray[] = $cont;

$combo = $form->addElement( "select", "age", "Edad", $ageArray );
$combo->setSelected($age - 17);


$streetTextField = $form->addElement( "text", "streetName", "Calle" );
$form->addRule("streetName", "Por favor, la calle", "regex","/^[a-zA-Zá-úÁ-Ú0-9 \\-,]+$/");
$streetTextField->setValue($streetName);
$streetTextField->setMaxLength("30");

$cpTextField=$form->addElement( "text", "postalCode", "CP" );
$form->addRule("postalCode", "El código postal no es correcto", "numeric");
$form->addRule("postalCode", "Compruebe su Código postal", "minlength",5);
$form->addRule("postalCode", "Compruebe su Código postal", "maxlength",5);
$cpTextField->setValue($postalCode);
$cpTextField->setMaxLength("5");

$numberTextField = $form->addElement( "text", "number", "Número" );
$form->addRule("number", "Comprueba tu número", "maxlength",5);
$form->addRule("number", "Por favor, la puerta", "regex","/^[a-zA-Z0-9]+$/");
$numberTextField->setValue($number);
$numberTextField->setMaxLength("6");

$floorTextField = $form->addElement( "text", "floor", "Piso" );
$form->addRule("floor", "El piso debe ser numérico", "numeric");
$floorTextField->setMaxLength("3");
$floorTextField->setValue($floor);

$doorTextField = $form->addElement( "text", "door", "Puerta" );
$form->addRule("door", "Por favor, la puerta", "regex","/^[a-zA-Z0-9 \\-]+$/");
$doorTextField->setMaxLength("3");
$doorTextField->setValue($door);

$form->addElement("hidden", "idUser", $userLogged->getValueDecoded('idUser'));

$form->addElement("submit", "Terminar", "Terminar" );

if ( $form->isSubmitted() and $form->validate() ) {

    $form->process("processForm" );

} else {

    echo $form->toHtml();

}