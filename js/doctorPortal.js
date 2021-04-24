function oldAppoinments() {
    document.getElementById("appoinment").innerHTML = "New";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("appoinment").innerHTML = "New";
        }
    };
    xmlhttp.open("GET", "controller/checkUserNameandEmail.php?trigger=old", true);
    xmlhttp.send();

}

