<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 11/08/14
 * Time: 19:21
 */

echo '<div id="main_content">
      <h2>Contacto</h2>
      <div class="center_container" >
      <form action="" method="POST" xmlns="http://www.w3.org/1999/html">
        <fieldset>
            <legend>Formulario de contacto</legend>

            <label class="element_above" for="email">Email</label>
            <input class="element_above_fill" type="email" id="email" name="email" required="required"/>

            <label class="element_above" for="subject">Asunto</label>
            <input class="element_above_fill" type="text" id="subject" name="subject" required="required"/>

            <br><br>
            <textarea class="element_above_fill" id="text" name="text" required="required" rows="15"></textarea>
<br/><br/>
    <img src="modules/captcha/captcha.php"/><br/>
	<input type="text" size="16" name="captcha" required="required"/>
	<br/><br/>
            <input type="submit" id="send" name="send">
        </fieldset>
      </form>
      </div></div>
     ';