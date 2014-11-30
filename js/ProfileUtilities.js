/**
 * Created by albertoperezperez on 23/11/14.
 */


/**
 * Starts a new edition
 */
function startEdition () {

    var title = document.getElementById('title');
    title.hidden=false;

    var profileDiv = document.getElementById('profile');
    profileDiv.hidden= true;

    var form = document.getElementById('convertForm');
    form.hidden=false;

}

/**
 * Validates the profile changes and allows the form sent if its all information is valid
// */
//function validateForm (){
//
//    var result = true;
//
//    var phoneNumber = document.getElementById("phoneNumber").value;
//
//    result = result && validatePhoneNumber(phoneNumber);
//
//    var age = document.getElementById("age").value;
//
//    if (!isNumber(age) || age.numberValue < 0) {
//
//        result = false;
//
//    }
//
//    var email = document.getElementById("email").value;
//    result = result && validateEmail(email);
//
//    var postalCode = document.getElementById("postalCode").value;
//
//    if (!isNumber(postalCode) || postalCode.length != 5) {
//
//        result = false;
//
//    }
//
//    return result;
//
//}