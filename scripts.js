
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
