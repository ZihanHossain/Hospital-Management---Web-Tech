<?php

session_start();
if ($_SESSION['user'] == '') {
    header("Location: login.php");
}

require_once 'controller/patientProfile.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/006416828e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/viewPatientProfile.css">
    <title>Patient Profile</title>
</head>

<header>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <img src="assets/logo.png" width="120" height="120">
            </div>
            <div class="col-sm nav justify-content-end align-self-center">
                <a class="nav-link" href="dashbord.php?flag=dashbord">Welcome <?php echo $_SESSION["user"] ?></a>
                <a class="nav-link" href="login.php?flag='logout">Log out</a>
            </div>
        </div>
    </div>
</header>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="list-group" id="list-tab">
                    <a class="list-group-item list-group-item-action" href="doctorPortal.php">Appoinments</a>
                    <a class="list-group-item list-group-item-action" href="accountViewProfile.php">Doctors Chamber</a>
                    <a class="list-group-item list-group-item-action" href="medicine.php">Medicine</a>
                    <a class="list-group-item list-group-item-action" href="editProfile.php">Messages</a>
                </div>
            </div>
            <div class="col-9 patientInfo">
                <div class="row">
                    <div class="col-4 list-group">
                        <div class="row">
                            <div class="col-6 list-group-item">
                                <span>Name: </span>
                            </div>
                            <div class="col-6 list-group-item">
                                <span><?php if (isset($patient['p_name'])) {
                                            echo $patient['p_name'];
                                        } ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 list-group-item">
                                <span>Age: </span>
                            </div>
                            <div class="col-6 list-group-item">
                                <span><?php
                                        $diff = date_diff(date_create($patient['dateofbirth']), date_create(date("Y-m-d"))); //Getting age from date of birth.
                                        echo $diff->format('%y');
                                        ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 list-group-item">
                                <label for="prescription">Prior Prescription: </label>
                            </div>
                            <div class="col-6 list-group-item">
                                <select name="prescription" id="cars">
                                    <option value="volvo">Volvo</option>
                                    <option value="saab">Saab</option>
                                    <option value="opel">Opel</option>
                                    <option value="audi">Audi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 list-group">
                        <div class="row">
                            <div class="col-6 list-group-item">
                                <span>Gender: </span>
                            </div>
                            <div class="col-6 list-group-item">
                                <span><?php if (isset($patient['p_name'])) {
                                            echo $patient['gender'];
                                        } ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 list-group-item">
                                <span>Date Of Birth: </span>
                            </div>
                            <div class="col-6 list-group-item">
                                <span><?php if (isset($patient['p_name'])) {
                                            echo $patient['dateofbirth'];
                                        } ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="list-group-item">
                                <button>Create A Prescription</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        //image
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>