<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 11/08/14
 * Time: 19:21
 */

require_once("HTML/QuickForm.php");

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
$form->addRule( "dni", "Comprueba tu DNI", "regex","/^[0-9]+8[a-zA-Z]/");
$form->addRule( "dni", "El DNI ya está registrado", "callback",'checkDNI');

$age = array();
$age [] = "-";

for ($cont = 18 ; $cont <= 100 ; $cont ++)
    $age[] = $cont;

$form->addElement( "select", "age", "Edad", $age );

$textField = $form->addElement( "text", "phone", "Teléfono de contacto" );
$textField->setMaxLength("9");
//$form->addRule( "phone", "Por favor, introduce tu telefono", "required");
$form->addRule( "phone", "El teléfono no es correcto", "numeric");
$form->addRule( "phone", "Compruebe teléfono", "minlength",9);

$form->addElement( "text", "email", "Correo electrónico" );
$form->addRule( "email", "Por favor, introduce tu correo electrónico", "required");
$form->addRule( "email", "Por favor, introduce una direccion de correo electrónico valida", "email");
$form->addRule( "email", "El correo electrónico ya esta registrado", "callback",'checkEmail');

$genderOptions = array();
//TODO:seleccionar por defecto una
$radioButton = HTML_QuickForm::createElement( "radio", null, null, " Hombre", "M");
//$radioButton->setAttributes(array("selected" => "selected"));
$genderOptions[] = $radioButton;
$genderOptions[] = HTML_QuickForm::createElement( "radio", null, null, " Mujer", "F" );
$form->addGroup( $genderOptions, "gender", "Sexo", "  " );

$form->addElement( "text", "streetInputName", "Calle" );
$form->addRule( "streetInputName", "Por favor, comprueba tus apellidos", "regex","/^[a-zA-Zá-úÁ-Ú0-9 \\-,/]+$/");

//TODO:Checkear desde aqui. Longitud maxima en el propio campo?? sin tener que checkear?
$form->addElement( "text", "CP", "CP" );
$form->addRule( "CP", "El código postal no es correcto", "numeric");
$form->addRule( "CP", "Compruebe su Código postal", "minlength",5);
$form->addRule( "CP", "Compruebe su Código postal", "maxlength",5);

$form->addElement( "text", "streetNumber", "Número" );
$form->addRule( "streetNumber", "Comprueba tu número", "maxlength",5);

$form->addElement( "text", "floor", "Piso" );

$form->addElement( "text", "door", "Puerta" );

$form->addElement( "submit", "addUser", "Dar de alta" );

if ( $form->isSubmitted() and $form->validate() ) {

    $form->process( "processForm" );

} else {

    echo '<h3 class="titulo_seccion">Formulario de alta de usuario</h3>';
    echo $form->toHtml();

}

echo '</div>';






/*
echo '<div id="main_content">

      <h2>Alta nuevo usuario</h2>

      <h3 class="titulo_seccion">¿Qué puedo hacer como usuario?</h3>

     <p>Podrás participar en los contenidos de la web y disfrutar de las promociones que pronto pondremos en marcha. Recibirás,
     si así lo deseas, todas las novedades interesantes en tu correo electrónico, con codigos y descuentos exclusivos.
     ¿A que esperas? ¡Date de alta ya!
    </p>

    <h3 class="titulo_seccion">Formulario de alta de usuario</h3>
      <form action="" method="POST" xmlns="http://www.w3.org/1999/html">
        <fieldset>
            <legend>Datos de contacto</legend>

            <label class="element_above" for="nickName">Nick</label>
            <input type="text" id="nickName" name="nickName" required="required" value = "nickName"/>
            <br/>

            <label class="element_above" for="password">Contraseña</label>
            <input type="text" id="password" name="password" required="required"/>
                        <br/>

            <label class="element_above" for="repeatpassword">Repita Contraseña</label>
            <input type="text" id="repeatpassword" name="repeatpassword" required="required"/>
            <br/><br/>

            <label class="element_above" for="name">Nombre</label>
            <input class="element_above" type="text" id="name" name="name" required="required" value = "name"/>
            <br/>
            <label class="element_above" for="surname">Apellidos</label>
            <input class="element_above" type="text" id="surname" name="surname" required="required" value = "surname"/>
            <br/>
            <label for="nif">NIF</label>
            <input type="text" id="nif" name="nif" required="required" value = "123456789F"/>

            <label for="age">Edad</label>
            <select id="age" name="age" required="required" value = "20">
                <option value="" selected="selected">- seleccione -</option>';

for ($cont = 18 ; $cont <=100 ; $cont ++) {

    echo '<option value="'.$cont.'">'.$cont.'</option>';

}

echo'</select>

            <label for="phone">Telefono de contacto</label>
            <input type="text" id="text" name="phone" required="required" value = "600000000"/>
            <br/><br/>
            <label class="element_above" for="email">Email</label>
            <input class="element_above" type="email" id="email" name="email" required="required" value = "pepe@gmail.com"/>
            <br/>
            <label class="element_above" for="gender">Sexo</label><br/>
            <input type="radio" name="gender" value="M" required="required" checked="checked"/>Hombre
            <input type="radio" name="gender" value="F"/>Mujer

            </fieldset>
            <br/><br/>


            <fieldset>
            <legend>Datos del domicilio</legend>
            <label for="streetInputName">Calle</label>
            <input class="element_above" type="text" id="streetInputName" name="streetInputName" required="required" value = "Floranes"/>
            <label class="element_above" for="CP">Código postal</label>
            <input type="text" id="CP" name="CP" required="required" value = "39010"/>

            <br/><br/>

            <label for="streetNumber">Número</label>
            <input type="text" id="streetNumber" name="streetNumber" required="required" value = "1"/>
            <label for="floor">Piso</label>
            <input type="text" id="floor" name="floor" value = "2"/>

            <label for="door">Puerta</label>
            <input type="text" id="door" name="door" value = "B"/>


        </fieldset>
        </br>

       <input type="submit" id="addUser" name="addUser">
      </form>
  </div>';*/