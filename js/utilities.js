/**
 * Created by albertoperezperez on 19/08/14.
 */

/**
 * Validates the email textfield passed.
 * @param inputText
 * @returns {boolean}
 */
function validateEmail(inputText) {

    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if(inputText.value.match(mailformat)) {

        return true;

    } else {

        return false;

    }

}


/**
 * Validates the contact form
 * @param form
 * @returns true if the form is correctly sent
 */
function validateContactForm(form) {

    var email = form.email;

    var valid = validateEmail(email);

    if (valid) {

        email.focus();
        email.style.border = '0.1 solid black';

    } else {

        email.focus();
        email.style.border = '2px solid red';

    }


    return valid;

}

/**
 * Validates a date formatted as dd/mm/yyyy
 *
 * @param dateString
 * @returns {boolean}
 */
function validateDateFormatted (dateString){

    var check = false;
    var re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
    if( re.test(dateString)){
        var adata = dateString.split('/');
        var dd = parseInt(adata[0],10); // was dd (day)
        var mm = parseInt(adata[1],10); // was mm (month)
        var yyyy = parseInt(adata[2],10); // was aaaa (year)
        var xdata = new Date(yyyy,mm-1,dd);
        if ( ( xdata.getFullYear() == yyyy ) && ( xdata.getMonth () == mm - 1 ) && ( xdata.getDate() == dd ) )
            check = true;
        else
            check = false;
    } else
        check = false;

    return check;

}