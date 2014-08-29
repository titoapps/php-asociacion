<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 03/08/14
 * Time: 18:24
 */


echo '<div id="main_content"><div id="members">
                <h2>Hemos encontrado..</h2>';

if ($totalRows > 0 ) {

    $index = 0;

    foreach ($members as $member) {

        $image = $images [$index];
        $address = $addresses [$index];
        $street = $streets [$index];

        $streetString = $street->getValueDecoded("streetName").' '.$address->getValueDecoded("number");

        $floor = $address->getValueDecoded("floor");

        if ($floor!= null && $floor >= 0 ) {

            $floor = ($floor == 0) ? " Bajo":" Planta ".$floor;

            $streetString = $streetString . $floor;

        }

        if ($address->getValueDecoded("door")!= null )
            $streetString = $streetString. ' Puerta '.$address->getValueDecoded("door");

        echo '<div id="member">';
        echo '<p><img src="'.$image->getValueDecoded("path").'" alt="'.$image->getValueDecoded("imageName").'" />';
        echo '<span id="nombre_comercio">'.$member->getValueDecoded("name").'</span><br/>

                        <span id="descripcion_comercio">'.$member->getValueDecoded("description").'</span>
                        <br /> <br />
                        <span id="direccion_comercio"> C/ ' .$streetString. '</br>
                        Telefono : '.$member->getValueDecoded("phoneNumber").'</br> Email:'.$member->getValueDecoded("email").
                        '</span>';

        echo '</br></br></p></div>';

    }

    echo'</div></div>';

} else {

    echo '<div id="main_content"></br><h3>Vaya! Parece que no existen comercios asociados con esos datos..</h3></div>';

}