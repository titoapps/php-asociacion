/**
 * Links the web menu and performs the main content retrieves
 * on menu selection
 *
 * Created by albertoperezperez on 16/07/14.
 */


//We link the web menu to the handler.

    $(document).ready(function () {

        var tab = $("li[rel=\'tab\']");

        tab.click(function(e) {

            if(this.id =='menu_inicio') {


            } else if(this.id =='menu_noticias') {

                loadMainContentFromLink('news.php');

            } else if(this.id =='menu_asociacion') {

            } else if(this.id =='menu_ofertas') {

            } else if(this.id =='menu_agenda') {

            } else if(this.id =='menu_asociate') {

            } else if(this.id =='menu_contacto') {

            }
        });

    })

/**
 * Performs the AJAX retrieve and sets the response as the content of the web
 * @param link
 */
function  loadMainContentFromLink(link) {

    var instance = false;

    //esto es para los diferentes navegadores
    if (window.XMLHttpRequest) {

        instance = new XMLHttpRequest();

    } else if (window.ActiveXObject) {

        try {

            instance = new ActiveXObject("Msxml2.XMLHTTP");

        } catch (e) {

            try {
                instance = new ActiveXObject("Microsoft.XMLHTTP");

            } catch (e) {

            }

        }

    } else {

        return false;

    }

    //si esta en 4->preparado y 200 -->ok entonces muestra como texto plano el examen
    instance.onreadystatechange = function() {
        if (instance.readyState === 4 && instance.status === 200) {

            var mainContent = document.getElementById('main');
            mainContent.innerHTML = instance.responseText;

        }

    }

    instance.open("GET", link, true);
    instance.send();

}