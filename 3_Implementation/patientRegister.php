<?php
session_start();
require_once 'models/Patient.php';
if (isset($_POST['patsub1'])) {
    $patient = Patient::getPatientByEmail($_POST['email']);
    if (!$patient) {
        if ($_POST['password'] == $_POST['cpassword']) {
            $patient = new Patient($_POST['name'], $_POST['father_name'], $_POST['surname'], $_POST['birth_year'], $_POST['gender'], $_POST['email'], $_POST['password'], $_POST['telephone'], $_POST['address'], "");
            $patient=Patient::savePatient($patient);
            $_SESSION['pid'] = $patient->id;
            header("Location:patient-panel.php");
        }
        else {
            echo "<script> alert('Passwords do not match!'); 
            window.location.href = 'patient-login.php';</script>";
        }
    } else {
        echo "<script> alert('Email already exists!'); 
        window.location.href = 'patient-login.php';</script>";
    }
}