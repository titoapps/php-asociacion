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
        <b> Nick :</b><span id="nickName" title = "'. $nickName .'"> '. $nickName .'</span><br>
        <b> Nombre :</b><span id="name" title = "'. $name .'"> '. $name .'</span><br>
        <b> Apellido :</b><span id="surname" title = "'. $surname .'"> '. $surname .'</span><br>
        <b> Telefono :</b><span id="phoneNumber" title = "'. $phoneNumber .'"> '. $phoneNumber .'</span><br>
        <b> Email :</b><span id="email" title = "'. $email .'"> '. $email .'</span><br>
        <b> Edad :</b><span id="age" title = "'. $age .'"> '. $age .'</span><br>
        <b> Direccion :</b><span id="streetName" title = "'. $streetName .'"> '. $streetName .'</span> <span id="number" title="'.$number.'"> Número '. $number.'</span> <span id="floor" title="'.$floor.'">'. $floor.'</span> <span id="door" title = "'.$door.'">'. $door.'<br>
        <b> CP :</b><span id="postalCode" title = "'. $postalCode .'"> '. $postalCode .'</span><br>
        <form id="editForm" action="index.php?option=profileEdition" method="POST">
            <input type="hidden" id="idUser" name = "idUser" value ='.$userLogged->getValueDecoded('idUser').'>
            <input type="submit" name ="Editar" title="Editar" value="Editar">
        </form>
        <form id="editForm" action="index.php?option=profile" method="POST">
            <input type="hidden" id="idUser" name = "idUser" value ='.$userLogged->getValueDecoded('idUser').'>
            </br>
            <input type="file" id="profileImage" name ="profileImage" title="Cambiar foto" value="profileImage">
        </form>

        </div>
    </div>';
