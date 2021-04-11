<?php

session_start();
if ($_SESSION['user'] == '') {
    header("Location: login.php");
}

require_once 'controller/medicineHandeler.php';

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/006416828e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/medicine.css">
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
                <div class="row">
                    <form method="POST" action="medicine.php">
                        <div>
                            <form method="POST" action="medicine.php">
                                <input type="text" class="form-control" name="medicineSearch">
                                <button class="btn btn-info" name="search">Search</button>
                            <sapn>Search by</sapn>
                            <input type="radio" class="btn-check" name="searchBy" id="name" value="name" autocomplete="off">
                            <label class="btn btn-outline-primary" id="name1" onclick="name_click()">Name</label>

                            <input type="radio" class="btn-check" name="searchBy" id="catagory" value="catagory" autocomplete="off">
                            <label class="btn btn-outline-primary" for="catagory">Catagory</label>

                            <input type="radio" class="btn-check" name="searchBy" id="disease" value="disease" autocomplete="off">
                            <label class="btn btn-outline-primary" for="disease">Disease</label>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <table class="table">
                        <thead class="">
                            <tr>
                                <th>Name</th>
                                <th>Catagory</th>
                                <th>Disease</th>
                            </tr>
                        </thead>
                    </table>
                    <table class="table">
                        <tbody class="">
                            <?php foreach ($medicines as $i => $medicine) :  ?>
                            <tr>
                                <td><a href="#"><?php echo $medicine['m_name'] ?></a></td>
                                <td><a href=""><?php echo $medicine['m_catagory'] ?></a></td>
                                <td><a href=""><?php echo $medicine['disease'] ?></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
function name_click()
{
    document.getElementById("name1").style.background = blue;
    document.getElementById("name1").innerHTML = "blue";
}
</script>
</html>