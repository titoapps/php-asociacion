/**
 * Links the web menu and performs the main content retrieves
 * on menu selection
 *
 * Created by albertoperezperez on 16/07/14.
 */

$(document).ready(function(){
    //función del slider principal
    $(function(){
        $('#galeria div:gt(0)').hide(); //esconde todos los div menos el primero
        setInterval(function(){
            $('#galeria div:first-child').fadeOut(4000) //tiempo que tarda la img en desaparecer
                .next('div').fadeIn(2000) //tiempo q tarda en aparacer la siguiente
                .end().appendTo('#galeria');}, 6000); //tiempo que permanece la img
    });

});
$(window).load(function() {
    $('#galeria').find('img').each(function () {
        var imgClass = (this.width / this.height > 1) ? 'wide' : 'tall';
        $(this).addClass(imgClass);
    });
});


/**
 * Performs the AJAX retrieve and sets the response as the content of the web
 * @param link
 */
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

            var mainContent = document.getElementById('main');
            var responseHTML = instance.responseText;

            if (responseHTML != null) {
                mainContent.innerHTML = responseHTML;
            }

        }

    }

    instance.open("GET", link, true);
    instance.send();

}

/**
 * Validates and launches the search retrieve
 */
function searchShop () {

    var nameInput = document.getElementById('nameInputSearch');
    var activitySelection = document.getElementById('activityInputSearch');
    var streetSelection = document.getElementById('streetInputName');

    var result = false;
    var name = nameInput.value;

    var activity = activitySelection.value;
    var activityIndex = activitySelection.selectedIndex;

    var street = streetSelection.value;
    var streetIndex = streetSelection.selectedIndex;

    if ((name.length == 0) && (activityIndex==0) && (streetIndex ==0)) {

        return false;

    } else {

        //we load the search result from AJAX
        var link = "modules/search/controller.php?search=search&name="+name+"&activity="+activity+"&street="+street;

        loadMainContentFromLink(link);

    }

}

/**
 * Validates and launches the search retrieve
 */
function showAllMembers () {

    //we load the search result from AJAX
    var link = "php//visuals/searchMembers.php";

    loadMainContentFromLink(link);

}

function º() {

    var name = document.getElementById("user").value;
    var password = document.getElementById("password").value;
    //TODO: what to do here?
    var remember = document.getElementById("recordarme").checked;

    //TODO: check errors (empty fields)

}