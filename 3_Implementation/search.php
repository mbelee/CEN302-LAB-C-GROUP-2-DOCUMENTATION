<?php
session_start();
require_once 'db-conn.php';
global $con;
if (isset($_POST['search_submit'])) {
    $result = Checkup::getCheckupsByPatientOrDoctor($_POST['contact']);
    echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body style="background-color:#000C40;color:white;text-align:center;padding-top:50px;">
  <div class="container" style="text-align:left;">
  <h3>Search Results</h3><br>
  <table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Appointment Date</th>
      <th>Diagnosis</th>
      <th>Details</th>
      <th>Patient</th>
      <th>Doctor</th>
    </tr>
  </thead>
  <tbody>
  ';
    $cnt = 1;
    foreach ($result as $row) {
        $patient = Patient::getPatientById($row['patient_id']);
        $doctor = Doctor::getDoctorById($row['doctor_id']);
        echo '<tr>
      <td>' . $cnt . '</td>
      <td>' . $row['appointment_date'] . '</td>
      <td>' . $row['diagnosis'] . '</td>
      <td>' . $row['details'] . '</td>
      <td>' . $patient['name'] . " " . $patient['surname'] . '</td>
      <td>' . $doctor['name'] . " " . $doctor['surname'] . '</td>
    </tr>';
        $cnt++;
    }
    echo '</tbody></table></div> 
<div><a href="done/doctor-panel.php" class="btn btn-light">Go Back</a></div>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>';
}