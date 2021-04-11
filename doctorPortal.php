<?php

session_start();
if ($_SESSION['user'] == '') {
    header("Location: login.php");
}

require_once 'controller/appointmentHandler.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/006416828e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/doctorPortal.css">
    <script src="js/doctorPortal.js"></script>
    <title>Portal</title>
</head>

<header>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <img src="assets/logo.png" width="120" height="120">
            </div>
            <div class="col-sm nav justify-content-end align-self-center">
                <a class="nav-link" href="accountViewProfile.php">Welcome <?php echo $_SESSION["user"] ?></a>
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
                <section>
                    <!--for demo wrap-->
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th colspan="2">Gender</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php $index = 1;
                                foreach ($patients as $i => $patient) : ?>
                                        <tr>
                                            <td><?php echo $index;
                                                $index++; ?></td>
                                            <td><a href="viewPatientProfile.php"><?php echo $patient['p_name'] ?></a></td>
                                            <td>
                                                <?php
                                                $diff = date_diff(date_create($patient['dateofbirth']), date_create(date("Y-m-d"))); //Getting age from date of birth.
                                                echo $diff->format('%y');
                                                ?>
                                            </td>
                                            <td><?php echo $patient['gender'] ?></td>
                                            <td><a href="doctorPortal.php?p_id=<?php echo $patient['p_id'] ?>"><i class="fas fa-check"></i></a></td>
                                        </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>