<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 11/08/14
 * Time: 19:21
 */

require_once("QuickForm.php");
include_once 'tools/Tools.php';

echo '<div id="main_content">

      <h2>Alta nuevo usuario</h2>

      <h3 class="titulo_seccion">¿Qué puedo hacer como usuario?</h3>

     <p>Podrás participar en los contenidos de la web y disfrutar de las promociones que pronto pondremos en marcha. Recibirás,
     si así lo deseas, todas las novedades interesantes en tu correo electrónico, con codigos y descuentos exclusivos.
     ¿A que esperas? ¡Date de alta ya!
    </p>';

$form = new HTML_QuickForm( "convertForm", "post", "index.php?option=newuser", "", null, true);
$form->removeAttribute( "name" );
$form->setRequiredNote ("* Los campos marcados con asterisco son obligatorios");

$textField = $form->addElement( "text", "nickName", "Nick" );
$textField->setMaxLength("20");
$form->addRule( "nickName", "Introduce tu nick", "required");
$form->addRule( "nickName", "El nick ya existe", "callback","checkNick");
$form->addRule( "nickName", "El nick sólo puede contener números, letras y guiones", "regex", "/^[\\-_a-zA-Z0-9]+$/" );

$textField = $form->addElement( "password", "password", "Contraseña" );
$textField->setMaxLength("30");
$form->addRule( "password", "Elige una contraseña", "required");
$form->addRule( "password", "La contraseña debe ser mas larga de 6 caracteres", "minlength",6);
$form->addRule( "password", "La contraseña sólo puede contener números, letras y guiones", "regex", "/^[\\-_a-zA-Z0-9]+$/");

$textField = $form->addElement( "password", "repeatpassword", "Repite tu contraseña" );
$textField->setMaxLength("30");
$form->addRule( array( "password", "repeatpassword" ), "Por favor, comprueba que las dos contraseñas coinciden", "compare" );

$textField = $form->addElement( "text", "name", "Nombre" );
$textField->setMaxLength("30");
$form->addRule( "name", "Por favor, introduce tu nombre", "required");
$form->addRule( "name", "Por favor, comprueba tu nombre", "regex","/^[a-zA-Zá-úÁ-Ú ]+$/");

$textField = $form->addElement( "text", "surname", "Apellidos" );
$textField->setMaxLength("50");
$form->addRule( "surname", "Por favor, introduce tus apellidos", "required");
$form->addRule( "surname", "Por favor, comprueba tus apellidos", "regex","/^[a-zA-Zá-úÁ-Ú \\-,]+$/");

$textField = $form->addElement( "text", "dni", "DNI" );
$textField->setMaxLength("9");
$form->addRule( "dni", "Introduce tu DNI", "required");
$form->addRule( "dni", "El DNI ya está registrado", "callback",'checkDNIExists');
$form->addRule( "dni", "El DNI no es correcto", "callback",'checkValidDNI');

$age = array();
$age [] = "-";

for ($cont = 18 ; $cont <= 100 ; $cont ++)
    $age[] = $cont;

$form->addElement( "select", "age", "Edad", $age );

$textField = $form->addElement( "text", "phone", "Teléfono de contacto" );
$textField->setMaxLength("9");
$form->addRule("phone", "El teléfono no es correcto", "numeric");
$form->addRule("phone", "Compruebe teléfono", "minlength",9);

$emailTextField = $form->addElement( "text", "email", "Correo electrónico" );
$form->addRule( "email", "Por favor, introduce tu correo electrónico", "required");
$form->addRule( "email", "Por favor, introduce una direccion de correo electrónico valida", "email");
$form->addRule( "email", "El correo electrónico ya esta registrado", "callback",'checkEmail');
$emailTextField->setMaxLength("30");

$genderOptions = array();
$radioButton = HTML_QuickForm::createElement( "radio", null, null, " Hombre", "M");
$genderOptions[] = $radioButton;
$genderOptions[] = HTML_QuickForm::createElement( "radio", null, null, " Mujer", "F" );
$form->addGroup( $genderOptions, "gender", "Sexo", "  " );
$radioButton->setChecked(true);

$streetTextField = $form->addElement( "text", "streetInputName", "Calle" );
$form->addRule( "streetInputName", "Por favor, comprueba la calle", "regex","/^[a-zA-Zá-úÁ-Ú0-9 \\-,]+$/");
$streetTextField->setMaxLength("30");

$cpTextField = $form->addElement( "text", "CP", "CP" );
$form->addRule( "CP", "El código postal no es correcto", "numeric");
$form->addRule( "CP", "Compruebe su Código postal", "minlength",5);
$form->addRule( "CP", "Compruebe su Código postal", "maxlength",5);
$cpTextField->setMaxLength("5");

$numberTextField = $form->addElement( "text", "streetNumber", "Número" );
$form->addRule("streetNumber", "Comprueba tu número", "maxlength",5);
$form->addRule("streetNumber", "El número debe ser numérico", "numeric");
$numberTextField->setMaxLength("6");

$floorTextField = $form->addElement( "text", "floor", "Piso" );
$floorTextField->setMaxLength("3");
$form->addRule("floor", "El piso debe ser numérico", "numeric");

$doorTextField = $form->addElement( "text", "door", "Puerta" );
$form->addRule("door", "Por favor, la puerta", "regex","/^[a-zA-Z0-9 \\-]+$/");
$doorTextField->setMaxLength("3");

$form->addElement( "submit", "addUser", "Dar de alta" );

if ( $form->isSubmitted() and $form->validate() ) {

    $form->process("processForm");

} else {

    echo '<h3 class="titulo_seccion">Formulario de alta de usuario</h3>';
    echo $form->toHtml();

}

echo '</div>';

