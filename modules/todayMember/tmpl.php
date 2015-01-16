<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 20:10
 */

echo ' <div id="visita_comercio">
            <h2>Visita el comercio de..</h2>
                <!-- Info sobre un comercio, con imagen, logo.. -->
                <a href="index.php?option=members"><img src="'.$path.'" alt="'.$image->getValueDecoded("imageName").'" /></a>

                <a href="index.php?option=members" id>'.$member->getValueDecoded("name").'</a> <br/>

                <span id="descripcion_comercio">'.$member->getValueDecoded("description").'</span>
                <br /> <br />
                <span id="direccion_comercio"> C/ ' .$streetString. '</span>
            </div>';
