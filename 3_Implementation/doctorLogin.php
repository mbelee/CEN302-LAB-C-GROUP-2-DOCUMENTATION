<?php
require_once "models/Doctor.php";
session_start();
if (isset($_POST['docsub1'])) {
    $doc = Doctor::getDoctorByEmail($_POST['email']);
    if ($doc) {
        if (password_verify($_POST['password'], $doc['password'])) {
            $_SESSION['pid'] = $doc['id'];
            header("Location:doctor-panel.php");
        } else {
            echo "<script> alert('Invalid password!'); 
            window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script> alert('Invalid email!'); 
        window.location.href = 'index.php';</script>";
    }
}


function display_docs()
{
    $doctors = Doctor::getAllDoctors();
    foreach ($doctors as $doc) {
        echo "<option value='$doc->name'>$doc->name</option>";
    }
}