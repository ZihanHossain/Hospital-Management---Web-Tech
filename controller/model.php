<?php

require_once 'db_connect.php';

function addDoctor($data)
{
    $conn = db_conn();
    $query = "INSERT into doctor (full_name, u_name, password, dateofbirth, email, gender) 
           VALUES (:name, :username, :password, :dateofbirth, :email, :gender)";
    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':name' => $data['name'],
            ':username' => $data['username'],
            ':password' => $data['password'],
            ':dateofbirth' => $data['dateofbirth'],
            ':email' => $data['email'],
            ':gender' => $data['gender']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
    return true;
}

function checkDoctorUser($username)
{
    $conn = db_conn();
    $selectQuery = "SELECT u_name FROM `doctor` WHERE u_name = '$username'";


    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetch();
    if(empty($rows))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function checkDoctorEmail($email)
{
    $conn = db_conn();
    $selectQuery = "SELECT email FROM `doctor` WHERE email = '$email'";


    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetch();
    if(empty($rows))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function login($user_name)
{
    $conn = db_conn();
    $selectQuery = "SELECT password, d_id, full_name, u_name FROM `doctor` WHERE u_name LIKE '%$user_name%'";


    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetch();
    return $rows;
}

function viewProfile($user_name)
{
    $conn = db_conn();
    $selectQuery = "SELECT full_name, email, gender, dateofbirth FROM `doctor` WHERE u_name LIKE '%$user_name%'";


    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetch();
    return $rows;
}

function viewPatientProfile($p_id)
{
    $conn = db_conn();
    $selectQuery = "SELECT p_name, gender, dateofbirth FROM `patient` WHERE p_id LIKE '%$p_id%'";


    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetch();
    return $rows;
}

function editProfile($data)
{
    $conn = db_conn();
    $user_name = $_SESSION['user'];
    $query = "UPDATE doctor 
        SET full_name = :name, u_name = :username, dateofbirth = :dateofbirth, 
        email = :email, gender = :gender
        WHERE u_name LIKE '%$user_name%'";
    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':name' => $data['name'],
            ':username' => $data['username'],
            ':dateofbirth' => $data['dateofbirth'],
            ':email' => $data['email'],
            ':gender' => $data['gender']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
    return true;
}

function changePassword($data)
{
    $conn = db_conn();
    $user_name = $_SESSION['user'];
    $query = "UPDATE doctor 
        SET password = :password
        WHERE u_name LIKE '%$user_name%'";
    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':password' => $data
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
    return true;
}

function matchPassword($user_name)
{
    $conn = db_conn();
    $selectQuery = "SELECT password FROM `doctor` WHERE u_name LIKE '%$user_name%'";


    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchColumn();
    return $rows;
}

function showNewAppointments($d_id)
{
    $conn = db_conn();
    $selectQuery = "SELECT p_id FROM `new appointment` WHERE d_id LIKE '%$d_id%'"; //Getting patiend id by the appointed doctor's id.
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $p_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $dataArray = array(); //Cerating an array to hold all the new appointed patients information.
    foreach ($p_ids as $i => $p_id) {
        $pp_id = $p_id['p_id']; //pp_id holds patient id.
        $selectQuery = "SELECT p_id, p_name, gender, dateofbirth FROM `patient` WHERE p_id LIKE '%$pp_id%'";


        try {
            $stmt = $conn->query($selectQuery);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetch();
        array_push($dataArray, $rows);
    }
    return $dataArray;
}

function showOldAppointments($d_id)
{
    $conn = db_conn();
    $selectQuery = "SELECT p_id FROM `old appointment` WHERE d_id LIKE '%$d_id%'"; //Getting patiend id by the appointed doctor's id.
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $p_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $dataArray = array(); //Cerating an array to hold all the new appointed patients information.
    foreach ($p_ids as $i => $p_id) {
        $pp_id = $p_id['p_id']; //pp_id holds patient id.
        $selectQuery = "SELECT p_id, p_name, gender, dateofbirth FROM `patient` WHERE p_id LIKE '%$pp_id%'";


        try {
            $stmt = $conn->query($selectQuery);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetch();
        array_push($dataArray, $rows);
    }
    return $dataArray;
}

function patientDonePHP($p_id)
{
    $conn = db_conn();
    $selectQuery = "SELECT a_id, p_id, d_id, room_num FROM `new appointment` WHERE p_id LIKE '%$p_id%'";

    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $patient = $stmt->fetch();


    if ($patient != null) {
        $selectQuery = "INSERT into `old appointment` (a_id, p_id, d_id, room_num) 
    VALUES (:a_id, :p_id, :d_id, :room_num)";

        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                ':a_id' => $patient['a_id'],
                ':p_id' => $patient['p_id'],
                ':d_id' => $patient['d_id'],
                ':room_num' => $patient['room_num']
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


        $selectQuery = "DELETE FROM `new appointment` WHERE `p_id` = ?";
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$patient['p_id']]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    $conn = null;
}

function medicineByName($name)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `medicine` WHERE m_name LIKE '%$name%'";

    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $medicine = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $medicine;
}

function medicineByCatagory($catagory)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `medicine` WHERE m_catagory LIKE '%$catagory%'";

    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $medicine = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $medicine;
}

function medicineByDisease($disease)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `medicine` WHERE disease LIKE '%$disease%'";

    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $medicine = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $medicine;
}

function allMedicine()
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `medicine`";

    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $medicine = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $medicine;
}

function showMessageRequests($d_id)
{
    $conn = db_conn();
    $selectQuery = "SELECT p_id FROM `messages` WHERE d_id = $d_id AND request_status = 1";

    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $p_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $dataArray = array(); //Cerating an array to hold all the new appointed patients information.
    foreach ($p_ids as $i => $p_id) {
        $pp_id = $p_id['p_id']; //pp_id holds patient id.
        $selectQuery = "SELECT p_name FROM `patient` WHERE p_id LIKE '%$pp_id%'";


        try {
            $stmt = $conn->query($selectQuery);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetch();
        array_push($dataArray, $rows);
    }
    return $dataArray;
}

?>