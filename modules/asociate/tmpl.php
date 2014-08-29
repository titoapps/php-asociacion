<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 11/08/14
 * Time: 19:21
 */

echo '<div id="main_content">

      <h2>Adhesión a la asociación</h2>

      <h3 class="titulo_seccion">¿Por qué asociarte?</h3>

     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ex odio, tempus sed condimentum in, efficitur eget risus.
     Suspendisse dignissim non metus sit amet hendrerit. Nulla blandit ipsum ante, non iaculis libero vestibulum non.
     Nunc eu nunc quam. Integer commodo, lacus sed vulputate cursus, ex dolor sagittis sem, malesuada vehicula purus nulla
      quis leo. Integer sed orci et sapien viverra efficitur.
    </p>

    <h3 class="titulo_seccion">Formulario de adhesión a la asociación</h3>
    <h4> * Una vez rellenado este formulario un representante de la Asociación se pondrá en contacto con usted para validar y firmar la afiliación. </h4>
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
  </div>';