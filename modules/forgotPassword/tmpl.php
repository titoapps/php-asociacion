<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 18/1/15
 * Time: 20:00
 */


require_once("QuickForm.php");
include_once 'tools/Tools.php';

echo '<div id="main_content">

      <h2>¿Olvidó su contraseña?</h2>

      <h3 class="titulo_seccion">¿Qué puedo hacer como usuario?</h3>

     <p>No pasa nada, puedes recuperar tu contraseña rellenando el siguiente formulario y en seguida podrás acceder de nuevo.
     Introduce el email con el que te registraste o tu nick.
    </p>';

$form = new HTML_QuickForm( "convertForm", "post", "index.php?option=forgotPassword", "", null, true);
$form->removeAttribute( "name" );

$textField = $form->addElement( "text", "nickName", "Nick");
$textField->setMaxLength("20");
$form->addRule( "nickName", "El nick sólo puede contener números, letras y guiones", "regex", "/^[\\-_a-zA-Z0-9]+$/" );

$emailTextField = $form->addElement( "text", "email", "Correo electrónico" );
$form->addRule( "email", "Por favor, introduce una dirección de correo electrónico válida", "email");
$emailTextField->setMaxLength("30");

$genderOptions = array();

$form->addElement( "submit", "forgetPass", "Enviar" );

if ( $form->isSubmitted() and $form->validate() ) {

    $form->process();

} else {

    echo $form->toHtml();

}

echo '</div>';
