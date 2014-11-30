<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 30/11/14
 * Time: 20:50
 */


//TODO:check send and complete
$form = new HTML_QuickForm( "convertForm", "post", "index.php?option=profile", "", null, true);
$form->removeAttribute( "name" );
$form->setAttribute( "hidden","true");
$form->setRequiredNote ("* Los campos marcados con asterisco son obligatorios");

$textField = $form->addElement( "text", "nickName", "Nick" );
$textField->setMaxLength("20");
$textField->setValue($nickName);
$form->addRule( "nickName", "Introduce tu nick", "required");
$form->addRule( "nickName", "El nick ya existe", "callback","checkNick");
$form->addRule( "nickName", "El nick sólo puede contener números, letras y guiones", "regex", "/^[\\-_a-zA-Z0-9]+$/" );

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
$form->addRule("phone", "El teléfono no es correcto", "numeric");
$form->addRule("phone", "Compruebe teléfono", "minlength",9);

$emailTextField = $form->addElement( "text", "email", "Correo electrónico" );
$emailTextField->setValue($email);
$form->addRule( "email", "Por favor, introduce tu correo electrónico", "required");
$form->addRule( "email", "Por favor, introduce una direccion de correo electrónico valida", "email");
$emailTextField->setMaxLength("30");

$ageArray = array();
$ageArray [] = "-";

for ($cont = 18 ; $cont <= 100 ; $cont ++)
    $ageArray[] = $cont;

$combo = $form->addElement( "select", "age", "Edad", $ageArray );
$combo->setSelected($age - 17);


$streetTextField = $form->addElement( "text", "streetName", "Calle" );
$form->addRule( "streetName", "Por favor, la calle", "regex","/^[a-zA-Zá-úÁ-Ú0-9 \\-,]+$/");
$streetTextField->setValue($streetName);
$streetTextField->setMaxLength("30");

$cpTextField=$form->addElement( "text", "postalCode", "CP" );
$form->addRule( "postalCode", "El código postal no es correcto", "numeric");
$form->addRule( "postalCode", "Compruebe su Código postal", "minlength",5);
$form->addRule( "postalCode", "Compruebe su Código postal", "maxlength",5);
$cpTextField->setValue($postalCode);
$cpTextField->setMaxLength("5");

$numberTextField = $form->addElement( "text", "number", "Número" );
$form->addRule( "number", "Comprueba tu número", "maxlength",5);
$numberTextField->setValue($number);
$numberTextField->setMaxLength("6");

$floorTextField = $form->addElement( "text", "floor", "Piso" );
$floorTextField->setMaxLength("3");

$doorTextField = $form->addElement( "text", "door", "Puerta" );
$doorTextField->setMaxLength("3");


$form->addElement( "hidden", "idUser", $userLogged->getValueDecoded('idUser'));

$form->addElement( "submit", "Terminar", "Terminar" );

if ( $form->isSubmitted() and $form->validate() ) {

    $form->process( "processForm" );

} else {

    echo '<h3 class="titulo_seccion" id="title" hidden="hidden">Formulario de alta de usuario</h3>';
    echo $form->toHtml();

}