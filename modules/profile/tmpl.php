<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 21/11/14
 * Time: 18:55
 */

echo'<div id="main_content">
      <h2>Mi Perfil</h2>
        <div id="profile">
        <img src='.$userImage->getValueDecoded('path').'> </img>

        <b> Nick</b> '. $userLogged->getValueDecoded('nickName').'<br>
        <b> Nombre </b> '. $userLogged->getValueDecoded('name').'<br>
        <b> Apellido </b> '. $userLogged->getValueDecoded('surname').'<br>
        <b> Telefono </b> '. $userLogged->getValueDecoded('phoneNumber').'<br>
        <b> Email </b> '. $userLogged->getValueDecoded('email').'<br>
        <b> Edad </b> '. $userLogged->getValueDecoded('age').'<br>
        <b> Direccion </b> '. $userLogged->getValueDecoded('streetName').' '. $userLogged->getValueDecoded('number').' '. $userLogged->getValueDecoded('floor').' '. $userLogged->getValueDecoded('door').'<br>
        <b> CP </b> '. $userLogged->getValueDecoded('postalCode').'<br>
        <a href="#" class="ampliar_info" onclick="startEdition()">Cambiar Imagen</a> <a href="#" class="ampliar_info" onclick="startEdition()">Editar</a>
        </div>
        </div>';

