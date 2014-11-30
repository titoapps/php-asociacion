<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 21/11/14
 * Time: 18:55
 */
require_once("../../lib/php/HTML/QuickForm.php");
require_once 'modules/tools/Tools.php';

echo'<script type="text/javascript" src="js/ProfileUtilities.js"></script>

    <div id="main_content">
      <h2>Mi Perfil</h2>
        <div id="profile">
        <img class="roundImage" src='.$userImagePath.'> </img>
        <input type="hidden" id="idUser" title ='.$userLogged->getValueDecoded('idUser').'>
        <b> Nick :</b><span id="nickName" title = "'. $nickName .'"> '. $nickName .'</span><br>
        <b> Nombre :</b><span id="name" title = "'. $name .'"> '. $name .'</span><br>
        <b> Apellido :</b><span id="surname" title = "'. $surname .'"> '. $surname .'</span><br>
        <b> Telefono :</b><span id="phoneNumber" title = "'. $phoneNumber .'"> '. $phoneNumber .'</span><br>
        <b> Email :</b><span id="email" title = "'. $email .'"> '. $email .'</span><br>
        <b> Edad :</b><span id="age" title = "'. $age .'"> '. $age .'</span><br>
        <b> Direccion :</b><span id="streetName" title = "'. $streetName .'"> '. $streetName .'</span> <span id="number" title="'.$number.'"> Número '. $number.'</span> <span id="floor" title="'.$floor.'">'. $floor.'</span> <span id="door" title = "'.$door.'">'. $door.'<br>
        <b> CP :</b><span id="postalCode" title = "'. $postalCode .'"> '. $postalCode .'</span><br>
        <a href="index.php?option=profile&editar" class="ampliar_info" onclick="startEdition()">Editar</a>
        </div>
    </div>';
