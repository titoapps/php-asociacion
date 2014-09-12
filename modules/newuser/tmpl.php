<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 11/08/14
 * Time: 19:21
 */

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
  </div>';