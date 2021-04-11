<?php

    require_once 'model.php';

    $data['name'] = $_POST['name'];
    $data['email'] = $_POST['email'];
    $data['username'] = $_POST['username'];
    $data['password'] = $_POST['password'];
    $data['gender'] = $_POST['gender'];
    $data['dateofbirth'] = $_POST['dateofbirth'];
    if(checkDoctorUser($_POST['username']))
    {
        $message = "<label class='alert alert-warning'>User already exist's</label>";
    }
    else{
        if(addDoctor($data))
        {
            $message = "<label class='alert alert-success'>Registration Successfull</label>";
        }
    }

    ?>