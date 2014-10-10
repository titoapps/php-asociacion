/**
 * Created by albertoperezperez on 26/09/14.
 */

var g_calendarObject;

/**
 * Provides a form to add a new
 */
function addNew () {

    var container = document.getElementById("newsContainer");
    var link = document.getElementById("addNewLink");
    link.hidden = "true";

    container.innerHTML = '<form id="myform" action="" method="POST" onsubmit="return validateForm()" accept-charset="utf-8">' +
    '<label for="title_edition">Título</label><input class="element_above" type="text" id="title_edition" name="title" required="required"/>' +
    '</br><label for="startDate">Fecha de Inicio (dd/mm/yyyy)</label></br><input type="text" class="datepicker" id="startDate" name="startDate" required="required"/><label id="dateMessage" class="error" style="visibility: hidden"> Compruebe la fecha, por favor.</label>' +
    '</br></br><label for="endDate">Fecha de Fin (dd/mm/yyyy)</label></br><input type="text" class="datepicker" id="endDate" name="endDate" required="required"/><label id="endDateMessage" class="error" style="visibility: hidden"> Compruebe la fecha, por favor.</label>' +
    '</br><label id="checkDatesMessage" class="error" style="visibility: hidden"> La fecha inicial debe ser anterior a la final.</label>' +
    '</br></br><label for="subtitle">Subtítulo</label><textarea class="element_above" id="subtitle" name="subtitle" required="required" rows="3"></textarea>' +
    '</br><label for="description">Descripción</label><textarea class="element_above" id="description" name="description" cols="40" rows="10"></textarea>' +
    '<input type="hidden" id="idNew" name = "idNew" value = "-1">'+
    '</br><input type="submit" name = "anadir" value="anadir"></form><script>$(function() {$( ".datepicker" ).datepicker();}); </script>';


}

/**
 * Starts a new edition
 */
function startEdition () {

    var container = document.getElementById("newContainer");

    var idNewItem = document.getElementById("idNew");
    var idNew = idNewItem.title;

    var titleItem = document.getElementById("title_static");
    var title = titleItem.title;

    var dateItem = document.getElementById("startDate_static");
    var date = dateItem.title;

    var endDateItem = document.getElementById("endDate_static");
    var endDate = endDateItem.title;

    var subTitleItem = document.getElementById("subtitle_static");
    var subtitle = subTitleItem.title;

    var descriptionItem = document.getElementById("description_static");
    var description = descriptionItem.title;


    container.innerHTML = '<form id="myform" action="" method="POST" onsubmit="return validateForm()" accept-charset="utf-8">' +
    '<label for="title_edition">Título</label><input class="element_above" type="text" id="title_edition" name="title" required="required" value = "'+title+'"/>' +
    '</br><label for="startDate">Fecha de Inicio (dd/mm/yyyy)</label></br><input type="text" class="datepicker" id="startDate" name="startDate" required="required" value = "'+date+'"/><label id="dateMessage" class="error" style="visibility: hidden"> Compruebe la fecha, por favor.</label>' +
    '</br></br><label for="endDate">Fecha de Fin (dd/mm/yyyy)</label></br><input type="text" class="datepicker" id="endDate" name="endDate" required="required" value = "'+endDate+'"/><label id="endDateMessage" class="error" style="visibility: hidden"> Compruebe la fecha, por favor.</label>' +
    '</br><label id="checkDatesMessage" class="error" style="visibility: hidden"> La fecha inicial debe ser anterior a la final.</label>' +
    '</br></br><label for="subtitle">Subtítulo</label><textarea class="element_above" id="subtitle" name="subtitle" required="required" rows="3">'+subtitle+'</textarea>' +
    '</br><label for="description">Descripción</label><textarea class="element_above" id="description" name="description" cols="40" rows="10">'+description+'</textarea>' +
    '<input type="hidden" id="idNew" name = "idNew" value = "'+idNew+'" title="'+idNew+'">'+
    '</br><input type="submit" name = "Terminar" value="Terminar"></form><script>$(function() {$( ".datepicker" ).datepicker();}); </script>';


}


/**
 * Provides a form to add a comment
 */
function addComment() {

    var container = document.getElementById("commentsContainer");
    var link = document.getElementById("addCommentLink");
    link.hidden = "true";
    var idNewItem = document.getElementById("idNew");
    var idNew = idNewItem.title;

    var content = container.innerHTML;
    var contentParts = content.split('</div>');

    container.innerHTML = contentParts[0] + '<form id="myform" action="" method="POST" accept-charset="utf-8">' +
    '<h5 class="title">Añada su comentario</h5>' +
    '<textarea class="element_above" id="commentText" name="commentText" cols="40" rows="10" maxlength="100"></textarea>' +
    '<input type="hidden" id="idNew" name = "idNew" value ="'+idNew+'">' +
    '<input type="submit" name = "comment" value="Comentar"></form>';


}

// dateUS function, modified from dateITA in additional-methods.js
// makes sure dates are valid (& US-format: m/d/yyyy)
function validateForm() {

    var result = false;

    var dateItem = document.getElementById("startDate");
    var value = dateItem.value;

    var endDateItem = document.getElementById("endDate");
    var endDateValue = endDateItem.value;

    var check = validateDateFormatted(value);
    var checkEndDate = validateDateFormatted(endDateValue);

    var message = document.getElementById("dateMessage");
    var messageEnd = document.getElementById("endDateMessage");

    if(!check) {

        message.style.visibility = "visible";

    } else {

        message.style.visibility = "hidden";

    }

    if(!checkEndDate) {

        messageEnd.style.visibility = "visible";

    } else{

        messageEnd.style.visibility = "hidden";
    }

    if (check && checkEndDate) {

        var startDateParts = value.split('/');
        var endDateParts = endDateValue.split('/');
        var startDate = new Date(startDateParts[2],startDateParts[1]-1,startDateParts[0]);
        var endDate = new Date(endDateParts[2],endDateParts[1]-1,endDateParts[0]);

        if (startDate < endDate) {
            result = true;

        } else {

            var messageDates = document.getElementById("checkDatesMessage");
            messageDates.style.visibility = "visible";

        }

    } else {

        var messageDates = document.getElementById("checkDatesMessage");
        messageDates.style.visibility = "hidden";

    }

    return result;

}