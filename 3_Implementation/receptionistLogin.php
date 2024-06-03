<?php
session_start();
require_once 'models/Doctor.php';
require_once 'models/Receptionist.php';
if (isset($_POST['adsub'])) {
    $receptionist = Receptionist::getReceptionistByEmail($_POST['email']);
    if ($receptionist) {
        if (password_verify($_POST['password'], $receptionist['password'])) {
            $_SESSION['receptionist'] = $receptionist;
            header("Location: receptionist-panel.php");
        } else {
            echo "<script> alert('Invalid password!'); </script>";
        }
    } else {
        echo "<script> alert('No entries found! Please enter valid details');</script>";
    }
}

function display_docs()
{
    $result = Doctor::getDoctors();
    foreach ($result as $row) {
        echo '<option value="' .$row['id']. '" data-value="'.$row['specialty'].'">'.$row['name']." ".$row['surname'].'</option>';
    }
}
