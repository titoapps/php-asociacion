<?php

require_once('php/configuration/Configuration.php');

/**
 * Draws the site left menu
 */
function drawLeftMenu () {

    echo '
        <div id="leftsecondary">

        	<h3>Área Privada</h3>
   			<div id="acceso_asociados">
            	<form action="#">
                	<fieldset>
                    	<legend>Acceso Asociados</legend>
                    	<label class="element_above" for="user">Usuario</label>
                    	<input type="text" value="" id="user"/>
                    	<label class="element_above" for="password">Clave</label>
                    	<input type="password" value="" id="password"/>
                    	<p><label for="recordarme">Recordarme </label>
                    	<input type="checkbox" value="recordarme" id="recordarme" checked="checked"/></p>
                    	<input class="element_above" type="submit" name="login" value="Acceder"/><br />
                    	<a href="#" class="ampliar_info" title="Olvido de clave">¿Contraseña olvidada?</a>
                    </fieldset>
                </form>
            </div>

            <h3>Asociados</h3>
            <div id="asociados">
            		<a href="#" id="link_asociado1" title="Floranes 19 Fruteria">
                    	<img src="images/members/fruteriafloraneslogo.jpg" alt="Floranes 19 Fruteria"/><br />
                    </a>
                 	<a href="#" id="link_asociado2" title="Carnicería Eño">
            		<img src="images/members/carnicerialogo.jpg" alt="Carnicería Eño"/><br />
                    </a>
                    <a href="#" id="link_asociado3" title="Tasca de Pedro">
                	<img src="images/members/tascalogo.jpg" alt="Tasca de Pedro"/><br />
                	</a>
                <a href="#" class="ampliar_info">Ver Asociados</a>
            </div>

        	<h3>Participe</h3>
            <div id="encuestas">
                <form action="#">
                    <fieldset>
                        <legend>Encuesta</legend>
                        <label>¿Qué le parece la renovación de las aceras de la calle?</label><br/>
                        <input type="radio" name="aceras_calle" value="a_favor" checked="checked" /> Es bueno para la calle.<br/>
                        <input type="radio" name="aceras_calle" value="en_contra" /> Es un engorro, imposible para circular y aparcar.<br/>
                        <input type="radio" name="aceras_calle" value="ns_nc" /> NS/NC<br /><br/>
                        <input type="submit" value="Votar" />
                        <input type="button" value="Resultados" />
                    </fieldset>
                </form>
            </div>

            <h3>Buzón de Sugerencias</h3>
            <div id="buzon">
                <a href="#"><img alt="buzon" src="images/buzon.gif"/><span>Ayúdenos a mejorar</span></a>
            </div>

            <h3>Twitter</h3>
            <div id="twitter">
                <a href="#" title="Seguir en Twitter"><img src="images/twitter_boton1.png" alt="twitter" id="imagen_seguir_twitter"/></a>
                <table id="table_twitter" summary="tweets">
                    <tr>
                        <th scope="col">A.C.C. Floranes y Alonso</th>
                    </tr>
                    <tr>
                        <td id="tweet_1" class="tweet_content">
                            <p class="tweet_text"><strong class="twitter">@eugenmart</strong>:<strong class="twitter">@acfloranesalonso</strong>
                            la promoción de descuentos por las fiestas del patrón ha sido una gran idea, ya tengo mis zapatillas para el verano!</p>
                        </td>
                    </tr>
                    <tr>
                        <td id="tweet_2" class="tweet_content">
                            <p class="tweet_text"><strong class="twitter">@frank_gon</strong>
                            :¿podrían <strong class="twitter">@acfloranesalonso</strong> decirme cual es el horario de oficina de la asociación?
                            No logro encontrarlo en la web.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <h3>Facebook</h3>
            <div id="facebook">
                <a href="#" title="Me gusta"></a>
                <table id="table_facebook" summary="Post en Facebook">
                    <tr>
                        <th scope="col"><a href="#" title="Me gusta A.C.C Floranes y Alonso">A.C.C. Floranes y Alonso
                        <img src="images/facebook.png" alt="facebook" id="imagen_megusta_facebook"/></a></th>
                    </tr>
                    <tr>
                        <td id="facebook_1" class="facebook_content">
                            <h4 class="post_title">Novedades de las Fiestas del Patrón</h4>
                            <p class="post_date">12/05/2013</p>
                            <p class="post_text">Como todos nuestros vecinos saben, este mismo fin de semana se celebran las fiestas
                            de nuestro patrón y queremos que todos puedan disfrutar de ellas. Para ello..</p>
                            <p><a href="#" class="ampliar_info">Leer post..</a></p>
                        </td>
                    </tr>
                    <tr>
                        <td id="facebook_2" class="facebook_content">
                            <h4 class="post_title">Agenda provisonal del fin de semana</h4>
                            <p class="post_date">08/05/2013</p>
                            <p class="post_text">Ya podemos adelantaros la agenda de eventos que hemos programado para el disfrute de todos los vecinos
                            este fin de semana en la Plaza de Numancia. Las fiestas comenzarán con un pequeño..</p>
                            <p><a href="#" class="ampliar_info">Leer post..</a></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div> ';

}

/**
 *
 */
function drawSearchItem () {

    require_once 'php/model/Activities.class.php';
    require_once 'php/model/Street.class.php';

    $allActivities = Activities::getActivities();

    echo'<div id="buscador">
                <h2>¿Dónde comprar?</h2>
                <form action="#">
                <fieldset>
                    <legend>Buscador de comercios</legend>
                    <div class="form_item">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="" />
                    </div>
                    <div class="form_item">
                    <label for="actividad">Actividad</label>
                    <select id="actividad" name="actividad">
                    <option value="" selected="selected">- seleccione -</option>';

    foreach ($allActivities as $activity) {

        $activityName = $activity->getValueDecoded('name');

        echo '<option value="'.$activityName.'">'.$activityName.'</option>';

    }

    echo'</select>
            </div>
            <div class="form_item">
                <label for="calle">Calle</label>
                <select id="calle" name="calle">
                    <option value="" selected="selected">- seleccione -</option>';

    $allStreets = Street::getStreets();

    foreach ($allStreets as $street) {

        $streetName = $street->getValueDecoded('name');

        echo '<option value="'.$streetName.'">'.$streetName.'</option>';

    }

    echo '</select>
            </div>
            <input class="form_item" type="submit" value="Buscar" name="search"/>
          </fieldset>
          </form>
          </div>';

}

function drawTodayMemberItem () {

    require_once 'php/model/Member.class.php';

    $memberInfo = Member::getTodayMember();

    if ($memberInfo) {

        $member = $memberInfo[0];
        $image = $memberInfo[1];

        echo ' <div id="visita_comercio">
                <h2>Visita el comercio de..</h2>
                    <!-- Info sobre un comercio, con imagen, logo.. -->
                    <a href="#"><img src="'.$image->getValueDecoded("path").'" alt="'.$image->getValueDecoded("imageName").'" /></a>

                    <a href="#" id>'.$member->getValueDecoded("name").'</a> <br/>

                    <span id="descripcion_comercio">'.$member->getValueDecoded("description").'</span>
                    <br /> <br />
                    <span id="direccion_comercio">'.$member->getValueDecoded("idAddress").'</span>
                </div>';
    }
}

/**
 * Draws the site main content header (center of the web page)
 */
function drawMainHeader () {

    echo '<div id="main_header">';

    drawSearchItem();
    drawTodayMemberItem();

    echo '</div>';

}

/**
 * Draws the site main content (the center of the web page)
 */
function drawMainContent (){

    echo '   <div id="main_content">
                <div id="noticias">
                    <h2>Noticias</h2>
                    <div class="noticia">
                        <h3 class="titulo_seccion">Comienzan las fiestas del Patrón ¡No te las pierdas!</h3>
                        <p class="fecha">Sabado, 18 de Mayo de 2013</p>
                        <p class="detalle_noticia">Llega el fin de semana y con él nuestro ansiado aniversario, en el que todos podreis participar
                        para hacerlo mas divertido que nunca. Con multitud de eventos, conciertos, concursos y actividades para todos. Elige tus<br />
                        preferidos y diviértete con..</p>
                        <p><a href="#" class="ampliar_info">Leer más..</a></p>
                    </div>
                    <div class="noticia">
                        <h3 class="titulo_seccion">Se ultiman los preparativos para este fin de semana</h3>
                        <p class="fecha">Viernes, 17 de Mayo de 2013</p>
                        <p class="detalle_noticia">Ya tenemos los horarios de todos los eventos programados para la celebracion
                        del fin de semana, en que se conmemorará el 15º aniversario de la asociación...</p>
                        <p><a href="#" class="ampliar_info">Leer más..</a></p>
                    </div>
                    <div class="noticia">
                        <h3 class="titulo_seccion">Ya está en marcha la campaña de promiciones y descuentos</h3>
                        <p class="fecha">Lunes, 6 de Mayo de 2013</p>
                        <p class="detalle_noticia">Como todos los años sobre estas fechas los comercios de la asociación ya empiezan la campaña de
                        promociones por las fiestas del patrón. Además de los descuentos, por cada compra superior a 15€ podrás participar en el sorteo
                        de regalos..</p>
                        <p><a href="#" class="ampliar_info">Leer más..</a></p>
                    </div>
                </div>

                <div id="galeria">
                    <h2>Galería</h2>
                    <div id="galeria_contenedor">
                        <img id="galeria_imagen_izq" src="images/galery/escaparatefruteria.jpg" alt="Galeria de imagenes"/>
                        <img id="galeria_imagen_centro" src="images/galery/callefloranes.jpg" alt="Galeria de imagenes"/>
                        <img id="galeria_imagen_der" src="images/galery/escaparatemodels.jpg" alt="Galeria de imagenes"/>
                    </div>
                </div>

                <!-- Pie Central Agenda y Empleo -->

                <div id="main_footer">
                    <div id="agenda">
                        <h2>Agenda</h2>
                        <div class="evento">
                            <div class="fecha">21-05-2013</div>
                            <h3 class="titulo_seccion">Fiestas del Patrón</h3>
                            <p>Ven a celebrar con nosotros las fiestas del patron de la asociación y disfruta de los conciertos, concursos..</p>
                            <p><a href="#" class="ampliar_info">Leer más..</a></p>
                        </div>
                        <div class="evento">
                            <div class="fecha">10-06-2013</div>
                            <h3 class="titulo_seccion">Talleres de manualidades</h3>
                            <p>¡Nuestro divertidos e interesantes talleres! Busca las actividades que mas te gusten y participa ¡reserva ya tu plaza!</p>
                            <p><a href="#" class="ampliar_info">Leer más..</a></p>
                        </div>
                        <div class="evento">
                            <div class="fecha">01-08-2013</div>
                            <h3 class="titulo_seccion">Pasacalles</h3>
                            <p>Los compañeros de la Escuela de Musica &quot;Solfa&quot; realizarán pequeñas actuaciones por nuestras calles ..</p>
                            <p><a href="#" class="ampliar_info">Leer más..</a></p>
                        </div>
                    </div>

                    <div id="empleo">
                    <h2>Empleo</h2>
                        <div class="oferta_empleo" id="oferta_empleo_1">
                            <h3 class="titulo_seccion" id="puesto_oferta1">Comercial con experiencia</h3>
                            <div class="fecha">Publicada el: 21-05-2013</div>
                            <p>
                            <span class="nombre_comercio_oferta">Electrodomésticos Master</span>
                            <span class="descripcion_oferta"> precisa la incorporación a su plantilla de comerciales de una persona con experiencia en..
                            </span>
                            </p>
                            <p><a href="#" class="ampliar_info" title="Ir a detalle de oferta" id="enlace_detalle_oferta_1">Ver oferta..</a></p>
                        </div>
                        <div class="oferta_empleo" id="oferta_empleo_2">
                            <h3 class="titulo_seccion" id="puesto_oferta2">Camarero para noches</h3>
                            <div class="fecha">Publicada el: 10-05-2013</div>
                            <p>
                            <span class="nombre_comercio_oferta">Cafetería Saylors</span>
                            <span class="descripcion_oferta"> busca camarero con experiencia en elaboración de...
                            </span>
                            </p>
                            <p><a href="#" class="ampliar_info" title="Ir a detalle de oferta" id="enlace_detalle_oferta_2">Ver oferta..</a></p>
                        </div>
                    </div>
                </div>
            </div>';

}
