<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:42
 */
echo '<h3>Área Privada</h3>
   			<div id="acceso_asociados">
   			    <form action="" method="POST" >
                	<fieldset>';

if ($userName == null) {

        echo'<legend>Acceso Asociados</legend>
            <label class="element_above" for="user">Usuario</label>
            <input type="text" value="" id="user" name="user" required="required"/>

            <label class="element_above" for="password">Clave</label>
            <input type="password" value="" id="password" name="password" required="required"/>

            <input type="submit" name="login" value="Acceder"/>

            <br/>';

        if ($loginError) {

            echo '<p class="error">Error de autenticación, el usuario o contraseña no son correctos</p>';

        }

        echo'<a href="#" class="ampliar_info" title="Olvido de clave">¿Contraseña olvidada?</a>
        <br/>
        </form>

        <form action="index.php?option=newuser" method="POST" ><!-- we set this here to avoid the text inputs validation-->
        <p><input type="submit" name="newuser" value="Nuevo Usuario"/></fieldset></p>
        </form>
        </div>';

} else {

    echo '<legend>Bienvenido</legend>
                ¡Hola '.$userName.' !
                <input type="submit" name="logout" value="Salir"/>
                <input type="button" name="profile" value="Mi perfil" onClick="window.location = \'index.php?option=profile\';"/>
                </fieldset>
            </form>
            </div>';

}

