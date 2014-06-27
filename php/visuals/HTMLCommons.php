<?php


/**
 * HTML functions to draw the main html content
 *
 * @author Alberto Pérez Pérez
 */

function drawCommonHeaderAndDocType (){

    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Asociación de Comerciantes de las Calles Floranes y Alonso</title>
    <link href="styles/styles.css" rel="stylesheet" type="text/css" />
</head>';
}

/**
 * Draws the site header
 */
function drawMenuHeader ($menuOption) {

    echo '
	<div id="header">
    	<div id="buscador_header">
        	Buscar
            <input id="texto_busqueda" value=""/>
            <input id="boton_buscar" type="image" name="buscar" src="images/lupa.png" title="Buscar"/>
        </div>
        <h1 id="headertitle">Asociación de Comerciantes<br /><span id="title_strong">Alonso y Floranes</span></h1>
    	<div id="menu">
        	<ul>';

    //TODO:Separate into enumerate or something. define doesnt work
    $menuOptions = array(0 => 'inicio',
                         1 => 'noticias',
                         2 => 'asociacion',
                         3 => 'ofertas',
                         4 => 'agenda',
                         5 => 'asociate',
                         6 => 'contacto');

    $menuReferences = array('index.php','news.php','asociation.php','offers.php','agenda.php','asociate.php','contact.php');

    foreach ($menuOptions as $option => $optiontext) {

        $lineText =  '<li id="menu_"'.$optiontext;

        if ($menuOption == $option) {

            $lineText = $lineText . ' class="seleccionado"';

        }

        $lineText = $lineText . '><a href="'.$menuReferences[$option].'" name="menu_'.$optiontext.'" id="menu_'.$optiontext.'">'.ucfirst($optiontext).'</a></li>';

        echo $lineText;
    }



    /*<li id="menu_inicio" class="seleccionado"><a href="index.php" name="menu_inicio" id="menu_inicio">Inicio</a></li>
                <li id="menu_noticias"><a href="news.php" name="menu_noticias" id="menu_noticias">Noticias</a></li>
               	<li id="menu_asociacion"><a href="#" name="menu_asociacion" id="menu_asociacion">La Asociación</a></li>
                <li id="menu_ofertas"><a href="#" name="menu_ofertas" id="menu_ofertas">Ofertas y Promociones</a></li>
                <li id="menu_agenda"><a href="#" name="menu_agenda" id="menu_agenda">Agenda</a></li>
                <li id="menu_asociate"><a href="#" name="menu_asociate" id="menu_asociate">Asóciate</a></li>
                <li id="menu_contacto"><a href="#" name="menu_contacto" id="menu_contacto">Contacto</a></li>*/

    echo '</ul> </div> </div>';

}

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
                    	<img src="images/members/fruteriafloranes.jpg" alt="Floranes 19 Fruteria"/><br />
                    </a>
                 	<a href="#" id="link_asociado2" title="Carnicería Eño">
            		<img src="images/members/Carniceria logo.jpg" alt="Carnicería Eño"/><br />
                    </a>
                    <a href="#" id="link_asociado3" title="Tasca de Pedro">
                	<img src="images/members/Tasca-Logo_Black.jpg" alt="Tasca de Pedro"/><br />
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
 * Draws the site main content header (center of the web page)
 */
function drawMainHeader () {

    echo '<div id="main_header">

                <div id="buscador">
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
                            <option value="" selected="selected">- seleccione -</option>
                            <option value="Agenciasdeviajes">Agencias de Viajes</option>
                            <option value="Alimentacion">Alimentación</option>
                            <option value="Animales">Animales</option>
                            <option value="Calzados">Calzados</option>
                            <option value="Carnicerias">Carniceria</option>
                            <option value="Complementos">Complementos</option>
                            <option value="Deportes">Deportes</option>
                            <option value="Electrodomesticos">Electrodomésticos</option>
                            <option value="Electronica">Electrónica</option>
                            <option value="Estanco">Estanco</option>
                            <option value="Farmacia">Farmacia</option>
                            <option value="Ferreteria">Ferreteria</option>
                        </select>
                     </div>
                    <div class="form_item">
                        <label for="calle">Calle</label>
                        <select id="calle" name="calle">
                            <option value="" selected="selected">- seleccione -</option>
                            <option value="Alonso">Alonso</option>
                            <option value="Floranes">Floranes</option>
                            <option value="Cisneros">Cisneros</option>
                            <option value="FranciscoCubria">Francisco Cubría</option>
                            <option value="NarcisoCuevas">Narciso Cuevas</option>
                            <option value="SanFernando">San Fernando</option>
                            <option value="Vargas">Vargas</option>
                        </select>
                    </div>
                     <input class="form_item" type="submit" value="Buscar" name="search"/>
                </fieldset>
                </form>
                </div>

                <div id="visita_comercio">
                    <h2>Visita el comercio de..</h2>
                        <!-- Info sobre un comercio, con imagen, logo.. -->
                        <a href="#"><img src="images/members/fruteriafloranes.jpg" alt="imagen del comercio" /></a>

                        <a href="#" id>Floranes 19 Fruteria</a> <br/>

                        <span id="descripcion_comercio">Frutas y Verduras de Cultivo Tradicional y Ecológico</span>
                        <br /> <br />
                        <span id="direccion_comercio"> C/ Floranes 19, 39010 Santander.</span>

                </div>
        	</div> ';

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
                        <img id="galeria_imagen_izq" src="images/galery/s2_Phto0045.jpg" alt="Galeria de imagenes"/>
                        <img id="galeria_imagen_centro" src="images/galery/floranes--253x190.jpg" alt="Galeria de imagenes"/>
                        <img id="galeria_imagen_der" src="images/galery/imagen.jpg" alt="Galeria de imagenes"/>
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

/**
 * Draws the partners section
 */
function drawPartners () {

    echo '
        <div id="colaboradores">
            <div class="colaborador">
                <a href="http://www.ayto-santander.es" title="Ayuntamiento de Santander" id="colaborador1" target="_blank">
                    <img src="images/partners/ayuntamiento.jpg" alt="Ayuntamiento de Santander"/>
                </a>
            </div>
            <div class="colaborador">
                <a href="http://www.cantabria.es" title="Gobierno de Cantabria" id="colaborador2" target="_blank">
                    <img src="images/partners/gobierno.jpg" alt="Gobierno de Cantabria"/>
                </a>
            </div>
            <div class="colaborador">
                <a href="http://www.mahou.es" title="Mahou" id="colaborador3" target="_blank">
                    <img src="images/partners/mahou.jpg" alt="Mahou"/>
                </a>
            </div>
            <div class="colaborador">
                <a href="http://www.perasderincondesoto.com" title="Peras de Rincon de Soto" id="colaborador4" target="_blank">
                    <img src="images/partners/rinconsoto.jpg" alt="Peras de Rincon de Soto"/>
                </a>
            </div>
        </div>';

}

/**
 * Draws the site footer
 */
function drawFooter () {

    echo '<div id="footer">
            <p id="footer_right">Diseño y Desarrollo :
            <a class="ampliar_info" href="http://www.albertoperezperez.com" target="new">www.albertoperezperez.com</a></p>

            <p id="validation">
                <a href="http://validator.w3.org/check?uri=referer">
                <img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" height="31" width="88" />
                </a>

                <a href="http://jigsaw.w3.org/css-validator/check/referer">
                <img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="¡CSS Válido!" />
                </a>
            </p>

            <p>Copyright 2013. Asociación de Comerciantes de las calles Alonso y Floranes.</p>
            <p id="footer_contacto">C/ Floranes 27 Bajo, 39010 Santander, Cantabria. CIF Z99999999<br/>Teléfono: 942909090 <br/>Email:
            <a class="ampliar_info" href="#">webmaster@asocalofloranes.com</a>
            </p>

        </div>';

}