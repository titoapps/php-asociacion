<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:42
 */

echo '<h3>Área Privada</h3>
   			<div id="acceso_asociados">
            	<form action="modules/user/doLogin.php" method="POST">
                	<fieldset>
                    	<legend>Acceso Asociados</legend>
                    	<label class="element_above" for="user">Usuario</label>
                    	<input type="text" value="" id="user" name="user" required="required"/>

                    	<label class="element_above" for="password">Clave</label>
                    	<input type="password" value="" id="password" name="password" required="required"/>

                    	<input type="submit" name="login" value="Acceder"/>

                    	<br/>
                        <a href="#" class="ampliar_info" title="Olvido de clave">¿Contraseña olvidada?</a>
                        <br/>

                    	<p><label for="recordarme">Recordarme </label>
                    	<input type="checkbox" value="recordarme" id="recordarme" checked="checked"/></p>

                    	<input type="submit" name="newuser" value="Nuevo Usuario"/>

                    </fieldset>
                </form>
            </div>';