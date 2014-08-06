<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 29/07/14
 * Time: 21:19
 */

echo '<h2>Contacta con nosotros</h2> ';


        echo'<h3 class="titulo_seccion">Para cualquier duda o sugerencia escribanos a traves de nuestro formulario de contacto</h3>';

        echo'<form action="#">
                <fieldset>
                    <legend>Contacto</legend>
                    <div class="form_item">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" value="" />
                    </div>
                    <div class="form_item">
                        <label for="surname">Apellidos</label>
                        <input type="text" id="surname" name="surname" value="" />
                    </div>
                    <div class="form_item">
                        <label for="email">Email</label>
                        <input type=email id="email" name="email" value="" />
                    </div>
                    <div class="form_item">
                        <label for="phone">Teléfono</label>
                        <input type="text" id="phone" name="phone" value="" />
                    </div>
                    <div class="form_item">
                        <label for="subject">Tema</label>
                        <input type="text" id="subject" name="subject" value="" />
                    </div>
                    </br>
                        <textarea id="content" name="content" cols="40" rows="10"></textarea>
                        <input type="submit">
                </fieldset>
              </form>';


?>