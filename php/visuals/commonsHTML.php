<?php

require_once('php/Configuration/Configuration.php');

/**
 * Draws the site left menu
 */
function drawLeftMenu () {

    echo '
        <div id="leftsecondary">';

    include_once 'user/controller.php';

    include_once 'membersPreview/controller.php';

    include_once 'surveys/controller.php';

    include_once 'contactLogo/controller.php';

        	echo '
            <!--h3>Twitter</h3>
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
            </div-->
        </div> ';

}


