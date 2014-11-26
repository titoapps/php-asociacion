<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 21/11/14
 * Time: 18:55
 */

echo'<script type="text/javascript" src="js/ProfileUtilities.js"></script>

    <div id="main_content">
      <h2>Mi Perfil</h2>
        <div id="profile">
        <img src='.$userImage->getValueDecoded('path').'> </img>
        <input type="hidden" id="idUser" title ='.$userLogged->getValueDecoded('idUser').'>
        <b> Nick</b><span id="nickName" title = "'. $userLogged->getValueDecoded('nickName').'"> '. $userLogged->getValueDecoded('nickName').'</span><br>
        <b> Nombre </b><span id="name" title = "'. $userLogged->getValueDecoded('name').'"> '. $userLogged->getValueDecoded('name').'</span><br>
        <b> Apellido </b><span id="surname" title = "'. $userLogged->getValueDecoded('surname').'"> '. $userLogged->getValueDecoded('surname').'</span><br>
        <b> Telefono </b><span id="phoneNumber" title = "'. $userLogged->getValueDecoded('phoneNumber').'"> '. $userLogged->getValueDecoded('phoneNumber').'</span><br>
        <b> Email </b><span id="email" title = "'. $userLogged->getValueDecoded('email').'"> '. $userLogged->getValueDecoded('email').'</span><br>
        <b> Edad </b><span id="age" title = "'. $userLogged->getValueDecoded('age').'"> '. $userLogged->getValueDecoded('age').'</span><br>
        <b> Direccion </b><span id="streetName" title = "'. $userLogged->getValueDecoded('streetName').'"> '. $userLogged->getValueDecoded('streetName').'</span> <span id="number">'. $userLogged->getValueDecoded('number').'</span> <span id="floor">'. $userLogged->getValueDecoded('floor').'</span> <span id="door">'. $userLogged->getValueDecoded('door').'<br>
        <b> CP </b><span id="postalCode" title = "'. $userLogged->getValueDecoded('postalCode').'"> '. $userLogged->getValueDecoded('postalCode').'</span><br>
        <a href="#" class="ampliar_info" onclick="startEdition()">Editar</a>
        </div>
    </div>';
