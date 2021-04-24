function checkName(name) {
    if (name.length === 0) {
        document.getElementById('jmessageName').innerHTML = "Name Cant be empty";
    }
}

function checkUserName(username) {

    if (username.length === 0) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("jmessageUserName").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "controller/checkUserNameandEmail.php?username=" + username, true);
        xmlhttp.send();
    }

}

function checkEmail(email) {

    if (email.length === 0) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("jmessageEmail").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "controller/checkUserNameandEmail.php?email=" + email, true);
        xmlhttp.send();
    }

}


