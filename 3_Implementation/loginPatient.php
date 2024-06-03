<?php
require_once 'models/Patient.php';
session_start();
if (isset($_POST['patsub'])) {
    $patient = Patient::getPatientByEmail($_POST['email']);
    if ($patient) {
        if (password_verify($_POST['password'], $patient['password'])) {
            $_SESSION['pid'] = $patient['id'];
            header("Location:patient-panel.php");
        } else {
            echo "<script> alert('Invalid password!'); 
            window.location.href = 'patient-login.php';</script>";
        }
    } else {
        echo "<script> alert('Invalid email!'); 
        window.location.href = 'patient-login.php';</script>";
    }
}