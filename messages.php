<?php

session_start();
if ($_SESSION['user'] == '') {
    header("Location: login.php");
}

require_once 'controller/messageHandeler.php';

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/006416828e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/messages.css">
    <title>Portal</title>
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
                    <a class="list-group-item list-group-item-action" href="messages.php">Messages</a>
                </div>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-12">
                        <div class="card text-center">
                            <div class="card-header">
                                Patients
                            </div>
                            <div class="card-body card-group">
                                <?php foreach ($patients as $i => $patient) :  ?>
                                    <div class="card" style="width: 15rem;">
                                        <img src="assets/test.jpg" class="card-img-top" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $patient['p_name'] ?></h5>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</body>

</html>