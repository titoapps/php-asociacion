<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 06/08/14
 * Time: 22:22
 */
echo '<div id="member">';
echo '<p><img src="'.$path.'" alt="'.$image->getValueDecoded("imageName").'" />';
echo '<span id="nombre_comercio">'.$member->getValueDecoded("name").'</span><br/>
      <span id="descripcion_comercio">'.$member->getValueDecoded("description").'</span>
      <br/> <br/>
      <span id="direccion_comercio"> C/ ' .$streetString. '</br>
      Telefono : '.$member->getValueDecoded("phoneNumber").'</br> Email:'.$member->getValueDecoded("email").'</span>';

echo '</br></br></br></p></div>';
