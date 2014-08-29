<?php

echo'<div id="buscador">
    <h2>¿Dónde comprar?</h2>
    <form action="#">
        <fieldset>
            <legend>Buscador de comercios</legend>
            <div class="form_item">
                <label for="nameInputSearch">Nombre</label>
                <input type="text" id="nameInputSearch" name="nameInputSearch" value="" />
            </div>
            <div class="form_item">
                <label for="activityInputSearch">Actividad</label>
                <select id="activityInputSearch" name="activityInputSearch">
                    <option value="" selected="selected">- seleccione -</option>';

                    foreach ($allActivities as $activity) {

                        $activityName = $activity->getValueDecoded('activityName');

                        echo '<option value="'.$activityName.'">'.$activityName.'</option>';

                    }

                    echo'</select>
            </div>
            <div class="form_item">
                <label for="streetInputName">Calle</label>
                <select id="streetInputName" name="streetInputName">
                    <option value="" selected="selected">- seleccione -</option>';


                    foreach ($allStreets as $street) {

                        $streetName = $street->getValueDecoded('streetName');

                        echo '<option value="'.$streetName.'">'.$streetName.'</option>';

                    }

                echo '</select>
            </div>
            <input class="form_item" type="button" value="Buscar" name="search" onclick="searchShop()"/>
          </fieldset>
          </form>
          </div>';