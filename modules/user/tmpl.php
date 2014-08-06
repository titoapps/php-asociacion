<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:42
 */

echo '<h3>Área Privada</h3>
   			<div id="acceso_asociados">
            	<form action="#">
                	<fieldset>
                    	<legend>Acceso Asociados</legend>
                    	<label class="element_above" for="user">Usuario</label>
                    	<input type="text" value="" id="user" required="required"/>
                    	<label class="element_above" for="password">Clave</label>
                    	<input type="password" value="" id="password" required="required"/>
                    	<p><label for="recordarme">Recordarme </label>
                    	<input type="checkbox" value="recordarme" id="recordarme" checked="checked"/></p>
                    	<input class="element_above" type="button" name="login" value="Acceder" onclick="doLogin()"/><br />
                    	<a href="#" class="ampliar_info" title="Olvido de clave">¿Contraseña olvidada?</a>
                    </fieldset>
                </form>
            </div>';