
function f_show_group_list(obj) {
    document.getElementById("request_table").style.display = "none";
    var numGroup = obj.innerHTML;
    var names = document.getElementsByClassName("group_table");
    for (var i = 0; i < names.length; i++) {
    if (!numGroup.localeCompare(names[i].innerHTML)) {
        names[i].parentElement.style.display="block";
    } else {
        names[i].parentElement.style.display="none";
    }
    }

}

function f_show_group_form() {
    if (document.getElementById("no_groups") != null) {
        document.getElementById("find_group_form").style.display = "block";
    }
}

function f_show_requests() {
    document.getElementById("request_table").style.display = "block";
    var names = document.getElementsByClassName("group_table");
    for (var i = 0; i < names.length; i++) {
        names[i].parentElement.style.display="none";
    }
}

function f_show_attempts() {
    document.getElementById("attempt_table").style.display = "block";
}

function f_validate_form(form) {
    const login = form.elements['login'].value;
    const surname = form.elements['surname'].value;
    const name = form.elements['name'].value;
    const second_name = form.elements['secname'].value;
    const password = form.elements['password'].value;
    var firstCheck = true;
    var secondCheck = true;
    var thirdCheck = true;
    if (login.length === 0 || surname.length === 0 || name.length === 0 ||
        second_name.length === 0 || password.length === 0) {
        document.getElementById("all_empty").style.display = "block";
        firstCheck = false;
    }
    if (login.length < 3 || login.length > 14) {
        document.getElementById("login_length").style.display = "block";
        secondCheck = false;
    }
    if (password.length < 4) {
        document.getElementById("password_length").style.display = "block";
        thirdCheck = false;
    }
    return firstCheck && secondCheck && thirdCheck;
}
