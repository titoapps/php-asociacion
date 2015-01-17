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

      <h2>Adhesión a la asociación</h2>

      <h3 class="titulo_seccion">¿Por qué asociarte?</h3>

     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ex odio, tempus sed condimentum in, efficitur eget risus.
     Suspendisse dignissim non metus sit amet hendrerit. Nulla blandit ipsum ante, non iaculis libero vestibulum non.
     Nunc eu nunc quam. Integer commodo, lacus sed vulputate cursus, ex dolor sagittis sem, malesuada vehicula purus nulla
      quis leo. Integer sed orci et sapien viverra efficitur.
    </p>
    <h3 class="titulo_seccion">Formulario de adhesión a la asociación</h3>
    <h4> * Una vez rellenado este formulario un representante de la Asociación se pondrá en contacto con usted para validar y firmar la afiliación. </h4>';



$form = new HTML_QuickForm( "asociateForm", "post", "index.php?option=asociate", "", null, true);
$form->removeAttribute( "name" );
$form->setRequiredNote ("* Los campos marcados con asterisco son obligatorios");


$fieldset = $form->addElement('fieldset','datos','datos');
//$fieldset->set('Name:')->setSeparator(',&nbsp;');
//$fieldset->setLabel('Datos de contacto');

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

$textField = $form->addElement( "text", "phone", "Teléfono de contacto" );
$textField->setMaxLength("9");
$form->addRule("phone", "El teléfono no es correcto", "numeric");
$form->addRule("phone", "Compruebe teléfono", "minlength",9);

$emailTextField = $form->addElement( "text", "email", "Correo electrónico" );
$form->addRule( "email", "Por favor, introduce tu correo electrónico", "required");
$form->addRule( "email", "Por favor, introduce una direccion de correo electrónico valida", "email");
$form->addRule( "email", "El correo electrónico ya esta registrado", "callback",'checkEmail');
$emailTextField->setMaxLength("30");

$emailTextField = $form->addElement( "text", "bussinesname", "Nombre del comercio" );
$form->addRule( "bussinesname", "Por favor, introduce el nombre del comercio", "required");
$form->addRule( "bussinesname", "Por favor, compruebe el nombre del comercio", "regex","/^[a-zA-Zá-úÁ-Ú0-9 \\-,]+$/");
$emailTextField->setMaxLength("50");

$cpTextField = $form->addElement( "text", "CP", "CP" );
$form->addRule( "CP", "El código postal no es correcto", "numeric");
$form->addRule( "CP", "Compruebe su Código postal", "minlength",5);
$form->addRule( "CP", "Compruebe su Código postal", "maxlength",5);
$cpTextField->setMaxLength("5");

$activities = array();
$activities [] = "- seleccione -";

foreach ($allActivities as $activity) {
    $activities[] = $activity->getValueDecoded('activityName');
    $activityName = $activity->getValueDecoded('activityName');
}
$activitySelect = $form->addElement( "select", "activityInputSearch", "Actividad", $activities);
$form->addRule( "activityInputSearch", "Por favor, seleccione la actividad", "required");


$streets = array();
$streets [] = "- seleccione -";

foreach ($allStreets as $street) {
    $streetName = $street->getValueDecoded('streetName');
    $streets [] = $streetName;
}
$activitySelect = $form->addElement( "select", "streetInputName", "Calle", $streets);
$form->addRule( "streetInputName", "Por favor, seleccione la calle", "required");

$numberTextField = $form->addElement( "text", "streetNumber", "Número" );
$form->addRule("streetNumber", "Comprueba tu número", "maxlength",5);
$form->addRule("streetNumber", "Por favor, introduce el número de la calle", "required");
$numberTextField->setMaxLength("5");

$floorTextField = $form->addElement( "text", "floor", "Piso" );
$floorTextField->setMaxLength("3");
$form->addRule("floor", "El piso debe ser numérico", "numeric");

$doorTextField = $form->addElement( "text", "door", "Puerta" );
$form->addRule("door", "Por favor, la puerta", "regex","/^[a-zA-Z0-9 \\-]+$/");
$doorTextField->setMaxLength("3");

$form->addElement( "textarea", "text", "Comentarios" );

$paymenyOptions = array();
$radioButton = HTML_QuickForm::createElement( "radio", null, null, " Transferencia bancaria o Ingreso por cajero en Caja Cantabria cuenta nº 1234 5678 01 0123456789 MUY IMPORTANTE, hacer constar: Importe: 90 € <br>", "account");
$paymenyOptions[] = $radioButton;
$paymenyOptions[] = HTML_QuickForm::createElement( "radio", null, null, " En Efectivo, cuando pase por mi domicilio la persona autorizada a confirmar la Inscripción  <br> <br>", "cash" );
$form->addGroup( $paymenyOptions, "payment", "Forma de pago", "  " );
$radioButton->setChecked(true);

$form->addElement( "submit", "send", "Enviar" );

if ( $form->isSubmitted() and $form->validate() ) {

    $form->process("processForm");

} else {

    echo $form->toHtml();
    echo '<p> * La cuota de Inscripción son 40 € y la cuota anual 50 €. Se abonarán las dos juntas al realizar la Inscripción.
(Forma de pago Inscripción y Cuota 2015)</p>';
}
/*
echo '</div>';

    echo'
      <form action="" method="POST" xmlns="http://www.w3.org/1999/html">
            <fieldset>
            <legend>Datos de contacto</legend>

            <label class="element_above" for="name">Nombre</label>
            <input class="element_above" type="text" id="name" name="name" required="required"/>

            <label class="element_above" for="surname">Apellidos</label>
            <input class="element_above" type="text" id="surname" name="surname" required="required"/>

            <label class="element_above" for="nif">NIF/NIE</label>
            <input type="text" id="nif" name="nif" required="required"/>

            <label class="element_above" for="phone">Telefono de contacto</label>
            <input type="text" id="text" name="phone" required="required"/>

            <label class="element_above" for="email">Email</label>
            <input class="element_above" type="email" id="email" name="email" required="required"/>
            </fieldset>
            <br/><br/>

            <fieldset>
            <legend>Datos del comercio</legend>
            <label class="element_above" for="bussinesname">Nombre del comercio</label>
            <input class="element_above" type="text" id="bussinesname" name="bussinesname" required="required"/>
            <label class="element_above" for="CP">Código postal</label>
            <input type="text" id="CP" name="CP" required="required"/>

            <br/><br/>
            <label for="activityInputSearch">Actividad</label>
            <select id="activityInputSearch" name="activityInputSearch" required="required">
                <option value="" selected="selected">- seleccione -</option>';

                foreach ($allActivities as $activity) {

                    $activityName = $activity->getValueDecoded('activityName');

                    echo '<option value="'.$activityName.'">'.$activityName.'</option>';

                }

                echo'</select>


                <label for="streetInputName">Calle</label>
                <select id="streetInputName" name="streetInputName" required="required">
                    <option value="" selected="selected">- seleccione -</option>';


                    foreach ($allStreets as $street) {

                        $streetName = $street->getValueDecoded('streetName');

                        echo '<option value="'.$streetName.'">'.$streetName.'</option>';

                    }

                    echo '</select>

            <br/><br/>

            <label for="streetNumber">Número</label>
            <input type="text" id="streetNumber" name="streetNumber" required="required"/>
            <label for="floor">Piso</label>
            <input type="text" id="floor" name="floor"/>

            <label for="door">Puerta</label>
            <input type="text" id="door" name="door"/>

            <br/>

            <br/>
            <label for="text">Comentarios</label>
            <textarea class="element_above" id="text" name="text" rows="5"  ></textarea>

            </fieldset>

        <fieldset>
            <legend>Datos de pago</legend>
            <p> * La cuota de Inscripción son 40 € y la cuota anual 50 €. Se abonarán las dos juntas al realizar la Inscripción.
             Forma de pago Inscripción y Cuota 2014 marcar con una cruz lo que proceda:</p>
            <input type="radio" name="payment" value="account" required="required"/>
            Transferencia bancaria o Ingreso por cajero en Caja Cantabria cuenta nº 1234 5678 01 0123456789 MUY IMPORTANTE, hacer constar: Importe: 90 €<br/><br/>
            <input type="radio" name="payment" value="cash"/>En Efectivo, cuando pase por mi domicilio la persona autorizada a confirmar la Inscripción
       </fieldset>

       <input type="submit" id="send" name="send">
      </form>
  </div>';*/