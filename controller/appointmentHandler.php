<?php

require_once 'model.php';

if(isset($_GET['p_id']))
{
    patientDonePHP($_GET['p_id']);
}


    $newpatients = showNewAppointments($_SESSION['d_id']);

    $oldpatients = showOldAppointments($_SESSION['d_id']); 



?>

