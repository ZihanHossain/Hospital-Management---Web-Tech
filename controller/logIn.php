<?php

require_once 'model.php';

$info = login($_POST['username']);

if($info != null)
{
if ($info['password'] == $_POST['password']) {
    header("Location: doctorPortal.php");
    $_SESSION['username'] = $info['u_name'];
    $_SESSION['user'] = $info['full_name'];
    $_SESSION['d_id'] = $info['d_id'];
    exit();
}
else{
    $error = "Wrong User Name or Password";
}
}
else{
    $error = "Wrong User Name or Password";
}

?>
