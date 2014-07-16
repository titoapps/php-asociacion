/**
 * Created by albertoperezperez on 16/07/14.
 */

    $(document).ready(function () {

        var tab = $("li[rel=\'tab\']");

        tab.click(function(e) {
//code for the link action

            var mainContent = document.getElementById('main');

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

//realiza la peticion al servidor y cuando esta preparada lo muestra en la capa examen
function loadMainContentFromLink(link) {

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
            //alert(instance.responseText);
            /*var json = JSON.parse(instance.responseText);
            resultadoJson = json.articulos;

            mostrarProductos();*/

            var mainContent = document.getElementById('main');

            mainContent.innerHTML = instance.responseText;

        }

    }

    instance.open("GET", link, true);
    instance.send();

}