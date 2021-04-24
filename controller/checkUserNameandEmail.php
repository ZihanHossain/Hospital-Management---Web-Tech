<?php

require_once 'model.php';

if(isset($_GET['username']))
{
    if(checkDoctorUser($_GET['username']))
    {
        echo "User already exist's";
    }
    else{
        echo "";
    }
}

else if(isset($_GET['email']))
{
    if(checkDoctorEmail($_GET['email']))
    {
        echo "Email already exist's";
    }
    else{
        echo "";
    }
}


?>