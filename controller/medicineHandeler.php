<?php

require_once 'model.php';
if(isset($_POST['searchBy']))
{
    if($_POST['searchBy'] == "name")
    {
        $medicines = medicineByName($_POST['medicineSearch']);
    }
    if($_POST['searchBy'] == 'catagory')
    {
        $medicines = medicineByCatagory($_POST['medicineSearch']);
    }
    if($_POST['searchBy'] == 'disease')
    {
        $medicines = medicineByDisease($_POST['medicineSearch']);
    }
}
else
{
    $medicines = allMedicine();
}


?>