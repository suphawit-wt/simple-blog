function formValidation() {
    var usrname = document.author_form.username;
    var pwd = document.author_form.password;
    var conpwd = document.author_form.conpasswd;
    var name = document.author_form.name;
    var penname = document.author_form.penname;
    var email = document.author_form.email;

    checked = false;
    if (validateUserName(usrname, 5, 45)) {
        if (validatePassword(pwd, conpwd, 5, 45)) {
            if (validateName(name)) {
                if (validatePenName(penname)) {
                    if (validateEmail(email)) {
                        return !checked;
                    }
                }
            }
        }
    }
    return checked;
}

function newArtiValidation() {
    var titleA = document.article_form.title;

    checked = false;
    if (validateTitle(titleA)) {
        return !checked;
    }
    return checked;
}

function validateTitle(titleA, min, max) {
    var error = "";
    var illegalChars = /\W/;

    if (titleA.value == "") {
        titleA.style.borderColor = "red";
        error = "*Please enter title. \n";
        alert(error);
        titleA.focus();
        return false;
    } else {
        titleA.style.borderColor = "#CEDADA";
    }
    return true;
}

function validateUserName(usrname, min, max) {
    var error = "";
    var illegalChars = /\W/;

    if (usrname.value == "") {
        usrname.style.borderColor = "red";
        error = "*Please enter username. \n";
        alert(error);
        usrname.focus();
        return false;
    } else if ((usrname.value.length < min) || (usrname.value.length > max)) {
        usrname.style.borderColor = "red";
        error = "*Username must be in length " + min + "-" + max + " character. \n";
        alert(error);
        usrname.focus();
        return false;
    } else if (illegalChars.test(usrname.value)) {
        usrname.style.borderColor = "red";
        error = "*Username must not have special character. \n";
        alert(error);
        usrname.focus();
        return false;
    } else {
        usrname.style.borderColor = "#CEDADA";
    }
    return true;
}

function validatePassword(pwd, uconfirmpwd, min, max) {
    var error = "";
    var illegalChars = /[\W_]/;

    if (pwd.value == "") {
        pwd.style.borderColor = "red";
        error = "*Please enter password. \n";
        alert(error);
        pwd.focus();
        return false;
    } else if ((pwd.value.length < min) || (pwd.value.length > max)) {
        error = "*Password must be in length " + min + "-" + max + " character. \n";
        pwd.style.borderColor = "red";
        alert(error);
        pwd.focus();
        return false;
    } else if (illegalChars.test(pwd.value)) {
        error = "*Password must not have special character. \n";
        pwd.style.borderColor = "red";
        alert(error);
        pwd.focus();
        return false;
    } else if ((pwd.value.search(/[a-zA-Z]+/) == -1) || (pwd.value.search(/[0-9]+/) == -1)) {
        error = "*Password must have Alphabet and Number. \n";
        pwd.style.background = "Yellow";
        alert(error);
        pwd.focus();
        return false;
    } else if (pwd.value != uconfirmpwd.value) {
        error = "*Password and Confirm Password must be match. \n";
        pwd.style.background = "Yellow";
        uconfirmpwd.style.background = "Yellow";
        alert(error);
        pwd.focus();
        return false;
    } else {
        pwd.style.background = "White";
        uconfirmpwd.style.background = "White";
    }
    return true;
}

function validateName(name) {
    var letters = /^[A-Za-z]+$/;
    if (name.value == "") {
        name.style.borderColor = "red";
        error = "*Please enter name. \n";
        alert(error);
        name.focus();
        return false;
    } else if (name.value.match(letters)) {
        return true;
    } else {
        alert('*Name must have Alphabet.');
        name.focus();
        return false;
    }
}

function validatePenName(penname) {
    var letters = /^[0-9a-zA-Z]+$/;
    if (penname.value == "") {
        penname.style.borderColor = "red";
        error = "*Please enter penname. \n";
        alert(error);
        penname.focus();
        return false;
    } else if (penname.value.match(letters)) {
        return true;
    } else {
        alert('*Penname must not have special character.');
        penname.focus();
        return false;
    }
}

function validateEmail(email) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (email.value == "") {
        email.style.borderColor = "red";
        error = "*Please enter email. \n";
        alert(error);
        email.focus();
        return false;
    } else if (!filter.test(email.value)) {
        alert('*Email must be valid format.');
        email.focus();
        return false;
    } else {
        return true;
    }
}