<?php
$message = '';
$error = '';

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST["submit"])) {
    if (empty($_POST["name"])) {
        $error = "<label class='alert alert-warning'>Enter Name</label>";
    } else if (empty($_POST["email"])) {
        $error = "<label class='alert alert-warning'>Enter Email</label>";
    } else if (empty($_POST["username"])) {
        $error = "<label class='alert alert-warning'>Enter User Name</label>";
    } else if (empty($_POST["password"])) {
        $error = "<label class='alert alert-warning'>Enter User Passowrd</label>";
    } else if (empty($_POST["gender"])) {
        $error = "<label class='alert alert-warning'>Enter Gender</label>";
    } else if (empty($_POST["dateofbirth"])) {
        $error = "<label class='alert alert-warning'>Enter Date of Birth</label>";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "<label class='alert alert-warning'>Invalid email format</label>";
        } else if ($_POST['password'] == $_POST['confirmpassword']) {
            require_once 'controller/addDoctor.php';
        } else {
            $error = "<label class='alert alert-warning'>Password and Confirm Password is not Same.</label>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script type="text/javascript" src="js/registrationjs.js"></script>
    <title>Registration</title>
</head>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <img src="assets/logo.png" width="120" height="120">
            </div>
            <div class="col-sm nav justify-content-end align-self-center">
                <a class="nav-link" href="Welcome.php">Home</a>
                <a class="nav-link" href="login.php">Login</a>
                <a class="nav-link" href="registration.php">Registration</a>
            </div>
        </div>
    </div>
</header>

<body>
    <div class="container">
        <legend>REGISTRATION</legend>
        <form method="POST" action="registration.php">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" onblur="checkName(this.value)">
                    <span id="jmessageName"></span>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="" id="email" name="email" class="form-control" onblur="checkEEmail(this.value)" onkeyup="checkEmail(this.value)">
                    <span id="jmessageEmail"></span>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Use Name</label>
                    <input type="text" autocomplete="off" id="username" name="username" class="form-control" onblur="checkUserName(this.value)">
                    <span id="jmessageUserName"></span>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" onblur="checkPassword(this.value)">
                    <span id="jmessagePassword"></span>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirmpassword" class="form-control" onblur="checkConfirmPassword(this.value, password.value)">
                    <span id="jmessageConfirmPassword"></span>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-lg-2">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                </div>
                <div class="col-lg-2">
                    <div class="form-check">
                        <input type="radio" name="gender" value="male" id="gridRadios1" class="form-check-input">
                        <label class="form-check-label" for="gridRadios1">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="gender" value="female" id="gridRadios2" class="form-check-input">
                        <label class="form-check-label" for="gridRadios2">Female</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="gender" value="other" id="gridRadios3" class="form-check-input">
                        <label class="form-check-label" for="gridRadios3">Other</label>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto">
                    <fieldset>
                        <legend>Date of Birth</legend>
                        <input type="date" name="dateofbirth">
                    </fieldset>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto">
                    <br>
                    <?php if (isset($error)) echo $error ?>
                    <?php if (isset($message)) echo $message ?>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-auto">
                    <input type="submit" name="submit" class="btn btn-primary">
                    <input type="reset" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    function checkName(name) {
        if (name.length === 0) {
            document.getElementById('jmessageName').innerHTML = "Name Cant be empty";
        }
    }

    function checkPassword(password) {
        var lower = /[a-z]/;
        var upper  =/[A-Z]/;
        var number = /[0-9]/;
        if(!lower.test(password)) {
            document.getElementById('jmessagePassword').innerHTML = "Please make sure password includes a lowercase letter";
        } 
        else if(!upper.test(password))
        {
            document.getElementById('jmessagePassword').innerHTML = "Please make sure password includes an uppercase letter";
        }
        else if(!number.test(password))
        {
            document.getElementById('jmessagePassword').innerHTML = "Please make sure Password Includes a Digit";
        }
        else{
            document.getElementById('jmessagePassword').innerHTML = "";
        }
    }

    function checkConfirmPassword(cpassword, password) {
        if (cpassword === password) {
            document.getElementById('jmessageConfirmPassword').innerHTML = "";
        } else {
            document.getElementById('jmessageConfirmPassword').innerHTML = "Please make sure passwords match";
        }

    }


    function checkEmail(email) {

        if (email.length === 0) {
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("jmessageEmail").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "controller/checkUserNameandEmail.php?email=" + email, true);
            xmlhttp.send();
        }

    }

    function checkEEmail(email) {
        var re = /\S+@\S+\.\S+/;
        if(re.test(email))
        {
            document.getElementById('jmessageEmail').innerHTML = "";
        }
        else{
            document.getElementById('jmessageEmail').innerHTML = "asda";
        }
    }

</script>

</html>