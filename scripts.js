
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

function f_show_error_mes() {
    var login = document.getElementById("user_id").value.length;
    var surname = document.getElementById("surname_reg").value.length;
    var name = document.getElementById("name_reg").value.length;
    var second_name = document.getElementById("second_name_reg").value.length;
    var password = document.getElementById("password_reg").value.length;
    var firstCheck = true;
    var secondCheck = true;
    var thirdCheck = true;
    if (login === 0 || surname === 0 || name === 0 || second_name === 0 || password === 0) {
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
    if (!firstCheck || !secondCheck || !thirdCheck) {
        return false;
    } 
}
