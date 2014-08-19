<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 11/08/14
 * Time: 19:21
 */

echo '<div class="center_container" >
      <h2>Contacto</h2>
      <form action="modules/contact/contactForm.php" method="POST" onsubmit="return validateContactForm(this);" xmlns="http://www.w3.org/1999/html">
        <fieldset>
            <legend>Formulario de contacto</legend>

            <label class="element_above" for="email">Email</label>
            <input class="element_above" type="text" id="email" name="email" required="required"/>

            <label class="element_above" for="subject">Asunto</label>
            <input class="element_above" type="text" id="subject" name="subject" required="required"/>

            <br><br>
            <textarea class="element_above" id="text" name="text" required="required" rows="15"></textarea>

            <input type="submit" id="send" name="send">
        </fieldset>
      </form>
      </div>
     ';