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