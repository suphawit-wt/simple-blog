function formValidation() {
    var usrname = document.registform.username;
    var pwd = document.registform.password;
    var conpwd = document.registform.conpasswd;
    var name = document.registform.name;
    var penname = document.registform.penname;
    var email = document.registform.email;

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
    var titleA = document.newarti.title;

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
        error = "กรุณากรอก หัวข้อ \n";
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
        error = "กรุณากรอก Username \n";
        alert(error);
        usrname.focus();
        return false;
    } else if ((usrname.value.length < min) || (usrname.value.length > max)) {
        usrname.style.borderColor = "red";
        error = "User ID ต้องมีความยาว " + min + "-" + max + " ตัวอักษร\n";
        alert(error);
        usrname.focus();
        return false;
    } else if (illegalChars.test(usrname.value)) {
        usrname.style.borderColor = "red";
        error = "User ID มีตัวอักษรที่ไม่ได้รับอนุญาติ\n";
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
        error = "กรุณาป้อน Password\n";
        alert(error);
        pwd.focus();
        return false;
    } else if ((pwd.value.length < min) || (pwd.value.length > max)) {
        error = "Password ต้องมีความยาว " + min + "-" + max + " ตัวอักษร\n";
        pwd.style.borderColor = "red";
        alert(error);
        pwd.focus();
        return false;
    } else if (illegalChars.test(pwd.value)) {
        error = "Password มีตัวอักษรที่ไม่ได้รับอนุญาติ\n";
        pwd.style.borderColor = "red";
        alert(error);
        pwd.focus();
        return false;
    } else if ((pwd.value.search(/[a-zA-Z]+/) == -1) || (pwd.value.search(/[0-9]+/) == -1)) {
        error = "Password ต้องมีทั้งตัวเลขและตัวอักษร\n";
        pwd.style.background = "Yellow";
        alert(error);
        pwd.focus();
        return false;
    } else if (pwd.value != uconfirmpwd.value) {
        error = "Password ไม่ตรงกัน\n";
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
        error = "กรุณากรอก ชื่อผู้แต่ง\n";
        alert(error);
        name.focus();
        return false;
    } else if (name.value.match(letters)) {
        return true;
    } else {
        alert('ชื่อผู้แต่ง ต้องเป็นตัวอักษรเท่านั้น');
        name.focus();
        return false;
    }
}

function validatePenName(penname) {
    var letters = /^[0-9a-zA-Z]+$/;
    if (penname.value == "") {
        penname.style.borderColor = "red";
        error = "กรุณากรอก นามปากกา\n";
        alert(error);
        penname.focus();
        return false;
    } else if (penname.value.match(letters)) {
        return true;
    } else {
        alert('นามปากกา ต้องประกอบไปด้วยตัวเลขหรือตัวอักษรเท่านั้น');
        penname.focus();
        return false;
    }
}

function validateEmail(email) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (email.value == "") {
        email.style.borderColor = "red";
        error = "กรุณากรอก อีเมล์\n";
        alert(error);
        email.focus();
        return false;
    } else if (!filter.test(email.value)) {
        alert('รูปแบบอีเมล์ของคุณไม่ถูกต้อง');
        email.focus();
        return false;
    } else {
        return true;
    }
}