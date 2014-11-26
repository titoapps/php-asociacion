/**
 * Created by albertoperezperez on 23/11/14.
 */


/**
 * Starts a new edition
 */
function startEdition () {

    var container = document.getElementById("profile");

    var nickName= document.getElementById("nickName");
    var nickNameItem = nickName.title;
    var name= document.getElementById("name");
    var nameItem = name.title;
    var surname= document.getElementById("surname");
    var surnameItem = surname.title;
    var phoneNumber= document.getElementById("phoneNumber");
    var phoneNumberItem = phoneNumber.title;
    var email= document.getElementById("email");
    var emailItem = email.title;
    var age= document.getElementById("age");
    var ageItem = age.title;
    var streetName= document.getElementById("streetName");
    var streetNameItem = streetName.title;
    var number = document.getElementById("number");
    var numberItem = number.title;
    var floor = document.getElementById("floor");
    var floorItem = floor.title;
    var door = document.getElementById("door");
    var doorItem = door.title;
    var postalCode= document.getElementById("postalCode");
    var postalCodeItem = postalCode.title;
    var idUser= document.getElementById("idUser");
    var idUserItem = idUser.title;

    container.innerHTML = '<form id="myform" action="" method="POST" onsubmit="return validateForm()" accept-charset="utf-8">' + '' +
    '</br><label for="nickName"> nickName </label><input class="element_above" type="text" id="nickName" name="nickName" required="required" value = "'+nickNameItem+'"/>' +
    '</br><label for="name"> name </label><input class="element_above" type="text" id="name" name="name" required="required" value = "'+nameItem+'"/>' +
    '</br><label for="surname"> surname </label><input class="element_above" type="text" id="surname" name="surname" required="required" value = "'+surnameItem+'"/>' +
    '</br><label for="phoneNumber"> phoneNumber </label><input class="element_above" type="text" id="phoneNumber" name="phoneNumber" required="required" maxlength="9" value = "'+phoneNumberItem+'"/>' +
    '</br><label for="email"> email </label><input class="element_above" type="email" id="email" name="email" required="required" value = "'+emailItem+'"/>' +
    '</br><label for="age"> age </label><input class="element_above" type="text" id="age" name="age" required="required" maxlength="3" value = "'+ageItem+'"/>' +
    '</br><label for="streetName"> streetName </label><input class="element_above" type="text" id="streetName" name="streetName" required="required" value = "'+streetNameItem+'"/>' +
    '</br><label for="number"> number  </label><input class="element_above" type="text" id="number" name="number" required="required" maxlength="4" value = "'+numberItem+'"/>' +
    '</br><label for="floor"> floor  </label><input class="element_above" type="text" id="floor" name="floor" required="required" maxlength="3" value = "'+floorItem+'"/>' +
    '</br><label for="door"> door  </label><input class="element_above" type="text" id="door" name="door" required="required" maxlength="3" value = "'+doorItem+'"/>' +
    '</br><label for="postalCode"> postalCode </label><input class="element_above" type="text" id="postalCode" name="postalCode" required="required" maxlength="5" value = "'+postalCodeItem+'"/>' +
    '</br><input type="hidden" id="idUser" name = "idUser" value = "'+idUserItem+'" title="'+idUser+'">'+
    '</br><input type="submit" name = "Terminar" value="Terminar"></form>';

}

/**
 * Validates the profile changes and allows the form sent if its all information is valid
 */
function validateForm (){

    var result = true;

    var phoneNumber = document.getElementById("phoneNumber").value;

    result = result && validatePhoneNumber(phoneNumber);

    var age = document.getElementById("age").value;

    if (!isNumber(age) || age.numberValue < 0) {

        result = false;

    }

    var email = document.getElementById("email").value;
    result = result && validateEmail(email);

    var postalCode = document.getElementById("postalCode").value;

    if (!isNumber(postalCode) || postalCode.length != 5) {

        result = false;

    }

    return result;

}