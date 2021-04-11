<?php

require_once 'model.php';

if(isset($_GET['p_id']))
{
    patientDonePHP($_GET['p_id']);
}

$patients = showNewAppointments($_SESSION['d_id']);


?>

